<?php
// MySQL 데이터베이스 연결 정보
$servername = "4e31b09b-acff-47d0-927a-244edce05073.internal.kr1.mysql.rds.nhncloudservice.com";
$username = "user"; // MySQL 사용자명
$password = "1234"; // MySQL 비밀번호
$dbname = "ticket";

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();

// 사용자 로그인 상태 확인
$is_logged_in = isset($_SESSION['user_id']);
$user_name = $is_logged_in ? $_SESSION['user_name'] : '';
$user_id = $is_logged_in ? $_SESSION['user_id'] : null;

// performance_id 값 가져오기
$performance_id = $_GET['performance_id'];

// performance_id에 해당하는 티켓 정보 가져오기
$sql = "SELECT * FROM performance_information WHERE performance_id = $performance_id";
$result = $conn->query($sql);

// event_name 초기화
$event_name = '';
$event_date = '';
$event_photo = '';
$event_cost = '';
$event_description = '';

if ($result->num_rows > 0) {
    // 데이터가 있는 경우
    $row = $result->fetch_assoc();
    $event_name = $row['event_name'];
    $event_date = $row['event_date'];
    $event_photo = $row['event_photo'];
    $event_cost = $row['event_cost'];
    $event_description = $row['event_description'];
} else {
    $event_name = 'Event not found';
}

// 사용 가능한 좌석 번호를 검색하는 쿼리
$sql_seat = "SELECT seat_number FROM ticket_information WHERE performance_id = ?";
$stmt_seat = $conn->prepare($sql_seat);
$stmt_seat->bind_param("i", $performance_id);
$stmt_seat->execute();
$result_seat = $stmt_seat->get_result();

// 이미 할당된 좌석 번호를 배열에 저장
$assigned_seats = [];
while ($row = $result_seat->fetch_assoc()) {
    $assigned_seats[] = $row['seat_number'];
}
$stmt_seat->close();

// 특정 user_id가 특정 performance_id에서 예약한 좌석 수를 확인하는 쿼리
$sql_user_seat_count = "SELECT COUNT(*) as seat_count FROM ticket_information WHERE user_id = ? AND performance_id = ?";
$stmt_user_seat_count = $conn->prepare($sql_user_seat_count);
$stmt_user_seat_count->bind_param("ii", $user_id, $performance_id);
$stmt_user_seat_count->execute();
$result_user_seat_count = $stmt_user_seat_count->get_result();
$user_seat_count = 0;
if ($result_user_seat_count->num_rows > 0) {
    $row = $result_user_seat_count->fetch_assoc();
    $user_seat_count = $row['seat_count'];
}
$stmt_user_seat_count->close();

// 사용 가능한 좌석 번호를 배열에 저장 (1부터 100까지)
$available_seats = array_diff(range(1, 100), $assigned_seats);
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>좌석 선택</title>
    <style>
        .seat-grid {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            gap: 5px;
            max-width: 600px;
            margin: auto;
        }
        .seat-grid label {
            display: block;
            text-align: center;
        }
        .seat-grid input[type="checkbox"] {
            display: none;
        }
        .seat-grid .seat {
            display: inline-block;
            width: 30px;
            height: 30px;
            background-color: #ddd;
            text-align: center;
            line-height: 30px;
            border: 1px solid #ccc;
            cursor: pointer;
        }
        .seat-grid .seat.checked {
            background-color: #f00;
            color: #fff;
            cursor: not-allowed;
        }
        .seat-grid .seat.selected {
            background-color: #0f0;
        }
        .screen {
            grid-column: span 10;
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .selected-seats {
            margin-top: 20px;
        }
        .error-message {
            color: red;
            font-weight: bold;
        }
        .seat-selection-container {
            text-align: center;
        }
        .selected-seats {
            margin-bottom: 10px;
        }
        .selected-seats ul {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .selected-seats li {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 3px;
            padding: 5px 10px;
            margin-right: 10px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <h2><?php echo htmlspecialchars($event_name); ?> 좌석 선택</h2>
    <div class="seat-selection-container">
        <div class="selected-seats">
            <h3>좌석 선택</h3>
            <ul id="selected-seats-list"></ul>
        </div>
        <form id="reservation-form" method="post" action="reserve_ticket.php">
    <input type="hidden" name="performance_id" value="<?php echo htmlspecialchars($performance_id); ?>">
    <input type="hidden" id="selected-seats-hidden" name="selected_seats" value="">
    <div class="seat-grid">
        <div class="screen">STAGE</div>
        <?php for ($seat = 1; $seat <= 100; $seat++): ?>
            <label>
                <input type="checkbox" name="seat_number[]" value="<?php echo htmlspecialchars($seat); ?>"
                    <?php if (in_array($seat, $assigned_seats) || $user_seat_count >= 2) echo 'checked disabled'; ?>>
                <div class="seat <?php if (in_array($seat, $assigned_seats)) echo 'checked'; ?>" data-seat="<?php echo htmlspecialchars($seat); ?>">
                    <?php echo htmlspecialchars($seat); ?>
                </div>
            </label>
        <?php endfor; ?>
    </div>
    <br><br>
    <input type="submit" value="좌석 예매">
</form>
<div id="error-message" class="error-message"></div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const seatElements = document.querySelectorAll('.seat-grid .seat');
    const selectedSeatsList = document.getElementById('selected-seats-list');
    const form = document.getElementById('reservation-form');
    const errorMessage = document.getElementById('error-message');
    const selectedSeatsHidden = document.getElementById('selected-seats-hidden');

    function updateErrorMessage() {
        const selectedSeats = document.querySelectorAll('.seat-grid .seat.selected');
        if (selectedSeats.length === 0) {
            errorMessage.textContent = '좌석을 선택하지 않았습니다.';
        } else if (selectedSeats.length > 2) {
            errorMessage.textContent = '최대 2개의 좌석만 선택할 수 있습니다.';
        } else {
            errorMessage.textContent = '';
        }
    }

    function updateSelectedSeatsHidden() {
        const selectedSeats = document.querySelectorAll('.seat-grid .seat.selected');
        const selectedSeatsArray = Array.from(selectedSeats).map(seat => seat.getAttribute('data-seat'));
        selectedSeatsHidden.value = selectedSeatsArray.join(',');
    }

    seatElements.forEach(seat => {
        seat.addEventListener('click', function () {
            const seatNumber = this.getAttribute('data-seat');
            const selectedSeats = document.querySelectorAll('.seat-grid .seat.selected');
            if (this.classList.contains('checked') || this.classList.contains('selected')) {
                this.classList.remove('selected');
                // Remove from list
                const listItem = document.querySelector(`li[data-seat="${seatNumber}"]`);
                if (listItem) {
                    listItem.remove();
                }
            } else {
                if (selectedSeats.length >= 2) {
                    errorMessage.textContent = '최대 2개의 좌석만 선택할 수 있습니다.';
                    return; // 2개 이상 선택할 수 없도록
                }
                this.classList.add('selected');
                // Add to list
                const listItem = document.createElement('li');
                listItem.setAttribute('data-seat', seatNumber);
                listItem.textContent = `Seat ${seatNumber}`;
                selectedSeatsList.appendChild(listItem);
            }
            updateErrorMessage();
            updateSelectedSeatsHidden();
        });
    });

    form.addEventListener('submit', function (event) {
        const selectedSeats = document.querySelectorAll('.seat-grid .seat.selected');
        if (selectedSeats.length === 0) {
            errorMessage.textContent = '좌석을 선택하지 않았습니다.';
            event.preventDefault(); // 폼 제출 막기
        } else if (selectedSeats.length > 2) {
            errorMessage.textContent = '최대 2개의 좌석만 선택할 수 있습니다.';
            event.preventDefault(); // 폼 제출 막기
        } else {
            errorMessage.textContent = '';
            updateSelectedSeatsHidden();
        }
    });
});
</script>
</body>
</html>

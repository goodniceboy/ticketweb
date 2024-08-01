<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>티켓 구매 결과</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1 class="title">티켓 구매 결과</h1>
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

        if ($_SERVER["REQUEST_METHOD"] == "POST" && $is_logged_in) {
            // POST 데이터 가져오기
            $performance_id = $_POST['performance_id'];
            $selected_seats = explode(',', $_POST['selected_seats']);

            // performance_information에서 데이터 가져오기
            $sql = "SELECT event_date, event_name, event_cost FROM performance_information WHERE performance_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $performance_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // 데이터가 있는 경우
                $row = $result->fetch_assoc();
                $event_date = $row['event_date'];
                $event_name = $row['event_name'];
                $event_cost = $row['event_cost'];

                // 사용자별 좌석 수 확인
                $sql_check = "SELECT COUNT(*) AS seat_count FROM ticket_information WHERE performance_id = ? AND user_id = ?";
                $stmt_check = $conn->prepare($sql_check);
                $stmt_check->bind_param("ii", $performance_id, $user_id);
                $stmt_check->execute();
                $check_result = $stmt_check->get_result();
                $check_row = $check_result->fetch_assoc();
                $existing_seat_count = $check_row['seat_count'];

                if ($existing_seat_count + count($selected_seats) > 2) {
                    echo "<div class='error'>한 계정당 좌석 2개까지 예약할 수 있습니다.</div>";
                } else {
                    $success = true;
                    foreach ($selected_seats as $seat_number) {
                        // ticket_information에 데이터 삽입
                        $sql_insert = "INSERT INTO ticket_information (performance_id, event_date, event_name, event_cost, seat_number, user_id) VALUES (?, ?, ?, ?, ?, ?)";
                        $stmt_insert = $conn->prepare($sql_insert);
                        $stmt_insert->bind_param("issdii", $performance_id, $event_date, $event_name, $event_cost, $seat_number, $user_id);

                        if ($stmt_insert->execute()) {
                            // 각 좌석에 대해 성공 메시지 출력
                            echo "<div class='congratulations'>";
                            echo "<p> 예약에 성공했습니다!</p>";
                            echo "<p>공연 이름 : " . htmlspecialchars($event_name) . "</p>";
                            echo "<p>좌석 번호 : " . htmlspecialchars($seat_number) . "</p>";
                            echo "<p>공연 날짜 : " . htmlspecialchars($event_date) . "</p>";
                            echo "<p>공연 비용 : " . htmlspecialchars($event_cost) . "</p>";
                            echo "</div><div class='divider'></div>";
                        } else {
                            $success = false;
                            echo "<div class='error'>Error: " . $stmt_insert->error . "</div>";
                        }

                        $stmt_insert->close();
                    }

                    if ($success) {
                        echo "<div class='details'>";
                        echo "<p>예약한 좌석: " . htmlspecialchars(implode(', ', $selected_seats)) . "</p>";
                        echo "</div>";
                    }
                }

                $stmt_check->close();
            } else {
                echo "<div class='error'>Event not found.</div>";
            }

            $stmt->close();
        } elseif (!$is_logged_in) {
            echo "<div class='error'>로그인 후 이용 가능합니다.</div>";
        }

        $conn->close();
        ?>
        <a href="index.php" class="back-button">홈</a>
        <a href="mypage.php" class="back-button">마이페이지</a>
    </div>
</body>
</html>

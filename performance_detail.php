<?php
session_start();

// 사용자 로그인 상태 확인
$is_logged_in = isset($_SESSION['user_id']);
$user_name = $is_logged_in ? $_SESSION['user_name'] : '';
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Tooplate">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>ArtXibition HTML Event Template</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" type="text/css" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/tooplate-artxibition.css">
<!--

Tooplate 2125 ArtXibition

https://www.tooplate.com/view/2125-artxibition

-->
    </head>
    
    <body>
    
    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
      <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
    <!-- ***** Preloader End ***** -->
    <!-- ***** Pre HEader ***** -->
     <?php if (!$is_logged_in): ?>
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <span>티켓팅 사이트에 온 것을 환영합니다!</span>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="text-button">
                        <a href="login.php">로그인<i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <!-- ***** Navbar ***** -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="nav-link">안녕하세요, <strong><?php echo htmlspecialchars($user_name); ?>님</strong></span>
                </li>
                <li class="nav-item">
                    <a class="btn btn-danger" href="logout.php">로그아웃</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php endif; ?>
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.php" class="logo">Intra<em>park</em></a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="musical.php" class="active">뮤지컬</a></li>
                            <li><a href="concert.php">콘서트</a></li>
                            <li><a href="sports.php">스포츠</a></li>
                            <li><a href="mypage.php">마이페이지</a></li> 
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

  

    <!-- ***** About Us Page ***** -->
    <div class="page-heading-shows-events">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Tickets On Sale Now!</h2>
                    <span>Check out upcoming and past shows & events and grab your ticket right now.</span>
                </div>
            </div>
        </div>
    </div>

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

// 데이터베이스 연결 종료
$conn->close();
?>




    <div class="ticket-details-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="left-image">
                        <img src=<?php echo htmlspecialchars($event_photo); ?> alt="">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="right-content">
                        <h4><?php echo htmlspecialchars($event_name); ?></h4>
                        <span>ticket information</span>
                        <ul>
                            <li><i class="fa fa-clock-o"></i> 24-07-18 Thursday 18:00 to 22:00</li>
                            <li><i class="fa fa-map-marker"></i> E9 308, CBNU</li>
                        </ul>
                        <div class="quantity-content">
                            <div class="left-content">
                                <h6>Standard Ticket</h6>
                                <p>$<?php echo htmlspecialchars($event_cost); ?>per ticket</p>
                            </div>
                            <div class="right-content">
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="2" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button" value="+" class="plus">
                                </div>
                            </div>
                        </div>
                        <div class="total">
                        <h4 id="total-price">Total: $<?php echo htmlspecialchars($event_cost); ?></h4>

    <div class="main-dark-button">
        <a href="purchase_ticket.php?performance_id=<?php echo htmlspecialchars($performance_id); ?>">Purchase Tickets</a>
    </div>
</div>
<div class="warn">
    <!-- 경고 메시지나 추가 정보가 필요할 경우 여기에 추가하세요. -->
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- *** Subscribe *** -->
    <div class="subscribe">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h4>Subscribe Our Newsletter:</h4>
                </div>
                <div class="col-lg-8">
                    <form id="subscribe" action="" method="get">
                        <div class="row">
                            <div class="col-lg-9">
                                <fieldset>
                                    <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email Address" required="" />
                                </fieldset>
                            </div>
                            <div class="col-lg-3">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="main-dark-button">Submit</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- *** Footer *** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="address">
                        <h4>인트라파크(주) 주소</h4>
                        <span>충청북도 청주시 <br />서원구 개신동<br />충대로1</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="links">
                        <h4>공지</h4>
                            <li>이 홈페이지는 NHN 클라우드 기반의 </li>
                            <li>웹서비스 프로젝트입니다.</li>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="hours">
                        <h4>고객센터 전화번호</h4>
                        <ul>
                            <li>Mon to Fri: 10:00 AM to 8:00 PM</li>
                            <li>Sat - Sun: 11:00 AM to 4:00 PM</li>
                            <li>043-1234-5678</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="under-footer">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <p>intrapark</p>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <p class="copyright">
                                    Copyright 2024 Intrapark
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="sub-footer">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="logo">
                                    <span>Intra<em>park</em></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu">
                                    <ul>
                                        <li><a href="musical.php" class="active">뮤지컬</a></li>
                                        <li><a href="concert.php">콘서트</a></li>
                                        <li><a href="sports.php">스포츠</a></li>
                                        <li><a href="mypage.php">마이페이지</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="social-links">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script> 
    <script src="assets/js/mixitup.js"></script> 
    <script src="assets/js/accordions.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/quantity.js"></script>
    
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // 요소 참조
    const quantityInput = document.querySelector('input[name="quantity"]');
    const totalPriceElement = document.getElementById('total-price');
    const unitPrice = parseFloat("<?php echo htmlspecialchars($event_cost); ?>");

    // 수량 변경 시 총 가격 업데이트
    function updateTotalPrice() {
        const quantity = parseInt(quantityInput.value, 10);
        const totalPrice = unitPrice * quantity;
        totalPriceElement.textContent = `Total: $${totalPrice.toFixed(2)}`;
    }

    // 수량 입력 필드에 이벤트 리스너 추가
    quantityInput.addEventListener('input', updateTotalPrice);

    // 수량 증가 버튼 클릭 시 이벤트 처리
    document.querySelector('.plus').addEventListener('click', function() {
        quantityInput.stepUp();
        updateTotalPrice();
    });

    // 수량 감소 버튼 클릭 시 이벤트 처리
    document.querySelector('.minus').addEventListener('click', function() {
        quantityInput.stepDown();
        updateTotalPrice();
    });

    // 초기 로드 시 총 가격 설정
    updateTotalPrice();
});
</script>


  </body>

</html>
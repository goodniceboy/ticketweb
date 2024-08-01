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
                        <a href="login.html">로그인<i class="fa fa-arrow-right"></i></a>
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
    <!-- ***** Navbar ***** -->
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
                            <li>
                                <a href="<?php echo $is_logged_in ? 'mypage.php' : 'login.php'; ?>">
                                     <?php echo $is_logged_in ? '마이페이지' : '로그인'; ?>
                                  </a>
                            </li>
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

    
    <!-- *** Venues & Tickets ***-->
    <div class="venue-tickets">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>뮤지컬</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="venue-item">
                        <div class="thumb">
                            <img src="assets/images/m3.png" alt="">
                        </div>
                        <div class="down-content">
                            <div class="left-content">
                                <div class="main-white-button">
                                    <a href="performance_detail.php?performance_id=7">Purchase Tickets</a>
                                </div>
                            </div>
                            <div class="right-content">
                                <h4>베르사유의 장미</h4>
                                <p>프랑스 혁명 격변기에 피어난 비극적 사랑!<br>어디서도 만날 수 없었던 매력적인 캐릭터의 향연</p>
                                
                               
                                <div class="price">
                                    <span>1 ticket<br>from <em>$45</em></span>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="venue-item">
                        <div class="thumb">
                            <img src="assets/images/m1.png" alt="">
                        </div>
                        <div class="down-content">
                            <div class="left-content">
                                <div class="main-white-button">
                                    <a href="performance_detail.php?performance_id=8">Purchase Tickets</a>
                                </div>
                            </div>
                            <div class="right-content">
                                <h4>영웅</h4>
                                <p>안중근 의거 100주년 기념 뮤지컬 영웅<br>나라를 위한 이들에 위대한 여정이 시작된다!</p>
                                
                                <div class="price">
                                    <span>1 ticket<br>from <em>$55</em></span>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="venue-item">
                        <div class="thumb">
                            <img src="assets/images/m2.png" alt="">
                        </div>
                        <div class="down-content">
                            <div class="left-content">
                                <div class="main-white-button">
                                    <a href="performance_detail.php?performance_id=9">Purchase Tickets</a>
                                </div>
                            </div>
                            <div class="right-content">
                                <h4>프랑켄슈타인</h4>
                                <p>"교만한 창조주여, 그동안 내가 겪은 세상을,<br>불행을 그대로 돌려주리라!"</p>
                              
                                <div class="price">
                                    <span>1 ticket<br>from <em>$65</em></span>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="venue-item">
                        <div class="thumb">
                            <img src="assets/images/m4.png" alt="">
                        </div>
                        <div class="down-content">
                            <div class="left-content">
                                <div class="main-white-button">
                                    <a href="performance_detail.php?performance_id=10">Purchase Tickets</a>
                                </div>
                            </div>
                            <div class="right-content">
                                <h4>시카고</h4>
                                <p>시선을 뗼 수 없는 관능적인 배우!<br>화려한 동작 속의 사회 풍자 그리고 유머</p>
                                
                                <div class="price">
                                    <span>1 ticket<br>from <em>$55</em></span>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="venue-item">
                        <div class="thumb">
                            <img src="assets/images/m6.png" alt="">
                        </div>
                        <div class="down-content">
                            <div class="left-content">
                                <div class="main-white-button">
                                    <a href="performance_detail.php?performance_id=11">Purchase Tickets</a>
                                </div>
                            </div>
                            <div class="right-content">
                                <h4>하데스 타운</h4>
                                <p>수천년전 신화의 새로운 변주!<br>지금 여기, 슬프고도 오래된 사랑이야기</p>
                               
                                <div class="price">
                                    <span>1 ticket<br>from <em>$55</em></span>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="venue-item">
                        <div class="thumb">
                            <img src="assets/images/m5.png" alt="">
                        </div>
                        <div class="down-content">
                            <div class="left-content">
                                <div class="main-white-button">
                                    <a href="performance_detail.php?performance_id=12">Purchase Tickets</a>
                                </div>
                            </div>
                            <div class="right-content">
                                <h4>등등곡</h4>
                                <p>"선비 집안의 자제들이 미친 척 노래하고, 춤추고<br>웃고, 울고 별짓을 다해 이를 등등곡이라 했었다.</p>
                                
                                <div class="price">
                                    <span>1 ticket<br>from <em>$55</em></span>
                                </div>
                            </div> 
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
    
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

  </body>
</html>
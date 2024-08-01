<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Tooplate">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <title>로그인</title>
    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="assets/css/owl-carousel.css">
    <link rel="stylesheet" href="assets/css/tooplate-artxibition.css">
    <link rel="stylesheet" href="assets/css/my-login.css">
</head>
<body class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <a href="index.php" class="logo">
                            <img src="assets/images/intra.png" alt="logo">
                    </div>
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title">로그인</h4>
                            <form method="POST" action="" class="my-login-validation" novalidate="">
                                <div class="form-group">
                                    <label for="email">아이디</label>
                                    <input id="email" type="email" class="form-control" name="email" required autofocus>
                                    <div class="invalid-feedback">
                                        Email is invalid
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password">비밀번호
                                        <a href="forgot.html" class="float-right">
                                            비밀번호 찾기
                                        </a>
                                    </label>
                                    <input id="password" type="password" class="form-control" name="password" required data-eye>
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" name="remember" id="remember" class="custom-control-input">
                                        <label for="remember" class="custom-control-label">로그인 상태 유지</label>
                                    </div>
                                </div>

                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        로그인
                                    </button>
                                </div>
                                <div class="mt-4 text-center">
                                    아이디가 없으신가요? <a href="register.html">회원 가입</a>
                                </div>
                            </form>

                            <?php
                            session_start(); // 세션 시작

                            // 데이터베이스 연결
                            $servername = "4e31b09b-acff-47d0-927a-244edce05073.internal.kr1.mysql.rds.nhncloudservice.com";
                            $username = "user"; // MySQL 사용자명
                            $password = "1234"; // MySQL 비밀번호
                            $dbname = "ticket";

                            // 연결 생성
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // 연결 확인
                            if ($conn->connect_error) {
                                die("연결 실패: " . $conn->connect_error);
                            }

                            // POST 요청 처리
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $email = $_POST['email']; // 사용자 이름(이메일 주소)
                                $password = $_POST['password'];

                                // 사용자 정보 조회
                                $sql = "SELECT id, name, password FROM Users WHERE username = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s", $email);
                                $stmt->execute();
                                $stmt->store_result();

                                if ($stmt->num_rows > 0) {
                                    $stmt->bind_result($id, $name, $hashed_password);
                                    $stmt->fetch();

                                    // 비밀번호 검증
                                    if (password_verify($password, $hashed_password)) {
                                        // 로그인 성공 시 세션에 사용자 정보 저장
                                        $_SESSION['user_id'] = $id;
                                        $_SESSION['user_name'] = $name;
                                        header("Location: welcome.php"); // 로그인 후 리디렉션
                                        exit();
                                    } else {
                                        echo "<div class='alert alert-danger mt-4'>잘못된 비밀번호입니다.</div>";
                                    }
                                } else {
                                    echo "<div class='alert alert-danger mt-4'>등록된 이메일이 없습니다.</div>";
                                }

                                $stmt->close();
                            }

                            $conn->close();
                            ?>
                        </div>
                    </div>
                    <div class="footer">
                        Copyright &copy; 2024 &mdash; 인트라파크
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/my-login.js"></script>
</body>
</html>
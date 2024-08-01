<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Kodinger">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>My Login Page &mdash; Bootstrap 4 Login Page Snippet</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/my-login.css">
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
                        </a>
                    </div>
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title">회원 가입</h4>
                            <form method="POST" action="" id="signup-form" class="my-login-validation" novalidate="">
                                <div class="form-group">
                                    <label for="name">이름</label>
                                    <input id="name" type="text" class="form-control" name="name" required autofocus>
                                    <div class="invalid-feedback">
                                        이름을 입력해 주세요.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email">아이디</label>
                                    <input id="email" type="email" class="form-control" name="email" required>
                                    <div class="invalid-feedback">
                                        유효한 이메일 주소를 입력해 주세요.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password">비밀번호</label>
                                    <input id="password" type="password" class="form-control" name="password" required data-eye>
                                    <div class="invalid-feedback">
                                        비밀번호를 입력해 주세요.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" name="agree" id="agree" class="custom-control-input" required="">
                                        <label for="agree" class="custom-control-label">이용 약관에 동의합니다.</label>
                                        <div class="invalid-feedback">
                                            이용 약관에 동의해 주세요.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        회원 가입
                                    </button>
                                </div>
                                <div class="mt-4 text-center">
                                    이미 계정이 있으신가요? <a href="login.php">로그인</a>
                                </div>
                            </form>

                            <?php
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                // 데이터베이스 연결
                                $servername = "localhost";
                                $username = "root"; // MySQL 사용자명
                                $password = "tjrwls0802"; // MySQL 비밀번호
                                $dbname = "ticket";

                                // 연결 생성
                                $conn = new mysqli($servername, $username, $password, $dbname);

                                // 연결 확인
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // 폼 데이터 가져오기
                                $name = $_POST['name'];
                                $email = $_POST['email'];
                                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

                                // SQL 쿼리
                                $sql = "INSERT INTO Users (name, username, password) VALUES (?, ?, ?)";

                                // Prepare and bind
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("sss", $name, $email, $password);

                                // Execute the statement
                                if ($stmt->execute()) {
                                    // 회원가입 성공 시 리디렉션
                                    header("Location: login.php");
                                    exit();
                                } else {
                                    // 회원가입 실패 시 에러 메시지 출력
                                    echo "<div class='alert alert-danger mt-4'>Error: " . $sql . "<br>" . $conn->error . "</div>";
                                }

                                // Close connection
                                $stmt->close();
                                $conn->close();
                            }
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

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-AvMv1j2D4xFE3JO2xN7nxr1ao3TFSKpP8/af7hX5YZ+ovXWnvoSR/s6X5p6sw7/i" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

<?php
session_start();

// 로그인 확인
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// 사용자 이름 가져오기
$user_name = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>환영합니다</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            color: #495057;
        }
        .welcome-section {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
        }
        .welcome-section h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .btn-custom {
            font-size: 1rem;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 10px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-main {
            background-color: #007bff;
        }
        .btn-main:hover {
            background-color: #0056b3;
        }
        .btn-mypage {
            background-color: #28a745;
        }
        .btn-mypage:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="nav-link">안녕하세요, <?php echo htmlspecialchars($user_name); ?>님</span>
                </li>
                <li class="nav-item">
                    <a class="btn btn-danger" href="logout.php">로그아웃</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="welcome-section">
            <h1>환영합니다, <?php echo htmlspecialchars($user_name); ?>님!</h1>
            <p>아래 버튼을 클릭하여 원하는 페이지로 이동하세요.</p>
            <a class="btn btn-custom btn-main" href="index.php">메인페이지</a>
            <a class="btn btn-custom btn-mypage" href="mypage.php">마이페이지</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

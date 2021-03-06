<?php
    include './controller/inc_head.php';
    $jb_login = get_session_state();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="./css/login.css" rel="stylesheet">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
</head>

<body>
<?php
    if( $jb_login ) {
        header( 'Location: /' );
    }else{
?>

<div class="sidenav">
    <div class="login-main-text">
        <h2>PopupStore<br> Login Page</h2>
        <p>Login or register from here to access.</p>
    </div>
</div>
<div class="main">
    <div class="col-md-6 col-sm-12">
        <div class="login-form">
            <form action="./controller/login.php" method="post">
                <div class="form-group">
                    <label>아이디</label>
                    <input type="text" class="form-control" name="userid" placeholder="아이디 입력">
                </div>
                <div class="form-group">
                    <label>비밀번호</label>
                    <input type="password" class="form-control" name="password" placeholder="비밀번호 입력">
                </div>
                <button type="submit" class="btn btn-black">로그인</button>
                <button type="button" onclick="location.href = './registration.html'" class="btn btn-secondary">회원가입</button>
            </form>
        </div>
    </div>
</div>
<?php }
    ?>
</body>
</html>
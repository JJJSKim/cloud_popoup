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
        <title>샘플 팝업스토어</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="bg-dark navbar navbar-expand-lg navbar-dark bg-light">
            <div class="container px-4 px-lg-5">
                <a class="text-white fw-bold navbar-brand" href="/">샘플 팝업스토어</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="text-white nav-link active" aria-current="page" href="#!">Home</a></li>
                        <li class="nav-item"><a class="text-white nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="text-white  nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="bg-dark border-light dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="text-white dropdown-item bg-dark" href="#!">모든 카테고리</a></li>
                                <li><hr class="text-white dropdown-divider" /></li>
                                <li><a class="text-white dropdown-item bg-dark" href="#!">인기 품목</a></li>
                                <li><a class="text-white dropdown-item bg-dark" href="#!">신규 품목</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="text-white nav-link dropdown-toggle" id="navbarAccount" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">계정 설정</a>
                            <ul class="bg-dark border-light dropdown-menu" aria-labelledby="navbarAccount">
                                <!--<li><a class="text-white dropdown-item bg-dark" href="#!">(계정 이름)</a></li>-->
                                <?php if($jb_login){?>
                                <li><a class="text-white dropdown-item bg-dark" href="./controller/logout.php">로그아웃</a></li>
                                <?php }else{?>
                                <li><a class="text-white dropdown-item bg-dark" href="login.php">로그인</a></li>
                                <?php }?>
                                <li><hr class="text-white dropdown-divider" /></li>
                                <!--<li><a class="text-white dropdown-item bg-dark" href="#!">계정 설정</a></li>-->
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5 header_bg_img" style="background-image:  url('./assets/images/banner.png')">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">회원가입이 완료되었습니다!</h1>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-primary" onclick="location.href = './#'" type="button">장바구니</button>
                        <button class="btn btn-secondary" onclick="location.href = '/'" type="button">홈으로 이동</button>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>

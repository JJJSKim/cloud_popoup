<?php
include './controller/inc_head.php';
$jb_login = get_session_state();
if (empty($_POST) && !empty($_GET[ 'id' ]))
{
    header('Location: ./controller/detail.php?id='.$_GET[ 'id' ]);
}else if (!empty($_POST)){
    $_p_id = $_POST[ '_p_id' ];
    $_p_name = $_POST[ '_p_name' ];
    $_p_stock = $_POST[ '_p_stock' ];
    $_p_value = $_POST[ '_p_value' ];
    $_p_description = $_POST[ '_p_description' ];
    $_p_ins_date = $_POST[ '_p_ins_date' ];
    $_p_update_date = $_POST[ '_p_update_date' ];
    $_p_options = json_decode($_POST[ '_p_options' ]);
}else{
    echo "<script>";
    echo "alert('잘못된 접근입니다.');";
    echo 'window.location.href = "/";';
    echo "</script>";
}
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
        <link href="css/detail.css" rel="stylesheet" />
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
        <!-- Section-->
        <div class="container px-4 px-lg-5 mt-5">
            <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
                <div class="col-md-5 p-lg-5 mx-auto my-5">
                    <h1 class="display-4 font-weight-normal"><?php echo $_p_name; ?></h1>
                    <p class="lead font-weight-normal"><?php echo $_p_description; ?></p>
                    <p class="lead font-weight-normal"><?php echo number_format($_p_value); ?>₩ 부터</p>
                    <select class="form-select" id="store_option" aria-label="Default select example">
                        <option value="null" selected>옵션 선택</option>
                        <option value="0"><?php echo $_p_options[0]->name ?> | <?php echo number_format($_p_options[0]->value); ?>₩</option>
                        <option value="1"><?php echo $_p_options[1]->name ?> | <?php echo number_format($_p_options[1]->value); ?>₩</option>
                    </select>
                    <br/>
                    <button type="button" onclick="order_func();" class="btn btn-primary">구매</button>
                </div>
                <div class="product-device box-shadow d-none d-md-block"></div>
                <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
            </div>

            <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3 detail-view_set">
                <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
                    <div class="my-3 py-3">
                        <h2 class="display-5">Another headline</h2>
                        <p class="lead">And an even wittier subheading.</p>
                    </div>
                    <div class="bg-light box-shadow mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
                </div>
                <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
                    <div class="my-3 p-3">
                        <h2 class="display-5">Another headline</h2>
                        <p class="lead">And an even wittier subheading.</p>
                    </div>
                    <div class="bg-dark box-shadow mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
                </div>
            </div>

            <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3 detail-view_set">
                <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
                    <div class="my-3 py-3">
                        <h2 class="display-5">Another headline</h2>
                        <p class="lead">And an even wittier subheading.</p>
                    </div>
                    <div class="bg-light box-shadow mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
                </div>
                <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
                    <div class="my-3 p-3">
                        <h2 class="display-5">Another headline</h2>
                        <p class="lead">And an even wittier subheading.</p>
                    </div>
                    <div class="bg-dark box-shadow mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
                </div>
            </div>
            <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3 detail-view_set">
                <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
                    <div class="my-3 py-3">
                        <h2 class="display-5">Another headline</h2>
                        <p class="lead">And an even wittier subheading.</p>
                    </div>
                    <div class="bg-light box-shadow mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
                </div>
                <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
                    <div class="my-3 p-3">
                        <h2 class="display-5">Another headline</h2>
                        <p class="lead">And an even wittier subheading.</p>
                    </div>
                    <div class="bg-dark box-shadow mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
                </div>
            </div>
            <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3 detail-view_set">
                <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
                    <div class="my-3 py-3">
                        <h2 class="display-5">Another headline</h2>
                        <p class="lead">And an even wittier subheading.</p>
                    </div>
                    <div class="bg-light box-shadow mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
                </div>
                <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
                    <div class="my-3 p-3">
                        <h2 class="display-5">Another headline</h2>
                        <p class="lead">And an even wittier subheading.</p>
                    </div>
                    <div class="bg-dark box-shadow mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="/assets/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script src="/js/jquery-1.12.4.min.js"></script>
        <script type="text/javascript">

            function order_func(){
                let option_val = $("#store_option option:selected").val();
                if(option_val == 'null'){
                    $("#store_option").css({'border-color':'red'});
                }else{
                    location.href="/controller/order.php?id=1&option="+option_val;
                }

            }
        </script>
    </body>

</html>

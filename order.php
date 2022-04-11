<?php
include './controller/inc_head.php';
$jb_login = get_session_state();
if (empty($_POST) && !empty($_GET[ 'id' ]))
{
    header('Location: ./controller/order.php?id='.$_GET[ 'id' ]);
}else if (!empty($_POST)){
    $_p_id = $_POST[ '_p_id' ];
    $_p_name = $_POST[ '_p_name' ];
    $_p_stock = $_POST[ '_p_stock' ];
    $_p_value = $_POST[ '_p_value' ];
    $_p_description = $_POST[ '_p_description' ];
    $_p_ins_date = $_POST[ '_p_ins_date' ];
    $_p_update_date = $_POST[ '_p_update_date' ];
    $_p_options = json_decode($_POST[ '_p_options' ]);
    $_p_u_name = $_POST[ '_p_u_name' ];
    $_p_u_mobile = $_POST[ '_p_u_mobile_num' ];
    $_p_u_address = $_POST[ '_p_u_address' ];
    $_p_u_id = $_POST[ '_p_u_id' ];
    $_p_u_mobile_num = $_POST[ '_p_u_mobile_num' ];

}else{
    echo "<script>";
    echo "alert('잘못된 접근입니다.');";
    echo 'window.location.href = "/";';
    echo "</script>";
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Checkout example for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>

  <body class="bg-light">

    <div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h2>결제 정보 입력</h2>
        <p class="lead"></p>
      </div>

      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">결제 품목</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0"><?php echo $_p_name;  ?></h6>
              </div>
              <span class="text-muted"><?php echo number_format($_p_value);  ?>₩</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0"><?php echo $_p_options[0]->name ?></h6>
              </div>
              <span class="text-muted"><?php echo number_format($_p_options[0]->value); ?>₩</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>총합 </span>
              <strong><?php echo number_format($_p_value + $_p_options[0]->value)?>₩</strong>
            </li>
          </ul>

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">청구 주소</h4>
          <form class="needs-validation" action="./controller/order_process.php"  method="post" novalidate>
            <div class="row">
              <div class="mb-3">
                <label for="lastName">이름 *</label>
                <input type="text" class="form-control" name="username" id="lastName" placeholder="" value="<?php echo $_p_u_name?>" required>
                <div class="invalid-feedback">
                  이름은 필수입니다.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">이메일</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com">
              <div class="invalid-feedback">
                정확한 이메일 주소를 입력해주세요
              </div>
            </div>

            <div class="mb-3">
              <label for="address">주소 *</label>
              <input type="text" class="form-control" name="address" id="address" value="<?php echo $_p_u_address ?>" placeholder="주소 정보를 입력해주세요" required>
              <div class="invalid-feedback">
                배송지 주소를 입력해주세요
              </div>
            </div>

            <div class="mb-3">
              <label for="address2">상세 주소</label>
              <input type="text" class="form-control" name="address2" id="address2" placeholder="상세 주소를 입력해주세요">
            </div>
            <hr class="mb-4">

            <h4 class="mb-3">결제</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                <label class="custom-control-label" for="credit">신용카드</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="paypal">페이팔</label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="cc-name">카드 소유주</label>
                <input type="text" class="form-control" name="cc_name" id="cc-name" placeholder="" required>
                <small class="text-muted">카드의 전체 이름을 입력해야 합니다.</small>
                <div class="invalid-feedback">
                  카드 소유주는 필수 항목입니다.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="cc-number">카드 번호</label>
                <input type="text" class="form-control" name="cc_number" id="cc-number" placeholder="" required>
                <div class="invalid-feedback">
                  카드 번호는 필수 항목입니다.
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">만료일</label>
                <input type="text" class="form-control" name="cc_expiration" id="cc-expiration" placeholder="" required>
                <div class="invalid-feedback">
                  만료일은 필수 항목입니다.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">CVV</label>
                <input type="text" class="form-control" name="cc_cvv" id="cc-cvv" placeholder="" required>
                <div class="invalid-feedback">
                  시큐리티 코드는 필수 항목입니다.
                </div>
              </div>
                <div class="col-md-3 mb-3" hidden>
                    <input type="text" class="form-control" value="<?php echo($_p_id); ?>" name="p_id" id="p_id"  placeholder="" required>
                    <input type="text" class="form-control" value="<?php echo($_p_u_id); ?>" name="usr_id" id="usr_id"  placeholder="" required>
                    <input type="text" class="form-control" value="<?php echo($_p_value); ?>" name="p_value" id="p_value"  placeholder="" required>
                    <input type="text" class="form-control" value="<?php echo($_p_u_mobile_num); ?>" name="p_u_mobile_num" id="p_u_mobile_num"  placeholder="" required>
                    <input type="text" class="form-control" value="<?php echo($_p_options[0]->ID); ?>" name="opt_id" id="opt_id"  placeholder="" required>
                    <input type="text" class="form-control" value="<?php echo($_p_options[0]->name); ?>" name="opt_name" id="opt_name"  placeholder="" required>
                    <input type="text" class="form-control" value="<?php echo($_p_options[0]->value); ?>" name="opt_value" id="opt_value"  placeholder="" required>
                    <input type="text" class="form-control" value="<?php echo($_p_options[0]->stock); ?>" name="opt_stock" id="opt_stock"  placeholder="" required>
                    <input type="text" class="form-control" value="<?php echo($_p_options[0]->state); ?>" name="opt_state" id="opt_state"  placeholder="" required>
                </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">결제 진행</button>
          </form>
        </div>
      </div>

      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017-2018 Company Name</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacy</a></li>
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
      </footer>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="/js/jquery-3.5.1.slim.js"><\/script>')</script>
    <script src="/assets/popper/popper.js"></script>
    <script src="/assets/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script src="/assets/holder/holder.min.js"></script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  </body>
</html>

<?php
include 'inc_head.php';
$jb_login = get_session_state();

?>
<!doctype html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <title>PHP</title>
</head>
<body>
<?php
if ( $jb_login ) {
    session_destroy();
    header( 'Location: /' );
} else {
    header( 'Location: /' );
}
?>
</body>
</html>
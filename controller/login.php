<?php
include 'inc_head.php';
include 'conn.php';
$jb_login = get_session_state();

$info_arr = getinfo();

$mysql_host = $info_arr->mysql_host;
$mysql_user = $info_arr->mysql_user;
$mysql_password = $info_arr->mysql_password;
$mysql_db = $info_arr->mysql_db;

//connect 설정(host, user, password)
$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}
//DB설정 끝


if ( $jb_login ) {
    header( 'Location: /' );
} else {
    $userid = $_POST[ 'userid' ];
    $password = $_POST[ 'password' ];

    $query = "SELECT user_id, password FROM member WHERE user_id = '".$userid."'";
    $result = $conn->query($query)->fetch_array(MYSQLI_ASSOC);

    if ( $userid == $result["user_id"] and $password == $result["password"] ) {
        $_SESSION[ 'username' ] = $userid;
        header( 'Location: /' );
    } else {
        echo "<script>";
        echo "alert('사용자 이름 또는 비밀번호가 틀렸습니다.');";
        echo 'window.location.href = "../login.php";';
        echo "</script>";
    }
}
?>
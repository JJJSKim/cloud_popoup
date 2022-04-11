<?php
//접속 계정정보 설정
require("conn.php");


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
//charset UTF8
mysqli_query($conn, "set names utf8");
//쿼리문 작성
$query = "select * from user";
$result = $conn->query($query);
echo "MySQL에서 가져온 데이터는 아래와 같습니다.<br/>";
var_dump($result->fetch_array(MYSQLI_ASSOC));

?>
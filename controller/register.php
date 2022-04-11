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
mysqli_query($conn, 'set names utf8');
//접속 계정정보 설정

$_get_id=$_POST["id"];
$_get_password=$_POST["password"];
$_get_password_re=$_POST["password_re"];
$_get_mobile_num=$_POST["mobile_num"];
$_get_address=$_POST["address"];
$_get_name=$_POST["name"];


//쿼리문 작성
//$query = "select * from user";
$query = "INSERT INTO member(user_id, password, mobile_num, address, name) values ('".$_get_id."', '".$_get_password."', ".$_get_mobile_num.", '".$_get_address."', '".$_get_name."')";
$result = $conn->query($query);
if(!$result){
    echo 'SQL 에러 발생: '.mysqli_error($conn);
}else{
    header( 'Location: /welcome.php' );
}

?>
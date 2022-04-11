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

//HTML post
$_post_uid=$_POST['usr_id'];
$_post_product_key=$_POST['p_id'];
$_post_address=$_POST['address']." ".$_POST['address2'];
$_post_value=$_POST['p_value'];
$_post_uname=$_POST['username'];
$_post_mobile_num=$_POST['p_u_mobile_num'];

$_post_opt_id=$_POST['opt_id'];
$_post_opt_name=$_POST['opt_name'];
$_post_opt_value=$_POST['opt_value'];
$_post_opt_stock=$_POST['opt_stock'];
$_post_opt_state=$_POST['opt_state'];

//product select
$member_key = "select ID from member where user_id = '".$_post_uid."'";
$member_key_result = $conn->query($member_key)->fetch_array(MYSQLI_ASSOC);
$query = "INSERT INTO `order`
(`member_key`,
`product_key`,
`state`,
`address`,
`value`,
`user_name`,
`mobile_num`)
VALUES
(".$member_key_result['ID'].",
".$_post_product_key.",
0,
'".$_post_address."',
".$_post_value.",
'".$_post_uname."',
".$_post_mobile_num."
);";
$result = $conn->query($query);

if(!$result){
    echo 'SQL 에러 발생: '.mysqli_error($conn);
    exit;
}else{
    $order_key = "SELECT LAST_INSERT_ID() as LID";
    $order_key_result = $conn->query($order_key)->fetch_array(MYSQLI_ASSOC);
    $query="INSERT INTO `order_option`
(`order_key`,
`product_option_key`,
`name`,
`value`,
`stock`,
`state`)
VALUES
(".$order_key_result['LID'].",
".$_post_opt_id.",
'".$_post_opt_name."',
".$_post_opt_value.",
".$_post_opt_stock.",
 0)";
    $result = $conn->query($query);
    if(!$result){
        echo 'SQL 에러 발생: '.mysqli_error($conn);
        exit;
    }
}
header( 'Location: /order_complete.php ?id='.$order_key_result['LID'] );




?>
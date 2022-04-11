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

//HTML get
$get_id = $_GET['id'];
$get_opt = $_GET['option'];

//product select
$query = "SELECT ID, name, stock, value, description, ins_date, update_date from product where ID = ".$get_id;
$result = $conn->query($query)->fetch_array(MYSQLI_ASSOC);

//option select
$query = "SELECT ID, name, value, stock, state, ins_date, update_date from product_option where product_id = ".$result["ID"]." LIMIT ".$get_opt.", 1";
$result2 = $conn->query($query);
$data_row = array();
while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
    array_push($data_row, $row);
}

var_dump($_SESSION);
//user data select
$query = "SELECT name, mobile_num, address from member where user_id = '".$_SESSION[ 'username' ]."'";
$result3 = $conn->query($query)->fetch_array(MYSQLI_ASSOC);

if( $result ){
    echo ("
<body onload='window.document.fc.submit ()'>
<form name='fc' action='/order.php' method='post' >
<input name=_p_id type=hidden value='".$result["ID"]."'>
<input name=_p_name type=hidden value='".$result["name"]."'>
<input name=_p_stock type=hidden value='".$result["stock"]."'>
<input name=_p_value type=hidden value='".$result["value"]."'>
<input name=_p_description type=hidden value='".$result["description"]."'>
<input name=_p_ins_date type=hidden value='".$result["ins_date"]."'>
<input name=_p_update_date type=hidden value='".$result["update_date"]."'>
<input name=_p_options type=hidden value='".json_encode($data_row, JSON_UNESCAPED_UNICODE)."'>
<input name=_p_u_id type=hidden value='".$_SESSION[ 'username' ]."'>
<input name=_p_u_name type=hidden value='".$result3["name"]."'>
<input name=_p_u_mobile_num type=hidden value='".$result3["mobile_num"]."'>
<input name=_p_u_address type=hidden value='".$result3["address"]."'>


</form>
</body>
");
}else{
    var_dump($result);
}

?>
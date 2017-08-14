<?php
/**根据手机号查询订单数据**/
header('Content-Type:application/json');
$output = '';

@$user_name = $_REQUEST['user_name'];
@$user_phone = $_REQUEST['user_phone'];
if(empty($user_name) || empty($user_phone)){
    echo "提交信息不足"; //若客户端提交信息不足，则返回一个空数组，
    return;    //并退出当前页面的执行
}
//访问数据库
$conn = mysqli_connect('localhost','root','root','zuce','3306');
//$conn = mysqli_connect(SAE_MYSQL_HOST_M, SAE_MYSQL_USER, SAE_MYSQL_PASS,  SAE_MYSQL_DB, SAE_MYSQL_PORT);
$sql = 'SET NAMES utf8';
mysqli_query($conn, $sql);
$sql="update user set user_name='$user_name' where user_phone= '$user_phone'";
$result = mysqli_query($conn, $sql);
if($result){
	$output='success';
}
$data = $output;
$callback = $_GET['callback'];
echo $callback.'('.json_encode($data).')';
// echo json_encode($output);
?>






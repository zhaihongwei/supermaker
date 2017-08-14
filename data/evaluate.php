<?php
header('Content-Type: application/json');
$output = '';

@$user_phone = $_REQUEST['user_phone'];
@$user_name = $_REQUEST['user_name'];
@$commodity_id = $_REQUEST['commodity_id'];
@$evaluate = $_REQUEST['evaluate'];
@$evaluate_info = $_REQUEST['evaluate_info'];

if(empty($user_phone) || empty($commodity_id) || empty($evaluate)|| empty($user_name)|| empty($evaluate_info)){

	$data['msg'] = 'error';
	$data['reason'] = "提交信息不足";
	$callback = $_GET['callback'];
	echo $callback.'('.json_encode($data).')';
    return;  

}

//访问数据库
$conn = mysqli_connect('localhost','root','root','supermarket','3306');
$sql = 'SET NAMES utf8';
mysqli_query($conn, $sql);

$sql = "INSERT INTO evaluate VALUES('$user_name','$commodity_id','$evaluate_info','$user_phone','$evaluate')";

$result = mysqli_query($conn, $sql);

$arr = '';
if($result){    //INSERT语句执行成功
    $arr['msg'] = 'success';
}else{
	$arr['msg'] = 'error';
	$arr['reason'] = "操作失败";
}
$output[] = $arr;

$data = $output;
$callback = $_GET['callback'];
echo $callback.'('.json_encode($data).')';
?>
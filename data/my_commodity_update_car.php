<?php
header('Content-Type: application/json');
@$user_phone = $_REQUEST['user_phone'];
@$commodity_id = $_REQUEST['commodity_id'];
@$count = $_REQUEST['count'];

if(empty($user_phone) || empty($commodity_id) || empty($count)){
	$data['msg'] = 'error';
	$data['reason'] = "提交信息不足";
	$callback = $_GET['callback'];
	echo $callback.'('.json_encode($data).')';
    return;  
}

//访问数据库
$conn = mysqli_connect('localhost','root','root','supermarket','3306');

$sql = "update my_commodity_car set count='$count' where user_phone= '$user_phone' and commodity_id='$commodity_id'";
$result = mysqli_query($conn, $sql);

if($result){
	$data['msg'] = 'success';	
	$callback = $_GET['callback'];
	echo $callback.'('.json_encode($data).')';
}else{
	$data['msg'] = 'error';	
	$callback = $_GET['callback'];
	echo $callback.'('.json_encode($data).')';
}







// $sql = 'SET NAMES utf8';
// mysqli_query($conn, $sql);

// $sql = "INSERT INTO my_commodity_car VALUES('$user_phone','$commodity_id','$order_time','$count')";

// $result = mysqli_query($conn, $sql);

// $arr = '';
// if($result){    //INSERT语句执行成功
//     $arr['msg'] = 'success';
//     $arr['did'] = mysqli_insert_id($conn); //获取最近执行的一条INSERT语句生成的自增主键
// }else{          //INSERT语句执行失败
//     $arr['msg'] = 'error';
//     $arr['reason'] = "添加失败";
// }
// $output[] = $arr;

// $data = $output;
// $callback = $_GET['callback'];
// echo $callback.'('.json_encode($data).')';
?>
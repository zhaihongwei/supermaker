<?php
header('Content-Type: application/json');
$output = '';
@$user_phone = $_REQUEST['user_phone'];
@$user_name = $_REQUEST['user_name'];
@$user_addr = $_REQUEST['user_addr'];
@$commodity_id = $_REQUEST['commodity_id'];
@$consignee_phone = $_REQUEST['consignee_phone'];
@$count = $_REQUEST['count'];
$order_time = time()*1000;   //PHP中的time()函数返回当前系统时间对应的整数值

if(empty($user_phone) || empty($commodity_id) || empty($count)|| empty($user_name)|| empty($user_addr)|| empty($consignee_phone)){
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

$sql = "INSERT INTO my_commodity_order VALUES('$user_phone','$commodity_id','$order_time','$count','$user_name','$user_addr','$consignee_phone')";

$result = mysqli_query($conn, $sql);

$sql2 = "DELETE FROM my_commodity_car WHERE user_phone='$user_phone' and commodity_id='$commodity_id'";
$result2 = mysqli_query($conn, $sql2);
$arr = '';
if($result&&$result2){    //INSERT语句执行成功
    $arr['msg'] = 'success';
    $arr['did'] = mysqli_insert_id($conn); //获取最近执行的一条INSERT语句生成的自增主键
}else{          //INSERT语句执行失败
    $arr['msg'] = 'error';
    $arr['reason'] = "添加失败";
}
$output[] = $arr;

$data = $output;
$callback = $_GET['callback'];
echo $callback.'('.json_encode($data).')';






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
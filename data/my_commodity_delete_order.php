<?php
header('Content-Type: application/json');
$output = '';

@$user_phone = $_REQUEST['user_phone'];
@$commodity_id = $_REQUEST['commodity_id'];
@$order_time = $_REQUEST['order_time'];

if(empty($user_phone) || empty($commodity_id) ||empty($order_time)){
	$data['msg'] = 'error';
	$data['reason'] = "提交信息不足";
	$callback = $_GET['callback'];
	echo $callback.'('.json_encode($data).')';
    return;  
}

//访问数据库
$conn = mysqli_connect('localhost','root','root','supermarket','3306');

$sql = 'SET NAMES utf8';
// mysqli_query($conn, $sql);
$sql = "DELETE FROM my_commodity_order WHERE user_phone='$user_phone' and commodity_id='$commodity_id' and order_time = $order_time";
$result = mysqli_query($conn, $sql);
$arr = '';
if($result){    //INSERT语句执行成功
    $arr['msg'] = 'success';
    $arr['did'] = mysqli_insert_id($conn); //获取最近执行的一条INSERT语句生成的自增主键
}else{          //INSERT语句执行失败
    $arr['msg'] = 'error';
    $arr['reason'] = "删除失败";
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
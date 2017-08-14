<?php
header('Content-Type: application/json');
// @$user_name = $_REQUEST['user_name'];
@$user_addr = null;
@$user_name = null;
@$user_sex = null;
@$user_phone = $_REQUEST['user_phone'];
@$user_pass_word = $_REQUEST['user_pass_word'];


if(empty($user_phone) || empty($user_pass_word) ){
	$data['msg'] = 'error';
	$data['reason'] = "提交信息不足";
	$callback = $_GET['callback'];
	echo $callback.'('.json_encode($data).')';
    // echo "提交信息不足"; //若客户端提交信息不足，则返回一个空数组，
    return;    
}

//访问数据库
$conn = mysqli_connect('localhost','root','root','supermarket','3306');
$sql = 'SET NAMES utf8';
mysqli_query($conn, $sql);
$sql = "INSERT INTO sk_user VALUES('$user_name','$user_phone','$user_sex','$user_addr','$user_pass_word')";
// $result = mysqli_query($conn, $sql);

$sql2="select * from sk_user";
$result2 = mysqli_query($conn, $sql2);


$bool= true;
foreach ($result2 as $key => $value) {
	foreach ($value as $key2 => $value2) {
		if($value2 == $user_phone){

			$arr['msg'] = 'error';
    		$arr['reason'] = "该手机号已经被注册";
    		$bool=false;
		}
	}
}
if($bool){
	$result = mysqli_query($conn, $sql);	
		if($result){    //INSERT语句执行成功
    		$arr['msg'] = 'success';  
		}else{         
    		$arr['msg'] = 'error';
    		$arr['reason'] = "注册失败,换个手机号试试";
		}	
}

$data = $arr;
$callback = $_GET['callback'];
echo $callback.'('.json_encode($data).')';

// if($_GET['callback']){
// $data = $output;
// $callback = $_GET['callback'];
// echo $callback.'('.json_encode($data).')';
// }else{
// 	 echo json_encode($output);
// }

?>
<?php
/**根据手机号查询订单数据**/
header('Content-Type:application/json');
$output = '';

@$user_name = $_REQUEST['user_name'];
@$user_phone = $_REQUEST['user_phone'];
if(empty($user_name) || empty($user_phone)){
	  $data['msg'] = 'error';
	$data['reason'] = "提交信息不足";
	$callback = $_GET['callback'];
	echo $callback.'('.json_encode($data).')';
    return; 
}

$conn = mysqli_connect('localhost','root','root','supermarket','3306');
$sql2 = 'SET NAMES utf8';

/*************************/
$sql2="select * from sk_user";
$result2 = mysqli_query($conn, $sql2);
$sql = 'SET NAMES utf8';
$sql="update sk_user set user_name='$user_name' where user_phone= '$user_phone'";
$bool= true;
foreach ($result2 as $key => $value) {
	foreach ($value as $key2 => $value2) {
		if($value2 == $user_name){

			$arr['msg'] = 'error';
    		$arr['reason'] = "该昵称已经被注册";
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
    		$arr['reason'] = "修改失败";
		}	
}
/**************************/

//访问数据库
// $conn = mysqli_connect('localhost','root','root','supermarket','3306');
// $sql = 'SET NAMES utf8';
// $sql="update sk_user set user_name='$user_name' where user_phone= '$user_phone'";
// $result = mysqli_query($conn, $sql);

// if($result){
// 	$data='success';
// }
$callback = $_GET['callback'];
echo $callback.'('.json_encode($arr).')';
?>






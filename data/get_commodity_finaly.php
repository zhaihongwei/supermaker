<?php
header('Content-Type: application/json');
$output = '';
@$user_phone = $_REQUEST['user_phone'];
  //客户端提交的起始记录的序号
/*@符号用于压制该行代码产生的错误/警告消息*/
if( empty($user_phone) ){        //empty()函数用于判断一个变量是否为空  
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
$sql = "SELECT user_commodity_finaly,count FROM sk_order where user_phone='$user_phone' and user_commodity_finaly!=''";
$result = mysqli_query($conn, $sql);


while( ($row=mysqli_fetch_assoc($result))!==NULL ){
 $output[] = $row;
}

	if(count($output)>0){
		
    $data = $output;
	$callback = $_GET['callback'];
	echo $callback.'('.json_encode($data).')';
	}else{
			$data['msg'] = 'empty';
	$callback = $_GET['callback'];
	echo $callback.'('.json_encode($data).')';
	}



// if(count($output)>0){
// 	$data = $output;
// 	$callback = $_GET['callback'];
// 	echo $callback.'('.json_encode($data).')';
// }else{
// 	$data['msg'] = 'empty';
// 	$callback = $_GET['callback'];
// 	echo $callback.'('.json_encode($data).')';
// }



// echo json_encode($output);
?>
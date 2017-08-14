<?php
/**根据手机号查询订单数据**/
header('Content-Type:application/json');
$output = '';
@$user_phone = $_REQUEST['user_phone'];
@$user_name = $_REQUEST['user_name'];
@$user_pass_word = $_REQUEST['user_pass_word'];
if((empty($user_name)&&empty($user_phone))||empty($user_pass_word)){
    $data['msg'] = 'error';
	$data['reason'] = "提交信息不足";
	$callback = $_GET['callback'];
	echo $callback.'('.json_encode($data).')';
    return;   
}

//访问数据库
$conn = mysqli_connect('localhost','root','root','supermarket','3306');
//$conn = mysqli_connect(SAE_MYSQL_HOST_M, SAE_MYSQL_USER, SAE_MYSQL_PASS,  SAE_MYSQL_DB, SAE_MYSQL_PORT);
$sql = 'SET NAMES utf8';
mysqli_query($conn, $sql);
if($user_name==''||$user_name==null){
	$sql = "SELECT * FROM sk_user WHERE user_phone='$user_phone' and user_psd='$user_pass_word'";
}else{
	$sql = "SELECT * FROM sk_user WHERE user_name='$user_name' and user_psd='$user_pass_word'";	
}

// $sql = "SELECT user_name,user_psd,user_phone FROM sk_user WHERE user_name='$user_name' and user_psd='$user_pass_word' or user_phone='$user_phone' and user_psd='$user_pass_word'";

$result = mysqli_query($conn, $sql);

//根据编号查询，结果集最多只有一行记录
while( ($row=mysqli_fetch_assoc($result))!==NULL ){
     $output = $row;
    
}
if($output){
 	 $data['msg'] = 'success';
     $data['info'] = $output;
}else{
	$data['msg'] = 'error';
	$data['reason'] = '用户名或密码不正确';
}
// $data = $output;
$callback = $_GET['callback'];
echo $callback.'('.json_encode($data).')';
// echo json_encode($output);
?>

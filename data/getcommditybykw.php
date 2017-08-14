<?php
header('Content-Type: application/json');
$output = '';

@$kw = $_REQUEST['kw'];
if(empty($kw)){
    // echo "[]"; //若客户端未提交查询关键字，则返回一个空数组，
    // return;    //并退出当前页面的执行
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
$sql = "SELECT id,name,img,price,count,classify FROM sk_commodity WHERE name LIKE '%$kw%' ";
$result = mysqli_query($conn, $sql);
while( ($row=mysqli_fetch_assoc($result))!==NULL ){
    $output[] = $row;
}

// echo json_encode($output);
$data = $output;
$callback = $_GET['callback'];
echo $callback.'('.json_encode($data).')';
?>
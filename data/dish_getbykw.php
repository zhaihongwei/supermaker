<?php
/*
*由main.html调用
*根据客户端提交的查询关键字，返回菜名或原料中包含指定关键字的菜品
*/
header('Content-Type: application/json');
$output = '';

@$kw = $_REQUEST['kw'];
if(empty($kw)){
    echo "[]"; //若客户端未提交查询关键字，则返回一个空数组，
    return;    //并退出当前页面的执行
}

//访问数据库
$conn = mysqli_connect('localhost','root','root','kaifanla','3306');
$sql = 'SET NAMES utf8';
mysqli_query($conn, $sql);
$sql = "SELECT did,name,img_sm,material,price FROM kf_dish WHERE name LIKE '%$kw%' ";
$result = mysqli_query($conn, $sql);
while( ($row=mysqli_fetch_assoc($result))!==NULL ){
    $output[] = $row;
}

// echo json_encode($output);
$data = $output;
$callback = $_GET['callback'];
echo $callback.'('.json_encode($data).')';
?>
<?php
/**根据手机号查询订单数据**/
header('Content-Type:application/json');
$output = '';
@$user_name = $_REQUEST['user_name'];
@$pic = $_REQUEST['pic'];
if(empty($user_name)||empty($pic)){
    echo "[]"; //若客户端未提交电话号码，则返回一个空数组，
    return;    //并退出当前页面的执行
}

//访问数据库
// $conn = mysqli_connect('localhost','root','root','zuce','3306');
// //$conn = mysqli_connect(SAE_MYSQL_HOST_M, SAE_MYSQL_USER, SAE_MYSQL_PASS,  SAE_MYSQL_DB, SAE_MYSQL_PORT);
// $sql = 'SET NAMES utf8';
// mysqli_query($conn, $sql);
// $sql = "SELECT user_name,user_pass_word,user_phone FROM user WHERE user_name='$user_name' and user_pass_word='$user_pass_word'";
// $result = mysqli_query($conn, $sql);

// //根据编号查询，结果集最多只有一行记录
// while( ($row=mysqli_fetch_assoc($result))!==NULL ){
//     $output = $row;
// }
// $data = $output;
// $callback = $_GET['callback'];
// echo $callback.'('.json_encode($data).')';
// echo json_encode($output);
?>

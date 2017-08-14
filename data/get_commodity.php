<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
$count = 4;  //一次最多返回的记录条数
@$start = $_REQUEST['start'];
@$classify = $_REQUEST['classify'];
  //客户端提交的起始记录的序号
/*@符号用于压制该行代码产生的错误/警告消息*/
if( empty($start) ){        //empty()函数用于判断一个变量是否为空
    $start = 0;
}

//访问数据库
$conn = mysqli_connect('localhost','root','root','supermarket','3306');
$sql = 'SET NAMES utf8';
mysqli_query($conn, $sql);
$sql = "SELECT id,name,img,count,price FROM sk_commodity where classify='$classify' order by id  LIMIT $start,$count";
//SELECT id,name,img,price FROM sk_commodity where id in(SELECT user_commodity_ready FROM sk_order where user_phone='17710486865');
$result = mysqli_query($conn, $sql);


while( ($row=mysqli_fetch_assoc($result))!==NULL ){
    $output[] = $row;
}



$data = $output;
$callback = $_GET['callback'];
echo json_encode($data);

// echo json_encode($output);
?>
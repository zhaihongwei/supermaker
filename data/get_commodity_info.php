<?php
/**根据id查询商品**/
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

@$id = $_REQUEST['id'];
if(empty($id)){
    echo '[]';
    return;
}

$conn = mysqli_connect('localhost','root','root','supermarket','3306');
//$conn = mysqli_connect(SAE_MYSQL_HOST_M,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);
$sql = 'SET NAMES UTF8';
mysqli_query($conn,  $sql);
$sql = "SELECT * FROM  sk_commodity WHERE id=$id";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);  //此处无需循环
if(empty($row))
   echo '[]';
else
{
    // $output[] = $row;
    // echo json_encode($output);
    $data = $row;
$callback = $_GET['callback'];
echo json_encode($data);
}
?>


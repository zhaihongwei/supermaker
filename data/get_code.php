<?php
/**根据手机号查询订单数据**/
header('Content-Type:application/json');
$arr = [];
$code=rand(1000,9999);
$arr['msg'] = 'success';
$arr['code'] = $code;


$data = $arr;
$callback = $_GET['callback'];
echo $callback.'('.json_encode($data).')';
// echo json_encode($output);
?>

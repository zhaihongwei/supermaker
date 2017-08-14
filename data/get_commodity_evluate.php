<?php
header('Content-Type: application/json');
$output = '';
@$commodity_id = $_REQUEST['commodity_id'];
if(empty($commodity_id) ){     
	$data['msg'] = 'error';
	$data['reason'] = "提交信息不足";
	$callback = $_GET['callback'];
	echo $callback.'('.json_encode($data).')';
    return;  
}
$conn = mysqli_connect('localhost','root','root','supermarket','3306');
	$sql = 'SET NAMES utf8';
	mysqli_query($conn, $sql);

$sql = "SELECT evaluate FROM evaluate where commodity_id='$commodity_id' order by user_name";

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

?>


<?php
//削除処理
$id = $_GET["id"];

include("funcs.php");

$pdo = db_conn();


//削除処理
$sql = "DELETE FROM main_table WHERE id=:id ";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  
$status = $stmt->execute(); 


if($status==false){
 sql_error();
}else{
  redirect("main.php");
}
?>
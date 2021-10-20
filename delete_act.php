<?php
//削除処理前の確認処理
session_start();
include("funcs.php");
$id = $_POST["id"];
$suid = $_SESSION["uid"];
$supw = $_SESSION["upw"];
$suname = $_SESSION["uname"];


$pdo = db_conn();


$sql = "SELECT * FROM main_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);  
$status = $stmt->execute(); 


if($status==false){
  sql_error();
}

$val = $stmt->fetch();

//ログインユーザーが投稿者か確認
if ($val["id"] != "" && $suid == $val["uid"] && $supw == $val["upw"]){
    header('Location: delete.php?id='.$val["id"]);
    
   
}else{
    echo "投稿者本人しか削除はできません。";
}
exit();
?>

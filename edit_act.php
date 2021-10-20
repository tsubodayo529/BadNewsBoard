<?php
//編集前確認処理
session_start();
$id = $_POST["id"];
$suid = $_SESSION["uid"];
$supw = $_SESSION["upw"];
$suname = $_SESSION["uname"];

include("funcs.php");
$pdo = db_conn();


$sql = "SELECT * FROM main_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$status = $stmt->execute(); 


if($status==false){
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]); 
}
else{
$val = $stmt->fetch();
}

//ログインユーザーが投稿者か確認
if ($val["id"] != "" && $suid == $val["uid"] && $supw == $val["upw"]){
    header('Location: edit.php?id='.$val["id"]);
    
   
}else{
    echo "投稿者本人しか編集はできません。";
    exit();
}
?>

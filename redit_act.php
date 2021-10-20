<?php

//リプライ編集確認処理

session_start();
$id = $_POST["id"];
$suid = $_SESSION["uid"];
$supw = $_SESSION["upw"];
$suname = $_SESSION["uname"];

include("funcs.php");
$pdo = db_conn();


$sql = "SELECT * FROM rep_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);  
$status = $stmt->execute(); 


if($status==false){
  sql_error();
}
else{
$val = $stmt->fetch();
}

//ログインユーザーが投稿者か確認
if ($val["id"] != "" && $suid == $val["ruid"] && $supw == $val["rupw"]){
    header('Location: redit.php?id='.$val["id"]);
    
   
}else{
    echo "投稿者本人しか編集はできません。";
    exit();
}
?>

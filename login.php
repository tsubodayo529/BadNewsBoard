<!DOCTYPE html>

<!-- ログイン画面 -->

<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>ログイン画面</title>
    <style>
    body {
        padding:10px
    }
    .title{
        width:70%; height:100px;
    }
    .container{
        height:180px;
    }
    * {box-sizing: border-box;}
    </style>
</head>

<body>
    <header>
        <h1 class="title bg-primary mx-auto text-center py-4 text-light my-4 font-weight-bold">Bad News掲示板</h1>
    </header>

<!-- Head[End] -->

<!-- Main[Start] -->
    <div class="w-50 mx-auto bg-warning rounded-pill text-center pt-3 pb-2 mb-5">
        <h2 class="font-weight-bold mb-3">「Bad News掲示板」とは</h2>
        <p>生活の中での「Bad News」を<br>
        みんなでシェアする掲示板のことである。</p>
    </div>

<div style="display:flex; justifycontent:space around; width:100%;">
  
    <form method="POST" action="login_act.php" class="my-5 w-75">
        <div class="container w-50 pt-4 px-5 text-center" style="background-color:#75A9FF">
            <!-- ログインボタンを押すとlidとlpwがPOSTされる  →  login_act.phpへ遷移 -->
            <label>
                <input type="text" name="lid" class="form-control" placeholder="ID" aria-label="ID" aria-describedby="basic-addon1">
            </label>
            <label>
                <input type="password" name="lpw" class="form-control mx-auto" placeholder="password" aria-label="password" aria-describedby="basic-addon1">
            </label>
                
            <input type="submit" value="ログイン" class="btn btn-primary mt-2">      
        </div>
    </form>
   



    <form method="POST" action="reg_act.php" class="my-5 w-75">
        <div class="container w-50 pt-4 px-5 text-center" style="background-color:#75A9FF; height:220px;">
            <!-- 新規登録ボタンを押すとuidとupwとunameがPOSTされる  →  reg_act.phpへ遷移 -->
                <label>
                    <input type="text" name="uid" class="form-control" placeholder="User ID" aria-label="User ID" aria-describedby="basic-addon1">
                </label>
                <label>
                    <input type="password" name="upw" class="form-control" placeholder="User Password" aria-label="User Password" aria-describedby="basic-addon1">
                </label>
                <label>
                    <input type="text" name="uname" class="form-control" placeholder="User Name" aria-label="User Name" aria-describedby="basic-addon1">
                </label>
        
                <input type="submit" value="新規登録"  class="btn btn-primary mt-2">
        </div>
    </form>
</div>

<!-- <a href="select.php">データ一覧へ</a> -->
<!-- Main[End] -->

<!-- bootstrapインストール -->
<script src="js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

</body>
</html>

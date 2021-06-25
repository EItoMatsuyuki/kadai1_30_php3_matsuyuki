<?php
//funcs.phpを読み込む
require_once('funcs.php');
//1.  DB接続します
$pdo=db_conn();

//２．SQL文を用意(データ取得：SELECT)
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");

//3. 実行
$status = $stmt->execute(); 

//4．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
    sql_error($status);
}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= "<p>";
    $view .= '<a href="detail.php?id='.$result["id"].'">'; //URLに自力でデータをくっつける
    $view .= 
    h($result['indate']).':'.h($result['書籍名']).':'.h($result['書籍URL'].':'.h($result['書籍コメント']));  //$view .= "</p>".$result['indate'].':'.$result['name'].':'.$result['naiyou']."</p>"でも良い
    $view .= '</a>';
    $view .= '<a href="delete.php?id='.$result["id"].'">';
    $view .= '[削除]';
    $view .= '</a>';
    $view .="</p>";
  }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>好きな本</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
    <a href="detail.php"></a>
    <?=$view?>
    </div>
</div>
<!-- Main[End] -->

</body>
</html>

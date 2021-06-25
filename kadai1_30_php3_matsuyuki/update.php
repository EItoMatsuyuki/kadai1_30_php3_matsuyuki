<?php
//insert.phpの処理を持ってくる
//1. POSTデータ取得
$book = $_POST['book'];
$book_url = $_POST['book_url'];
$book_comment = $_POST['book_comment'];
$id = $_POST["id"];


//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ更新SQL作成（UPDATE テーブル名 SET 更新対象1=:更新データ ,更新対象2=:更新データ2,... WHERE id = 対象ID;）
  $stmt = $pdo->prepare(
    "UPDATE gs_bm_table SET 書籍名=:book,書籍URL=:book_url,書籍コメント=:book_comment,indate=sysdate() 
    WHERE id=:id"
  );
  
  // 4. バインド変数を用意
$stmt->bindValue(':book', $book, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':book_url', $book_url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':book_comment', $book_comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
  // 5. 実行
$status = $stmt->execute();


//４．データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    //以下を関数化
    sql_error($stmt);
  }else{
    //５．index.phpへリダイレクト
    //以下を関数化
    redirect('select.php');
  }
?>
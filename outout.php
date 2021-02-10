<html>
<head>
  <title>output.php</title>
  <?php
  try{
    $dbh = new PDO('mysql:host=111.111.111;dbname=aaaaaa_aaa;charset=utf8;',aaaaa,aaaaa);
    } catch ( PDOException $e ) {
      exit('接続エラー');
    }
  ?>
</head>
<body>
  <?php
  $場所=$_POST['場所'];
  $名前=$_POST['名前'];
  $値段=$_POST['値段'];
  $感想=$_POST['感想'];
  $削除 = explode(' ',$_POST['削除データ']);//$削除[0]が場所,$削除[1]が名前 explode(分ける文字,分割するデータ)ここでの分ける文字は空白
  $変更 = explode(' ',$_POST['変更前']);
  if(isset($_POST['送信'])&&$場所!=""&&$名前!=""&&$値段!=""&&$感想!=""&&isset($_FILES)&&isset($_FILES['画像'])&&is_uploaded_file($_FILES['画像']['tmp_name'])){
    $sql = "insert into food(場所,名前,値段,感想) values('$場所','$名前','$値段','$感想')";
    $dbh->query($sql);
    $a = 'foods/'."$場所"."$名前".'.jpg';//foods/ファイル名 ってなってる
    move_uploaded_file($_FILES['画像']['tmp_name'], $a);
    echo '<p>追加した</p>';
  }

  if(isset($_POST['変更'])&&$場所!=""&&$名前!=""&&$値段!=""&&$感想!=""){
    // $update = "UPDATE FROM food SET 感想 = '$感想', WHERE 場所 = '$変更[0]' and 名前='$変更[1]'";
    $update = "UPDATE food SET 場所 = '$場所',  名前 = '$名前',  値段 = '$値段',  感想 = '$感想' WHERE 場所 = '$変更[0]' and 名前='$変更[1]'";
    $dbh->query($update);
    $before = 'foods/'."$変更[0]"."$変更[1]".'.jpg';//foods/ファイル名 ってなってる
    $after = 'foods/'."$場所"."$名前".'.jpg';
    rename($before,$after);
    echo '<p>変更した</p>';
  }

  if(isset($_POST['削除'])&& $削除[0]!="" && $削除[1]!= ""){
    $del = "DELETE FROM food WHERE 場所 = '$削除[0]' and 名前='$削除[1]'";
    $dbh->query($del);
    $a = 'foods/'."$削除[0]"."$削除[1]".'.jpg';//foods/ファイル名 ってなってる
    unlink($a);
    echo '<p>削除した</p>';
  }
   ?>
   <a href="index.php" style="font-size:50px;">学食サイト</a>
</body>
</html>

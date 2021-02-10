<html>
<head>
  <title>change.php</title>
  <?php
  try{
    $dbh = new PDO('mysql:host=111.111.111;dbname=aaaaaa_aaa;charset=utf8;',aaaaa,aaaaa);
    } catch ( PDOException $e ) {
      exit('接続エラー');
    }
  ?>
</head>
<body>
  <form action="output.php" method="post">
    <?php
    $場所=$_POST['場所'];
    $名前=$_POST['名前'];
    $値段=$_POST['値段'];
    $感想=$_POST['感想'];
    $変更 = explode(' ',$_POST['変更データ']);
     ?>
    <p><label>変更前:</label><input type="text" name="変更前" value="<?php echo "$変更[0] $変更[1]"; ?>" readonly style="background-color: rgba(0,0,0,0);border:solid 0px;"></p>
    <p><label>場所:</label><input type="text" name="場所" value="<?php echo $変更[0]; ?>"></p>
    <p><label>名前:</label><input type="text" name="名前" value="<?php echo $変更[1]; ?>"></p>
    <p><label>値段:</label><input type="text" name="値段" value="<?php echo $変更[2]; ?>"></p>
    <p><label>感想:</label><input type="text" name="感想" value="<?php echo $変更[3]; ?>"></p>
    <input type="submit" value="変更" name="変更">
  </form>
   <a href="index.php" style="font-size:50px;">学食サイト</a>
</body>
</html>

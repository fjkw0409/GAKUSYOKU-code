<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="img/lunch.png"><!--アイコン表示-->
    <title>千葉工大学食</title>
    <link rel="stylesheet" href="stylesheet.css"><!--cssを読取-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script><!-- jque -->
    <?php
    try{
      $dbh = new PDO('mysql:host=111.111.111;dbname=aaaaaa_aaa;charset=utf8;',aaaaa,aaaaa);
      // ip,データベース名,  接続者名,パス
      } catch ( PDOException $e ) {
        exit('接続エラー');}
    ?>
  </head>
  <body>
    <p class="logo">千葉工大学食</p>
    <div class="main">
      <div class="tab-area">
        <div class="tab"><p>新習志野1階</p></div>
        <div class="tab"><p>新習志野2階</p></div>
        <div class="tab"><p>津田沼</p></div>
        <div class="tab"><p>その他</p></div>
        <div class="tab"><p>データ変更</p></div>
      </div>
      <div class="panel-area">
        <?php
        for ($i=1; $i <= 4 ; $i++) {
          echo '<div class="panel">
            <img src="img/'.$i.'.jpg" class="build build'.$i.'">
            <div class="box">';
              foreach ($dbh->query('select * from food') as $row) {
                if ($row[場所]==$i) {
                  echo '<div class="contents"><img src="foods/'."$row[場所]"."$row[名前].jpg".'">'."<p>$row[名前]</p><p>$row[値段]円</p><p>$row[感想]</p></div>";}}
            echo '</div>
          </div>';}
        ?>
        <div class="panel">
          <form action="output.php" method="post" enctype="multipart/form-data" class="">
            <!-- enctype="multipart/form-data"は画像とかファイルを送る機能があるときつける -->
            <h1>データ追加</h1>
            <p>場所</p>
            <select size="4" name="場所">
              <option value="1">新習志野1階</option>
              <option value="2">新習志野2階</option>
              <option value="3">津田沼</option>
              <option value="4">その他</option>
            </select><br>
            <input type="file" name="画像">
            <p>名前</p><input type="text" name="名前">
            <p>値段</p><input type="text" name="値段">
            <p>感想</p><input type="text" name="感想"><br>
            <input type="submit" value="送信" name="送信"><br>
          </form>


          <form action="change.php" method="post" enctype="multipart/form-data">
            <h1>データ変更</h1>
            <select size="20" name="変更データ">
              <?php
              $場所配列 = array('新習志野1階','新習志野2階','津田沼','その他');
              foreach ($dbh->query('select 場所,名前 from food ORDER BY 場所') as $row) {
                    echo '<option value="' . "$row[場所] $row[名前]" . '">'.$場所配列[$row[場所]-1].','.$row[名前].'</option>"';}
                ?>
            </select><br>
            <input type="submit" value="変更" name="変更">
          </form>


          <form action="output.php" method="post" enctype="multipart/form-data">
            <h1>データ削除</h1>
            <select size="20" name="削除データ">
              <?php
              $場所配列 = array('新習志野1階','新習志野2階','津田沼','その他');
              foreach ($dbh->query('select 場所,名前 from food') as $row) {
                    echo '<option value="' . "$row[場所] $row[名前]" . '">'.$場所配列[$row[場所]-1].','.$row[名前].'</option>"';}
                ?>
            </select><br>
            <input type="submit" value="削除" name="削除">
          </form>
          <!-- <a href="http://koppecraft.php.xdomain.jp">koppe</a>
          <p>たらこすぱげっちー、300円、おいしかった、ひぇっ</p>
          <img src="img/child.gif" alt=""> -->
        </div>
      </div>
    </div>
  </body>
  <script src="javascript.js"></script><!-- 外部のjsを読取 -->
</html>

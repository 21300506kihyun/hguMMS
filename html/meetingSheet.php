<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel = "stylesheet" href = "../css/meetingSheet.css"/>
  <meta name="google-signin-scope" content="profile email">
  <meta name="google-signin-client_id" content="924098158115-3oevbe0lurkhouu0fb98br6paj7i5e1a.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
  <script type="text/javascript">
    function clickTrEvent(obj){
      if(obj.style.backgroundColor == "white"){
        obj.style.backgroundColor = "Gainsboro";
        obj.innerHTML = "OFF";
      }
      else{
        obj.style.backgroundColor = "white";
        obj.innerHTML = "ON";
      }
    }
  </script>
  <title>handongMMS</title>
</head>
<body>
  <div class = "header" onclick="location.href='main.php'">
    <h1>HGU Meeting Management System (MMS)</h1>
    <br>
    <p>한동대학교 면담 예약 및 관리 시스템입니다.</p>
  </div>

  <div class="row">
    <div class="column left">
      <h1 class="icon"> <img src="<?php echo $_POST['img1']?>"></i></h1>
      <!-- <h1 class="icon"><i class="fas fa-snowman"></i></h1> -->

      <h2><?php echo $_POST['name1']?> 님</h2>
      <h3 class="info">E-mail : <?php echo $_POST['email1']?></h3>
      <h3 class="info">오피스 위치 : none(영어?)</h3>
      <h3 class="info">개인 면담 시트 : 없음(한글?)</h3>

      <input class="btn_left" type="button" value="면담 신청하기"/>
      <form action="meetingSheet.php" method="post">
        <input style="display: none" class="info" id = 'name1' name ="name1"  value ="<?php echo $_POST['name1']?>"  />
        <input style="display: none" class="info" id = 'email1' name ="email1"  value ="<?php echo $_POST['email1']?>"/>
        <input style="display: none" class="info" id = 'img1' name ="img1" value ="<?php echo $_POST['img1']?>"/>
        <input class="btn_left" type="submit" value="개인 면담 시트 바로가기"/>
      </form>
      <input class="btn_left" type="button" value="개인정보 수정하기"/>
      <input class="btn_left" type="button" value="면담승인 요청"/>
      <input class="btn_left" type="button" value="로그아웃"/>

    </div>

    <div class="column middle">
      <h2 class="subtitle">개인 면담 일정</h2>
      <div>
        <h3 class="left_subtitle"><?php echo $_POST['name1']?>님 개인 면담 시트</h3>
        <h3 class="right_subtitle">개인의 고유 링크 혹은 QR code</h3>
      </div>

<<<<<<< HEAD
      <?php
      $conn = new mysqli("db4free.net","emawlrdl","toddlf930","mydata_21300506");
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
        echo "Connected successfully <br>";

          echo "<div style='float:left;'>";
          echo("<table width='1000'>");
          echo "<tr >";
          echo "<td> </td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td> 시간 </td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td> 0 : 00 ~ 0 : 30  </td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td> 1 : 00 ~ 1 : 30  </td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td> 1 : 30 ~ 2 : 00  </td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td> 2 : 00 ~ 2 : 30  </td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td> 2 : 30 ~ 3 : 00  </td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td> 3 : 00 ~ 3 : 30  </td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td> 3 : 30 ~ 4 : 00  </td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td> 4 : 00 ~ 4 : 30  </td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td> 4 : 30 ~ 5 : 00  </td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td> 5 : 00 ~ 5 : 30  </td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td> 5 : 30 ~ 6 : 00  </td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td> 6 : 00 ~ 7 : 00  </td>";
          echo "</tr>";
          echo "</table>";
          echo "</div>";


        $sql = "SELECT db_date, day_name FROM time_dimension WHERE id between 20190101 and 20190103";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          $cnt = 0;
          while($cnt <3){
            $row = $result->fetch_assoc();
            echo "<div style='float:left;'>";
            echo("<table class='table' width='200'>");
            echo "<tr>";
            echo "<td>" . $row["db_date"]. "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>"  . $row["day_name"]. "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>  off </td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>  off </td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>  off </td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>  off </td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>  off </td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>  off </td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>  off </td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>  off </td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>  off </td>";
            echo "</tr>";
            $cnt = $cnt+1;
            echo "</table>";
            echo "</div>";

        } else {
            echo "0 results";
        }
        $conn->close();
      ?>
      <div class="btns">
        <form action="main.php" method="post">
          <input style="display: none" class="info" id = 'name1' name ="name1"  value ="<?php echo $_POST['name1']?>"  />
          <input style="display: none" class="info" id = 'email1' name ="email1"  value ="<?php echo $_POST['email1']?>"/>
          <input style="display: none" class="info" id = 'img1' name ="img1" value ="<?php echo $_POST['img1']?>"/>
          <input class="btn_back" type="submit" value="돌아가기"/>
        </form>
        <input class="btn_save" type="button" value="변경 사항 저장하기"/>
      </div>
    </div>
  </div>

  <div class = "footer">
    <h3>Powered by WA lab 2020</h3>
    <p>문의 및 버그제보: abcd@gmail.com</p>
  </div>

</body>
</html>

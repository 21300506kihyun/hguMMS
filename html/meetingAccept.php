<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel = "stylesheet" href = "../css/meetingAccept.css"/>
  <meta name="google-signin-scope" content="profile email">
  <meta name="google-signin-client_id" content="924098158115-3oevbe0lurkhouu0fb98br6paj7i5e1a.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
  <script>
    function clickMore(str, info) {
      if(str.style.display=='none'){
        str.style.display='';
        info.innerText = '닫기 ▲'
      } else {
        str.style.display = 'none';
        info.innerText = '더 보기 ▼'
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

  <?php
    $conn = new mysqli("localhost","hgumms","handong11*","hgumms");
    // Check connection
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully <br>";

    // $sql = "SELECT db_date, day_name FROM time_dimension WHERE id between 20190101 and 20190103";
    // $result = $conn->query($sql);
    session_start();
    if($_POST['name1'] !== NULL){
      $name = $_POST['name1'];
      $_SESSION["name"] = $name;
      $email = $_POST['email1'];
      $_SESSION["email"] = $email;
      $img = $_POST['img1'];
      $_SESSION["img"] = $img;

      $sql2 = "SELECT * FROM user_info where email='$email'";
      $result = mysqli_query($conn, "SELECT * FROM user_info where email='$email'");
      $data = mysqli_fetch_assoc($result);
      echo $data['sid'];
      echo $data['name'];
      echo $data['department'];
      echo $data['prof'];
      echo $data['sheet'];
      echo $data['email'];
      echo $data['phone'];
      echo $data['office'];
      echo "<br/>";

      $_SESSION['department'] = $data['department'];
      $_SESSION['office'] = $data['office'];
      $_SESSION['prof'] = $data['prof'];
      $_SESSION['office'] = $data['office'];
    }

    $sql = "insert into user_info (name,email) select '$name','$email' from dual where not exists( select * from user_info where email = '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  ?>

  <div class="row">
    <div class="column left">
      <h1 class="icon"> <img src="<?php echo $_SESSION['img']?>"></i></h1>
      <h2><?php echo $_SESSION['name']?> </h2>
      <h3 class="info">E-mail : <?php echo $_SESSION['email']?></h3>
      <h3 class="info">소속 학부 : <?php if($_SESSION['department'] == ''){echo 'none';} else {echo $_SESSION['department'];}?></h3>
      <h3 class="info">오피스 위치 : <?php if($_SESSION['office'] == ''){echo 'none';} else {echo $_SESSION['office'];}?></h3>
      <h3 class="info">면담 제공 여부 : <?php if($_SESSION['prof'] == 'on'){echo 'O';} else{echo 'X';}?></h3>
      <h3 class="info">시트 제공 여부 : <?php if($_SESSION['sheet'] == 'on'){echo 'O';} else{echo 'X';}?></h3>

      <input class="btn_left" onclick="location.href ='applypage.php'" type="button" value="면담 신청하기"/>
      <form action="meetingSheet.php" method="post">
        <input class="btn_left" type="submit" value="개인 면담 시트 바로가기"/>
      </form>
      <form action="personalInfo.php" method="post">
        <input class="btn_left" type="submit" value="개인정보 수정하기"/>
      </form>
      <form action="meetingAccept.php" method="post">
        <input class="btn_left" type="submit" value="면담승인 요청"/>
      </form>
      <input class="btn_left" onClick="location.href='login.php' "type="button" value="로그아웃"/>
    </div>

    <div class="column middle">
      <h2 class="subtitle">면담 승인 요청</h2>
      <br>
      <table>
        <tr>
          <th>면담 시간</th>
          <th>면담 제공자</th>
          <th>면담 신청자</th>
          <th>오피스</th>
          <th>면담사유</th>
          <th>상태</th>
          <th></th>
        </tr>
        <tr>
          <td>2020.02.03 (월) 17:00 ~ 17:30</td>
          <td><?php echo $_SESSION['name']?></td>
          <td>학생 1</td>
          <td>NTH 406</td>
          <td>학부 행사 면담</td>
          <td>승인대기</td>
          <td><span id="moreInfo1" style="CURSOR: pointer" onclick="clickMore(more1, moreInfo1)">더 보기 ▼</span></td>
        </tr>
        <tr class="additional" id="more1" style="display: none">
          <td colspan = "7" >hi</td>
        </tr>
        <tr>
          <td>2020.02.04 (화) 17:00 ~ 17:30</td>
          <td><?php echo $_SESSION['name']?></td>
          <td>학생 2</td>
          <td>NTH 306</td>
          <td>학부 행사 면담</td>
          <td>승인대기</td>
          <td><span id="moreInfo2" style="CURSOR: pointer" onclick="clickMore(more2, moreInfo2)">더 보기 ▼</span></td>
        </tr>
        <tr class="additional" id="more2" style="display: none">
          <td colspan = "7" >hi</td>
        </tr>
        <tr>
          <td>2020.02.05 (수) 17:00 ~ 17:30</td>
          <td><?php echo $_SESSION['name']?></td>
          <td>학생 3</td>
          <td>NTH 204</td>
          <td>학부 행사 면담</td>
          <td>승인대기</td>
          <td><span id="moreInfo3" style="CURSOR: pointer" onclick="clickMore(more3, moreInfo3)">더 보기 ▼</span></td>
        </tr>
        <tr class="additional" id="more3" style="display: none">
          <td colspan = "7" >hi</td>
        </tr>
        <tr>
          <td>2020.02.06 (목) 17:00 ~ 17:30</td>
          <td><?php echo $_SESSION['name']?></td>
          <td>학생 4</td>
          <td>NTH 203</td>
          <td>학부 행사 면담</td>
          <td>승인대기</td>
          <td><span id="moreInfo4" style="CURSOR: pointer" onclick="clickMore(more4, moreInfo4)">더 보기 ▼</span></td>
        </tr>
        <tr class="additional" id="more4" style="display: none">
          <td colspan = "7" >메시지 기록</td>
        </tr>
      </table>
    </div>
  </div>

  <div class = "footer">
    <h3>Powered by WA lab 2020</h3>
    <p>문의 및 버그제보: abcd@gmail.com</p>
  </div>
</body>
</html>

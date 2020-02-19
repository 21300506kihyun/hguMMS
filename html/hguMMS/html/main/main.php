<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel = "stylesheet" href = "../../css/main.css"/>
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
    session_start();
    if($_POST['name1'] !== NULL){
      $name = $_POST['name1'];
      $_SESSION["name"] = $name;
      $email = $_POST['email1'];
      $_SESSION["email"] = $email;
      $img = $_POST['img1'];
      $_SESSION["img"] = $img;
    }
      $log_email = $_SESSION["email"];
    //  else {
    //   echo "<script>alert('로그인 해주세요')</script>";
    //   echo "<script>location.href = '../login/login.php'</script>";
    // }

    $sql = "insert into user_info (name,email) select '$name','$email' from dual where not exists( select * from user_info where email = '$log_email')";
    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $result = mysqli_query($conn, "SELECT * FROM user_info where email='$log_email'");

    $data = mysqli_fetch_assoc($result);

    $_SESSION['department'] = $data['department'];
    $_SESSION['office'] = $data['office'];
    $_SESSION['prof'] = $data['prof'];
    $_SESSION['office'] = $data['office'];
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

      <input class="btn_left" onclick="location.href ='../apply_meeting/applypage.php'" type="button" value="면담 신청하기"/>
      <form action="../personal_meeting_sheet/meetingSheet.php" method="post">
        <input class="btn_left" type="submit" value="개인 면담 시트 바로가기"/>
      </form>
      <form action="../personal_info/personalInfo.php" method="post">
        <input class="btn_left" type="submit" value="개인정보 수정하기"/>
      </form>
      <form action="meetingAccept.php" method="post">
        <input class="btn_left" type="submit" value="면담승인 요청"/>
      </form>
      <input class="btn_left" onClick="location.href='../login/login.php' "type="button" value="로그아웃"/>
    </div>

    <div class="column middle">
      <h2 class="subtitle">면담 일정</h2>
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
      <?php
        $sql = "SELECT * FROM meeting_info where stu_email='$log_email' or prof_email='$log_email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td> $row[time] </td>";
              echo  "<td>$row[prof_name]</td>";
              echo  "<td>$row[stu_name]</td>";
              echo  "<td>$row[office]</td>";
              echo  "<td>$row[category]</td>";
              if($row['state'] == 0){
              echo  "<td>승인대기</td>";
              }
              if($row['state'] == 1){
              echo  "<td>승인</td>";
              }
              if($row['state'] == 2){
              echo  "<td>승인거절</td>";
              }
              echo "<td><span id=\"moreInfo1\" style=\"CURSOR: pointer\" onclick=\"clickMore(more1, moreInfo1)\">더 보기 ▼</span></td>";
              echo "</tr>";
              echo "<tr class=\"additional\" id=\"more1\" style=\"display: none\">";
                echo "<td colspan = \"7\" >hi</td>";
              echo "</tr>";
            }
            //print_r($xx);
            //echo $time_arr[0]['date'];
            //print_r($time_arr[0]['time']); // 첫번째 요소가 안불러와짐
            //print_r($arr_cnt);
        } else {
            echo "0 results";
        }


       ?>
      </table>
    </div>
  </div>

  <div class = "footer">
    <h3>Powered by WA lab 2020</h3>
    <p>문의 및 버그제보: abcd@gmail.com</p>
  </div>
</body>
</html>

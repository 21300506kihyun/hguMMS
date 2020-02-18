
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

    // function m_apply(){
    //   var time = document.getElementById('m_date')
    //   var f_name = document.getElementById('f_name');
    //   var s_name = document.getElementById('s_name');
    //   var m_date = document.getElementById('m_date');
    //   var category = document.getElementById('category');
    //   var meeting_contents = document.getElementById('meeting_contents');
    //   alert(time);
    //
    // }
  </script>
  <title>handongMMS</title>
</head>
<body>
  <div class = "header" onclick="location.href='../main/main.php'">
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
      $sql2 = "SELECT * FROM user_info where email='$email'";
      $result = mysqli_query($conn, "SELECT * FROM user_info where email='$email'");
      $data = mysqli_fetch_assoc($result);

      $_SESSION['department'] = $data['department'];
      $_SESSION['office'] = $data['office'];
      $_SESSION['prof'] = $data['prof'];
      $_SESSION['office'] = $data['office'];

       $date = $_GET['date'];
       $name = $_GET['name'];
       $f_name = $_GET['f_name'];


       if(isset($_POST['submit'])){
          $prof_name = $_POST['prof_name'];
         $stu_name = $_POST['stu_name'];
         $meeting_date = $_POST['meeting_date'];
         $category = $_POST['category'];
         $contents = $_POST['meeting_contents'];
         //echo $prof_name;

       $sql="insert into meeting_info (stu_name,prof_name, time, state, category, extra)
                values ('$stu_name','$prof_name', '$meeting_date', 0,'$category','$contents')";
       if ($conn->query($sql) === TRUE) {
          echo "<script>alert(\"신청이 완료되었습니다\")</script>";
          echo "<script>location.href='../main/main.php'</script>";
       }
       else
       {
           echo $conn->error;;
       }
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
      <h3>면담 신청서 작성 </h3>

      <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        면담제공자 : <input name ='prof_name' type="text" value="<?php echo $f_name?>" readonly><br>
        면담 일자 : <input name ='meeting_date' type="text" value="<?php echo $date?>" style="width:250px"readonly/><br>
        면담 신청자 : <input name ='stu_name' type="text" value="<?php echo $name?>" readonly><br>
        공동 면담자 추가 : <input name ='tog_name' type="text" value="<?php echo $name?>" ><br>
        면담 카테고리 :
        <select name="category">
          <option value="진로상담">진로상담</option>
          <option value="전공상담">전공상담</option>
          <option value="취업상담">취업상담</option>
          <option value="기타">기타</option>
        </select><br>
        면담 사유 : <textarea name ='meeting_contents' rows="4" cols="50"></textarea>
      <input type="submit" name="submit" value="면담 신청"><br>
    </form>


      <?php
       // echo $date ."<br>";
       // echo $name ."<br>"  ;
       // echo $f_name;

      // $sql="insert into meeting_info (stu_name,prof_name, time, state) values ('$name','$f_name', '$date', 0)";
      // if ($conn->query($sql) === TRUE) {
      //     echo "data inserted";
      // }
      // else
      // {
      //     echo $conn->error;;
      // }
       ?>

  </div>

  <div class = "footer">
    <h3>Powered by WA lab 2020</h3>
    <p>문의 및 버그제보: abcd@gmail.com</p>
  </div>
</body>
</html>

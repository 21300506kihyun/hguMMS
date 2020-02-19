
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel = "stylesheet" href = "../../css/meeting_apply.css"/>
  <meta name="google-signin-scope" content="profile email">
  <meta name="google-signin-client_id" content="924098158115-3oevbe0lurkhouu0fb98br6paj7i5e1a.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
  <script>
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

    session_start();
    $name = $_SESSION["name"];
    $email = $_SESSION["email"] ;
    $img = $_SESSION["img"] ;

    $result = mysqli_query($conn, "SELECT * FROM user_info where email='$email'");
    $data = mysqli_fetch_assoc($result);

    $_SESSION['department'] = $data['department'];
    $_SESSION['office'] = $data['office'];
    $_SESSION['prof'] = $data['prof'];
    $_SESSION['office'] = $data['office'];

     $date = $_GET['date'];
     $stu_email = $_GET['stu_email'];
     $prof_email = $_GET['prof_email'];
     $stu_name = $_GET['stu_name'];
     $prof_name = $_GET['prof_name'];


     if(isset($_POST['submit'])){
       $prof_email = $_POST['prof_email'];
       $stu_email = $_POST['stu_email'];
       $prof_name = $_POST['prof_name'];
       $stu_name = $_POST['stu_name'];
       $meeting_date = $_POST['meeting_date'];
       $category = $_POST['category'];
       $contents = $_POST['meeting_contents'];
       //echo $prof_name;

     $sql="insert into meeting_info (stu_name,prof_name, time, state, category, extra, stu_email, prof_email)
              values ('$stu_name','$prof_name', '$meeting_date', 0,'$category','$contents', '$stu_email','$prof_email')";
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
      <h3 class="sub_subtitle">면담 신청서 작성 </h3>

      <div class="form">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
          <div class="content">
            <h4 class="category">면담 제공자</h4>
            <!-- <input class="value" name ='prof_name' type="text" value="<?php echo $prof_name?>" readonly> -->
            <!-- <input name ='prof_email' type="hidden" value="<?php echo $prof_email?>"/> -->
            <input class="value" name ='prof_name' type="text" value="<?php echo $_SESSION['prof_name']?>" readonly>
            <input name ='prof_email' type="hidden" value="<?php echo $_SESSION['prof_email']?>"/>
          </div>
          <div class="content">
            <h4 class="category">면담 일자</h4>
            <input class="value" name ='meeting_date' type="text" value="<?php echo $date?>" readonly>
          </div>
          <div class="content">
            <h4 class="category">면담 신청자</h4>
            <input class="value" name ='stu_name' type="text" value="<?php echo $stu_name?>" readonly>
            <input name ='stu_email' type="hidden" value="<?php echo $stu_email?>" readonly>
          </div>
          <div class="content">
            <h4 class="category">공동 면담자 추가</h4>
            <input class='value' name ='tog_name' type="text" placeholder="공동 면담자를 추가해 주세요.">
          </div>
          <div class="content">
            <h4 class="category">면담 카테고리</h4>
            <select class="value" name="category">
              <option value="진로상담">진로상담</option>
              <option value="전공상담">전공상담</option>
              <option value="취업상담">취업상담</option>
              <option value="기타">기타</option>
            </select>
          </div>
          <div class="content">
            <h4 class="category">면담 사유</h4>
            <textarea class="value" name ='meeting_contents' rows="4" cols="50" placeholder="면담 사유를 입력해 주세요."></textarea>
          </div>
          <div class="content">
            <h4 class="category"></h4>
            <input class="submit_btn" type="submit" name="submit" value="면담 신청"><br>
          </div>
        </form>
      </div>




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
  </div>

  <div class = "footer">
    <h3>Powered by WA lab 2020</h3>
    <p>문의 및 버그제보: abcd@gmail.com</p>
  </div>
</body>
</html>

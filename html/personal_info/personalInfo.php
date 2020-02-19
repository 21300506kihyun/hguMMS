<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel = "stylesheet" href = "../../css/personalInfo.css"/>
  <meta name="google-signin-scope" content="profile email">
  <meta name="google-signin-client_id" content="924098158115-3oevbe0lurkhouu0fb98br6paj7i5e1a.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
  <title>handongMMS</title>
</head>
<body>
  <div class = "header" onclick="location.href='../main/main.php'">
    <h1>HGU Meeting Management System (MMS)</h1>
    <br>
    <p>한동대학교 면담 예약 및 관리 시스템입니다.</p>
  </div>

  <?php
    session_start();
    $name = $_SESSION["name"];
    $email = $_SESSION['email'];
    $img = $_SESSION['img'];

    $conn = new mysqli("localhost", "hgumms", "handong11*");
    mysqli_select_db($conn, 'hgumms');
    $result = mysqli_query($conn, "select * from user_info where email='$email'");

    $data = mysqli_fetch_assoc($result);
    echo $data['department'];
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

    <form action="personalInfoController.php" method="post" name="form" >
      <div class="column middle">
        <h2 class="subtitle">개인정보 수정</h2>
        <div class="content">
          <h3 class="category">이름</h3>
          <h3 class="deli">:</h3>
          <input name="name" id="name" class="value" type="text" value="<?php echo $name ?>" readonly>
        </div>
        <div class="content">
          <h3 class="category">학부</h3>
          <h3 class="deli">:</h3>
          <input name="department" id="department" class="value" type="text" placeholder="ex) 전산전자공학부" value="<?php echo $data['department'] ?>">
        </div>
        <div class="content">
          <h3 class="category">전화번호</h3>
          <h3 class="deli">:</h3>
          <input name="phone" id="phone" class="value" type="text" placeholder="ex) 010-0000-0000" value="<?php echo $data['phone'] ?>">
        </div>
        <div class="content">
          <h3 class="category">오피스 위치</h3>
          <h3 class="deli">:</h3>
          <input name="office" id="office" class="value" type="text" placeholder="ex) NTH 415 or None" value="<?php echo $data['office']?>">
        </div>
        <div class="content">
          <h3 class="category" style="width:85%">면담 제공 여부</h3>
          <h3 class="deli">:</h3>
          <input name="is_prof" class="checkbox" type="checkbox" id="is_prof" <?if($data['prof'] == "on"){ echo 'checked';} ?> />
        </div>
        <div class="content">
          <h3 class="category" style="width:85%">개인 면담시트 개설 여부</h3>
          <h3 class="deli">:</h3>
          <input name="is_sheet" class="checkbox" type="checkbox" id="is_sheet" <?if($data['sheet'] == "on"){ echo 'checked';} ?> />
        </div>

        <div class="btns">
            <input class="btn_back" type="button" value="돌아가기" onclick="location.href='../main/main.php'"/>
            <input class="btn_save" type="submit" value="변경 사항 저장하기"/>
        </div>
      </div>
    </form>
  </div>

  <div class = "footer">
    <h3>Powered by WA lab 2020</h3>
    <p>문의 및 버그제보: abcd@gmail.com</p>
  </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel = "stylesheet" href = "../css/personalInfo.css"/>
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
    function check(){
      var frm = document.form;
      var phone_number = frm.phone.value;
      var office_place = frm.office.value;
      var val_sheet = false;
      var val_prof = false;
      var sheet = document.getElementById('is_sheet');
      var prof = document.getElementById('is_prof');
      if(sheet.checked){
        val_sheet = true;
      }
      else{
        val_sheet = false;
      }

      if(prof.checked){
        val_prof = true;
      }
      else{
        val_prof = false;
      }


      alert(val_sheet);
      alert(val_prof);



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
    session_start();
    $name = $_SESSION["name"];
    $email = $_SESSION['email'];
    $img = $_SESSION['img'];

    $conn = new mysqli("localhost", "hgumms", "handong11*");
    mysqli_select_db($conn, 'hgumms');
    $result = mysqli_query($conn, "select * from user_info where email='$email'");

    $data = mysqli_fetch_assoc($result);
      echo $data['sid'];
      echo $data['name'];
      echo $data['prof'];
      echo $data['sheet'];
      echo $data['email'];
      echo $data['phone'];
      echo $data['office'];
      echo "<br/>";
  ?>

  <div class="row">
    <div class="column left">
      <h1 class="icon"> <img src="<?php echo $_SESSION['img']?>"></i></h1>
      <h2><?php echo $_SESSION['name']?> </h2>
      <h3 class="info">E-mail : <?php echo $_SESSION['email']?></h3>
      <h3 class="info">오피스 위치 : none(영어?)</h3>
      <h3 class="info">개인 면담 시트 : 없음(한글?)</h3>

      <input class="btn_left" type="button" value="면담 신청하기"/>
      <form action="meetingSheet.php" method="post">
        <input class="btn_left" type="submit" value="개인 면담 시트 바로가기"/>
      </form>
      <form action="personalInfo.php" method="post">
        <input class="btn_left" type="submit" value="개인정보 수정하기"/>
      </form>
      <input class="btn_left" type="button" value="면담승인 요청"/>
      <input class="btn_left" type="button" value="로그아웃"/>
    </div>

<form action="./personalInfoController.php" method="post" name="form" >
    <div class="column middle">
      <h2 class="subtitle">개인정보 수정</h2>
      <div class="content">
        <h3 class="category">이름</h3>
        <h3 class="deli">:</h3>
        <input name="name" id="name" class="value" type="text" value="<?php echo $name ?>" readonly>
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
        <h3 class="category" style="width:85%">개인 면담시트 개설 여부</h3>
        <h3 class="deli">:</h3>
        <input name="is_sheet" class="checkbox" type="checkbox" id="is_sheet" <?if($data['sheet'] == "on"){ echo 'checked';} ?> />
      </div>
      <div class="content">
        <h3 class="category" style="width:85%">면담 제공 여부</h3>
        <h3 class="deli">:</h3>
        <input name="is_prof" class="checkbox" type="checkbox" id="is_prof" <?if($data['prof'] == "on"){ echo 'checked';} ?> />
      </div>

      <div class="btns">
          <input class="btn_back" type="button" value="돌아가기" onclick="location.href='main.php'"/>
          <input class="btn_save" type="submit" value="변경 사항 저장하기"/>
      </div>
</form>


    </div>
  </div>

  <div class = "footer">
    <h3>Powered by WA lab 2020</h3>
    <p>문의 및 버그제보: abcd@gmail.com</p>
  </div>

</body>
</html>

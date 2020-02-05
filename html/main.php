<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel = "stylesheet" href = "../CSS/Main.css"/>
  <meta name="google-signin-scope" content="profile email">
  <meta name="google-signin-client_id" content="924098158115-3oevbe0lurkhouu0fb98br6paj7i5e1a.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
  <title>handongMMS</title>
</head>
<body>
  <div class = "header">
    <h1>HGU Meeting Management System (MMS)</h1>
    <br>
    <p>한동대학교 면담 예약 및 관리 시스템입니다.</p>
  </div>

  <div class="row">
    <div class="column left">
      <h1 class="icon"> <img src="<?php echo $_POST['img1']?>"></i></h1>
      <!-- <h1 class="icon"><i class="fas fa-snowman"></i></h1> -->

      <h2><?php echo $_POST['name1']?> 님</h2>
      <h3 class="info">E-mail : <?php echo $_POST['email1']?>"</h3>
      <h3 class="info">오피스 위치 : none(영어?)</h3>
      <h3 class="info">개인 면담 시트 : 없음(한글?)</h3>



      <input class="btn_left" type="button" value="면담 신청하기"/>
      <input class="btn_left" type="button" value="개인 면담 시트 바로가기"/>
      <input class="btn_left" type="button" value="개인정보 수정하기"/>
      <input class="btn_left" type="button" value="면담승인 요청"/>

    </div>
    <div class="column middle">
      <h2 class="subtitle">면담 일정</h2>
      <br>
      <table>
        <tr>
          <th>면담 시간</th>
          <th>면담자</th>
          <th>오피스</th>
          <th>면담사유</th>
          <th>상태</th>
          <th></th>
        </tr>
        <tr>
          <td>2020.02.03 (월) 17:00 ~ 17:30</td>
          <td>이강</td>
          <td>NTH 406</td>
          <td>학부 행사 면담</td>
          <td>승인</td>
          <!-- <td><button id="top" class="btn_moreInfo" onclick="showInfo()"><i class="fas fa-caret-up"></i></button></td> -->
          <td><span id="moreInfo1" style="CURSOR: pointer" onclick="clickMore(more1, moreInfo1)">더 보기 ▼</span></td>
        </tr>
        <tr id="more1" style="display: none">
          <td colspan = "5" >hi</td colspan = "5">
        </tr>

        <tr>
          <td>2020.02.04 (화) 17:00 ~ 17:30</td>
          <td>이건</td>
          <td>NTH 306</td>
          <td>학부 행사 면담</td>
          <td>승인</td>
          <!-- <td><button class="btn_moreInfo"><i class="fas fa-caret-down"></i></button></td> -->
          <td><span id="moreInfo2" style="CURSOR: pointer" onclick="clickMore(more2, moreInfo2)">더 보기 ▼</span></td>
        </tr>
        <tr id="more2" style="display: none">
          <td colspan = "5" >hi</td colspan = "5">
        </tr>

        <tr>
          <td>2020.02.05 (수) 17:00 ~ 17:30</td>
          <td>장소연</td>
          <td>NTH 204</td>
          <td>학부 행사 면담</td>
          <td>승인</td>
          <!-- <td><button class="btn_moreInfo"><i class="fas fa-caret-down"></i></button></td> -->
          <td><span id="moreInfo3" style="CURSOR: pointer" onclick="clickMore(more3, moreInfo3)">더 보기 ▼</span></td>
        </tr>
        <tr id="more3" style="display: none">
          <td colspan = "5" >hi</td>
        </tr>

        <tr>
          <td>2020.02.06 (목) 17:00 ~ 17:30</td>
          <td>김광</td>
          <td>NTH 203</td>
          <td>학부 행사 면담</td>
          <td>승인</td>
          <!-- <td><button class="btn_moreInfo"><i class="fas fa-caret-down"></i></button></td> -->
          <td><span id="moreInfo4" style="CURSOR: pointer" onclick="clickMore(more4, moreInfo4)">더 보기 ▼</span></td>
        </tr>
        <tr id="more4" style="display: none">
          <td colspan = "5" >메시지 기록</td>
        </tr>
      </table>
    </div>
  </div>


  <div class = "footer">
    <h3>Powered by WA lab 2020</h3>
    <p>문의 및 버그제보: abcd@gmail.com</p>
  </div>

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
</body>
</html>

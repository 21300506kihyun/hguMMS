<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel = "stylesheet" href = "../css/meetingSheet.css"/>
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
      <h3 class="info">E-mail : <?php echo $_POST['email1']?></h3>
      <h3 class="info">오피스 위치 : none(영어?)</h3>
      <h3 class="info">개인 면담 시트 : 없음(한글?)</h3>

      <input class="btn_left" type="button" value="면담 신청하기"/>
      <input class="btn_left" type="button" value="개인 면담 시트 바로가기"/>
      <input class="btn_left" type="button" value="개인정보 수정하기"/>
      <input class="btn_left" type="button" value="면담승인 요청"/>

    </div>

    <div class="column middle">
      <h2 class="subtitle">개인 면담 일정</h2>
      <div>
        <h3 class="left_subtitle"><?php echo $_POST['name1']?>님 개인 면담 시트</h3>
        <h3 class="right_subtitle">개인의 고유 링크 혹은 QR code</h3>
      </div>

      <script language="JavaScript">
        document.write("<table class='table'>");
        document.write("<tr>")
        document.write("<th></th>")
        for(col=2; col<=8; col++){
          document.write("<th>날짜</th>");
        }
        document.write("</tr><tr>")
        document.write("<th>시간</th>")
        for(col=2; col<=8; col++){
          document.write("<th>요일</th>");
        }
        document.write("</tr>");
        for(row=0; row<=47; row++) {
          document.write("<tr>");
          if(row % 2 == 0){
            document.write("<td>"+row/2+" : 00 ~ "+row/2+" : 30</td>")
          }
          else{
            document.write("<td>"+(row/2-0.5)+" : 30 ~ "+(row/2 + 0.5)+" : 00</td>");
          }
          for(col=2; col<=8; col++) {
            // document.write("<td bgcolor='#bbb'>&nbsp;</td>");
            // TODO: 오프시 색깔/ 오픈시 색깔 추가하기
            // TODO: 클릭 가능하게, 클릭하면 색깔 변화하게 만들기
            document.write("<td bgcolor='#eee'>OFF</td>");
          }
          document.write("</tr>");
          }
        document.write("</table>");
      </script>
      <div class="btns">
        <input class="btn_back" type="button" value="돌아가기"/>
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
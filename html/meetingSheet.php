<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel = "stylesheet" href = "../css/meetingSheet.css"/>
  <meta name="google-signin-scope" content="profile email">
  <meta name="google-signin-client_id" content="924098158115-3oevbe0lurkhouu0fb98br6paj7i5e1a.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

  <style type="text/css">

  .cal_top{
      text-align: center;
      font-size: 30px;
  }
  .cal{
      text-align: center;
  }
  table.calendar{
      border: 1px solid black;
      display: inline-table;
      text-align: left;
  }
  table.calendar td{
      vertical-align: top;
      border: 1px solid skyblue;
      width: 100px;
  }
  </style>
  <style type="text/css">
    body,div,p,h1,h2,h3,h4,h5,h6,ul,ol,li,dl,dt,dd,table,th,td,form,fieldset,legend,input,textare,a,button,select{margin:0;padding:0}
    body,input,textarea,select,button
    /* table{font-family:'돋움',dotum,AppleGothic,sans-serif;font-size:12px} */
    body{word-break:break-all}
    a{text-decoration:none}
    a:hover,a:active,a:focus{text-decoration:underline}
    caption,legend,.blind{visibility:hidden;overflow:hidden;width:0;height:0;font-size:0;line-height:0;text-align:left}
    hr{display:none}
    table{border-collapse: collapse;
        width: 90%;
        margin-top: 50px;
    }
    th{font-weight:normal}
    .bbs_table{width:100%;border:1px solid #d0d4d9;line-height:16px;/* IE7 수정 */*border-right:0/* IE7 수정 */}
    .bbs_table th:first-child,.bbs_tbl_type2 td:first-child{border-left:0}
    .bbs_table th{padding:10px 9px 7px;border-width:0 0 0 1px;border-color:#dcdee2;border-style:solid;text-align:center;background-color:#eff0f2;color:#333}
    .bbs_table td{padding:10px 9px 7px;border-width:1px 0 0 1px;border-color:#edeef0 #dcdee2;border-style:solid;text-align:center;line-height:33px;color:#666;/* IE7 수정 */*border-left:0;*border-top:0;*border-bottom:1px solid #edeef0;*border-right:1px solid #dcdee2;/* IE7 수정 */}
    .bbs_table td input[type=text],.bbs_tbl_type2 td select,.bbs_tbl_type2 td a.fron{margin:-6px 0 -2px}
    .bbs_table td:hover{border: 2px solid #777 !important}
    .bbs_table tr:first-child td{border-top:1px solid #dcdee2}
    .bbs_table tr:first-child td:hover{border-top:2px solid #777 !important}
    .schu_line_bg{border:1px solid #999 !important;background-color:/*#f9fafa*/ Gainsboro; cursor:pointer}
    .schedule_area_v1{position:relative;/* IE7 수정 */*top:3px;/* IE7 수정 */padding:18px 5px 16px;line-height:18px;font-size:12px}
    .schedule_area_v1 a{display:block;position:relative;color:#333}
    .schedule_area_v1 a:hover{font-weight:bold}
    .schedule_close{display:block;position:absolute;top:2px;right:2px;width:15px;height:15px;cursor:pointer}
  </style>

  <script>
    function clickTdEvent(obj){
        if(obj.style.backgroundColor === "white"){
            obj.style.backgroundColor = "Gainsboro";
            obj.innerHTML = "<div class='schedule_area_v1'> <span class='schedule_close'>X</span> </div>";
        }
        else{
            obj.style.backgroundColor = "white";
            obj.innerHTML = "<div class='schedule_area_v1'> <span class='schedule_close'>O</span> </div>";
        }
        alert(obj.id);
    }
  </script>
  <?php
  session_start();
  if($_POST['name1'] !== NULL){
    $name = $_POST['name1'];
    $_SESSION["name"] = $name;
    $email = $_POST['email1'];
    $_SESSION["email"] = $email;
    $img = $_POST['img1'];
    $_SESSION["img"] = $img;
  }
  ?>
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
      <h1 class="icon"> <img src="<?php echo $_SESSION['img']?>"></i></h1>
      <h2><?php echo $_SESSION['name']?></h2>
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

    <div class="column middle">
      <h2 class="subtitle">개인 면담 일정</h2>
      <div>
        <h3 class="left_subtitle"><?php echo $_SESSION['name']?>님 개인 면담 시트</h3>
        <h3 class="right_subtitle">개인의 고유 링크 혹은 QR code</h3>
      </div>



      <script language="JavaScript">
        document.write("<table class='bbs_table'");
          document.write("<colgroup>");
            document.write("<col />")
            for(col=1; col<=7; col++){
              document.write("<col style='width:12%'>")
            }
          document.write("</colgroup>")

          document.write("<thead>")
            document.write("<tr class='schedult_lst'>")
            document.write("<th scope='col'></th>")
            for(date=1; date<=7; date++){
              document.write("<th scope='col'>Date</th>")
            }
            document.write("</tr>")
          document.write("</thead>")

          document.write("<thead>")
            document.write("<tr class='schedult_lst'>")
            document.write("<th scope='col'></th>")
            document.write("<th scope='col'>월</th>")
            document.write("<th scope='col'>화</th>")
            document.write("<th scope='col'>수</th>")
            document.write("<th scope='col'>목</th>")
            document.write("<th scope='col'>금</th>")
            document.write("<th scope='col'>토</th>")
            document.write("<th scope='col'>일</th>")
            document.write("</tr>")
          document.write("</thead>")

          document.write("<tbody>")
            for(row=0; row<=47; row++){
              document.write("<tr>")
              if(row % 2 == 0){
                document.write("<td>"+row/2+" : 00 ~ "+row/2+" : 30</td>")
              }
              else{
                document.write("<td>"+(row/2 - 0.5)+" : 30 ~ "+(row/2 + 0.5)+" : 00</td>")
              }
              for(col=1; col<=7; col++){
                document.write("<td id="+row+"-"+col+" class='schu_line_bg' onclick='javascript:clickTdEvent(this)'>")
                document.write("<div class='schedule_area_v1'>")
                document.write("<span class='schedule_close'>X</span>")
                document.write("</div></td>")
              }
              document.write("</tr>")
            }
            document.write("</tbody>")
          document.write("</table>")
      </script>




      <!-- <div class="cal_top">
          <a href="#" id="movePrevMonth"><span id="prevMonth" class="cal_tit">&lt;</span></a>
          <span id="cal_top_year"></span>
          <span id="cal_top_month"></span>
          <a href="#" id="moveNextMonth"><span id="nextMonth" class="cal_tit">&gt;</span></a>
      </div>
      <div id="cal_tab" class="cal">
      </div>

      <script type="text/javascript">

          var today = null;
          var year = null;
          var month = null;
          var firstDay = null;
          var lastDay = null;
          var $tdDay = null;
          var $tdSche = null;
          var jsonData = null;
          $(document).ready(function() {
              drawCalendar();
              initDate();
              drawDays();
              drawSche();
              $("#movePrevMonth").on("click", function(){movePrevMonth();});
              $("#moveNextMonth").on("click", function(){moveNextMonth();});
          });

          //Calendar 그리기
          function drawCalendar(){
              var setTableHTML = "";
              setTableHTML+='<table class="calendar">';
              setTableHTML+='<tr><th>SUN</th><th>MON</th><th>TUE</th><th>WED</th><th>THU</th><th>FRI</th><th>SAT</th></tr>';
              for(var i=0;i<6;i++){
                  setTableHTML+='<tr height="100">';
                  for(var j=0;j<7;j++){
                      setTableHTML+='<td style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap">';
                      setTableHTML+='    <div class="cal-day"></div>';
                      setTableHTML+='    <div class="cal-schedule"></div>';
                      setTableHTML+='</td>';
                  }
                  setTableHTML+='</tr>';
              }
              setTableHTML+='</table>';
              $("#cal_tab").html(setTableHTML);
          }

          //날짜 초기화
          function initDate(){
              $tdDay = $("td div.cal-day")
              $tdSche = $("td div.cal-schedule")
              dayCount = 0;
              today = new Date();
              year = today.getFullYear();
              month = today.getMonth()+1;
              if(month < 10){month = "0"+month;}
              firstDay = new Date(year,month-1,1);
              lastDay = new Date(year,month,0);
              fd = lastDay.getDay();
          }

          //calendar 날짜표시
          function drawDays(){
              $("#cal_top_year").text(year);
              $("#cal_top_month").text(month);
              for(var i=firstDay.getDay();i<firstDay.getDay()+lastDay.getDate();i++){ //getDay는 요일을 나타냄 getdate는 그날의 날짜
                  $tdDay.eq(i).text(++dayCount); // eq는 tdDay의 index를 나타냄
              }
              for(var i=0;i<42;i+=7){
                  $tdDay.eq(i).css("color","red");
              }
              for(var i=6;i<42;i+=7){
                  $tdDay.eq(i).css("color","blue");
              }
          }

          //calendar 월 이동
          function movePrevMonth(){
              month--;
              if(month<=0){
                  month=12;
                  year--;
              }
              if(month<10){
                  month=String("0"+month);
              }
              getNewInfo();
              }

          function moveNextMonth(){
              month++;
              if(month>12){
                  month=1;
                  year++;
              }
              if(month<10){
                  month=String("0"+month);
              }
              getNewInfo();
          }

          //정보갱신
          function getNewInfo(){
              for(var i=0;i<42;i++){
                  $tdDay.eq(i).text("");
                  $tdSche.eq(i).text("");
              }
              dayCount=0;
              firstDay = new Date(year,month-1,1);
              lastDay = new Date(year,month,0);
              drawDays();
              drawSche();
          }

          //2019-08-27 추가본

          //데이터 등록
          function setData(){
              jsonData =  //json은 JavaScript Object Notation
              {
                  "2019":{
                      "07":{
                          "17":"제헌절"
                      }
                      ,"08":{
                          "7":"칠석"
                          ,"15":"광복절"
                          ,"23":"처서"
                      }
                      ,"09":{
                          "13":"추석"
                          ,"23":"추분"
                      }
                  }
              }
          }

          //스케줄 그리기
          function drawSche(){
              setData();
              var dateMatch = null;
              for(var i=firstDay.getDay();i<firstDay.getDay()+lastDay.getDate();i++){
                  var txt = "";
                  txt =jsonData[year];
                  if(txt){
                      txt = jsonData[year][month];
                      if(txt){
                          txt = jsonData[year][month][i];
                          dateMatch = firstDay.getDay() + i -1;
                          $tdSche.eq(dateMatch).text(txt);
                      }
                  }
              }
          }

      </script> -->


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

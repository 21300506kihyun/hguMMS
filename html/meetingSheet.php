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

      <input class="btn_left" type1="button" value="면담 신청하기"/>
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
      <div class="cal_top">
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
          }

          //calendar 날짜표시
          function drawDays(){
              $("#cal_top_year").text(year);
              $("#cal_top_month").text(month);
              for(var i=firstDay.getDay();i<firstDay.getDay()+lastDay.getDate();i++){
                  $tdDay.eq(i).text(++dayCount);
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
              jsonData =
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

      </script>



      <!-- <?php
      $conn = new mysqli("db4free.net","emawlrdl","toddlf930","mydata_21300506");
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
        echo "Connected successfully <br>";

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
        }
        } else {
            echo "0 results";
        }
        $conn->close();
      ?> -->

    </div>
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

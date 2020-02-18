<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel = "stylesheet" href = "../../css/meetingSheet.css"/>
  <meta name="google-signin-scope" content="profile email">
  <meta name="google-signin-client_id" content="924098158115-3oevbe0lurkhouu0fb98br6paj7i5e1a.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <style type="text/css">
    .year-week{text-align: center; font-size: 150%;}
    table{border-collapse:collapse}
    th{font-weight:normal}
    .bbs_table{width:100%;border:2px solid #d0d4d9;line-height:16px;/* IE7 수정 border-right:0 IE7 수정 */}
    .bbs_table th:first-child,.bbs_tbl_type2 td:first-child{border-left:0}
    .bbs_table th{padding:10px 9px 7px;border-width:0 0 0 1px;border-color:#dcdee2;border-style:solid;text-align:center;background-color:#eff0f2;color:#333}
    .bbs_table td{padding:10px 9px 7px;border-width:1px 0 0 1px;border-color:#edeef0 #dcdee2;border-style:solid;text-align:center;line-height:33px;color:#666;}
    .bbs_table td input[type=text],.bbs_tbl_type2 td select,.bbs_tbl_type2 td a.fron{margin:-6px 0 -2px}
    .bbs_table td.yes_hover:hover{border:2px solid #777 !important}
    .schu_line_bg{border:1px solid #ccc !important;background-color:/*#f9fafa*/ Gainsboro; cursor:pointer}
    .schedule_area_v1{position:relative; padding:18px 5px 16px;line-height:18px;font-size:12px}
    .schedule_area_v1 a{display:block;position:relative;color:#333}
    .schedule_area_v1 a:hover{font-weight:bold}
    .schedule_close{display:block;position:absolute;top:2px;right:2px;width:15px;height:15px;cursor:pointer}
  </style>
  <?php
    session_start();
    $name = $_SESSION["name"];
    $email = $_SESSION["email"] ;
    $img = $_SESSION["img"] ;

    $conn = new mysqli("localhost","hgumms","handong11*","hgumms");
    // Check connection
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
    }
     //echo "Connected successfully <br>";
   ?>
  <script>
    var meeting_list = new Array(); // 새로운 일정 추가하는 array이
    var modify_list = new Array(); // 기존에 DB에 있던 일정 수정(삭제)하는 array
    function clickTdEvent(obj){
        if(obj.style.backgroundColor === "white" ){
            obj.style.backgroundColor = "Gainsboro";
            obj.innerHTML = "<div class='schedule_area_v1'> <span class='schedule_close'>X</span> </div>";
            meeting_list.splice(meeting_list.indexOf(obj.id),1);
            modify_list.push(obj.id);
        }
        else{
            obj.style.backgroundColor = "white";
            obj.innerHTML = "<div class='schedule_area_v1'> <span class='schedule_close'>O</span> </div>";
            meeting_list.push(obj.id);
            //alert(meeting_list[0]);
            //$('#jb').html(obj.id);
          }
        //alert(obj.id);
    }
    function savetime(){
      meeting_list.forEach(function(element){
        var user = "<?php echo $_SESSION['email']?>";
        var day_list = element.split('-'); // 요일 표시
          console.log(day_list[0],day_list[1]);  // 날짜. 시간 표시
              var date= day_list[0];
              var time= day_list[1];

              $.ajax({
                  url:'sheet_time_add.php',
                  method:'POST',
                  data:{
                      user: user,
                      date:date,
                      time:time,

                  },
                 success:function(data){
                     //alert(data);
                 }
          });
      });
      modify_list.forEach(function(element){
        var user = "<?php echo $_SESSION['email']?>";
        var day_list = element.split('-'); // 요일 표시
          console.log(day_list[0],day_list[1]);  // 날짜. 시간 표시
              var date= day_list[0];
              var time= day_list[1];
              $.ajax({
                  url:'sheet_time_delete.php',
                  method:'POST',
                  data:{
                      user: user,
                      date:date,
                      time:time,
                  },
                 success:function(data){
                     //alert();
                 }
          });
      });
      alert("저장되었습니다");
      location.reload();
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
      <h2 class="subtitle">개인 면담 일정</h2>
      <div>
        <h3 class="left_subtitle"><?php echo $_SESSION['name']?>님 개인 면담 시트</h3>
        <h3 class="right_subtitle">개인의 고유 링크 혹은 QR code</h3>
      </div>

      <br>

      <?php // user의 스케줄을 표시하기 위해서 DB에서 그 유저의 스케줄을 받아서 array에 저장
      $arr_cnt = 0;
      $time_arr = array();
      $sql = "select * from sheet_info where owner = '$email'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              array_push($time_arr, $row);
              $arr_cnt += 1;
          }
          //print_r($xx);
          print_r($time_arr[0]['date']);
          //print_r($time_arr[0]['time']); // 첫번째 요소가 안불러와짐
          print_r($arr_cnt);
      } else {
          echo "0 results";
      }

        $dt = new DateTime;
        if (isset($_GET['year']) && isset($_GET['week'])) {
          $dt->setISODate($_GET['year'], $_GET['week']); // 2020 , 0주차면 자동으로 2019 마지막 주차로 변환 하는듯.
        } else {
          $dt->setISODate($dt->format('o'), $dt->format('W'));
        }

        //echo $dt -> format('y-m-d');
        $year = $dt->format('o');
        $week = $dt->format('W');  //1년중 몇번쨰 주차인지

        echo "<br>";
        echo "<div class='year-week'>";
        echo "<p>" . $year . "년 ";
        echo $week . "주차</p></div>";

        $conn->close();
      ?>

      <div style="font-size: 130%; ">
        <a style="float: left; text-decoration: none; color: #58666e;" href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week-1).'&year='.$year; ?>">◀ Prev Week </a> <!--Previous week-->
        <a style="float: right; text-decoration: none; color: #58666e;" href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week+1).'&year='.$year; ?>"> Next Week ▶</a> <!--Next week-->
      </div>
      <br>

      <?php
        $count = 0;
        echo '<table class="bbs_table">';
          echo '<colgroup>';
          echo '<col />';
          for($col=1; $col<=7; $col++){
            echo '<col style="width:12%">';
          }
          echo '</colgroup>';
          echo '<thead>';
            echo '<tr class="schedult_lst">';
              echo '<th>Time</th>';
              do {
                            // 월요일부터 일요일까지 표시
                echo "<th>" . $dt->format('l') . "<br>" . $dt->format('d M Y') . "</th>\n";
                $dt->modify('+1 day');
                $count ++;
              } while ($week == $dt->format('W'));
            echo '</tr>';
          echo '</thead>';

          echo '<tbody>';
            $dt->modify('-7 day');  //날짜를 그 주의 처음으로 돌리기
                //echo $dt->format('d M Y');
            $th = 8; // 시작시간 설정
            for($t =0; $t < 24; $t++){  //몇개의 시간으로 나타낼지
              $m = "00";
              $m2 = "30";
              $d = $t;
              $d %= 2; // 홀수 짝수 구분
              echo '<tr>';
              if($d == 0){
                echo "<td>" .$th.":".$m. "-".$th.":".$m2. "</td>";
                $th = $th+1;
              }else{
                $th2 = $th-1;
                echo "<td>" .$th2.":".$m2. "-".$th.":".$m. "</td>";
              }
              for($i = 0; $i < $count; $i++){
                if($d == 0){
                  $th = $th-1;
                  $var_dt = $dt->format('y')."년".$dt->format('m')."월".$dt->format('d')."일"."-".$th."시".$m."분"."~".$th."시".$m2."분";
                  $var_day = $dt->format('y')."년".$dt->format('m')."월".$dt->format('d')."일";
                  $var_time = $th."시".$m."분"."~".$th."시".$m2."분";
                  $th = $th+1;
                } else{
                  $var_dt = $dt->format('y')."년".$dt->format('m')."월".$dt->format('d')."일"."-".$th2."시".$m2."분"."~".$th."시".$m."분";
                  $var_day = $dt->format('y')."년".$dt->format('m')."월".$dt->format('d')."일";
                  $var_time = $th2."시".$m2."분"."~".$th."시".$m."분";
                }
                $todo = '';
                $col = 0;
                    for($j =0; $j <= $arr_cnt ; $j ++){
                    if($time_arr[$j]['date'] == $var_day && $time_arr[$j]['time'] == $var_time){ //날짜와 시간이 맞는지 확인
                      $todo = 'yes';
                      $col = 1;
                      }
                  }
                  if($col == 0){
                    echo "<td id =". $var_dt . " class='schu_line_bg yes_hover' onClick='javascript:clickTdEvent(this)'>" .
                    "<div class='schedule_area_v1'>" . "<span class='schedule_close'>X</span>" . "\n" ."</div>".$todo. "</td>";}
                  else {
                    echo "<td id =". $var_dt . " style ='background-color:white;' class='yes_hover' onClick='javascript:clickTdEvent(this)'>" .
                    "<div class='schedule_area_v1'>" . "<span class='schedule_close'>X</span>" . "\n" ."</div>".$todo. "</td>";
                  }
                  $dt->modify('+1 day');
                }
              echo '</tr>';
              $dt->modify('-7 day');
            }
          echo '</tbody>';
        echo '</table>';
      ?>

      <div class="btns">
          <input class="btn_back" type="button" value="돌아가기" onclick="location.href='../main/main.php'"/>
          <input class="btn_save" type="button" value="변경 사항 저장하기" onclick="javascript:savetime()"/>
      </div>
    </div>
  </div>

  <div class = "footer">
    <h3>Powered by WA lab 2020</h3>
    <p>문의 및 버그제보: abcd@gmail.com</p>
  </div>
</body>
</html>

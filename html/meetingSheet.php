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

  <!-- <style type="text/css">

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
  </style> -->
  <style type="text/css">
    body,div,p,h1,h2,h3,h4,h5,h6,ul,ol,li,dl,dt,dd,table,th,td,form,fieldset,legend,input,textare,a,button,select{margin:0;padding:0}
    /* body,input,textarea,select,button,table{font-family:'돋움',dotum,AppleGothic,sans-serif;font-size:12px} */
    body{word-break:break-all}
    a{text-decoration:none}
    a:hover,a:active,a:focus{text-decoration:underline}
    caption,legend,.blind{visibility:hidden;overflow:hidden;width:0;height:0;font-size:0;line-height:0;text-align:left}
    hr{display:none}
    table{border-collapse:collapse}
    th{font-weight:normal}
    .bbs_table{width:100%;border:1px solid #d0d4d9;line-height:16px;/* IE7 수정 */*border-right:0/* IE7 수정 */}
    .bbs_table th:first-child,.bbs_tbl_type2 td:first-child{border-left:0}
    .bbs_table th{padding:10px 9px 7px;border-width:0 0 0 1px;border-color:#dcdee2;border-style:solid;text-align:center;background-color:#eff0f2;color:#333}
    .bbs_table td{padding:10px 9px 7px;border-width:1px 0 0 1px;border-color:#edeef0 #dcdee2;border-style:solid;text-align:center;line-height:33px;color:#666;/* IE7 수정 */*border-left:0;*border-top:0;*border-bottom:1px solid #edeef0;*border-right:1px solid #dcdee2;/* IE7 수정 */}
    .bbs_table td input[type=text],.bbs_tbl_type2 td select,.bbs_tbl_type2 td a.fron{margin:-6px 0 -2px}
    .bbs_table td.yes_hover:hover{border:2px solid #666 !important}
    .bbs_table tr:first-child td{border-top:1px solid #dcdee2}
    .bbs_table tr:first-child td.yes_hover:hover{border-top:2px solid #666 !important}
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

      <br>

      <?php
        $dt = new DateTime;
        if (isset($_GET['year']) && isset($_GET['week'])) {
          $dt->setISODate($_GET['year'], $_GET['week']); // 2020 , 0주차면 자동으로 2019 마지막 주차로 변환 하는듯.
        } else {
          $dt->setISODate($dt->format('o'), $dt->format('W'));
        }

        //echo $dt -> format('y-m-d');
        $year = $dt->format('o');
        $week = $dt->format('W');  //1년중 몇번쨰 주차인지

        echo "<div style='text-align: center; font-size: 150%;'>";
        // echo "<br>";
        echo "<p>" . $year . "년 ";
        echo $week . "주차</p></div>";
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
              echo '<th></th>';
              // echo '<tr>';
              // echo '<td> time   </td>';
              do {
                // 월요일부터 일요일까지 표시
                // echo "<td>" . $dt->format('l') . "<br>" . $dt->format('d M Y') . "</td>\n";
                echo "<th>" . $dt->format('l') . "<br>" . $dt->format('d M Y') . "</th>\n";
                $dt->modify('+1 day');
                $count ++;
              } while ($week == $dt->format('W'));
            echo '</tr>';
          echo '</thead>';

          echo '<tbody>';
            $dt->modify('-7 day');  //날짜를 그 주의 처음으로 돌리기
                //echo $dt->format('d M Y');
            $th = 0; // 시작시간 설정
            for($t =0; $t < 48; $t++){
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
                $var_dt = $dt->format('y-m-d')."-".$th."-".$m;
                // echo "<td id =". $var_dt . " onClick= 'move(this.id)'>" . "off". "\n" ."</td>";
                echo "<td id =". $var_dt . " class='schu_line_bg yes_hover' onClick='javascript:clickTdEvent(this)'>" . "<div class='schedule_area_v1'>" . "<span class='schedule_close'>X</span>" . "\n" ."</div></td>";
                $dt->modify('+1 day');
              }
              echo '</tr>';
              $dt->modify('-7 day');
            }
          echo '</tbody>';
        echo '</table>';
      ?>

      <div class="btns">
          <input class="btn_back" type="button" value="돌아가기" onclick="location.href='main.php'"/>
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

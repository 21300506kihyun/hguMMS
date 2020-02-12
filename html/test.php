
<HTML>
<HEAD>
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="924098158115-3oevbe0lurkhouu0fb98br6paj7i5e1a.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta charset="utf-8">
    <script type="text/javascript" src ="../JS/script.js"></script>
    <link rel = "stylesheet" href = "../css/login.css"/>
    <title>handongMMS</title>

    <!-- <style type="text/css">

    table{
        border: 1px solid black;
        display: inline-table;
        text-align: left;
    }
    table td{
        vertical-align: top;
        border: 1px solid skyblue;
        width: 100px;
    }
    </style> -->
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
      .bbs_table td:hover{border: 1px solid black !important}
      .bbs_table tr:first-child td{border-top:1px solid #dcdee2}
      .bbs_table tr:first-child td:hover{border-top:1px solid #777 !important}
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


</HEAD>
<BODY>

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

    echo $year . "<br>";
    echo $week. "<br>";
  ?>

  <a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week-1).'&year='.$year; ?>">Pre Week</a> <!--Previous week-->
  <a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week+1).'&year='.$year; ?>">Next Week</a> <!--Next week-->
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
            echo "<td id =". $var_dt . " class='schu_line_bg' onClick='javascript:clickTdEvent(this)'>" . "<div class='schedule_area_v1'>" . "<span class='schedule_close'>X</span>" . "\n" ."</div></td>";
            $dt->modify('+1 day');
          }
          echo '</tr>';
          $dt->modify('-7 day');
        }
      echo '</tbody>';
    echo '</table>';
  ?>

  <div id="rand-val"></div>
	<button id = "tswefwefww" onclick="innerHTMLTest(this.id)">Generate</button>
  <script type= "text/javascript">
    function move(cl){
      alert("wefwefw");
      var randValNode = document.getElementById("rand-val");
      randValNode.innerHTML = "<b><font color='red'>"+cl+"</font></b>";
    }
  </script>
</BODY>
</HTML>

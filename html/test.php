
<HTML>
<HEAD>
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="924098158115-3oevbe0lurkhouu0fb98br6paj7i5e1a.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta charset="utf-8">
    <script type="text/javascript" src ="../JS/script.js"></script>
    <link rel = "stylesheet" href = "../css/login.css"/>
    <title>handongMMS</title>

    <style type="text/css">

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
    </style>

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
    echo '<table>';
        echo '<tr>';
        echo '<td> time   </td>';
    do {
           // 월요일부터 일요일까지 표시
        echo "<td>" . $dt->format('l') . "<br>" . $dt->format('d M Y') . "</td>\n";
        $dt->modify('+1 day');
        $count ++;
    } while ($week == $dt->format('W'));
      {echo    '</tr>';}

    $dt->modify('-7 day');  //날짜를 그 주의 처음으로 돌리기
        //echo $dt->format('d M Y');
    $th =8; // 시작시간 설정
    for($t =8; $t < 28; $t++){
      $m = "00";
      $m2 = "30";
      $d = $t;
      $d %= 2; // 홀수 짝수 구분
      echo '<tr>';
      if($d == 0){
        echo "<td>" .$th.":".$m. "-".$th.":".$m2. "</td>";
        $th = $th+1;
      } else{
        $th2 = $th-1;
        echo "<td>" .$th2.":".$m2. "-".$th.":".$m. "</td>";
      }
      for($i = 0; $i < $count; $i++){
        if($d ==0){
          $th = $th-1;
          $var_dt = $dt->format('y-m-d')."-".$th.":".$m. "-".$th.":".$m2;
          echo "<td id =". $var_dt . " onClick= 'select(this.id)'>" . "off". "\n" ."</td>";
          $th = $th+1;
        } else{
          $var_dt = $dt->format('y-m-d')."-".$th2.":".$m2. "-".$th.":".$m;
          echo "<td id =". $var_dt . " onClick= 'select(this.id)'>" . "off". "\n" ."</td>";

        }
          $dt->modify('+1 day');
      }
      echo '</tr>';
      $dt->modify('-7 day');
    }
      echo '</table>';
    ?>
    <div id="rand-val"></div>
  	<button id = "tswefwefww" onclick="innerHTMLTest(this.id)">Generate</button>
    <script type= "text/javascript">
    function select(cl){

      var arr = new Array("qwd","qwdq"); //배열선언
      arr.push(cl);
      arr.forEach(function(element)) {
        //alert(element);
      }
    }
    </script>
</BODY>
</HTML>

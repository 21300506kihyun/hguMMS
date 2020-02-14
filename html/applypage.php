
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel = "stylesheet" href = "../css/applyMeeting_search.css"/>
  <meta name="google-signin-scope" content="profile email">
  <meta name="google-signin-client_id" content="924098158115-3oevbe0lurkhouu0fb98br6paj7i5e1a.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

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
     echo "Connected successfully <br>";

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
      <h2><?php echo $_SESSION['name']?> </h2>
      <h3 class="info">E-mail : <?php echo $_SESSION['email']?></h3>
      <h3 class="info">소속 학부 : <?php if($_SESSION['department'] == ''){echo 'none';} else {echo $_SESSION['department'];}?></h3>
      <h3 class="info">오피스 위치 : <?php if($_SESSION['office'] == ''){echo 'none';} else {echo $_SESSION['office'];}?></h3>
      <h3 class="info">면담 제공 여부 : <?php if($_SESSION['prof'] == 'on'){echo 'O';} else{echo 'X';}?></h3>
      <h3 class="info">시트 제공 여부 : <?php if($_SESSION['sheet'] == 'on'){echo 'O';} else{echo 'X';}?></h3>

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
      <h2 class="subtitle">면담 신청하기</h2>
      <div>
        <h3 class="left_subtitle">면담 제공자 조회하기 (Search by Name)</h3>
      </div>

      <br>
      <br>
      <form name="bizLoginForm123" method="post" action="" >
        <input type="text" name="search_name" />
      <input type="submit" value="검색" />
      </form>

      <table>
        <tr>
          <th>소속 학부</th>
          <th>이름</th>
          <th>개인 면담 시트</th>
          <th>오피스</th>
          <th>이메일</th>
          <th>면담 신청</th>
        </tr>
        <?php
        $name = $_POST['search_name'];
        echo $name;
        $sql = "select *  from user_info where name = '$name'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo '<th>'. $row["department"]. '</th>';
              echo '<th>'. $row["name"]. '</th>';
              echo '<th>' . $row["sheet"]. '</th>';
              echo '<th>'. $row["office"]. '</th>';
              echo '<th>'. $row["email"]. '</th>';
              $temp = $row["email"]; // 교수님 이메일
              echo  "<th>". "<form name=\"go_sheet\" method=\"post\" action=\"view_sheet.php\" >
                      <input type=\"hidden\" name=\"prof_name\" value = \"$name\">
                      <input type=\"hidden\" name=\"prof_email\" value = \"$temp\">
                    <input type=\"Submit\" value=\"신청\"/>" ."</th>";
              echo  '</tr>';
            } echo '</table>';
        } else {
            echo "0 results";
        }

        $conn->close();
         ?>

      </table>

      <br>
      <div class="btns">
          <input class="btn_back" type="button" value="돌아가기" onclick="location.href='main.php'"/>
      </div>
    </div>

  </div>


  <div class = "footer">
    <h3>Powered by WA lab 2020</h3>
    <p>문의 및 버그제보: abcd@gmail.com</p>
  </div>

</body>
</html>

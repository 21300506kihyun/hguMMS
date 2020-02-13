<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
</head>
<body>

  <?php
    session_start();
    $db_host = 'localhost';
    $db_user = 'hgumms';
    $db_password = 'handong11*';
    $db_database = 'hgumms';
    $prof = $_POST['is_prof'];
    $sheet = $_POST['is_sheet'];
    $phone = $_POST['phone'];
    $office = $_POST['office'];
    $email = $_SESSION['email'];

    $connect = new mysqli($db_host, $db_user, $db_password, $db_database);
    // $connect->query("SET NAMES 'utf8'", $connect);
    if($connect->connect_error){
      die("CONNECTION FAILED : " . $conn->connect_error);
    }
    // echo "CONNECTION SUCCESS <br>";

    //TODO: DB에서 prof value INT -> varchar로 바꿔야 함
    //TODO: DB에 면담 제공여부 + 면담시트 제공여부 만들어야할까?(어짜피 시트에서 긁어오는 건데 상관이 없겟다 그죠?)
    $sql = "UPDATE user_info SET prof='$prof', sheet='$sheet', phone='$phone', office='$office' where email='$email'";

    if($connect->query($sql) === TRUE){
      echo "<script charset=utf-8>alert('개인정보가 수정되었습니다.')</script>";
      echo "<script>location.href='main.php'</script>";
      // echo "SUCCESS";
    }
    else{
      echo "ERROR : " . $sql ." + " . $connect->error . ";;";
    }

    $_SESSION['office'] = $office;
    $_SESSION['prof'] = $prof;
    $_SESSION['sheet'] = $sheet;
    $connect->close();
  ?>

</body>
</html>

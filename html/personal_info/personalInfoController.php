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
    $department = $_POST['department'];
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

    $sql = "UPDATE user_info SET department='$department', prof='$prof', sheet='$sheet', phone='$phone', office='$office' where email='$email'";

    if($connect->query($sql) === TRUE){
      echo "<script charset=utf-8>alert('개인정보가 수정되었습니다.')</script>";
      echo "<script>location.href='../main/main.php'</script>";
      // echo "SUCCESS";
    }
    else{
      echo "ERROR : " . $sql ." + " . $connect->error . ";;";
    }

    $_SESSION['department'] = $department;
    $_SESSION['office'] = $office;
    $_SESSION['prof'] = $prof;
    $_SESSION['sheet'] = $sheet;
    $connect->close();
  ?>

</body>
</html>

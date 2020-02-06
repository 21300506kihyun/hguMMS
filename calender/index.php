<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    $servername = "db4free.net";
    $username = "emawlrdl";
    $password = "toddlf930";
    $dbname = "mydata_21300506";
    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    $sql = "select * from time_dimension";
    //쿼리보내고 결과를 변수에 저장
    $result = $conn->query($sql);
    echo "MySQL에서 가져온 데이터는 아래와 같습니다.<br/>";
    echo "<table border='1'>
          <tr>
          <th>Firstname</th>
          <th>Lastname</th>
          </tr>";
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. " - db_date: " . $row["db_date"]. " year: " . $row["year"]. "<br>";
        }
    } else {
        echo "0 results";
    }
    ?>

  </body>
</html>

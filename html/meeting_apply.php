<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php


    $conn = new mysqli("localhost","hgumms","handong11*","hgumms");
    // Check connection
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
    }
     echo "Connected successfully <br>";


     $date = $_POST['date'];
     $name = $_POST['name'];
     $f_name = $_POST['f_name'];

     // echo $date ."<br>";
     // echo $name ."<br>"  ;
     // echo $f_name;

    $sql="insert into meeting_info (stu_name,prof_name, time, state) values ('$name','$f_name', '$date', 0)";
    if ($conn->query($sql) === TRUE) {
        echo "data inserted";
    }
    else
    {
        echo $conn->error;;
    }
     ?>
  </body>
</html>

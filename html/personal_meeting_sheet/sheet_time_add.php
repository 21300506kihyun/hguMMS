<?php
$conn = new mysqli("localhost","hgumms","handong11*","hgumms");
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
 echo "Connected successfully <br>";

$user=$_POST['user'];
$date=$_POST['date'];
$time=$_POST['time'];


$sql="insert into sheet_info (owner,time, date, state) values ('$user','$time', '$date',0)";
if ($conn->query($sql) === TRUE) {
    echo "data inserted";
}
else
{
    echo $conn->error;;
}
?>


 <!DOCTYPE html>
 <html>
 <head>
   <meta charset="UTF-8">
   <link rel = "stylesheet" href = "../css/no_sheet.css"/>
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

     if(isset($_POST['prof_name']) && isset($_POST['prof_email'])){ // 보고자 하는 교수님에 대한 정보 저장
       //echo $_POST['prof_name'];
       //echo $_POST['prof_email'];
       $_SESSION["view_name"] = $_POST['prof_name'];
       $_SESSION["view_email"] = $_POST['prof_email'];
     }
     $f_name = $_SESSION["view_name"];
     $f_email = $_SESSION["view_email"];
     //echo $f_name;
     //echo $f_email;
     $conn = new mysqli("localhost","hgumms","handong11*","hgumms");
     // Check connection
     if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
     }
      //echo "Connected successfully <br>";
    ?>
   <script>
     var meeting_list = new Array();
     function clickTdEvent(obj){
         if(obj.style.backgroundColor === "white" ){
             obj.style.backgroundColor = "#b3daff";
             obj.innerHTML = "<div class='schedule_area_v1'> <span class='schedule_close'>X</span> </div>";
             meeting_list.splice(meeting_list.indexOf(obj.id),1);
         }
         else{
             obj.style.backgroundColor = "white";
             obj.innerHTML = "<div class='schedule_area_v1'> <span class='schedule_close'>O</span> </div>";
             meeting_list.push(obj.id);
             //alert(meeting_list[0]);
             //$('#jb').html(obj.id);
           }
     }
     function savetime(){
       meeting_list.forEach(function(element){
         var user = "<?php echo $_SESSION['email']?>";
         var day_list = element.split('-'); // 요일 표시
           console.log(day_list[0],day_list[1],day_list[2]);  // 날짜. 시간, 요일 표시
               var date= day_list[0];
               var time= day_list[1];
               var day= day_list[2];
               $.ajax({
                   url:'sheet_time.php',
                   method:'POST',
                   data:{
                       user: user,
                       date:date,
                       time:time,
                       day:day
                   },
                  success:function(data){
                      //alert(data);
                  }
           });
       });
       //meeting_list.forEach(element => console.log(element.substring(0,9),element.substring(9,15),element.substring(21,)));
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

       <input class="btn_left" onclick="location.href ='applypage.php'" type="button" value="면담 신청하기"/>
       <form action="meetingSheet.php" method="post">
         <input class="btn_left" type="submit" value="개인 면담 시트 바로가기"/>
       </form>
       <form action="personalInfo.php" method="post">
         <input class="btn_left" type="submit" value="개인정보 수정하기"/>
       </form>
       <form action="meetingAccept.php" method="post">
         <input class="btn_left" type="submit" value="면담승인 요청"/>
       </form>
       <input class="btn_left" onClick="location.href='login.php' "type="button" value="로그아웃"/>
     </div>

     <div class="column middle">
       <h2 class="subtitle">면담 신청하기</h2>
       <div>
         <h2 class='sub_subtitle'><?php echo $f_name ?> 님의 면담 시트일정</h2>
       </div>

       <div class='content'>
         <p>개인 면담 시트가 없습니다.</p>
       </div>

       <div class="btns">
           <input class="btn_back" type="button" value="돌아가기" onclick="location.href='applypage.php'"/>
           <input class="btn_save" type="button" value="면담 일정 제안하기" onclick="javascript:savetime()"/>
       </div>
     </div>
   </div>

   <div class = "footer">
     <h3>Powered by WA lab 2020</h3>
     <p>문의 및 버그제보: abcd@gmail.com</p>
   </div>
 </body>
 </html>

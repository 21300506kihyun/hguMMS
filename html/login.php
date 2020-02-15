<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta name="google-signin-scope" content="profile email">
  <meta name="google-signin-client_id" content="924098158115-3oevbe0lurkhouu0fb98br6paj7i5e1a.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <meta charset="utf-8">
  <script type="text/javascript" src ="../JS/script.js"></script>
  <link rel = "stylesheet" href = "../css/login.css"/>
  <title>handongMMS</title>
  <script>
    function onSignIn(googleUser) {
      // Useful data for your client-side scripts:
      var profile = googleUser.getBasicProfile();
      document.getElementById('name1').value = profile.getName();
      document.getElementById('email1').value = profile.getEmail();
      document.getElementById('img1').value = profile.getImageUrl();
      console.log(profile.getImageUrl());

      // The ID token you need to pass to your backend:
      var id_token = googleUser.getAuthResponse().id_token;
      console.log("ID Token: " + id_token);

      next.style.display = '';
      logout.style.display = '';
    }

    function signOut() {
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function () {
        console.log('User signed out.');
      });
      next.style.display = 'none';
      logout.style.display = 'none';
    }
  </script>
</head>
<body>
  <div class = "header">
    <h1 id="title">HGU Meeting Management System (MMS)</h1>
    <br>
    <p>한동대학교 면담 예약 및 관리 시스템입니다.</p>
  </div>
  <div class = "container">
    <h2 class="subtitle">Google Login</h2>
    <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
    <form action="main.php" method="post">
      <input style="display: none" class="info" id = 'name1' name ="name1"  value ="wefwe"  />
      <input style="display: none" class="info" id = 'email1' name ="email1"  value ="wefe"/>
      <input style="display: none" class="info" id = 'img1' name ="img1" value =""/>
      <input id="next" class="submit" type="submit" value="HGU MMS 접속하기" style="display:none"/>
    </form>
    <input id="logout" class="logout" type="submit" href="#" onclick="signOut();" style="display:none" value="로그아웃">
  </div>
</body>
</html>

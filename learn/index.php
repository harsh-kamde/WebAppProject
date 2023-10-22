<!-- <html>
<body>

<form method="post" action="contact.php">
  Name: <input type="text" name="fname">
  <br>
  Email: <input type="email" name="email">
  <br>
  password: <input type="password" name="pass">
  <br>
  <input type="submit">
</form> -->

<!-- search suggestion  -->
<!-- <html>
<head>
<script>
function showHint(str) {
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "gethint.php?q=" + str, true);
    xmlhttp.send();
  }
}
</script>
</head>
<body>

<p><b>Start typing a name in the input field below:</b></p>
<form action="">
  <label for="fname">First name:</label>
  <input type="text" id="fname" name="fname" onkeyup="showHint(this.value)">
</form>
<p>Suggestions: <span id="txtHint"></span></p>
</body>
</html> -->
<!-- 
<html>
<head>
<script>
function showResult(str) {
  if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","livesearch.php?q="+str,true);
  xmlhttp.send();
}
</script>
</head>
<body>

<form>
<input type="text" size="30" onkeyup="showResult(this.value)">
<div id="livesearch"></div>
</form>

</body>
</html> -->

<!-- AJAX Poll -->
<!-- <html>
<head>
<script>
function getVote(int) {
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("poll").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","poll_vote.php?vote="+int,true);
  xmlhttp.send();
}
</script>
</head>
<body>

<div id="poll">
<h3>Do you like PHP and AJAX so far?</h3>
<form>
Yes: <input type="radio" name="vote" value="0" onclick="getVote(this.value)"><br>
No: <input type="radio" name="vote" value="1" onclick="getVote(this.value)">
</form>
</div>

</body>
</html> -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP page</title>
</head>
<body>
  
  <?php

  // function add(){
  //   $sum = 0;
  //   foreach (func_get_args() as $num ) {
  //     $sum += $num;
  //   }
  //   return $sum;

  // }


  // echo add(3,2,3,53,2);
  // echo "<br>";
  // echo add(3,3,3);


  // function show_Name($name, $prefix="Mr."){
  //     return $prefix." ".$name;
  // }

  // echo show_Name("Hello Man")


  // // set a cookie
  // $cookie_name = "cookie_name";
  // $cookie_value = "cookie_value";
  // setcookie($cookie_name, $cookie_value, time() + 3600, "/");



  // // delete a cookie
  // setcookie($cookie_name, "", time() - 3600, "/");

// Sessions 
//   session_start();

//   if(isset($_SESSION['visit_counter'])){
//     $_SESSION['visit_counter'] += 1;   
//   }
//   else{
//     $_SESSION['visit_counter'] = 1;
//   }

//  $message = "you have visited this page ".$_SESSION['visit_counter']." in this session.";
//  echo $message;

// //  destroy the session
//  session_destroy();

// database mysqli

$host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "Students";
$conn = mysqli_connect($host, $db_user, $db_password, $db_name) or die("Connection error: ".mysqli_connect_error());

if ($conn) {
  echo "Connection successful";

  $sql = "SELECT * FROM student";
  $results = mysqli_query($conn, $sql);
  
  while ($row = mysqli_fetch_assoc($results)){
    echo $row['stu_name']," : ".$row['course'],"</br>";
  }

}
else{
  echo "Connection failed";
}

  ?>


</body>
</html>
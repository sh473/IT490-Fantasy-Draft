<html>
<head>
<style type="text/css">
 input{
 border:1px solid olive;
 border-radius:5px;
 }
 h1{
  color:darkgreen;
  font-size:22px;
  text-align:center;
 }
 p{
  text-align: center; 
 }
</style>
</head>
<body>
<h1>Login</h1>
<form action='#' method='post'>
<table cellspacing='5' align='center'>
<tr><td><input type='hidden' name='username'/></td></tr>
<tr><td>User name:</td><td><input type='text' name='username'/></td></tr>
<tr><td>Password:</td><td><input type='password' name='password'/></td></tr>
<tr><td></td><td><input type='submit' name='submit' value='Submit'/></td></tr>
</table>

<p>        
Not a member? <a href="Registration.php">Register</a>
</p>

</form>
<?php
session_start();
if(isset($_POST['submit']))
{
 $db_host = '10.0.2.4';
 $db_user = 'root';
 $db_password = 'root';
 $db_db = 'it490';
 $myConnection = mysqli_connect($db_host,$db_user,$db_password);
 mysqli_select_db($db_db, 'users') or die(mysqli_error());
 $username=$_POST['username'];
 $password=$_POST['password'];
 if($username!=''&&$password!='')
 {
   $query=mysql_query("SELECT * FROM users
WHERE username='".$username."' and password='".$password."'") or die(mysql_error());
   $res=mysql_fetch_row($query);
   if($res)
   {
    $_SESSION['username']=$username;
    header('location:10.0.2.6:8080');
   }
   else
   {
    echo'Your username or password is incorrect';
   }
 }
 else
 {
  echo'Enter both username and password';
 }
}
session_write_close();
?>
</body>
</html>
<?php

$host="mysql16.000webhost.com"; // Host name 
$username="a7009401_zach"; // Mysql username 
$password="zach1829"; // Mysql password 
$db_name="a7009401_users"; // Database name 
$tbl_name="members"; // Table name 

// Connect to server and select databse.
$con = mysql_connect("$host", "$username", "$password");
if (!$con){
 die("cannot connect");
}
mysql_select_db("$db_name", $con)or die("cannot select DB");

// email and password sent from form 
$myemail=$_POST['myemail']; 
$mypassword=$_POST['mypassword'];
$mypasswordrepeated=$_POST['mypasswordrepeated'];

// To protect MySQL injection
$myemail = stripslashes($myemail);
$mypassword = stripslashes($mypassword);
$mypasswordrepeated = stripslashes($mypasswordrepeated);
$myemail = mysql_real_escape_string($myemail);
$mypassword = mysql_real_escape_string($mypassword);
$mypasswordrepeated = mysql_real_escape_string($mypasswordrepeated);
$checkemail="SELECT * FROM $tbl_name WHERE email='$myemail'";
$checkemailresult=mysql_query($checkemail,$con);

// Mysql_num_row is counting table row
$numemails=mysql_num_rows($checkemailresult);

if (strcmp($mypassword, $mypasswordrepeated) != 0){
die('Passwords did not match');
}

if (!strstr($myemail, "@carleton.edu")){
die('You must have a Carleton email.');
}

// If result matched $myemail and $mypassword, table row must be 1 row
if($numemails==0){

$addaccount="INSERT INTO $tbl_name (email, password) VALUES ('$myemail', '$mypassword')";
$addaccountresult=mysql_query($addaccount, $con);
if (!addaccountresult)
  {
  die('Error: ' . mysql_error());
  }
mysql_close($con);
header("location:pick_username.php");
}
else {
echo "An account with that email already exists";
}
?>		
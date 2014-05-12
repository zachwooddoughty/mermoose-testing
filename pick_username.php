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

$username_filename = "usernames.txt";
$username_file = fopen($username_filename, "r");

if ($username_file == false){
  echo("Error opening username file");
  exit();
}

$line = "poop";
while ($line != false){
  $line = fgets($username_file);
  $usernames[] = $line;
}

fclose($username_file);

$available_usernames = array();
for ($i = 1; $i <= 7; $i++) {
  $j = rand(0, count($usernames) - 1);
  if (in_array($usernames[$j], $available_usernames) == false && $usernames[$j]){
    $available_usernames[] = $usernames[$j];
  }
  else {
    $i--;
  }
}
for ($i = 0; $i < count($available_usernames); $i++){
  $output = "Available username: ";
  $output .= $available_usernames[$i];
  $output .= " \n";
  echo nl2br($output);
}

?>

<html>

<head>
</head>

<body>

<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="login_success.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3"><strong>Pick an Available Username </strong></td>
</tr>
<tr>
<td width="78">Username</td>
<td width="6">:</td>
<td width="294"><input name="myusername" type="text" id="myusername"></td>
</tr>
<td colspan="3"><strong>Please reenter your email and password </strong></td>
</tr>
<tr>
<td width="78">Carleton Email</td>
<td width="6">:</td>
<td width="294"><input name="myemail" type="text" id="myemail"></td>
</tr>
<tr>
<td>Password</td>
<td>:</td>
<td><input name="mypassword" type="password" id="mypassword"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Login"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
</body>
</html>	
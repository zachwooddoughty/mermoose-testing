<?php

$host="mysql16.000webhost.com"; // Host name 
$username="a7009401_zach"; // Mysql username 
$password="zach1829"; // Mysql password 
$db_name="a7009401_users"; // Database name 
$tbl_name="members"; // Table name 

// Connect to server and select database.
$con = mysql_connect("$host", "$username", "$password");
if (!$con){
 die("cannot connect");
}
mysql_select_db("$db_name", $con)or die("cannot select DB");

// email and password sent from form 
$myemail=$_POST['myemail'];
$mypassword=$_POST['mypassword'];


if ($myemail && $mypassword){

// To protect MySQL injection (more detail about MySQL injection)
$myemail = stripslashes($myemail);
$mypassword = stripslashes($mypassword);
$myemail = mysql_real_escape_string($myemail);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM $tbl_name WHERE email='$myemail' and password='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myemail and $mypassword, table row must be 1 row
if($count==1){
// First check if we already have a username
// We may have come from the login page, so find the username from the database.
$getusername="SELECT * FROM $tbl_name WHERE email='$myemail'";
$getusernameresult= mysql_query($getusername, $con);
if (mysql_num_rows($getusernameresult) ==1)
{ // if email appears once
$usernamerow = mysql_fetch_array($getusernameresult);
if (isset($usernamerow['username']))
{ // if valid username
$myusername = $usernamerow['username'];
} else {
$myusername = "";
}
}
}
else
{ // count != 1
die("Wrong email or password");
} 
}
//If we didn't find a username in database, try to add one from POST data
if (isset($_POST['myusername'])){
// If we've received a POST username, then we've come from a new registration
// We need to add the username to the database, and update the usernames.txt file

$username_filename = "usernames.txt";
$username_file = fopen($username_filename, "r");

if ($username_file == false){
die("Error opening username file");
}

$line = "poop";
while ($line != false){
$line = fgets($username_file);
$usernames[] = trim($line);
}

fclose($username_file);

// username sent from form 

$myusername=$_POST['myusername'];
unset($_POST['myusername']);

if (in_array(trim($myusername), $usernames) == false){
die("You entered an invalid username or something went wrong with your session. Please return to the home page and try logging in again.");
}

// To protect MySQL injection
$myusername = stripslashes($myusername);
$myusername = mysql_real_escape_string($myusername);

// We have a valid username, but we need to remove it from the text file.
if(($key = array_search($myusername, $usernames)) !== false) {
unset($usernames[$key]);
}

// Write back everything except the removed username
$username_file = fopen($username_filename, "w");

if ($username_file == false){
echo("Error opening username file");
exit();
}

foreach ($usernames as $name){
$line = $name . PHP_EOL;
fwrite($username_file, $line);
}

fclose($username_file);

// Check for other accounts already using this username

$checkusername="SELECT * FROM $tbl_name WHERE username='$myusername'";
$checkusernameresult=mysql_query($checkusername,$con);
$numusernames=mysql_num_rows($checkusernameresult);
if($numusernames==0)
{ // if username not in use
$addusername="UPDATE $tbl_name SET username='$myusername' WHERE email='$myemail'";
$addusernameresult=mysql_query($addusername, $con);
if (!$addusernameresult)
{ // if failed attempt to add username
die('Error: ' . mysql_error());
} 

mysql_close($con);
}
else
{ // else username in use
die("An account with that username already exists or you attempted to register twice. Please return to the home page and log in again.");
}
}  //END IF username isset
else
{ // if we couldn't add one and don't have one, return to pick_username.php
if (!$myusername){
header("location:pick_username.php");
}
}
?>

<html>
<body>
<?
//Switch to entries database table
$tbl_name="entries";

$con = mysql_connect("$host", "$username", "$password");
if (!$con){
 die("cannot connect");
}
mysql_select_db("$db_name", $con)or die("cannot select DB");

$owner_array = array();
$id_array = array();
$row_array = array('A','B','C','D','E','F','G','H','I','J');

for ($row_index = 0; $row_index <= 9; $row_index++){
$owner_array[] = array();
$id_array[] = array();
for ($col_index =1; $col_index <= 8; $col_index++){

$name_query = "SELECT * from $tbl_name WHERE row='$row_array[$row_index]' AND col='$col_index' ORDER BY `date` DESC LIMIT 1";
$name_result = mysql_query($name_query);
if (mysql_num_rows($name_result) == 1){
$name_result_array = mysql_fetch_array($name_result);
$name = $name_result_array['name'];
$owner_array[$row_index][$col_index] = $name;
$id = $name_result_array['id'];
$id_array[$row_index][$col_index] = $id;
} // end num rows > 1

}
} // end both for loops

$ownership_query = "SELECT * from $tbl_name WHERE first='$myusername' OR second='$myusername'";
$ownership_result = mysql_query($ownership_query);
$ownership_ids = array();
for ($i = 0; $i < mysql_num_rows($ownership_result); $i++){
$ownership_result_array = mysql_fetch_array($ownership_result);
$ownership_ids[] = $ownership_result_array['id'];
}




?>
<h1>Welcome, <?=$myusername?>.</h1> <br> Squares you control or jointly control are colored red. If you and a friend claimed a square together, you have been assigned a new duo username to represent the two of you.<br>
Scroll down below the map to claim a square. <br>
<table border="1" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
<tr>
<td colspan="9"><strong><center>Fuck A Little</center></strong></td>
</tr>
<tr>
<td width="30"></td>
<?php for ($i = 1; $i < 9; $i++){ echo "<td width='100'><strong><center>" . $i . "</center></strong></td>"; } ?>
</tr>
<?php 
for ($k = 0; $k <= 9; $k ++){
echo "<tr><td width='30'><strong><center>" . $row_array[$k] . "</center></strong></td>";
for ($j = 1; $j < 9; $j++){
$bgcolor = "";
if (in_array($id_array[$k][$j], $ownership_ids)){
$bgcolor = "bgcolor=#FF0000";
}
echo "<td " . $bgcolor . "><center><img src='/grid/" . strtolower($row_array[$k]) . $j . ".png'/></center></td>";
}
echo "</tr><td width='30'><strong>Owner:</strong></td>";
for ($i = 1; $i < 9; $i++){
$bgcolor = "";
if (in_array($id_array[$k][$i], $ownership_ids)){
$bgcolor = "bgcolor=#FF0000";
}
echo '<td ' . $bgcolor . '><center>' . $owner_array[$k][$i] . '</center></td>';
}
echo "</tr>";
}
?>
</table><br><br>

<center><h1>Please remember that all sex must be<br>consensual and safe to claim a square.</h1></center>

<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="claim.php">
<td>
<table border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3"><strong><center>Claim a square!</center></strong></td>
</tr>
<tr>
<td width="120">Row (A-J)</td>
<td width="6">:</td>
<td width="294"><input name="row" type="text" id="row"></td>
</tr>
<tr>
<td>Column (1-8)</td>
<td>:</td>
<td><input name="col" type="text" id="col"></td>
</tr>
<tr>
<td>Share code*</td>
<td>:</td>
<td><input name="share" type="text" id="share"></td>
</tr>
<tr>
<td><input name="myemail" type="hidden" id="myemail" value="<?php echo $myemail; ?>"></td>
<td><input name="mypassword" type="hidden" id="mypassword" value="<?php echo $mypassword; ?>"></td>
<td><input name="myusername" type="hidden" id="myusername" value="<?php echo $myusername; ?>"></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Claim!"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>

<center>* If a friend already claimed a square for sex you were a partner in, <br>ask them for the share code they received so you can claim the square together!</center>
</body>
</html>
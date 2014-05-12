<?php

$host="mysql16.000webhost.com"; // Host name 
$username="a7009401_zach"; // Mysql username 
$password="zach1829"; // Mysql password 
$db_name="a7009401_users"; // Database name 
$tbl_entries="entries"; // Table name 
$tbl_duo_names = "duo_names";

// Connect to server and select databse.
$con = mysql_connect("$host", "$username", "$password");
if (!$con){
 die("cannot connect");
}
mysql_select_db("$db_name", $con)or die("cannot select DB");

// email and password sent from form
$myusername=$_POST['myusername'];
$myemail=$_POST['myemail']; 
$mypassword=$_POST['mypassword'];
$row = $_POST['row'];
$col = $_POST['col'];
$share = $_POST['share'];

// To protect MySQL injection
$myemail = stripslashes($myemail);
$mypassword = stripslashes($mypassword);
$myusername = stripslashes($myusername);
$row = stripslashes($row);
$col = stripslashes($col);
$share = stripslashes($share);
$myemail = mysql_real_escape_string($myemail);
$mypassword = mysql_real_escape_string($mypassword);
$myusername = mysql_real_escape_string($myusername);
$row = mysql_real_escape_string($row);
$col = mysql_real_escape_string($col);
$share = mysql_real_escape_string($share);

//check for share code, see if we can add to another player
if ($share){
$query = "SELECT * FROM $tbl_entries WHERE share='$share' ORDER BY `date` DESC LIMIT 1";
$result = mysql_query($query);
$num_results = mysql_num_rows($result);
if ($num_results > 0){
$result_array = mysql_fetch_array($result);
$shared_entry_id = $result_array['id'];
$first_player = $result_array['first'];
$row = $result_array['row'];
$col = $result_array['col'];

$players_array = array($first_player, $myusername);
sort($players_array);

$duo_name_query = "SELECT * FROM $tbl_duo_names WHERE first='$players_array[0]' AND second='$players_array[1]'";
$duo_name_result = mysql_query($duo_name_query);
$num_results = mysql_num_rows($duo_name_result);
if ($num_results > 0){
// If we have found a duo_name for user 1 and user 2, then set that.
$duo_result_array = mysql_fetch_array($duo_name_result);
$duo_name = $duo_result_array['duo_name'];
} else{
// Otherwise, generate a name for the two and insert it into the duo_name table

$duo_name_filename = "duo_names.txt";
$duo_name_file = fopen($duo_name_filename, "r");

if ($duo_name_file == false){
echo("Error opening duo_name file");
exit();
}

$line = "poop";
while ($line != false){
$line = fgets($duo_name_file);
$duo_names[] = trim($line);
}

fclose($duo_name_file);

$duo_name = "";
while (!$duo_name){
$duo_name_index = rand(0, count($duo_names) - 1);
$duo_name = $duo_names[$duo_name_index];
}
unset($duo_names[$duo_name_index]);

// Write back everything except the removed username
$duo_name_file = fopen($duo_name_filename, "w");

if ($duo_name_file == false){
echo("Error opening duo_name file");
exit();
}

foreach ($duo_names as $name){
$line = $name . PHP_EOL;
fwrite($duo_name_file, $line);
}

fclose($duo_name_file);

$create_duo_query = "INSERT INTO $tbl_duo_names (first, second, duo_name) VALUES ('$players_array[0]', '$players_array[1]', '$duo_name')";
echo $create_duo_query;
mysql_query($create_duo_query);


} // end num_results > 0 if/else

$update_entry_query = "UPDATE $tbl_entries SET first='$players_array[0]', second='$players_array[1]', name='$duo_name' WHERE id='$shared_entry_id'";
mysql_query($update_entry_query);


}
} // end share if
else
{ // create individual claim entry
$chars = "abcdefghijklmnopqrstuvwxyz";
for( $i = 0; $i < 4; $i++ ) {
	$share_code .= $chars[ rand( 0, strlen($chars) - 1 ) ];
}
$query = "INSERT INTO $tbl_entries (row, col, first, name, share) VALUES('$row', '$col', '$myusername', '$myusername', '$share_code')";
$result = mysql_query($query);
}
?>
<html>
<head><title>You have claimed a square!</title></head>
<body>
<center><h2>You have claimed square [<?php echo $row . "," . $col ?>]!</h2><br><br>

<?php if (!$share){ echo "If your partner in coitus also wishes to receive credit for this square without knocking you off the board, have them claim the square by typing in your share code! <br>
Your share code is: " . $share_code . "."; } else { echo "You shared a square with " . $first_player . "! The two of you will be forever known as " . $duo_name . "!";} ?>
</center>
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="login_success.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td><input name="myemail" type="hidden" id="myemail" value=<?php echo $myemail ?>>
<input name="mypassword" type="hidden" id="mypassword" value=<?php echo $mypassword ?>></td>
</tr>
<tr>
<td><input type="submit" name="Submit" value="Okay"></td>
</tr>
</table>

</body>
</html>
 
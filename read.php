<?php
    $start_time = time();
?>
<html>

<head>
<title>Mermoose</title>
<script>
var start_time = new Date().getTime();
function arrive()
{
    alert("Hello!");
}
function leave()
{
    //$("#testForm").submit();
    var str1 = "You spent ";
    var str2 = " seconds on this page!";
    var time = new Date().getTime() - start_time;
    alert(str1.concat(time, str2));
}
</script>
</head>

<body onload="arrive()", onbeforeunload="leave()">
<!--<form name="myForm" id="testForm" method="POST" action="index.php">
UserName: <input type="text" name="user" value="test" /> <br/>
Password: <input type="password" name="password" value="test"/> <br/>
</form>
-->

Woo this is an awesome article.

<a href="index.php">Back to home</a>

</body>
</html>

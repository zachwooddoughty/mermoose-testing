<?php
    $start_time = time();
?>
<html>

<head>
<title>Mermoose</title>
<script>
function arrive()
{
    alert("Hello!");
}
function leave()
{
    //$("#testForm").submit();
    alert("You spent " . '<?php echo (time() - $start_time) ?>' . " seconds on this page!");
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

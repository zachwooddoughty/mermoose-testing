<html>

<head>
<title>Mermoose</title>
</head>
<script>
$(window).unload(function () {
    $("#testForm").submit();
});

</script>
</head>
<form name="myForm" id="testForm" method="POST" action="index.php">
UserName: <input type="text" name="user" value="test" /> <br/>
Password: <input type="password" name="password" value="test"/> <br/>
</form>
Woo this is an awesome article.

<a href="index.php">Back to home</a>

</body>
</html>

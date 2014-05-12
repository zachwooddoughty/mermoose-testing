<html>

<head>
<title>Mermoose</title>
<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
</head>

<body>
<form name="myForm" id="testForm" method="POST" action="index.php">
UserName: <input type="text" name="user" value="test" /> <br/>
Password: <input type="password" name="password" value="test"/> <br/>
</form>

<button id="reload">Refresh a Page in jQuery</button>
 
<script type="text/javascript">
 
	$('#reload').click(function() {
 
	 	location.reload();
 
	});
 
	$(window).bind('beforeunload', function(){
		alert("goodbye!");
	});
 
</script>

Woo this is an awesome article.

<a href="index.php">Back to home</a>

</body>
</html>

<html>

<head>
<title>Mermoose</title>
<script>
var start_time = new Date().getTime();
function leave()
{
    var str1 = "You spent ";
    var str2 = " seconds on this page!";
    var time = new Date().getTime() - start_time;
    alert(str1.concat(time, str2));

    document.myForm.time_input.value = '100';
    document.myForm.submit();

    //document.getElementById("time_input").value = time;
    //document.getElementById("testForm").submit();
    
}
</script>
</head>

<body onbeforeunload="leave()">
<form name="myForm" id="testForm" method="POST" action="index.php">
    <input type="text" name="time_input" id="time_input"/>
</form>

Woo this is an awesome article.

<a href="index.php">Back to home</a>

</body>
</html>

<html>

<head>
<title>Mermoose</title>
<script>
var start_time = new Date().getTime();
function arrive()
{
    document.myForm.style.display = 'none';
}
function leave()
{
    var str1 = "You spent ";
    var str2 = " seconds on this page!";
    var time = new Date().getTime() - start_time;
    //alert(str1.concat(time, str2));

    document.myForm.time_input.value = time;
    document.myForm.submit();
}
</script>
</head>

<body onload="arrive()" onbeforeunload="leave()">
<form name="myForm" method="POST" action="index.php">
    <input type="text" name="time_input" id="time_input"/>
</form>

<a href="index.php">Back to home</a>

<?php
$article = "articles/" . $_GET["id"] . ".txt";
echo readfile($article)
?>

<a href="index.php">Back to home</a>

</body>
</html>

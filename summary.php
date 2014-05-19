<html>

<head>
<title>Mermoose</title>
</head>

<body>

<a href="read.php?id="<?php echo $_GET["id"]; ?> >Read Full Article</a>
<br><br>

<?php
$article = "summaries/" . $_GET["id"] . ".txt";
$myfile = fopen($article, "r") or die("Unable to open file!");
while(!feof($myfile)) {
  echo fgets($myfile) . "<br>";
}
fclose($myfile);
?>

<br><br>
<a href="index.php">Back to home</a>

</body>
</html>

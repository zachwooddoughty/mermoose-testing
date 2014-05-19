<html>

<head>
<title>Mermoose</title>
</head>

<body>

<?php
echo "<a href='read.php?id=" . $_GET["id"] . "'> Read Full Article</a><br><br>";
?>
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

<html>
<head>
<title>Mermoose</title>
</head>

<script>

</script>

<body>

Welcome to Mermoose!
<br>

<?php
$time = $_POST['time'];
if (!is_null($time))
{
    echo "You spent " . $time . " milliseconds on that last article!";
}
?>

<?php
for ($i = 1; $i <=10; $i++)
{
    $articles_dir = "articles/";
    $myfile = fopen($articles_dir . $i . ".txt", "r") or die("Unable to open file!");
    echo "<a href='read.php?id=" . $i . "'>" . fgets($myfile) . "</a><br><br>";
    fclose($myfile);
}
?>
</body>
</html>

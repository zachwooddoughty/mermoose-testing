<?php
$name = $_POST['time'];
print_r($_POST)
?>
<html>
<head>
<title>Mermoose</title>
</head>

<script>

</script>

<body>

<?php
for ($i = 1; $i <=10; $i++)
{
    $articles_dir = "articles/";
    $myfile = fopen($articles_dir . $i . ".txt", "r") or die("Unable to open file!");
    echo "<a href='read.php?" . $i . "'>" . fgets($myfile) . "</a><br><br>";
    fclose($myfile);
}
?>
</body>
</html>

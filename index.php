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

Welcome to Mermoose! This is a site with some words that you are going to read and while you do we will track how long it takes you to read them!
<br>

<?php
for ($i = 1; $i <=10; $i++)
{
    $articles_dir = "articles/";
    $myfile = fopen($articles_dir . $i . ".txt", "r") or die("Unable to open file!");
    echo "<a href='read.php?" . $i . "'>" . fgets($myfile) . "</a><br><br>";
    fclose($myfile);
}
?>
<br><br>
I think that <?php echo "your name is" . $name ?> or something.

</body>
</html>

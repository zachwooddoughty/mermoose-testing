<?php
$name = $_POST['user'];
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
<a href="read.php">A cool article</a>
I think that <?php echo "your name is" . $name ?> or something.

</body>
</html>

<html>

<head>
<title>Mermoose</title>
</head>

<body>

<button type="button" onclick="myFunction()">Date</button>

<p id="demo"></p>

<script>
function myFunction() {
    document.getElementById("demo").innerHTML = Date();
}
</script>

<script type="text/javascript">
    var startTime = new Date();        //Start the clock!
    window.onbeforeunload = function()        //When the user leaves the page(closes the window/tab, clicks a link)...
    {
        var endTime = new Date();        //Get the current time.
        var timeSpent=(endTime - startTime);        //Find out how long it's been.
        alert(timeSpent);        //Pop up a window with the time spent in microseconds.
    }
</script>

Check out this fucking awesome article!

</body>
</html>

<?php //include("userauth.php"); ?>
<html>
<head>
<title>Disc Golf Foursomes/Threesomes Player Manager</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
H4 {
   color: red;
   font-size: 20px;
   font-weight: bold;
   font-family: arial,tahoma,verdana,sans-serif;
 }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div class="w3-responsive w3-margin-left">
<!--<img src="logo.png">-->
<H4>FOURSOMES/THREESOMES GENERATOR ~ MANAGER</H4>
<?php
$players = $_REQUEST["players"];
$csvfile = 'players.txt';
$file_handle = fopen($csvfile, 'r');

if(!$_REQUEST["players"]) {
echo "<hr><b>Use This Panel To Add/Edit/Delete Players In The Club/League List</b>";
echo "<fieldset>";
echo "(<i>Be sure to leave no empty rows or spaces after names</i>)";
echo "<form class='w3-container' action='manage.php' method='REQUEST' id='panelone'>";
echo "<textarea class='w3-input w3-border' name='players' rows='30' cols='10'>";
while (($data = fgetcsv($file_handle)) !== FALSE) {
    echo $data[0];
  }
fclose($file_handle);
echo "</textarea>";
echo "<br><input type='submit' value='Update This Listing'> &nbsp;&nbsp;&nbsp;<font color='red'><< click the button to save your changes</font>";
echo "</form>";
}
if($_REQUEST['players']) {
echo "<hr>";
echo "<div class='w3-responsive w3-margin-left'>";
echo "<a href=\"manage.php\" class='w3-button w3-red'>Reload</a>";
echo "<br><br>";
echo "</div>";
echo "<div class='w3-responsive'>";
echo "<fieldset class='w3-responsive w3-margin'>";
echo "<legend><b>AND HERE'S WHAT HAPPENED . . .</b></legend>\n";

$players=array();

// Get values from form and put them in an array
$players = $_REQUEST['players'];
$list = array($players);
$file = fopen("players.txt","w");
foreach ($list as $line){
 fputcsv($file,explode('\r\n', $line));
}
fclose($file);
$players = explode("\r\n",$players);

if (in_array('',$players,true)) {
	echo "Hmmm . . . your list contains empty spaces.<br/>";
	echo "You need to <a href=\"manage.php\">go back</a>, get rid of the spaces and try it again.<br/>";
	die();
}

echo "<h4>Nicely Done! Click the [Reload] button to see the updated list.</h4>";
echo "</fieldset>";
echo "<div class='w3-container w3-margin-left'>";
echo "</div>";
echo "</div>";
}
?>
<h5>HIGHLY RECOMMENDED:</h5>
<div>
<p>We highly recommend that you copy and save your club or league player list to a plain text file on your local computer. Please don't use a word processor. Use a text editor like Windows Notepad, Editpad Lite (<a href="https://www.editpadlite.com/" target="_blank">https://www.editpadlite.com/</a>) or even Online Editpad (<a href="https://www.editpad.org/" target="_blank">https://www.editpad.org/</a>).  That way, if you would happen to accidently delete the player list above, you can restore it from your saved text file.</p>
</div>
<footer id="footer">
<details>
<summary>Copyright &copy; <?php echo date('Y'); ?></summary>
<p>Mark Drone. All Rights Reserved.</p>
</details>
</footer>

</body>
<script>
function myFunction() {
// Reload the page keeping the REQUEST data
    location.reload();
}
</script>

</html>

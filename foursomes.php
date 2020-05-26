<?php
session_start();
$d=4;
$_SESSION["radios"] = $_REQUEST["radios"];
$d=$_SESSION["radios"];
?>
<html>
<head>
<title>Disc Golf Player Foursomes/Threesomes Randomizer</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="bootstrap.css">
<script src="jquery-3.4.1.min.js"></script>
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
 /* background-color: #2196F3; */
  background-color: #f22121;
}

input:focus + .slider {
 /* box-shadow: 0 0 1px #2196F3; */
  box-shadow: 0 0 1px #f22121;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

.input_fields_wrap{
max-width: 350px;
}
.input_fields_wrap input[type=text]{
 width:100%;
 margin:2px 0;
}
H4 {
   color: red;
   font-size: 20px;
   font-weight: bold;
   font-family: arial,tahoma,verdana,sans-serif;
 }
#count-checked-checkboxes,.form-required, #output, #total  {
    color:red;
}
span.counter {
  font-size: 18px;
  font-weight: 700;
}
span.number {
   color: red;
   font-weight: 700;  
}

</style>
</head>
<body>
<?php

$radio_options = array('3' => 'Threesomes/Twosomes','4' => 'Foursomes/Threesomes',);

if (count($_REQUEST, 1) > 0) {
	unset($_SESSION['form']);

foreach ($_REQUEST as $key=>$value) {
	$_SESSION['form'][$key] = $value;
}

foreach ($_SESSION['form'] as $key=>$value) {
	$$key = $value;

  }
}
?>
<div class="w3-responsive w3-margin">
[ Go To <a href="doubles.php" target="_blank">Doubles Randomizer</a> ]
<H4>FOURSOMES/THREESOMES RANDOM GENERATOR</H4>
<form name="form" method="POST" action="<?php echo $_SESSION['PHP_SELF'] ?>">
<table>
<tr>
<td>
<?php
if($_REQUEST['checkbox']) {
?>
<label>Foursomes/Threesomes: <input type="radio" name="radios" value="4" <?php if($_SESSION["radios"]=='4'){ echo "checked"; } ?>  onchange="this.form.submit()" /></label>
<br/>
<label>Threesomes/Twosomes: <input type="radio" name="radios" value="3" <?php if($_SESSION["radios"]=='3'){ echo "checked"; } ?>  onchange="this.form.submit()"/></label>
<br/>
<label>Twosomes Only: <input type="radio" name="radios" value="2" <?php if($_SESSION["radios"]=='2'){ echo "checked"; } ?>  onchange="this.form.submit()"/></label>
<?php } ?>

<?php 
/*
if($_REQUEST["max"]=='3' || $_SESSION["radios"]=='3') {
echo '<label class="switch"><input name="radios" id="switch" type="checkbox" value="3" checked / onchange="this.form.submit()"><span class="slider round"></span></label> Threesomes/Twosomes';
} else {
echo '<label class="switch"><input name="radios" id="switch" type="checkbox" value="3" / onchange="this.form.submit()"><span class="slider round"></span></label> Threesomes/Twosomes';
}
*/
?>
</td>
</tr>
</table>
</form>
<?php
if($_REQUEST['checkbox']) {
    if($_REQUEST["max"]=='2' || $_REQUEST["radios"]=='2') {
        echo "<fieldset>Your groups will have no more than <b>2 players</b> in them</fieldset>";
    } elseif ($_REQUEST["max"]=='3' || $_REQUEST["radios"]=='3') { 
        echo "<fieldset>Your groups will have a maximimum number of <b>3 players</b> in them</fieldset>";
    } else {
        echo "<fieldset>Your groups will have a maximimum number of <b>4 players</b> in them</fieldset>";
    $d='4';
    }
}
if(!$_REQUEST["checkbox"]) {
echo "<b>Use The Checkboxes Below To Select Players For Groups To Play Today</b>";
echo "<fieldset>";
?>
<form action="foursomes.php" method="REQUEST" id="panelone">
<div class="count-checkboxes-wrapper">
<b>Players Playing Today</b>: <span class="counter" id="count-checked-checkboxes">0</span><br/>
New Players Just For Today: <span class="counter" id="output">0</span><br/>
<fieldset style="display: inline-block;"><b>Total:</b> <span class="counter" id="total">0</span></fieldset> <a href="foursomes.php" class="btn btn-default">Reset</a>
</div>
<table border="0" class="w3-table-all">
<tr class="w3-red">
<th>SELECT</th>
<th>PLAYER</th>
</tr>
<?php
$i = 0;
$csv = array();
$enclosure = '"';
$row = file('players.txt', FILE_IGNORE_NEW_LINES);
    $num = count($row);
echo "There are <span class='number'>".$num." </span>players in the listing<br/>";

foreach ($row as $key => $value) {
    $csv[$key] = str_getcsv($value,$enclosure);
?>
<tr>
<td align="center" bgcolor="#FFFFFF">
<input class="w3-check" name="checkbox[]" type="checkbox" value="<?php echo $csv[$key][0];?>" />
</td>
<td align="center">
<input name="user[]" type="hidden" id="user" value="<?php echo $csv[$key][0];?>"><?php echo $csv[$key][0]; ?>
</td>
</tr>
<?php
 $i++;
 }
?>
<button type="button" id="increment" class="add_field_button">Add Player Field</button>
<button type="button" id="decrement" class="remove_field_button">Remove Player Field</button>
<br/>
<div class="input_fields_wrap">
</div>
<a href="#" class="" id="selectAll" value="selectAll">Select/Deselect All Players</a>
<?php
echo "</table>";
echo "<br><input type=\"submit\" value=\"Group These Players\" \>";
echo "</form>";
}

if($_REQUEST['checkbox']) {
echo "<br/>";
echo "<div class='w3-responsive w3-margin-left'>";
echo "<a href=\"foursomes.php\" class='w3-button w3-red'>Reset</a>";
echo "&nbsp;&nbsp;";
echo "<button class='w3-button w3-red' onclick=\"myFunction()\">Mix This List Again</button>";
echo "<br><br>\n";
echo "</div>";

/*
if(!$_REQUEST["radios"] && $_REQUEST["max"]=='') {
echo "<fieldset><b>Oops! Please Click the Reset Button and Select Threesomes/Twosomes or Foursomes/Threesomes First</fieldset>";
//die();
}
*/

echo "<fieldset class='w3-responsive w3-margin'>";
echo "<legend><b>RESULTS</b></legend>\n";
echo "<b>";
// Get values from form and put them in an array
$players = $_REQUEST['checkbox'];
$addplayers = $_REQUEST['user2'];

if($addplayers != '') {
  $players = array_merge($players,$addplayers);
}

if (in_array('',$players,true)) {
  echo "Hmmm . . . your list contains empty spaces.<br/>";
  echo "You better <a href='foursomes.php'>go back</a> and try it again.<br/>";
  die();
}

// Randomize the values in the array
shuffle($players);

// Count the elements in the array
$howmany = count($players);

echo "<i>There are ".$howmany." golfers arranged in ";

if(!$_SESSION['$radios'] || $d = '') {
//$d = $_REQUEST['max'];
}


if($howmany<'6') { $numgroups = '1'; } else {
$numgroups = ceil($howmany/$d);
}
echo $numgroups." groups</i><br/><br/>";

$groups = array();

for ($index=0; $index < $numgroups; $index++) {
	array_push($groups,array());
}

for ($index = 0; $index < $howmany; $index++) {
	array_push($groups[$index%$numgroups],$players[$index]);
    }

for ($index=0; $index < $numgroups; $index++) {
	$count = $index+1;
//	echo "<b><font color='#F44336'>Group ".$count."</font></b><br/>";
	echo "<span style='font-size:16px;color:#F44336;font-weight:bold;border: 1px solid;padding:2px;'>Group ".$count."</span><br/>";
	for ($index2=0; $index2 < count($groups[$index]); $index2++) {
		echo "<li style='padding-left:30px; list-style-type: \"→ \";'>".$groups[$index][$index2]."</li>";
	}
}
echo "</b>";
echo "</fieldset>";
echo "<div class='w3-container w3-margin-left'>";
echo "<br/>";
echo "Click the symbol at the lower left to manage the player listing. The management panel will open in a new window or tab.";
echo "<br/>";
echo "</div>";
echo "</div>";
 }
?>
<div class='w3-margin-left'><a href="manage.php" target="_blank"><font size="+1">&#167;</font></a></div>
<footer id="footer">
<details>
<summary>Copyright &copy; <?php echo date('Y'); ?></summary>
<p>Mark Drone. All Rights Reserved.</p>
</details>
</footer>
</body>
<script>
function myFunction() {
    location.reload();
}
</script>

<script>
/* Special thanks to Jake Wolpert @ https://forum.jquery.com/ for his help with this code */
var max_fields = 16;
var wrapper = $(".input_fields_wrap");
var add_button = $(".add_field_button");
var remove_button = $(".remove_field_button");

/* ADD NEW PLAYER TEXT FIELDS */
add_button.click(function(e) {
    e.preventDefault();
    var total_fields = wrapper[0].childNodes.length;
    if(total_fields < max_fields) {
        $(wrapper).append('<tr class="new-player"><td align="center" bgcolor="#FFFFFF">NEW PLAYER:</td><td align="center"><input type="text" name="user2[]" id="user" class="field-long"></td></tr>');
    }
    totalItUp()
});

/* REMOVE NEW PLAYER TEXT FIELDS */
remove_button.click(function(e) {
    e.preventDefault();
    var total_fields = wrapper[0].childNodes.length;
    if(total_fields > 1) {
        wrapper[0].childNodes[total_fields - 1].remove();
    }
    totalItUp()
});

/* SELECT/DESELECT CHECKBOXES */
$('#selectAll').click(function(e) {
    e.preventDefault();
    $("input:checkbox").prop('checked', function(i, current) {
        return !current;
    });
    totalItUp()
});

/* COUNT SELECTED CHECKBOXES */
$('input[type="checkbox"]').change(totalItUp);

function totalItUp() {
    var newPlayers = $('.new-player').length,
        checked = $(":checked").length;
    $('#count-checked-checkboxes').text(checked);
    $('#output').text(newPlayers);
    $('#total').text(checked + newPlayers);
}

</script>
</html>

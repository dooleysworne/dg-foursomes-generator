<?php //include("userauth.php"); ?>
<html>
<head>
<title>Disc Golf Player Doubles Randomizer</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="http://code.jquery.com/jquery.js"></script>
<style>
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
#count-checked-checkboxes,.form-required, #output {
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
<div class="w3-responsive w3-margin">
<button class='w3-button w3-red' onclick="myFunction()">Reset</button>
[ Go To <a href="foursomes.php" target="_blank">Foursomes/Threesomes Random Generator</a> ]
<H4>DOUBLES TEAMS RANDOMIZER</H4>
<hr>
<?php

if(!$_REQUEST["checkbox"]) {

echo "<b>Use This Web App To Randomize Doubles Teams</b>";
echo "<fieldset>";
?>
<form action="doubles.php" method="REQUEST" id="panelone">
<div class="count-checkboxes-wrapper">
<b>Players Playing Today</b>: <span class="counter" id="count-checked-checkboxes">0</span><br/>
New Players Just For Today: <span class="counter" id="output">0</span>
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

//echo "There are <span class='number'>".$num." </span>players in the listing<br/>";

foreach ($row as $key => $value) {
    $csv[$key] = str_getcsv($value,$enclosure);
?>
<tr>
<td align="center" bgcolor="#FFFFFF">
<input class="w3-check" name="checkbox[]" type="checkbox" value="<?php echo $csv[$key][0];?>" />
</td>
<td align="center">
<input name="user[]" type="hidden" id="user" value="<? echo $csv[$key][0];?>"><?php echo $csv[$key][0]; ?>
</td>
</tr>
<?php
 $i++;
 }
?>
<button type="button" id="increment" class="add_field_button">Add Player Field</button>
<button type="button" id="decrement" class="remove_field_button">Remove Player Field</button>
<br/>
<!--<label><input type="checkbox" name="checkAll" id="checkAll" class="checkAll"/> Select All Players</label>
 <label><input type="checkbox" name="checkbox" class="selectall"/> Select All Players</label> -->
<div class="input_fields_wrap">
</div>
<a href="#" class="" id="selectAll" value="selectAll">Select/Deselect All Players</a>
<?php
echo "</table>";
echo "<br><input type=\"submit\" value=\"Pair These Players\" \>";
echo "</form>";
}

if($_REQUEST['checkbox']) {
echo "<br/>";
echo "<div class='w3-responsive w3-margin-left'>";
echo "<a href=\"doubles.php\" class='w3-button w3-red'>Reset</a>";
echo "&nbsp;&nbsp;";
echo "<button class='w3-button w3-red' onclick=\"myFunction()\">Mix The Pairings Again</button>";
echo "<br><br>\n";
echo "</div>";
echo "<fieldset class='w3-responsive w3-margin'>";
echo "<legend><b>RESULTS</b></legend>\n";

// Get values from form and put them in an array
$players = $_REQUEST['checkbox'];
$addplayers = $_REQUEST['user2'];

if($addplayers != '') {
  $players = array_merge($players,$addplayers);
}

$teams = $players;

$number_of_teams = count($teams);

shuffle($teams);

echo "<ol>";

// Pair the adjacent teams
for ( $index = 0; $index < $number_of_teams; $index +=2) {

if($teams[$index+1] == '') { $teams[$index+1] = "[Nobody]"; }

     echo "<li><font color='#800000'><b>".$teams[$index] ."</b></font> paired with <font color='#800000'><b>" . $teams[$index+1] . "</b></font></li>\n";
}

echo "</ol>";

if ($number_of_teams % 2 != 0) {
end($teams);
$z=prev($teams);
echo "<font color='#800000'><b>*** ".$z." will play Cali ***</font>";

}

echo "</fieldset>";
echo "<div class='w3-container w3-margin-left'>";
echo "</div>";
echo "</div>";
}
?>
<div class='w3-margin-left'><a href="manage.php" target="_blank">*</a></div>
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

var max_fields      = 16;
var wrapper         = $(".input_fields_wrap");
var add_button      = $(".add_field_button");
var remove_button   = $(".remove_field_button");

$(add_button).click(function(e){
	e.preventDefault();
	var total_fields = wrapper[0].childNodes.length;
	if(total_fields < max_fields){
		$(wrapper).append('<tr><td align="center" bgcolor="#FFFFFF">NEW PLAYER:</td><td align="center"><input type="text" name="user2[]" id="user" class="field-long"></td></tr>');
	}
});
$(remove_button).click(function(e){
	e.preventDefault();
	var total_fields = wrapper[0].childNodes.length;
	if(total_fields>1){
		wrapper[0].childNodes[total_fields-1].remove();
	}
});

$('.selectall').click(function() {
    if ($(this).is(':checked')) {
        $('input:checkbox').attr('checked', true);
    } else {
        $('input:checkbox').attr('checked', false);
    }
});
</script>

<script type="text/javascript">

/* SELECT ALL CHECKBOXES 

jQuery(document).ready(function(){
    var checkAll = document.getElementById('checkAll');
    checkAll.onchange = function(){
        var set = false;
        if (this.checked) {
            set = true;
        }
        var checkboxes = document.getElementsByName('checkbox[]');
        for (var i = 0, n = checkboxes.length; i < n; i++){ checkboxes[i].checked = set; } }; });
 END SELECT ALL CHECKBOXES */
</script>

<script>
$(document).ready(function() {
  $('#selectAll').click(function(e){
    e.preventDefault();
    $("input:checkbox").prop('checked', function(i, current) { return !current; });
  });
});
</script>

<script>
$(document).ready(function(){
    var $checkboxes = $('input[type="checkbox"]');
    $checkboxes.change(function(){
        var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
//      if (this.id === "checkAll" && this.checked) {
//        $('#count-checked-checkboxes').text(countCheckedCheckboxes-1);
//        } else {        
        $('#count-checked-checkboxes').text(countCheckedCheckboxes);
//        }
    });
});

$('#increment').click(function() {
    $('#output').html(function(i, val) { return val*1+1 });
});
$('#decrement').click(function() {
    $('#output').html(function(i, val) {
        if (val <= 0) { return; }
        return val*1-1
     });
});

$('#count-checked-checkboxes, #output').change(function(){
   var val1 = $('#count-checked-checkboxes').val();
   var val2 = $('#output').val();
   //$("#total").val(val1+' '+val2);
   $('#total').val(val1 + val2);
   $("#total").change();
console.log(val1);
console.log(val2);
});    
</script>
</html>

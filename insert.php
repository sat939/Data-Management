<!DOCTYPE html>
<html>
<head>
<style>
h1{ color:black;text-align:center; }
body{ background-color:#d0e4fe; }
a{ font-size:20px; }
p{color:red;font-size:18px;font:'verdana';>
</style>
</head>
<body>
<h1>PHARMACEUTICAL STORES DATA MANAGMENT</h1>
<!------------------------common for all pages----------------------->
<h2><center>
<table border="2" bgcolor="lightpink"><tr>
<td>
<FORM>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE="BUTTON" VALUE="Home" ONCLICK="window.location.href='home.php'">

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" onclick="window.location.href='select.php'">Select</button>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" onclick="window.location.href='insert.php'">Insert</button>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" onclick="window.location.href='update.php'">Update</button>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" onclick="window.location.href='delete.php'">Delete</button>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" onclick="window.location.href='queries.php'">Queries</button>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</FORM></td>
 </tr></table></center></h2>
<!-------------------------------------------------------->

<?php
// Create connection to Oracle
$con = oci_connect("SYSTEM", "sat", "XE");

if (!$con)
{
   $m = oci_error();
   echo $m['message'], "\n";
   exit;
}
else 
{
	echo "</br>";
   echo "<center><b>Connected to Oracle!</b></center>";
	
}

echo "<br/>";

echo "<br/>";
echo "<center><u>INSERT STATEMENT EXECUTION</u>";

echo "<br/>";
echo "<table border='0'><tr><td>";
echo "<form name='selectform' method='GET' action='insert.php'>";
echo "<input type='radio' name='group1' value='customer'> Customer<br>";
echo "<input type='radio' name='group1' value='doctor'> Doctor<br>";
echo "<input type='radio' name='group1' value='store'> Store<br>";
echo "<input type='radio' name='group1' value='medicines'> Medicines<br>";
echo "<input type='radio' name='group1' value='supplier'> Supplier<br>";
echo "<input type='radio' name='group1' value='inventory'> Inventory<br>";
echo "<input type='radio' name='group1' value='employee'> Employee<br>";
echo "</td></tr></table>";
echo "enter values to insert(seperated by comma):"; 
echo "<input type='text' name='group2' style='width:250px'><br/>";
echo "<INPUT type='submit' name='submit' value='Insert Data'>";


if(isset($_GET['group1']))
{

$query=$_GET['group1'];

echo "<br/>";
$query1=$_GET['group2'];
if($query1=="")
{
die('ERROR: Must enter values to be inserted' . mysql_error());
}
else
{

$string1='INSERT INTO PHARMACY.'.$query;
$string2=' VALUES ('.$query1;
$string3=')';
$result=$string1.$string2.$string3;

$stid = oci_parse($con,$result);
$r=oci_execute($stid);
if($r){echo "<br/><h3>Inserted Successfully....!!!</h3><br/>";}

$result='select * from PHARMACY.'.$query;
$stid=oci_parse($con,$result);
$r=oci_execute($stid);

print '<table border="1"><thead>';
$ncols = oci_num_fields($stid);
for ($i = 1; $i <= $ncols; $i++)
{
    $column_name  = oci_field_name($stid, $i);
    echo "<th> $column_name </th>";
   
}

print '</thead>';


// Fetch each row in an associative array
//print '<table border="1">';
while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
   print '<tr>';
   foreach ($row as $item) {
       print '<td>'.($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp').'</td>';
   }
   print '</tr>';
}
print '</table>';
}	
}
?>

</center>
</body>
</html>
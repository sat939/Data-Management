<!DOCTYPE html>
<html>
<head>
<style>
h1{ color:black;text-align:center; }
body{ background-color:#d0e4fe; }
a{ font-size:20px; }


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
<center>
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
   print "<b>Connected to Oracle!</b>";echo "<br/>";echo "<br/>";echo "<br/>";
	
}
echo "<u>UPDATE STATEMENT EXECUTION</u><br/>";


echo "<table border='0'><tr><td>";
echo "<form name='selectform' method='GET'>";
echo "<input type='radio' name='group1' value='customer'> Customer<br>";
echo "<input type='radio' name='group1' value='doctor'> Doctor<br>";
echo "<input type='radio' name='group1' value='store'> Store<br>";
echo "<input type='radio' name='group1' value='medicine'> Medicine<br>";
echo "<input type='radio' name='group1' value='supplier'> Supplier<br>";
echo "<input type='radio' name='group1' value='inventory'> Inventory<br>";
echo "<input type='radio' name='group1' value='employee'> Employee<br>";
echo "</td></tr></table>";
echo "<center>";
echo "Enter value to change:<input type='text' ";?> 
 
<?php 
	echo "name='group2'><br/>";
echo "Enter related Key:<input type='text'  ";?> 
 <?php 
	echo " name='group3'><br/>";
echo "</center>";

echo "<INPUT type='submit' value='Update Data'>";

if(isset($_GET['group1']))
{
$query=$_GET['group1'];

$query1=$_GET['group2'];
$query2=$_GET['group3'];
if($query1==""|| $query2=="")
{
die('ERROR: Must enter values to update' . mysql_error());
}
else
{
$string1="update"." PHARMACY.".$query;
$string2=" set ".$query1;
$string3=" WHERE ".$query2;
$result=$string1.$string2.$string3;

$stid = oci_parse($con,$result);
$r=oci_execute($stid);
if($r)
{
echo "<br/><h3>Updated Successfully....!!!</h3><br/>";
}

$result='select * from PHARMACY.'.$query;
$stid=oci_parse($con,$result);
$r=oci_execute($stid);

// Fetch each row in an associative array

print '<table border="1"><thead>';
$ncols = oci_num_fields($stid);

for ($i = 1; $i <= $ncols; $i++)
{
    $column_name  = oci_field_name($stid, $i);
    echo "<th>$column_name</th>";
   
}

print '</thead>';


while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC))
{
   print '<tr>';
   foreach ($row as $item) 
   {
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
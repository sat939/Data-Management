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
   //print "Connected to Oracle!";
	
}
echo "<p> <u> PRODUCT WITH HIGHEST COST</u></p>";
$result="select i.productid,i.itemname,i.cost "."from PHARMACY."."inventory i "."
where i.cost".">"."all"."(select cost "."
from PHARMACY."."inventory "."
where productid"."<>"."i.productid)";


$stid = oci_parse($con,$result);
oci_execute($stid);


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
?>
</center>
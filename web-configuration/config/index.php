<!-- By D.J. Murray (apie), 2016-10-27 -->
<?php
function switchorder($order){
  if ($order=='ASC') return 'DESC';
  if ($order=='DESC') return 'ASC';
  return '';
}
//including the database connection file
include_once("../conf/config.php");

$sort = 'config_name';
if (isset($_GET['sort'])) $sort = mysqli_real_escape_string($mysqli, $_GET['sort']);
$order = 'ASC';
if (isset($_GET['order'])) $order = mysqli_real_escape_string($mysqli, $_GET['order']);

$result = mysqli_query($mysqli, "SELECT config_id,config_name,from_name,from_address,bcc_address,topic,line1,age_line,noage_line,picture_file FROM config ORDER BY $sort $order ");
mysqli_close($mysqli);
$order = switchorder($order);
?>

<html>
<head>
<title>Birthday mailer - e-mail message configuration</title>
<link rel="stylesheet" type="text/css" href="../style.css" />
</head>

<body>
    <h1>Birthday mailer - e-mail message configuration</h1>
	  <br/>
    <a href="add.html">Add new message configuration</a><br/><br/>
    <table width='80%' border=0>
        <tr bgcolor='#CCCCCC'>
            <td><a href="?sort=config_name&order=<?php echo $order;  ?>">config_name</a></td>
            <td><a href="?sort=from_name&order=<?php echo $order;    ?>">from_name</a></td>
            <td><a href="?sort=from_address&order=<?php echo $order; ?>">from_address</a></td>
            <td><a href="?sort=bcc_address&order=<?php echo $order;  ?>">bcc_address</a></td>
            <td><a href="?sort=topic&order=<?php echo $order;        ?>">topic</a></td>
            <td><a href="?sort=line1&order=<?php echo $order;        ?>">line1</a></td>
            <td><a href="?sort=age_line&order=<?php echo $order;     ?>">age_line</a></td>
            <td><a href="?sort=noage_line&order=<?php echo $order;   ?>">noage_line</a></td>
            <td><a href="?sort=picture_file&order=<?php echo $order; ?>">picture_file</a></td>
            <td>Update</td>
        </tr>
        <?php
        while($res = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>".$res['config_name']."</td>";
            echo "<td>".$res['from_name']."</td>";
            echo "<td>".$res['from_address']."</td>";
            echo "<td>".$res['bcc_address']."</td>";
            echo "<td>".$res['topic']."</td>";
            echo "<td>".$res['line1']."</td>";
            echo "<td>".$res['age_line']."</td>";
            echo "<td>".$res['noage_line']."</td>";
            echo "<td>".$res['picture_file']."</td>";
            echo "<td><a href=\"edit.php?config_id=$res[config_id]\">Edit</a>";
            echo "| <a href=\"delete.php?config_id=$res[config_id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

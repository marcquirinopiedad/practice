<html>
<head>
<link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.css" rel="stylesheet" >
</head>
<table class='table table-striped'>
<th>ID</th> 
<th>Name</th>
<th>Address</th>
<th>City</th>
<?php
foreach($datas as $data) {
	echo "<tr>";
	echo "<td>" . $data->i_id . "</td>";
	echo "<td>" . $data->s_first_name . " " . $data->s_last_name ."</td>";
	echo "<td>" . $data->s_address . "</td>";
	echo "<td>" . $data->s_city. "</td>";
	echo "</tr>";
}
 echo "</table>";
 echo anchor('exam/index/','<button>Back</button>') ;
 ?>
 </html>
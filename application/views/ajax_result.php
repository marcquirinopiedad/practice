
<table class='table table-striped'>

<th>Order Number</th>
<th>Person Name</th>
<th>Item Name</th>
<th>Quantity Ordered </th>


<?php
foreach($datas as $data) {



echo "<tr>";
	echo "<td>" . $data->i_item_id. "</td>";
	echo "<td>" . $data->s_first_name . " " . $data->s_last_name ."</td>";
	echo "<td>" . $data->s_name ."</td>";
	echo "<td>" . $data->i_order_quantity. "</td>";
	
	echo "</tr>";
}

 
 ?>
 
 </table>
 <?php echo $pagination; ?>

 
 
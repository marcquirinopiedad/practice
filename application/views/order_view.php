<!DOCTYPE html>
<html lang="en">


<head>
<script src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>

<script src="<?php echo base_url(); ?>js/search.js "> </script>

<link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.css" rel="stylesheet" >
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" >
</head>


<form action="#" method="post" class="form-search">
<p class="search_box"><input type="text" class="search" name="search" placeholder="Text input" />
<select class="selection">
	<option value="person"> Person </option>
	<option value="item"> Item </option>
</select>

<input type="submit" value="Search" class="search_button"/> </p>

</form>
<div class="search_result">
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
 echo "</table>";

 ?>
 </div>
 
 <?php echo $pagination; ?>
 <?php  echo anchor('exam/index/','<button>Back</button>') ; ?>
 </html>
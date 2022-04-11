<?php
	include('../dbcon.php');
	$id = $_GET['id'];
	$con->query("delete  from notice where notice_id = '$id'");
?>
<script>
	window.location = '../dashboard.php';
</script>




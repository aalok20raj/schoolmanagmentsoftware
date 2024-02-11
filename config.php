<?php
$server = 'localhost';
$username = 'root';
$password = '';
$db = 'conventsschool';
$conn = mysqli_connect($server,$username,$password,$db);
// Check connection
if (mysqli_connect_errno()) {
  // echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
else{
	?>
	<script type="text/javascript">
		alert('Database connection successfully');
	</script>
	<?php 
}
?>
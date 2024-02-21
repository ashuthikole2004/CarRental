<?php
require_once("includes/config.php");
// code user email availablity
if (isset($_POST['submit'])) {
	if (filter_var($vhid) === false) {

		echo "error : You have choosed the already booked car.";
	} else {
		$vhid = $_GET['vhid'];

		$sql = "SELECT VehicleId FROM tblbooking WHERE VehicleId=:vhid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':vhid', $vhid, PDO::PARAM_STR);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_OBJ);
		$cnt = 1;
		if ($query->rowCount() > 0) {
			echo "<span style='color:red'> Car already booked .</span>";
			echo "<script>$('#submit').prop('disabled',true);</script>";
		} else {

			echo "<span style='color:green'>Car available for booking.</span>";
			echo "<script>$('#submit').prop('disabled',false);</script>";
		}
	}

}

?>
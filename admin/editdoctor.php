<?php 
  include('../database/connection.php');
  include('auth.php');
      if(isset($_POST['edit_id'])) {
	$edit_id = $_POST['edit_id'];
        $stmt = $conn->prepare("SELECT * FROM doctors WHERE doctors_id = ?");
        $stmt->bind_param("i", $edit_id);
        $stmt->execute();
        $yw = $stmt->get_result();
    	$ywww = $yw->fetch_assoc();

        $stmt = $conn->prepare("SELECT day_id FROM doctor_availability WHERE doctor_id = ?");
        $stmt->bind_param("i", $edit_id);
        $stmt->execute();
        $availability_result = $stmt->get_result();
        $availability = [];
        while($row = $availability_result->fetch_assoc()) {
            $availability[] = $row['day_id'];
        }
        $ywww['day_id'] = $availability;

    	echo json_encode($ywww);
    }
?>
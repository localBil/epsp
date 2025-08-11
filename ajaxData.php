<?php
	include('database/connection.php');
	if(isset($_POST['department_id'])) {
		$department_id = $_POST['department_id'];
		$stmt = $conn->prepare("SELECT * FROM doctors WHERE depid = ?");
		$stmt->bind_param("i", $department_id);
		$stmt->execute();
		$yes = $stmt->get_result();
		$yescount = $yes->num_rows;
		$output = '';
		if($yescount > 0){
			$output.='<option value="">--CHOISIR Médecin--</option>';
			while($yesyes = $yes->fetch_assoc()) {
				$output.= '<option value="'.$yesyes['doctors_id'].'">'.$yesyes['name'].'</option>';
			}
		}else{
			$output.= '<option value="">Médecin non disponible</option>';
		}
		echo $output;
	}elseif(isset($_POST['doctor_id'])) {
		$doctor_id = $_POST['doctor_id'];
		$stmt = $conn->prepare("SELECT d.dates_id, d.datename FROM dates d JOIN doctor_availability da ON d.dates_id = da.day_id WHERE da.doctor_id = ?");
		$stmt->bind_param("i", $doctor_id);
		$stmt->execute();
		$no = $stmt->get_result();
		$nocount = $no->num_rows;
		$output = '';
		if($nocount > 0) {
			$output.= '<option value-"">--CHOISIR JOUR--</option>';
			while($nono = $no->fetch_assoc()) {
				$output.= '<option value="'.$nono['dates_id'].'">'.$nono['datename'].'</option>';
			}
		}else{
				$output.= '<option value="">Jour non disponible</option>';
		}
			echo $output;
	}
?>
<?php 
	include('database/connection.php');
	if(isset($_GET['d_id']) && isset($_GET['do_id']) && isset($_GET['email']) && isset($_GET['date'])) 
	{
		$doctor_id = $_GET['do_id'];
		$day_id = $_GET['d_id'];
		$email = $_GET['email'];
		$date = $_GET['date'];

		$stmt = $conn->prepare("DELETE FROM appointments WHERE doctor_id=? AND day_id=? AND email = ? AND date_id= ?");
		$stmt->bind_param("iiss", $doctor_id, $day_id, $email, $date);
		$delete = $stmt->execute();

		if($delete)
		{
			$stmt = $conn->prepare("SELECT * FROM countt WHERE count_doctor_id = ? AND count_day_id=? AND count_date = ?");
			$stmt->bind_param("iis", $doctor_id, $day_id, $date);
			$stmt->execute();
			$query = $stmt->get_result();
			$fetch_query = $query->fetch_assoc();
			$count_query = $fetch_query['count_hit'];
			if($query->num_rows > 0) 
			{
				if($count_query == 1) 
				{
					$stmt = $conn->prepare("DELETE FROM countt WHERE count_doctor_id=? AND count_day_id=? AND count_date=?");
					$stmt->bind_param("iis", $doctor_id, $day_id, $date);
					$end = $stmt->execute();
				}else
				{
					$minus_count = $count_query-1;
					$stmt = $conn->prepare("UPDATE countt SET count_hit=? WHERE count_doctor_id=? AND count_day_id=? AND count_date=?");
					$stmt->bind_param("iiis", $minus_count, $doctor_id, $day_id, $date);
					$end = $stmt->execute();
				}
					if($end)
						{
							echo "<script>
					      	window.location.href = 'index.php';
					      	window.alert('Votre demande de réservation a été annulée avec succès !');
					      	</script>";
						}
			}
		}
	}
?>
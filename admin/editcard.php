<?php 
  include('../database/connection.php');
  include('auth.php');
      if(isset($_POST['edit_id'])) {
    	$edit_id = $conn->real_escape_string($_POST['edit_id']);
    	$yw = $conn->query("SELECT c.*,d.name as doc_name,dp.depname as depname FROM cards c inner join doctors d on d.doctors_id=c.doc_card inner join departments dp on dp.departments_id=c.doc_spec  WHERE id_card ='$edit_id'");
    	$ywww = $yw->fetch_assoc();
    	echo json_encode($ywww);
    }
?>
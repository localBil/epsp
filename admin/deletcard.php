<?php 
  include('../database/connection.php');
  include('auth.php');
      if(isset($_POST['trash_id'])) {
    	$trash_id = $conn->real_escape_string($_POST['trash_id']);
    	$yes = $conn->query("DELETE FROM cards WHERE id_card = '$trash_id'");
    }
?>
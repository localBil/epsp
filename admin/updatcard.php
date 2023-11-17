<?php 
  include('../database/connection.php');
  include('auth.php');
  $error = "";
      if(isset($_POST['submit'])) {
    	$edit_id = $_POST['hiddeneditid'];
    	$cardname = $conn->real_escape_string($_POST['editdocname']);
		$carddep = $conn->real_escape_string($_POST['editdep']);
		$carddescr = $conn->real_escape_string($_POST['editdescr']);
		$cardfile = $conn->real_escape_string($_FILLES['editfile']['tmp_name']);
		
			$ext_img=pathinfo($cardfile,PATHINFO_EXTENSION);
			$data=file_get_contents($cardfile);
			$img_base64=base64_encode($data);
			$img='data:image/'.$ext_img.';base64,'.$img_base64;
    	$woo = $conn->query("SELECT * FROM cards WHERE doc_card = '$cardname', doc_dep='$carddep',doc_descr='$carddescr',doc_image='$img'");
    	if($woo->num_rows > 0) {
    		$error = "Le nom existe déja";
    		$output = array('error' => $error);
    		echo json_encode($output);
    	}else{
    	$change = $conn->query("UPDATE cards SET doc_card = '$cardname', doc_dep='$carddep',doc_descr='$carddescr',doc_image='$img' WHERE id_card='$edit_id'");
    	if($change) {
    	  $output = array();
    	  echo json_encode($output);
    	}
    }
}
?>
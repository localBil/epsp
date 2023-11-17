
<?php 
  include('../database/connection.php');
  include('auth.php');
  if(isset($_POST['cardinsert'])){

    $n_doc=($_POST['name_doc']);
    $n_dep=($_POST['dep']);
    $descr = ($_POST['descr']); 
    
    
    $tmp_name_img=$_FILES['file']['tmp_name'];
    $ext_img=pathinfo($tmp_name_img,PATHINFO_EXTENSION);
    $data=file_get_contents($tmp_name_img);
    $img_base64=base64_encode($data);
    $img='data:image/'.$ext_img.';base64,'.$img_base64;

      $insert =("INSERT INTO cards (doc_card,doc_spec,doc_image,doc_descr) VALUES ('$n_doc','$n_dep','$img','$descr')");
      $stm=$conn->prepare($insert);
      $stm->execute();
      $error = ""; ;
      }

      header("location:/v/admin/card.php");


    
?>
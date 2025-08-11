<?php
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../PHPMailer-5.2-stable/PHPMailerAutoload.php');

function archive_old_appointments($conn) {
    $today = date('Y-m-d');

    $stmt = $conn->prepare("SELECT * FROM appointments WHERE date_id < ?");
    $stmt->bind_param("s", $today);
    $stmt->execute();
    $select = $stmt->get_result();

    foreach ($select as $key => $value) {
     $stmt = $conn->prepare("INSERT INTO history_appointments(history_patientname,history_email,history_phonenumber,history_age,history_department_id,history_doctor_id,history_day_id,history_date,created_at,updated_at) VALUES (?,?,?,?,?,?,?,?,now(),now())");
     $stmt->bind_param("sssisiss", $value['patientname'], $value['email'], $value['phonenumber'], $value['age'], $value['department_id'], $value['doctor_id'], $value['day_id'], $value['date_id']);
     $insert = $stmt->execute();
    }
    if($select->num_rows > 0) {
     if($insert) {
         $stmt = $conn->prepare("DELETE FROM appointments WHERE date_id < ?");
         $stmt->bind_param("s", $today);
         $yes = $stmt->execute();

         $stmt = $conn->prepare("DELETE FROM countt WHERE count_date < ?");
         $stmt->bind_param("s", $today);
         $nice = $stmt->execute();
      }
    }
}

if(isset($_POST['appoint'])){
    date_default_timezone_set('Asia/Rangoon');
    archive_old_appointments($conn);

    $errors = [];
    if (empty($_POST['patient_name'])) {
        $errors[] = "Le nom complet est requis";
    }
    if (empty($_POST['patient_email']) || !filter_var($_POST['patient_email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Un email valide est requis";
    }
    if (empty($_POST['appointment_phone'])) {
        $errors[] = "Le numéro de téléphone est requis";
    }
    if (empty($_POST['patient_age'])) {
        $errors[] = "L'âge est requis";
    }
    if (empty($_POST['appointment_depart'])) {
        $errors[] = "Le département est requis";
    }
    if (empty($_POST['appointment_doctor'])) {
        $errors[] = "Le médecin est requis";
    }
    if (empty($_POST['appointment_day'])) {
        $errors[] = "Le jour est requis";
    }
    if (empty($_POST['adate'])) {
        $errors[] = "La date est requise";
    }

    if (!empty($errors)) {
        echo "<script>alert('" . implode("\\n", $errors) . "');</script>";
        return;
    }

    $patient_name = $_POST['patient_name'];
    $patient_email = $_POST['patient_email'];
    $patient_phone = $_POST['appointment_phone'];
    $patient_age = $_POST['patient_age'];
    $department_id = $_POST['appointment_depart'];
    $doctor_id = $_POST['appointment_doctor'];
    $day_id = $_POST['appointment_day'];
    $date = $_POST['adate'];

     $mail = new PHPMailer;
     $mail->isSMTP();
     $mail->Host = SMTP_HOST;
     $mail->SMTPAuth = true;
     $mail->Username = SMTP_USERNAME;
     $mail->Password = SMTP_PASSWORD;
     $mail->SMTPSecure = SMTP_SECURE;
     $mail->Port = SMTP_PORT;
     $mail->setFrom(EMAIL_FROM, EMAIL_FROM_NAME);
     $mail->addAddress($patient_email);
     $mail->addReplyTo(EMAIL_REPLY_TO);
     $mail->isHTML(true);

     $stmt = $conn->prepare("SELECT * FROM appointments WHERE email=? AND doctor_id=?");
     $stmt->bind_param("si", $patient_email, $doctor_id);
     $stmt->execute();
     $xo = $stmt->get_result();
     $zero = $xo->fetch_assoc();
     $dayzo = $zero['day_id'];
          if($dayzo == '1') {
             $print = "Lundi";
          }elseif($dayzo == '2'){
             $print = "Mardi";
          }elseif ($dayzo == '3') {
            $print = "Mercredi";
          }elseif ($dayzo == '4') {
            $print = "Jeudi";
          }elseif($dayzo == '5') {
           $print = "Vendredi";
          }elseif($dayzo == '6') {
           $print = "Samedi";
          }else{
           $print = "Dimanche";
          }

   $stmt = $conn->prepare("SELECT * FROM countt WHERE count_doctor_id = ? AND count_day_id = ? AND count_date=?");
   $stmt->bind_param("iis", $doctor_id, $day_id, $date);
   $stmt->execute();
   $xoo = $stmt->get_result();
   $zoo = $xoo->fetch_assoc();

    if($xo->num_rows > 0)
    {
       $mail->Subject = 'Appointment';
             $mail->Body    = '<b>La réservation a échoué. Vous êtes déjà dans notre "'.$zero['date_id'].'" ("'.$print.'" ) Booking List!</b><br>
             <b>Vous pouvez annuler votre réservation et réserver à nouveau un autre jour en cliquant sur ce bouton. <a href="'.BASE_URL.'/cancelbooking.php?do_id='.$doctor_id.'&&d_id='.$day_id.'&&email='.$patient_email.'&&date='.$zero['date_id'].'"><button>Cancel</button></a>';
             $mail->AltBody = 'Il sagit du corps en texte brut pour les clients de messagerie non HTML';

             if(!$mail->send()) {
                 echo 'Le message n a pas pu être envoyé.';
                 echo 'Mailer Error: ' . $mail->ErrorInfo;
             }else{
                 echo '<script>window.alert("Veuillez vérifier votre compte")</script>';
             }
    }else{
     if($zoo['count_hit'] < APPOINTMENT_LIMIT) {
       if($xoo->num_rows > 0){
           $count_hit = $zoo['count_hit']+1;
           $stmt = $conn->prepare("UPDATE countt SET count_hit = ? WHERE count_doctor_id=? AND count_day_id = ? AND count_date = ?");
           $stmt->bind_param("iiis", $count_hit, $doctor_id, $day_id, $date);
           $crazy = $stmt->execute();
       }else{
         $count_hit = 1;
         $stmt = $conn->prepare("INSERT INTO countt(count_day_id, count_doctor_id,count_date,count_hit, created_date, updated_date) VALUES(?,?,?,?,now(),now())");
         $stmt->bind_param("iisi", $day_id, $doctor_id, $date, $count_hit);
         $crazy = $stmt->execute();
       }
       if($crazy) {
           $stmt = $conn->prepare("INSERT INTO appointments (patientname, email, phonenumber, age, department_id, doctor_id, day_id, date_id, created_at, updated_at ) VALUES (?,?,?,?,?,?,?,?,now(),now())");
           $stmt->bind_param("sssiisss", $patient_name, $patient_email, $patient_phone, $patient_age, $department_id, $doctor_id, $day_id, $date);
           $nice = $stmt->execute();
          if($nice){
              $mail->Subject = 'Appointment Success';
             $mail->Body    = 'Votre demande de réservation est confirmée !<br>
             Votre numéro est<br>
               <center><b style="font-size:20px">'.$count_hit.'</b></center><br>
               Vous pouvez annuler votre réservation précédente en cliquant sur ce bouton.<a href="'.BASE_URL.'/cancelbooking.php?do_id='.$doctor_id.'&&d_id='.$day_id.'&&email='.$patient_email.'&&date='.$date.'"><button>Cancel</button></a>';
             $mail->AltBody = 'Il sagit du corps en texte brut pour les clients de messagerie non HTML';

             if(!$mail->send()) {
                 echo 'Le message n a pas pu être envoyé.';
                 echo 'Mailer Error: ' . $mail->ErrorInfo;
             } else {
                 echo '<script>window.alert("Veuillez vérifier votre compte GMAIL")</script>';
             }
          }
      }
       }else{
             $mail->Subject = 'Appointment';
             $mail->Body    = '<b style="color:red">Booking are full for . We allowed only '.APPOINTMENT_LIMIT.' persons in a day.</b>';
             $mail->AltBody = 'Il sagit du corps en texte brut pour les clients de messagerie non HTML';

             if(!$mail->send()) {
                 echo 'Le message n a pas pu être envoyé.';
                 echo 'Mailer Error: ' . $mail->ErrorInfo;
             } else {
                 echo '<script>window.alert("Veuillez vérifier votre compte GMAIL ")</script>';
             }
       }
    }
 }
?>

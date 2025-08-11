<?php 
  include('../database/connection.php');
  include('includes/header.php'); 
  include('auth.php');
  include('../includes/handle_appointment.php');
  archive_old_appointments($conn);

     if(isset($_POST['change'])) {
        $doctor_id = $_POST['doctor'];
        $stmt = $conn->prepare("SELECT a.*,de.*,d.*,da.* FROM appointments as a LEFT JOIN departments as de ON a.department_id = de.departments_id LEFT JOIN doctors as d ON a.doctor_id = d.doctors_id LEFT JOIN dates as da ON a.day_id = da.dates_id WHERE a.doctor_id = ?");
        $stmt->bind_param("i", $doctor_id);
        $stmt->execute();
        $si = $stmt->get_result();
     }else{
      $doctor_id = 1;
      $stmt = $conn->prepare("SELECT a.*,de.*,d.*,da.* FROM appointments as a LEFT JOIN departments as de ON a.department_id = de.departments_id LEFT JOIN doctors as d ON a.doctor_id = d.doctors_id LEFT JOIN dates as da ON a.day_id = da.dates_id WHERE a.doctor_id = ?");
      $stmt->bind_param("i", $doctor_id);
      $stmt->execute();
      $si = $stmt->get_result();
     }
?>
<body class=" ">
  <div class="wrapper ">
   <?php include('includes/sidebar.php');?>
    <div class="main-panel">
      <!-- Navbar -->
     <?php include('includes/navbar.php'); ?>
      <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title">Rendez-vous</h4>
                <div class="text-right">
                <form action="index.php" method="POST">
                <select name="doctor" class="form-control text-center text-secondary">
                   <?php $doctor = $conn->query("SELECT * FROM doctors"); 
                    foreach ($doctor as $row) { 
                      echo '<option value="'.$row['doctors_id'].'"
                      '.(($row['doctors_id'] == $doctor_id)?'selected="selected"':'').'>'.$row['name'].'</option>';
                     } ?>
                 </select>
                 <input type="submit" name="change" class="btn btn-primary btn-sm" value="Change">
               </form>
               </div>
              </div>
            
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-primary">
                        <tr>
                           <td>N</td>
                           <td>Nom</td>
                           <td>Email</td>
                           <td>Telephone</td>
                           <td>Age</td>
                           <td>Département</td>
                           <td>Jour</td>
                           <td>Date</td>
                        </tr>                      
                    </thead>
                    <tbody class="text-primary">
                       <?php 
                       foreach ($si as $key => $wu) { ?>
                       <tr>
                           <td><?php echo $key+1 ?></td>
                           <td><?php echo $wu['patientname'] ?></td>
                           <td><?php echo $wu['email'] ?></td>
                           <td><?php echo $wu['phonenumber'] ?></td>
                           <td><?php echo $wu['age'] ?></td>
                           <td><?php echo $wu['depname'] ?></td>
                           <td><?php echo $wu['datename']?></td>
                           <td><?php echo $wu['date_id']?></td>
                       </tr>
                     <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      </div>
    </div>
     
    <?php include('includes/fixedplugin.php');
          include('includes/footer.php'); ?>
    <!--   Core JS Files   -->
   
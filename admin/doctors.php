<?php 
  include('../database/connection.php');
  include('includes/header.php'); 
  include('auth.php');
  $doctor_query = "
    SELECT d.doctors_id, d.name, d.degree, d.sitting_time, de.depname, GROUP_CONCAT(da.datename SEPARATOR ', ') as available_days
    FROM doctors d
    LEFT JOIN departments de ON d.depid = de.departments_id
    LEFT JOIN doctor_availability da_ref ON d.doctors_id = da_ref.doctor_id
    LEFT JOIN dates da ON da_ref.day_id = da.dates_id
    GROUP BY d.doctors_id
  ";
  $doctor =  $conn->query($doctor_query);
  $department = $conn->query("SELECT * FROM departments");
  $output = "";
  $date = $conn->query("SELECT * FROM dates");
  $errMsg = $erMsg = "";
     if(isset($_POST['add'])) {
       $doctorname = $_POST['doctorname'];
       $degree = $_POST['doctordegree'];
       $department_id = $_POST['doctordepartment'];
       $sitting_time = $_POST['sitting_time'];
       if(empty($_POST['doctorday'])) {
        $errMsg = "Day Field cannot be blank;";
       }else{
       $day_ids = $_POST['doctorday'];
       }
      
       if(empty($errMsg)) {
        $stmt = $conn->prepare("INSERT INTO doctors(depid,name,degree,sitting_time,created_at,updated_at) VALUES (?,?,?,?,now(),now())");
        $stmt->bind_param("isss", $department_id, $doctorname, $degree, $sitting_time);
        $yes = $stmt->execute();
        $doctor_id = $conn->insert_id;

        foreach($day_ids as $day_id) {
            $stmt = $conn->prepare("INSERT INTO doctor_availability(doctor_id, day_id) VALUES (?,?)");
            $stmt->bind_param("ii", $doctor_id, $day_id);
            $stmt->execute();
        }
         if($yes) {
          header("location:doctors.php?succ");
         }
       }
     }
     if(isset($_POST['update'])) {
      $edit_id = $_POST['hiddeneditid'];
       $doctorname = $_POST['editdoctorname'];
       $degree = $_POST['editdoctordegree'];
       $department_id = $_POST['editdoctordepartment'];
       $sitting_time = $_POST['editsittingtime'];
        if(empty($_POST['editdoctorday'])) {
        $erMsg = "Day Field cannot be blank;";
       }else{
       $day_ids = $_POST['editdoctorday'];
       }
      
       if(empty($erMsg)) {
        $stmt = $conn->prepare("UPDATE doctors SET depid=?,name=?,degree=?,sitting_time=? WHERE doctors_id = ?");
        $stmt->bind_param("isssi", $department_id, $doctorname, $degree, $sitting_time, $edit_id);
        $yes = $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM doctor_availability WHERE doctor_id = ?");
        $stmt->bind_param("i", $edit_id);
        $stmt->execute();

        foreach($day_ids as $day_id) {
            $stmt = $conn->prepare("INSERT INTO doctor_availability(doctor_id, day_id) VALUES (?,?)");
            $stmt->bind_param("ii", $edit_id, $day_id);
            $stmt->execute();
        }
         if($yes) {
          header("location:doctors.php?update");
         }
       }
     }
?>
<style type="text/css">
  label#doctorname-error.error,label#doctordegree-error.error,label#doctordepartment-error.error,label#doctorday-error.error,label#sitting_time-error.error,label#editdoctorname-error.error,label#editdoctordegree-error.error,label#editdoctordepartment-error.error,label#editdoctorday-error.error {
    color:red;
  }
</style>
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
                <h4 class="card-title">Doctor</h4>
                <?php if(isset($_GET['succ'])) { ?>
                    <div class="alert alert-success">
                  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                  </button>
                  <span>
                    <b> Succéss - </b> aujoutement reussie!</span>
                </div>
              <?php } ?>
                  <?php if(isset($_GET['update'])) { ?>
                    <div class="alert alert-success">
                  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                  </button>
                  <span>
                    <b> Succéss - </b> modification reussite!</span>
                </div>
              <?php } ?>
               <?php if($erMsg) { ?>
                    <div class="alert alert-danger">
                  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                  </button>
                  <span>
                    <b> Polyclinique- </b> <?php echo $erMsg; ?>!</span>
                </div>
              <?php } ?>
                  <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addDoctor">Ajouter</a>


                  <div class="modal fade" id="addDoctor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title text-primary" id="exampleModalLabel">Ajouter</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-primary">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form id="addDear" name="addDoctor" class="text-primary" method="POST">
                                   <?php if($errMsg) { ?>
                    <div class="alert alert-danger">
                  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                  </button>
                  <span>
                    <b> Polyclinique - </b> <?php echo $errMsg; ?>!</span>
                </div>
              <?php } ?>
                               Nom:<input type="text" id="doctorname" name="doctorname" class="form-control text-secondary">
                               Polyclinique:<input type="text" id="doctordegree" name="doctordegree" class="form-control text-secondary">
                               Département:<select name="doctordepartment" id="doctordepartment" class="form-control text-secondary">
                                <option value="">--Choix Département--</option>
                               <?php foreach ($department as $depa) { ?> 
                                  <option value="<?php echo $depa['departments_id']?>"><?php echo $depa['depname']?></option>
                               <?php } ?>
                             </select>
                                Day:<select name="doctorday[]" multiple="multiple" id="doctorday" class="form-control text-secondary">

                               <?php foreach ($date as $dep) { ?> 
                                  <option value="<?php echo $dep['dates_id']?>"><?php echo $dep['datename']?></option>
                               <?php } ?>
                             </select>
                             Horaire<textarea name="sitting_time" class="form-control text-secondary"></textarea>
                               <input type="submit" class="btn btn-primary" name="add" value="Add">
                            </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                      </div>
                    </div>
                  </div>
                   <div class="modal fade" id="editDoctor" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title text-primary" id="editModalLabel">Ajouter</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-primary">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form id="editDear" name="editDear" class="text-primary" method="POST">
                                   <?php if($erMsg) { ?>
                    <div class="alert alert-danger">
                  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                  </button>
                  <span>
                    <b> Polyclinique</b> <?php echo $erMsg; ?>!</span>
                </div>
              <?php } ?>
                              <input type="hidden" name="hiddeneditid" id="hiddeneditid">
                               Nom:<input type="text" id="editdoctorname" name="editdoctorname" class="form-control text-secondary">
                               Polyclinique:<input type="text" id="editdoctordegree" name="editdoctordegree" class="form-control text-secondary">
                               Département:<select name="editdoctordepartment" id="editdoctordepartment" class="form-control text-secondary">
                                <option value="">--choisir département--</option>
                               <?php foreach ($department as $depa) { ?> 
                                  <option value="<?php echo $depa['departments_id']?>"><?php echo $depa['depname']?></option>
                               <?php } ?>
                             </select>
                                Day:<select name="editdoctorday[]" multiple="multiple" id="editdoctorday" class="form-control text-secondary">
                               <?php foreach ($date as $dep) { ?> 
                                  <option value="<?php echo $dep['dates_id']?>"><?php echo $dep['datename']?></option>
                               <?php } ?>
                             </select>
                             <textarea name="editsittingtime" id="editsittingtime" class="form-control text-secondary"></textarea>
                               <input type="submit" class="btn btn-primary" name="update" value="Update">
                            </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-primary">
                        <tr>
                           <td>No.</td>
                           <td>Nom Medecin</td>
                           <td>Polyclinique</td>
                           <td>Département</td>
                           <td>Jour</td>
                           <td>Horaire</td>
                           <td>Action</td>
                        </tr>                      
                    </thead>
                    <tbody class="text-primary depart">
                        <?php foreach($doctor as $key => $d) { ?>
                          <tr id="nice<?php echo $d['doctors_id']?>">
                             <td><?php echo $key+1 ?></td>
                             <td><?php echo $d['name']; ?></td>
                             <td><?php echo $d['degree']; ?></td>
                             <td><?php echo $d['depname']; ?></td>
                             <td><?php echo $d['available_days']; ?></td>
                             <td><?php echo $d['sitting_time']?></td>
                              <td><i class="tim-icons icon-pencil text-success editer" id="<?php echo $d['doctors_id']?>"></i> &nbsp; &nbsp;
                                 <i class="tim-icons icon-trash-simple text-danger trasher" id="<?php echo $d['doctors_id']?>">
                                 </i>
                               </td>
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
  <script type="text/javascript">
    $(document).ready(function(){
      $('#addDear').validate({
          rules: {
            doctorname: {
              required: true,
            },
            doctordegree: {
              required: true
            },
            doctordepartment: {
              required: true
            },
            sitting_time: {
              required: true
            },
              doctorday: {
              required: true
            }
          },
          messages: {
            
          }
      });
    });
</script>
 <script type="text/javascript">
    $(document).ready(function(){
      $('#editDear').validate({
          rules: {
            editdoctorname: {
              required: true,
            },
            editdoctordegree: {
              required: true
            },
            editdoctordepartment: {
              required: true
            },
            editdoctorday: {
              required: true
            }
          },
          messages: {
            
          }
      });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
      $('.trasher').on('click', function() {
        var trash_id = $(this).attr('id');
            const swalWithBootstrapButtons = Swal.mixin({
              customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
              },
              buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
              title: 'Êtes-vous sûr?',
              text: "Vous ne pourrez pas revenir en arrière!",
              type: 'Attention',
              showCancelButton: true,
              confirmButtonText: 'Oui, supprimez-le !',
              cancelButtonText: 'Non, annulez !',
              reverseButtons: true
            }).then((result) => {
              if (result.value) {
        $.ajax({
           url: "deletedoctor.php",
           method: "POST",
           data: {trash_id:trash_id},
           success: function() {
            $('#nice'+trash_id).css({'background': 'tomato'});
            $('#nice'+trash_id).fadeTo('slow',0.7,function(){
              $(this).remove();
                swalWithBootstrapButtons.fire(
                  'Supprimé!',
                  'Votre fichier a été supprimé.',
                  'Succès'
                )
              });
            }
        });
         }else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
              ) {
                swalWithBootstrapButtons.fire(
                  'Annulé',
                  'Votre fichier imaginaire est en sécurité :',
                  'Erreur'
                )
              }
            });
      });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
      $('.editer').on('click',function() {
          var edit_id = $(this).attr('id');
          $.ajax({
            url: "editdoctor.php",
            method: "POST",
            dataType : "json",
            data: {edit_id:edit_id},
            success: function(data) {
              $('#editdoctorname').val(data.name);
              $('#editdoctordegree').val(data.degree);
              $('#editsittingtime').val(data.sitting_time);
              var string = data.day_id;
              var array = string.split(',');
              $('#editdoctordepartment').val(data.depid);
              $('#editdoctorday').val(array);
              $('#hiddeneditid').val(data.doctors_id);
              $('#editDoctor').modal('show');
            }
          });
        });
    });
</script>

 
   
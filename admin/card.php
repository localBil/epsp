<?php 

  include('../database/connection.php');
  include('includes/header.php');
  include('auth.php'); 
  

  

  $card = $conn->query("SELECT c.id_card,c.doc_image img,c.doc_descr descr,de.depname dep,doc.name docName  FROM cards as c INNER JOIN departments as de ON c.doc_spec = de.departments_id INNER JOIN doctors as doc on doc.doctors_id = c.doc_card");
  
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
                <h4 class="card-title">Card</h4>
             
                  <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addDepartment">Ajouter Card</a>


                  <div class="modal fade" id="addDepartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title text-primary" id="exampleModalLabel">Ajouter</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-primary">&times;</span>
                          </button>
                        </div>

                        <!--- add card ---->
                        
                        <div class="modal-body">
                        
                             <form action="addcard.php" method="POST" enctype="multipart/form-data">
                             CHOISIR MEDECIN:<select name="name_doc"  id="name_doc" class="form-control text-secondary">
                              <option value=""> --CHOISIR MEDECIN--</option>
                                <?php $doc = $conn->query("SELECT * FROM doctors ORDER BY doctors_id ASC");
                                  while($docu = $doc->fetch_assoc()) : ?>
                                    <option value="<?php echo $docu['doctors_id']?>"><?php echo $docu['name']?></option>
                                        <?php endwhile; ?>
                                           </select>
                                             Département:<select name="dep" id="dep" class="form-control text-secondary">
                                              <option value="">--Choisir Département--</option>
                                            <?php $dep = $conn->query("SELECT * FROM departments ORDER BY departments_id ASC");
                                          while($depar = $dep->fetch_assoc()) : ?>
                                        <option value="<?php echo $depar['departments_id']?>"><?php echo $depar['depname']?></option>
                                       <?php endwhile; ?>
                                        </select><br>
                                        Description:
                                           <input type="text"  name="descr" id="descr" class="form-control text-secondary"><br>
                                              <input type="file" id="file" name="file"  class="form-control text-secondary"><br>
                                                 <input type="submit" id="submit" name="cardinsert" class='btn btn-primary' value='Ajouter'>
                                                     </form>
                                                        </div>
                                                             <div class="modal-footer">
                                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
                                                                </div>
                                                                    </div>
                                                                  </div>
                                                              </div>
                                                          <div class="modal fade" id="editcard" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                      <div class="modal-content">
                                                    <div class="modal-header">
                                                   <h5 class="modal-title text-primary" id="editModalLabel">Edit Card</h5>
                                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true" class="text-primary">&times;</span>
                                           </button>
                                        </div>
                        <div  class="modal-body">
                            <form  id="editDepart" name="editDepart"  enctype="multipart/form-data"  >
                               <input type="hidden" name="hiddeneditid" id="hiddeneditid">
                               <input type="text" id="editdocname" name="editdocname" class="form-control text-secondary"><br>
                               <input type="text" id="editdep" name="editdep" class="form-control text-secondary"><br>
                               <input type="text" id="editdescr" name="editdescr" class="form-control text-secondary"><br>
                               <input type="file" id="editfile" name="editfile" class="form-control text-secondary"><br>
                               <img style="width:50%;" id="display-image"></img></br>
                               <input type="submit"  id='editcard' class="btn btn-primary" value="modifier">
                            </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
                          
                        </div>
                      </div>
                    </div>
                  </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-primary">
                        <tr>
                           <td>id</td>
                           <td>Nom Médecin</td>
                           <td>Département</td>
                           <td>Déscription</td>
                           <td>Image</td>
                           <td>Action</td>
                        </tr>                      
                    </thead>
                    <tbody class="text-primary depart">
                        <?php foreach($card as $key => $d) { ?>
                          <tr  id="nice<?php echo $d['id_card']?>">
                             <td><?php echo $key+1 ?></td>
                             <td><?php echo $d['docName']; ?></td>
                             <td><?php echo $d['dep']; ?></td>
                             <td><?php echo $d['descr']; ?> </td>
                             <td > <?php echo "<img  src='{$d['img']}' width='80' height='80''>"; ?></td> 
                             <td>
                               <i class="tim-icons icon-pencil text-success editer" name="edit" id="<?php echo $d['id_card']?>"></i> &nbsp; &nbsp;
                               <i class="tim-icons icon-trash-simple text-danger trasher" id="<?php echo $d['id_card']?>"></i>
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
    $(document).ready(function() {

      $('.editer').on('click',function() {
          var edit_id = $(this).attr('id');
          $.ajax({
            url: "editcard.php",
            method: "POST",
            dataType : "json",
            data: {edit_id:edit_id},
            success: function(data) {
              $('#editdocname').val(data.doc_name);
              $('#editdep').val(data.depname);
              $('#editdescr').val(data.doc_descr);
              $('#display-image').attr("src",data.doc_image);
              $('#hiddeneditid').val(data.id_card);
              $('#editcard').modal('show');
            }
          });
        });
        $('#editDepart').on('submit',function(event) {
               event.preventDefault();
               if(
                  
              $('#editdocname').val()!="",
              $('#editdep').val()!="",
              $('#editdescr').val()!="",
              $('#display-image').attr("src")!="",
              $('#hiddeneditid').val()!="",
              $('#editcard').modal('show')
                
                ) {
               $.ajax({
                url: "updatcard.php",
                method: "POST",
                dataType: "json",
                data: $(this).serialize(),
                success: function(data) {
                       if(data.doc_name,data.depname,data.doc_descr,data.doc_image) {
                      location.reload();
                    }
                    else{
                      alert(data.error);
                      $('#editDepart')[0].reset();
                    }
                }
               });
             }
        });

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
           url: "deletcard.php",
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
                  'Votre fichier imaginaire est en sécurité :)',
                  'Erreur'
                )
              }
            });
      });
    });
</script>

    

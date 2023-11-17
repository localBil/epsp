<?php 
include('database/connection.php');
include('includes/userheader.php'); 

?>


<body>
<?php include('includes/usernavbar.php');?>

<div class="hero-wrap" style="background-image: url('images/radio.jpg'); background-attachment:fixed;">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-8 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Accueill</a></span> <span class="mr-2"><a href="departments.php">Départements</a></span> <span>Digestif</span></p>
            <h1 class="mb-3 bread"> Département<br>Digestif</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ftco-animate">
            <p>
              <img src="images/digestif.jpg" alt="" class="img-fluid">
            </p>
            <h5 class="text-danger">SPÉCIALITÉ </5>
            <h2 class="mb-3">Digestif</h2>
            <p>Le pôle digestif de la Polyclinique de Picardie regroupe l’ensemble des spécialités traitant les pathologies liées à l’appareil digestif de l’œsophage, en passant par les intestins jusqu’au rectum.
              Que votre pathologie soit médicale ou chirurgicale, vous bénéficierez d’une prise en charge complète grâce à notre équipe pluridisciplinaire composée de différents praticiens spécialistes.
            </p>
            </div> 
          <div class="col-md-4 sidebar ftco-animate">
                <div class="categories">
                <h3>Categories</h3>
                <li><a href="departments.php">Départements <span>(6)</span></a></li>
                                <li><a href="#">Médicin <span>(110)</span></a></li>
                <li><a href="#">hôpitaux<span>(21)</span></a></li>
                <li><a href="#">Plyclinique <span>(36)</span></a></li>
              </div>
              </div>
              <div class="col-md-8 ftco-animate">
              <h5 class="text-danger">SPÉCIALITÉ </5>
            <h2 class="mb-3  ">La chirurgie viscérale et digestive</h2>
            <p>La chirurgie viscérale et digestive s’intéresse à la prise en charge chirurgicale des affections du tube digestif et organes digestifs (œsophage, estomac, intestins, appendice, côlon, etc.), des viscères (vésicule et voies biliaires, pancréas, foie, etc.) et de certaines glandes endocrines.

            <strong>La chirurgie viscérale et digestive, selon le type d’opération et le profil du patient, peut se pratiquer par :</strong>

            - coelioscopie, appelée aussi laparoscopie : technique chirurgicale peu invasive qui consiste par de fines incisions à introduire des instruments chirurgicaux équipés d’un système optique relié à un écran.
            - laparotomie : opération à ventre ouvert qui par une incision au niveau de l’abdomen permet au chirurgien d’atteindre directement l’organe concerné.
            - Nos cinq chirurgiens digestifs consultent au rez-de-chaussée de la Polyclinique, dans l’aile gauche.
            </p>
           </div>


           <div class="col-md-8 ftco-animate">
              <h5 class="text-danger">SPÉCIALITÉ </5>
            <h2 class="mb-3  ">La stomathérapie digestive</h2>
            <p>La Polyclinique de Picardie compte dans ses équipes une infirmière stomathérapeute digestive. Elle rencontre les patients après l’annonce d’une stomie (poche) temporaire ou permanente par le chirurgien digestif. Elle maîtrise les connaissances techniques et les principes de relations d’aide permettant au patient stomisé de retrouver son autonomie le plus rapidement possible après l’intervention, de façon à reprendre une vie familiale, personnelle, professionnelle et sociale normale. Elle intervient dans le choix de l’appareillage, dans l’éducation, le suivi, et le conseil des patients. Elle réalise des consultations au 1er étage du bâtiment, dans le secteur B1, et se déplace dans les différents services de la clinique.
            </p>
           </div>
      </div>
    </section> 
    
    <!-- footer start -->
    <?php include('includes/foot.php'); ?>
    <!-- footer end -->


    <!-- Modal -->
    <div class="modal fade" id="modalAppointment" tabindex="-1" role="dialog" aria-labelledby="modalAppointmentLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalAppointmentLabel">Appointment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="index.php" id="appoint" method="POST">
              <div class="form-group">
                <label for="patient_name" class="text-black">Full Name</label>
                <input type="text" class="form-control" id="patient_name" name="patient_name">
              </div>
              <div class="form-group">
                <label for="patient_email" class="text-black">Email</label>
                <input type="email" class="form-control" id="patient_email" name="patient_email">
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="appointment_phone" class="text-black">Phone Number</label>
                    <input type="text" class="form-control" id="appointment_phone" name="appointment_phone">
                  </div>    
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="patient_age" class="text-black">Age</label>
                    <input type="number" class="form-control" id="patient_age" name="patient_age">
                  </div>
                </div>
              </div>
              <div class="form-group">
                
              </div>
               <div class="form-group">
                <label for="appointment_depart" class="text-black">Select Department</label>
                <select name="appointment_depart" class="form-control" id="appointment_depart">
                  <option value=""> --SELECT DEPARTMENT--</option>
                  <?php $doc = $conn->query("SELECT * FROM departments ORDER BY departments_id ASC");
                     while($docu = $doc->fetch_assoc()) : ?>
                      <option value="<?php echo $docu['departments_id']?>"><?php echo $docu['depname']?></option>
                    <?php endwhile; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="appointment_doctor" class="text-black">Select Doctor</label>
                <select name="appointment_doctor" class="form-control" id="appointment_doctor">
                  <option value="">--SELECT DOCTOR--</option>  
                </select>
              </div>
              <div class="form-group">
                <label for="appointment_day" class="text-black">Select Day</label>
                <select name="appointment_day" class="form-control" id="appointment_day">
                  <option value="">--SELECT DAY--</option>  
                </select>
              </div>

                  <div class="form-group">
                    <label for="appointment_date" class="text-black">Date</label>
                    <input type="date" class="form-control" name="appointment_date">
                  </div>    
              
              <div class="form-group">
                <input type="submit" value="Rendez-vous" class=" btn-primary" name="appoint">
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>
    <!-- model end -->


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
  <script src="js/jquery.validate.min.js"></script>


</body>
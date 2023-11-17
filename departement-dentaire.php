<?php 
include('database/connection.php');
include('includes/userheader.php'); 

?>


<body>
<?php include('includes/usernavbar.php');?>

<div class="hero-wrap" style="background-image: url('images/bbg_7.jpg'); background-attachment:fixed;">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-8 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Accueill</a></span> <span class="mr-2"><a href="departments.php">Départements</a></span> <span>Médical</span></p>
            <h1 class="mb-3 bread">Département Dentaire</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ftco-animate">
            <p>
              <img src="images/thesis_img/dentaire.jpg" alt="" class="img-fluid">
            </p>
            <h5 class="text-danger">SPÉCIALITÉ </5>
            <h2 class="mb-3">Chirurgie dentaire</h2>
            <p>Le service de chirurgien dentaire propose à ses patients une offre personnalisée de soins humains, de qualité et innovants. Découvrez ci-dessous les informations essentielles sur le traitement, la consultation ou la prise de rendez-vous avec un chirurgien-dentiste de la Polyclinique du Val de Loire.
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
            <div class="col-md-8 mt-5 ftco-animate">
            <h2 class="mb-3 text-primary">Qu’est-ce que la chirurgie dentaire ?</h2>
            <p>La chirurgie dentaire ou odontologie est la spécialité médicale qui étudie et traite les affections des dents et de la mâchoire. Elle comporte plusieurs disciplines, dont l’implantologie – pose de prothèses et implants –, l’orthodontie – correction de l’alignement des dents – et la médecine bucco-dentaire intervenant spécifiquement sur des patients dont la prise en charge est délicate pour raisons médicales ou techniques.
            </p>
            </div>
            <div class="col-md-8 mt-5 ftco-animate">
            <h2 class="mb-3 text-primary">Que fait le chirurgien-dentiste ?</h2>
            <h5>Le docteur en chirurgie dentaire est un omnipraticien en odontologie :</h5>
            <p>Il effectue des soins (traitement des caries, canaux dentaires)
               - Il procède à des extractions, et des implants dentaires
               - Il pose des prothèses
               - Il réalise des actes esthétiques (blanchiment, nettoyage des taches…)
               - Il peut privilégier une pratique : endodontie (système pulpaire) parodontie (tissus soutenant les dents), ou encore pédodontie (enfants).
            </p>
            </div>
            <div class="col-md-8 mt-5 ftco-animate">
            <h2 class="mb-3 text-primary">Quand consulter un chirurgien-dentiste ?</h2>
            <p>Les soins dentaires sont accessibles sans prescription d’un médecin traitant. Il est conseillé de prendre rendez-vous chez un chirurgien-dentiste une à deux fois par an, dès le plus jeune âge, pour prévenir et maintenir (détartrage) une bonne santé dentaire. La consultation avec un chirurgien-dentiste s’impose et nécessite un suivi régulier en cas de mauvaise haleine, de saignements au brossage ou à la mastication, d’une sensibilité ou douleur (dents, gencives), de la perte d’une dent, d’un chevauchement qui nuit à une bonne hygiène, etc
            </p>
            </div>
              </div>        
            </div>
            </div>
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
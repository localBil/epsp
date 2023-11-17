
<body>
<?php include('includes/usernavbar.php');?>
     
    <div class="hero-wrap" style="background-image: url('images/thesis_img/about.jpg'); background-attachment:fixed;">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-8 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Accuiell</a></span> <span>Nos connaitre</span></p>
            <h1 class="mb-3 bread">Nos connaitre</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section-2">
      <div class="container-fluid d-flex">
        <div class="section-2-blocks-wrapper row no-gutters">
          <div class="img col-sm-12 col-lg-6" style="background-image: url('images/about.jpg');">
           </div>
          <div class="text col-lg-6 ftco-animate">
            <div class="text-inner align-self-start">
              <h3>Bienveunu dans notre etablissement </h3>
              <p>L’établissement public de santé de proximité (E.P.S.P.) de Oum El Bouaghi est crée dans le cadre de la mise en œuvre 
                de la nouvelle carte sanitaire qui est régie par la circulaire N° 24 du 20 septembre 2007 conformément aux dispositions
                  du décret exécutif  N° 07- 140 du 19 mai relative  aux  activités d’une polyclinique laquelle polyclinique, constitue
                   une unité  de base médicalisée en matière de soins de proximité  afin de réhabiliter la  polyclinique  en tant que 
                   prescriptrice  de soins de  base, de les hiérarchiser ,de mieux répondre  aux  attentes  et aux besoins de la population
                   , de renforcer les activités de prévention  pour  prémunir la population de toute épidémie, et de se rapprocher d’avantage de la population  jusqu‘à arriver au concept de médecin de famille.</p>
              <p>L’E.P.S.P.  est doté d’une ressource humaine  et de structures de santés et  est rattaché administrativement à la  polyclinique IHADDADEN dont  elle  est son  siège  technico -administratif . </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- card médecin -->
  <?php
  include('includes/card_medecin.php');
  ?>


	<!-- footer start -->
<?php 
include('includes/foot.php');
?>
    <!-- footer end -->


    <!-- Modal -->
   <?php
   include('includes/tableau_rendez_vous.php');
   ?>
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
    <!--  <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  </body>
<script type="text/javascript">
  $(document).ready(function() {
    $('#adate').datepicker({
      minDate: 0, 
      maxDate: '+1M',
      dateFormat: 'yy-mm-dd',
       beforeShowDay: function(date)
       {
        var fromdb = $('#appointment_day').val();
        var day= date.getDay();
        if(day == fromdb){
          return [true];
        }else{
          return [false];
        }
       }
    });
  });
</script>
<?php include('includes/footer.php');?> 

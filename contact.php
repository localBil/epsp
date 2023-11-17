

<body>
<?php include('includes/usernavbar.php');?>

<div class="hero-wrap" style="background-image: url('images/bg_3.jpg'); background-attachment:fixed;">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-8 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Accuiell</a></p>
            <h1 class="mb-3 bread">Contacté Nos</h1>
          </div>
        </div>
      </div>
    </div>

   <section class="ftco-section contact-section ftco-degree-bg">
      <div class="container">
        <div class="row d-flex mb-5 contact-info">
          <div class="col-md-12 mb-4">
            <h2 class="h4">Information contact</h2>
          </div>
          <div class="w-100"></div>
          <div class="col-md-3">
            <p><span>Addresse:</span> Makomdas,Nouvelle ville, Oum el Bouaghi</p>
          </div>
          <div class="col-md-3">
            <p><span>Télephonne:</span> <a href="tel://1234567920">+213 54254432</a></p>
          </div>
          <div class="col-md-3">
            <p><span>Email:</span> <a href="mailto:www.gmail.com">epsp-oeb@gmail.com</a></p>
          </div>
          <div class="col-md-3">
            <p><span>Website</span> <a href="localhost/appointment">epsp-oeb.com</a></p>
          </div>
        </div>   
      </div>     
    </section>






<!-- footer start -->
<?php 
include('includes/foot.php');
?>
    <!-- footer end -->

<?php
include('includes/tableau_rendez_vous.php');
?>

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
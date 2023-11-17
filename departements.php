
<body>
<?php include('includes/usernavbar.php');?>

	<div class="hero-wrap" style="background-image: url('images/thesis_img/department.jpg'); background-attachment:fixed;">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-8 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Accueill</a></span> <span>Département</span></p>
            <h1 class="mb-3 bread">Département</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row d-flex">
    			<div class="col-lg-6 d-flex ftco-animate">
    				<div class="dept d-md-flex">
    					<a href="departement-medical.php" class="img" style="background-image: url(images/medical.jpeg);"></a>
    					<div class="text p-4">
    						<h3><a href="departement-medical.php">Médical</a></h3>
                <?php  
                  $req= "SELECT depid FROM doctors WHERE depid=2";
                  $req_run= mysqli_query($conn,$req);
                  $cnt=mysqli_num_rows($req_run)
                  ?>
    						<p><span class="doc"><?php echo $cnt ?> </span></p>
    						<p>Le pôle médical de la Polyclinique de BERKANI MADANI regroupe des différentes spécialités de médecine.
							</p>
							</div>
    				</div>
    			</div>

    			<!-- surgical -->
    			<div class="col-lg-6 d-flex ftco-animate">
    				<div class="dept d-md-flex">
    					<a href="departement-cardio.php" class="img" style="background-image: url(images/thesis_img/cardio.jpg);"></a>
    					<div class="text p-4">
    						<h3><a href="departement-cardio.php">Département cardiovasculaire</a></h3> 
                <?php  
                  $req= "SELECT depid FROM doctors WHERE depid=1";
                  $req_run= mysqli_query($conn,$req);
                  $c=mysqli_num_rows($req_run)
                  ?> 				
    						<p><span class="doc"><?php echo $c ?></span></p>
    						<p>Le pôle cardiovasculaire de la Polyclinique de BERKANI MADANI se situe dans l’aile droite au rez-de-chaussée de la clinique. Il regroupe l’ensemble des spécialités traitant les pathologies du cœur et des vaisseaux.</p>
    						
    					</div>
    				</div>
    			</div>

    			<!-- ent -->
    			<div class="col-lg-6 d-flex ftco-animate">
    				<div class="dept d-md-flex">
    					<a href="departement-neurologie.php" class="img" style="background-image: url(images/thesis_img/norologie.jpg);"></a>
    					<div class="text p-4">
    						<h3><a href="departement-neurologie.php">Neurologie.</a></h3>
    						<p><span class="doc">3 Doctors</span></p>
    						<p>Le pôle neurologie de la Clinique du BERKANI MADANI les patients pour les consultations et les explorations neurologiques. Il prend en charge les affections du cerveau, de la moelle épinière, des nerfs périphériques, des muscles, l’imagerie neurologique et Doppler et les consultations mémoires. </p>
    						
    					</div>
    				</div>
    			</div>

    			<!-- paediatric -->
    			<div class="col-lg-6 d-flex ftco-animate">
    				<div class="dept d-md-flex">
    					<a href="departement-dentaire.php" class="img" style="background-image: url(images/thesis_img/dentaire.jpg);"></a>
    					<div class="text p-4">
    						<h3><a href="departement-dentaire.php"> Dentiste </a></h3>
    						<p><span class="doc">2 Doctors</span></p>
    						<p>	Nos chirurgiens-dentistes réalisent un examen approfondi. Ils vérifient la totalité des arcades, les articulations de la mâchoire, les muscles masticateurs, les muqueuses de la bouche. </p>
							
    						
    					</div>
    				</div>
    			</div>


    			<!--Neurological  -->
    			<div class="col-lg-6 d-flex ftco-animate">
    				<div class="dept d-md-flex">
    					<a href="departement-radio.php" class="img" style="background-image: url(images/thesis_img/radio.jpg);"></a>
    					<div class="text p-4">
    						<h3><a href="departement-radio.php">Radio et analyses </a></h3>
    						<p><span class="doc">3 Doctors</span></p>
    						<p>Pour vous accompagner efficacement dans la prise en charge d’examens médicaux complémentaires, un centre d’imagerie médicale et un laboratoire d’analyses sont à votre disposition au sein la Polyclinique de BERKANI MADANI. </p>
    						
    					</div>
    				</div>
    			</div>

    			<!-- ophthalmological -->
    			<div class="col-lg-6 d-flex ftco-animate">
    				<div class="dept d-md-flex">
    					<a href="departement-digestif.php" class="img" style="background-image: url(images/thesis_img/digestif.jpg);"></a>
    					<div class="text p-4">
    						<h3><a href="departement-digestif.php">Département digestif </a></h3>
    						<p><span class="doc">2 Doctors</span></p>
    						<p>Le pôle digestif de la Polyclinique de BERKANI MADANI l’ensemble des spécialités traitant les pathologies liées à l’appareil digestif de l’œsophage, en passant par les intestins jusqu’au rectum. Que votre pathologie soit médicale ou chirurgicale, vous bénéficierez d’une prise en charge complète grâce à notre équipe pluridisciplinaire composée de différents praticiens spécialistes.
						    </p>
    						
    					</div>
    				</div>
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
        if(fromdb == 7) {
         var fromdb = 0;
        }
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
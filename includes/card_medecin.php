  <!-- card médecin -->
  <?php
  include('database/connection.php');
  ?>
 <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
            <h2 class="mb-4">NOS MÉDECINS EXPÉRIMENTÉS</h2>
          </div>
        </div>
        <div class="row">
        	
				  <?php
					//$cards = $conn->query("SELECT c.image img,c.description descr,de.depname dep,doc.name docName  FROM 'card' as c INNER JOIN departments as de ON c.doc_spec = de.departments_id INNER JOIN doctors as doc on doc.doctors_id = c.doc_card");
					$cards = mysqli_query($conn, "SELECT c.doc_image img,c.doc_descr descr,de.depname dep,doc.name docName 
					 FROM cards as c INNER JOIN departments as de ON c.doc_spec = de.departments_id INNER JOIN
					  doctors as doc on doc.doctors_id = c.doc_card");
				  foreach($cards as $key=>$card){
					  ?>
					 		 <div class="col-md-6 col-lg-3 ftco-animate">
							<div class="block-2">
								<div class="flipper">
								<div class="front" style="background-image: url(<?php echo $card['img']; ?>);">
									<div class="box">
									<h2> <?php echo $card['docName']; ?></h2>
									<p> <?php echo $card['dep']; ?></p>
									</div>
								</div> 
									<div class="back">
	                <!-- back content -->
	                <blockquote>
	                  <p> <?php  echo $card['descr']; ?></p>
	                </blockquote>
	                <div class="author d-flex">
	                  <div class="image mr-3 align-self-center">
	                    <div class="img" style="background-image: url(<?php echo $card['img']; ?>);"></div>
	                  </div>
	                  <div class="name align-self-center"><?php echo $card['docName']; ?> <span class="position"><?php echo $card['dep']; ?></span></div>
	                </div>
	              </div>
	            </div>
	          </div> 
			  <!-- .flip-container -->
	        </div>
	        
				  <?php
				  }
				  ?>
				  
	              
	              
        <div class="row">
        	<div class="col-md-9 ftco-animate">
        		<h4>Nous sommes des médecins expérimentés</h4>
        		<p>Le traitement nécessaire à de nombreux patients ne peut pas être conditionné sous forme de pilule. Le vrai traitement de la personne implique tellement plus.</p>
        	</div>
        </div>
    	</div>
    </section>
    

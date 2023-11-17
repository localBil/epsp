


  <body>
    <?php include('includes/usernavbar.php'); ?>
    <!-- END nav -->
    
    <div class="hero-wrap" style="background-image: url('images/bbg_6.jpg'); background-attachment:fixed;">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-8 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Accueill</a></span> <span>Médecin</span></p>
            <h1 class="mb-3 bread">Tableau des Médecin</h1>
          </div>
        </div>
      </div>
    </div>
    <section class="ftco-section">
      <div class="container">
        <div class="row">
           <div class="table-responsive">
                  <table class="table table-striped table-light table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-primary">
                        <tr>
                           <td>No.</td>
                           <td>Nom Médecin</td>
                           <td>Polyclinique</td>
                           <td>Département</td>
                           <td width="220px">Horaire</td>
                        </tr>                      
                    </thead>
                    <tbody class="text-primary depart">
                        <?php foreach($doctor as $key => $d) { ?>
                          <tr id="nice<?php echo $d['doctors_id']?>">
                             <td><?php echo $key+1 ?></td>
                             <td><?php echo $d['name']; ?></td>
                             <td><?php echo $d['degree']; ?></td>
                             <td><?php echo $d['depname']; ?></td>
                             <td width="220px"><?php echo $d['sitting_time'];?></td>
                          </tr>
                        <?php } ?>
                    </tbody>
                  </table>
                </div>
        </div>
    
      </div>
    </section>
    




 


  <!-- loader -->


  <!-- Modal -->
<?php include('includes/tableau_rendez_vous.php'); ?>
<?php include('includes/footer.php');?>
<?php include('includes/foot.php'); ?>

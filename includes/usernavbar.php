
<link rel="stylesheet" href="css/main.css">

<?php 
include('database/connection.php');
include('includes/userheader.php'); 
include('includes/handle_appointment.php');
    $doctor =  $conn->query("SELECT de.*,d.* FROM doctors as d LEFT JOIN departments as de ON d.depid = de.departments_id");
?>
  <style type="text/css">
     .error {
        color:red;
     }
  </style>



<style>
  body {
  
  font-size: 15px;
  
}
  


#bar-top {
	position: relative;
	width: 100%;
    overflow: hidden;
    background-color: #ffffff;
}


.bar-top {
	height: 40px;
  height: 40px;
    align-content: center;
    background-color: #423d61;
    text-underline-position: inherit;

}
.slide-text h1 {
    font-size: 55px;
    color: #fdfdfd;
    line-height: 1.2;
    font-weight: 400;
    text-transform: uppercase;
    /* text-align-last: justify; */
    -webkit-text-stroke-width: thin;
    outline: double;
   }
.bar-top p {
  line-height: 40px;
    margin: 0px;
    color: #ffffff;
    font-weight: 500;
    font-size: 11px;
    display: inline-block;
    font-family: revert;
    font-style: italic;
    text-transform: uppercase;
}
.bar-top .social-icons {
	text-align: right;
	float: right;
  padding-top: 12;
}
.bar-top .social-icons a {
  line-height: 40px;
    color: #fff;
    float: left;
    width: 33px;
    text-align: center;
    display: inline-block;
    font-size: 20px;
    margin: -2px;
    
}
.bar-top .social-icons a:hover {
	color: #696969;
}
.bar-top .dropdown-menu>li>a {
	width: 100%;
}
.bar-top .dropdown-menu>li>a:hover {
	background: #232955 !important;
	color: #fff;
}
.bar-top .bootstrap-select.btn-group .dropdown-menu li {
	width: 100%;
}
.bar-top .btn {
	border: none;
	padding: 0px;
	line-height: 70px;
	width: 50px;
	font-weight: normal;
	font-size: 15px;
	color: #fff !important;
	background: none !important;
	border-radius: 0px;
	outline: none !important;
	box-shadow: none !important;
}
.bar-top .langug {
	margin-left: 40px;
}
.bar-top .langug p {
	line-height: 30px;
}

.social_icons {
	position: relative;
	z-index: 1;
}
.social_icons ul {
	margin: 0;
	padding: 0;
	text-align: center;
}
.social_icons li {
	display: inline-block;
	list-style: none;
	float: left;
}
.social_icons a {
	display: block;
	width: 40px;
	height: 40px;
	margin: 0px;
	font-size: 14px;
	line-height: 40px;
	text-decoration: none;
	border-radius: 50%;
	text-align: center;
	color: #696969;
	border: 1px solid #f5f5f5;
	margin-right: 5px;
}
.social_icons a:hover i {
	-webkit-border-radius: 100%;
	-moz-border-radius: 100%;
	-webkit-transition: 0.4s ease-in-out;
	color: #fff;
}
.social_icons .behance a:hover {
	color: #fff;
	background-color: #2b9ad2;
	border-color: #2b9ad2;
}
.social_icons .blogger a:hover {
	color: #fff;
	background-color: #ff6500;
	border-color: #ff6500;
}
.social_icons .deviantart a:hover {
	color: #fff;
	background-color: #536659;
	border-color: #536659;
}
.social_icons .dribbble a:hover {
	color: #fff;
	background-color: #f973a4;
	border-color: #f973a4;
}
.social_icons .facebook a:hover {
	color: #fff;
	background-color: #3b5a9b;
	border-color: #3b5a9b;
}
.social_icons .flickr a:hover {
	color: #fff;
	background-color: #ff0084;
	border-color: #ff0084;
}
.social_icons .forrst a:hover {
	color: #fff;
	background-color: #2f713d;
	border-color: #2f713d;
}
.social_icons .googleplus a:hover {
	color: #fff;
	background-color: #f63d26;
	border-color: #f63d26;
}
.social_icons .instagram a:hover {
	color: #fff;
	background-color: #507ea4;
	border-color: #507ea4;
}
.social_icons .lastfm a:hover {
	color: #fff;
	background-color: #da0019;
	border-color: #da0019;
}
.social_icons .linkedin a:hover {
	color: #fff;
	background-color: #0072b2;
	border-color: #0072b2;
}
.social_icons .paypal a:hover {
	color: #fff;
	background-color: #165c82;
	border-color: #165c82;
}
.social_icons .picasa a:hover {
	color: #fff;
	background-color: #cb2027;
	border-color: #cb2027;
}
.social_icons .pinterest a:hover {
	color: #fff;
	background-color: #cb2027;
	border-color: #cb2027;
}
.social_icons .skype a:hover {
	color: #fff;
	background-color: #00aaf1;
	border-color: #00aaf1;
}
.social_icons .soundcloud a:hover {
	color: #fff;
	background-color: #ff6900;
	border-color: #ff6900;
}
.social_icons .stumbleupon a:hover {
	color: #fff;
	background-color: #eb4823;
	border-color: #eb4823;
}
.social_icons .twitter a:hover {
	color: #fff;
	background-color: #2baae1;
	border-color: #2baae1;
}
.social_icons .vimeo a:hover {
	color: #fff;
	background-color: #40b2dc;
	border-color: #40b2dc;
}
.social_icons .youtube a:hover {
	color: #fff;
	background-color: #ff3330;
	border-color: #ff3330;
}
.social_icons .tumblr a:hover {
	color: #fff;
	background-color: #35506b;
	border-color: #35506b;
}
</style>



  <div class="bar-top">
    <div class="container">
       <div class="row">
                  <div class="col-sm-6">
                    <p>L’établissement public de santé de proximité de Oum El Bouaghi</p>
                  </div>
                  <div class="col-sm-6">
                    <div class="social-icons"> <a href="https://www.facebook.com/itsourcecode"><i class="ion-logo-facebook"></i></a> <a href="https://www.twitter.com/itsourcecode"><i class="ion-logo-twitter"></i></a><a href="https://www.facebook.com/itsourcecode"><i class="ion-logo-instagram"></i></a><a href="https://www.youtube.com/c/JokenVillanueva?sub_confirmation=1"><i class="ion-logo-youtube"></i></a> </div>
        </div>
        </div>
      </div>
    </div>




<nav class="navbar navbar-expand-sm navbar-dark ftco_navbar bg-dark ftco-navbar-light " id="ftco-navbar">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse justify-content-center" id="ftco-nav">
        <ul class="navbar-nav ">
          <li class="nav-item active"><a href="index.php" class="nav-link">Accueil</a></li>
          <li class="nav-item"><a href="about.php" class="nav-link">Nos connaitre</a></li>
          <li class="nav-item"><a href="departements.php" class="nav-link">Départements</a></li>
          <li class="nav-item"><a href="doctors.php" class="nav-link">Médecin</a></li>
          <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
          </ul>
          <button href="#" class="btn btn-primary btn-sm ml-3" data-toggle="modal" data-target="#modalAppointment"><span>Prendre un Rendez-vous </span></button>
          </div>
  </nav>
<!-- Start Header Jumbotron  -->
<header class="jumbotron back-image" style="background-image: url(assets/images/5.jpg)">
     <div class="header-div main-heading text-left">
     <h1 class="text-uppercase text-primary font-weight-bold">Welcom to SMS</h1>
     <p class="text-dark font-italic header-p">Repair with Care</p>
     <a href="views/requester/rlogin.php" class="btn btn-success mr-4">Login</a>
     <a href="#" class="btn btn-primary mr-4">Sign Up</a>
     </div>
    </header>

    <!-- End Header Jumbotron  -->

    <!-- Start INTRODUCTION  SECTION -->

    <div class="container" id="Services">
        <div class="jumbotron">
            <h3 class="text-center">Services</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                 Consectetur voluptates tempore sequi et asperiores blanditiis nostrum? Reiciendis 
                 porro dolore officia consequuntur, modi, eaque assumenda perspiciatis voluptates, quos a earum amet accusantium.
                  Doloremque sint possimus commodi itaque tempore. Quidem, ipsum explicabo!</p>

        </div>
    </div> <!-- End Container -->
   <!-- End INTRODUCTION SECTION -->

   <!-- START SERVICES -->
   <div class="container text-center border-bottom">
       <h2 class="mt-4">OUR SERVICES</h2>
       <div class="row mt-4">
           <div class="col-sm-4">
               <a href="#"><i class="fas fa-tv fa-8x mb-4 text-success"></i></a>
               <h4 class="mt-4">Electronic Appliences</h4>
           </div>
           <div class="col-sm-4">
               <a href="#"><i class="fas fa-sliders-h fa-8x mb-4 text-primary"></i></a>
               <h4 class="mt-4">Preventive Maintenance</h4>
           </div>
           <div class="col-sm-4">
               <a href="#"><i class="fas fa-cogs fa-8x mb-4 text-info"></i></a>
               <h4 class="mt-4">Fault Repair</h4>
           </div>
       </div>
   </div>  <!--End Container -->
   <!-- END SERVICES -->

   <!-- Start Registration Form -->

   <?php
   include('registration.php');
   ?>

   <!-- Start Happy Customer -->

   <div class="jumbotron bg-danger">
       <div class="container">
        <h2 class="text-center text-white">Happy Customer</h2>
          <div class="row mt-5">
                <div class="col-lg-3 col-sm-6"><!-- start 1st Column  -->
                    <div class="card shadow-lg mb-2">
                        <div class="card-body text-center">
                        <img src="assets/images/avtar1.jpeg" alt="avt1" class="img-fluid" style="border-radius: 100px;">
                            <h4 class="card-title">Ali Ahmad</h4>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ut, ratione.</p>
                        </div>                 
                     </div> <!-- End Card  -->
                </div><!-- End 1st Column  -->
                <div class="col-lg-3 col-sm-6"><!-- start 2nd Column  -->
                    <div class="card shadow-lg mb-2">
                        <div class="card-body text-center">
                        <img src="assets/images/avtar2.jpeg" alt="avt2" class="img-fluid" style="border-radius: 100px;">
                            <h4 class="card-title">Aysha Afzal</h4>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ut, ratione.</p>
                        </div>                 
                     </div> <!-- End Card  -->
                </div><!-- End 2nd Column  -->
                <div class="col-lg-3 col-sm-6"><!-- start 3rd Column  -->
                    <div class="card shadow-lg mb-2">
                        <div class="card-body text-center">
                        <img src="assets/images/avtar3.jpeg" alt="avt3" class="img-fluid" style="border-radius: 100px;">
                            <h4 class="card-title">Mosa Khalil</h4>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ut, ratione.</p>
                        </div>                 
                     </div> <!-- End Card  -->
                </div><!-- End 3rd Column  -->
                <div class="col-lg-3 col-sm-6"><!-- start 4th Column  -->
                    <div class="card shadow-lg mb-2">
                        <div class="card-body text-center">
                        <img src="assets/images/avtar4.jpeg" alt="avt4" class="img-fluid" style="border-radius: 100px;">
                            <h4 class="card-title">Bismil Akhtar</h4>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ut, ratione.</p>
                        </div>                 
                     </div> <!-- End Card  -->
                </div><!-- End 4th Column  -->
            </div><!-- End Row  -->
        </div>
   </div><!-- End JumboTron -->
<!-- End Happy Customer -->

<!-- Start Contact Us-->
<div class="container" id="Contact">
<h2 class="text-left mb-4">Contact Us</h2>
    <div class="row">
      <!-- Start 1st Column -->
      <?php
      include('contact_us.php');
      ?>
       <!-- End 1st Column -->
     
      <div class="col-md-4 text-center">  <!-- Star 2nd Column   -->
       <strong> Address Main Branch:</strong> <br> 
        SMS Pvt Ltd. <br> MARKAZ Islamabad-4032 <br>
        Phone: +92 348 6469693 <br> 
        <a href="#" target="_blank">www.SMS.com.pk</a><br>
        <br><br>

        <strong> Address 2nd Branch:</strong> <br> 
        SMS Pvt Ltd. <br> Shamsabad Rawalpindi-4032 <br>
        Phone: +92 348 6469693 <br> 
        <a href="#" target="_blank">www.SMS.com.pk</a><br>
     
     
      </div> <!-- End 2nd Column   -->

    </div>

</div> <!-- End Contact Us-->
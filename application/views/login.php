<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?=$this->app_module;?> - <?=$this->app_name;?></title>
    <meta name="description" content="ระบบบริหาร ควบคุมพื้นที่เข้าออก (TSWG System)">
    <link rel="stylesheet" href="<?=base_url();?>public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="<?=base_url();?>public/assets/fonts/fontawesome-all.min.css">
</head>

<body class="bg-gradient-primary">
    <style>
    
    body {
          background-image: url("<?=base_url();?>/public/assets/img/login_bg.png") !important;
          background-repeat: no-repeat, repeat  !important;
          background-position: center !important; /* Center the image */
          background-size: cover !important; /* Resize the background image to cover the entire container */
         
        }
        
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" >
                                <center>
                                <img src="<?=base_url();?>/public/assets/img/logo/logo.jpg" width="70%" height="70%" />
                                </center>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">ระบบบริหาร ควบคุมพื้นที่เข้าออก (TSWG System)</h4>
                                    </div>
                                    <form class="user" action="<?=site_url("welcome/authen_business_site");?>" method="post">
                                        <div class="form-group">
                                        <input class="form-control form-control-user" 
                                        type="text" id="exampleInputEmail" aria-describedby="emailHelp" 
                                        placeholder="Enter Email Address..." name="uname"></div>
                                        <div class="form-group">
                                        <input class="form-control form-control-user" 
                                        type="password" id="exampleInputPassword" 
                                        placeholder="Password..." name="pword"></div>
 
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <div class="form-check"><input class="form-check-input custom-control-input" type="checkbox" id="formCheck-1"><label class="form-check-label custom-control-label" for="formCheck-1">Remember Me</label></div>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary btn-block text-white btn-user" type="submit">Login</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <?php include_once("_footer.php"); ?>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
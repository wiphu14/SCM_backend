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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
</head>

<body id="page-top">
    <div id="wrapper">
    <?php $this->load->view('nav'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            
            
            
            <div id="content">
                <?php $this->load->view('content_nav'); ?>
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Profile</h3>
                <div class="row mb-3">
                    <div class="col-lg-4">
                        <form action="<?=site_url("welcome/douploadsettingMember");?>" enctype="multipart/form-data" method="post">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow">
                                    <input class="form-control-plaintext" type="hidden" placeholder="0" value="<?= $rs[0]->id; ?>" name="id">
                                    <img class="rounded-circle mb-3 mt-4" 
                                    <?php
                                        if($rs[0]->pic_file != ""){
                                    ?>
                                            src="<?=base_url();?>uploads/members/<?=$rs[0]->pic_file;?>"
                                    <?php
                                        }else{
                                    ?>
                                            src="<?=base_url();?>public/assets/img/dogs/image2.jpeg" 
                                    <?php
                                        }
                                    ?>
                                    width="160" height="160" id="output_image" name="img">
                                    <input type="file" accept="image/*" onchange="preview_image(event)" name="file_pic">
                                    <button class="btn btn-primary btn-sm mt-3" type="submit">Save Settings</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-8">
                        <div class="row mb-3 d-none">
                            <div class="col">
                                <div class="card text-white bg-primary shadow">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col">
                                                <p class="m-0">Peformance</p>
                                                <p class="m-0"><strong>65.2%</strong></p>
                                            </div>
                                            <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                        </div>
                                        <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card text-white bg-success shadow">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col">
                                                <p class="m-0">Peformance</p>
                                                <p class="m-0"><strong>65.2%</strong></p>
                                            </div>
                                            <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                        </div>
                                        <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-3">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">User Settings</p>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?=site_url("welcome/updateProfile");?>" method="post">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><input class="form-control-plaintext" type="hidden" placeholder="0" value="<?= $rs[0]->id; ?>" name="id"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="first_name"><strong>ชื่อ</strong></label><input class="form-control" type="text" placeholder="John" value="<?= $rs[0]->name; ?>" name="first_name"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="last_name"><strong>นามสกุล</strong></label><input class="form-control" type="text" placeholder="Doe" value="<?= $rs[0]->surname; ?>" name="last_name"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="member_id"><strong>เจ้าของรถ</strong></label>
                                                        <?php 
                                                        if ($rs[0]->type_member == 1){
                                                            $tm1 = "บุคคล";
                                                            $tm2 = "นิติบุคคล";
                                                        }else if ($rs[0]->type_member == 2){
                                                            $tm1 = "นิติบุคคล";
                                                            $tm2 = "บุคคล";
                                                        }
                                                        ?>                                                        
                                                        <select class="form-control" type="text" placeholder="1" name="type_member">
                                                            <option><?= $tm1 ?></option>
                                                            <option><?= $tm2 ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="telephone"><strong>เบอร์โทรศัพท์</strong></label><input class="form-control" type="text" placeholder="0999999999" value="<?= $rs[0]->tel; ?>" name="telephone"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="email"><strong>Email</strong></label><input class="form-control" type="email" placeholder="user@example.com" value="<?= $rs[0]->email; ?>" name="email"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="Line ID"><strong>Line ID</strong></label><input class="form-control" type="text" placeholder="Line ID" value="<?= $rs[0]->lineid; ?>" name="line"></div>
                                                </div>
                                            </div>
                                        
                                            <div class="form-group"><label for="address"><strong>ที่อยู่</strong></label><input class="form-control" type="text" placeholder="Sunset Blvd, 38" value="<?= $rs[0]->address; ?>" name="address"></div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="city"><strong>จังหวัด</strong></label><input class="form-control" type="text" placeholder="Los Angeles" value="<?= $rs[0]->city; ?>" name="city"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="country"><strong>ประเทศ</strong></label><input class="form-control" type="text" placeholder="USA" value="<?= $rs[0]->country; ?>" name="country"></div>
                                                </div>
                                            </div>
                                            <div class="text-center"><button class="btn btn-primary btn-sm" type="submit">Save Settings</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include_once("_footer.php"); ?>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>

<script>
    function preview_image(event) 
    {
        var reader = new FileReader();
        reader.onload = function()
        {
            var output = document.getElementById('output_image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
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

<body id="page-top">
    <div id="wrapper">
    <?php $this->load->view('nav'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            
            
            
            <div id="content">
                <?php $this->load->view('content_nav'); ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-10"><h3 class="text-dark mb-4">Calculation</h3></div>
                </div>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Calculation</p>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col">                                                        
                                <div class="form-group"><label for="price"><strong>เวลาเข้า</strong></label><input class="form-control" type="text" placeholder="0" value="<?= $items[0]->time_in ?>" name="price"></div>                        
                            </div>
                            <div class="col">
                                <div class="form-group"><label for="price"><strong>เวลาออก</strong></label><input class="form-control" type="text" placeholder="0" value="<?= $items[0]->time_out ?>" name="price"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group"><label for="price"><strong>เวลาจอด</strong></label><input class="form-control" type="text" placeholder="0" value="<?= $hr ?> ชั่วโมง <?= $min ?> นาที" name="price"></div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label for="price"><strong>ราคา</strong></label><input class="form-control" type="text" placeholder="0" value="<?= $price ?>" name="price"></div>
                            </div>
                        </div>
                                            
                        <div class="text-center"><button class="btn btn-primary btn-sm" type="submit">Save Settings</button></div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © TSWG-VSM: Vehicle Security Management System 2020-2024</span></div>
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="<?=base_url();?>public/assets/js/jquery.min.js"></script>
    <script src="<?=base_url();?>public/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=base_url();?>public/assets/js/chart.min.js"></script>
    <script src="<?=base_url();?>public/assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="<?=base_url();?>public/assets/js/theme.js"></script>
</body>

</html>

<script>
    
    function PageAddPrice(){
        location.href = "<?=site_url("welcome/newprofileprice");?>";
    }

    function deleteById(id){
        var yn=confirm("ต้องการลบใช่หรือไม่ ?");
        if(yn){
            postDel(id)
            location.href = "<?=site_url("welcome/profileprice");?>";
        }
    }

    function postDel(id){			
			$.post( "<?=site_url("welcome/deleteProPrice");?>", { 
			
					"id": id
                    },
					
				function(response){
					if(response.msg = "success"){
						alert(' ทำรายการสำเร็จ');
					}else{
						alert('เกิดข้อผิดพลาด ทำรายการไม่สำเร็จ');
					}
				},
			"json" );		
	}// .End postSave

    function editProPrice(id){
        var yn=confirm("ต้องการแก้ไขใช่หรือไม่ ?");
        if(yn){
            postEdit(id)
        }
    }
    function postEdit(id){
        window.location = "<?=site_url("welcome/editProPrice/");?>"+id;	
    }

</script>
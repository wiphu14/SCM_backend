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
                    <div class="col-sm-10"><h3 class="text-dark mb-4">ราคาจอดรถ แยกตามประเภทรถ</h3></div>
                    <div class="col-sm-2"><button class="btn-success" onclick="PageAddPrice()"><i class="fa fa-plus"></i> เพิ่มราคาใหม่</button></div>
                </div>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Profile Price</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-nowrap">
                                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="10" selected="">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                            </div>
                        </div>
                        <div 
                        class="table-responsive table mt-2" 
                        id="dataTable"
                        role="grid"
                        aria-describedby="dataTable_info">
                            <table class="table my-0" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>ประเภทรถ</th>
                                        <th>เวลาจอด (ช.ม.)</th>
                                        <th>ราคา</th>
                                        <th>ประเภทสมาชิก</th>
                                        <th>ลบ/แก้ไข</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
                                    foreach ($items as $item){
                                        ?>
                                        <tr>
                                            <?php $res = $this->cartype->getById($item->car_type_id); ?>
                                            <td><?php echo $res[0]->name;?></td>
                                            <td><?php echo $item->h;?></td>
                                            <td><?php echo $item->price;?></td>
                                            <td><?php echo $item->for_member;?></td>
                                            <td><button class="btn" onclick="deleteById(<?=$item->id;?>)"><i class="fa fa-trash"></i>
                                            <button class="btn" onclick="editProPrice(<?=$item->id;?>)"><i class="fa fa-wrench"></i></button></td>
                                        </tr> 
                                    <?php
                                    }
                                    ?>

                                    
                                    
                                </tbody>
                                <!-- <tfoot>
                                    <tr>
                                        <td><strong>Name</strong></td>
                                        <td><strong>Position</strong></td>
                                        <td><strong>Office</strong></td>
                                        <td><strong>Age</strong></td>
                                        <td><strong>Start date</strong></td>
                                    </tr>
                                </tfoot> -->
                            </table>
                        </div>
                        <!-- <div class="row">
                            <div class="col-md-6 align-self-center">
                                <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                            </div>
                            <div class="col-md-6">
                                <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                    <ul class="pagination">
                                        <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
<?php include_once("_footer.php"); ?>
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
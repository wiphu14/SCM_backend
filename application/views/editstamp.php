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
                <div class="row">
                    <div class="col-lg-8">
                        <form   action="<?=site_url("welcome/updateStamp");?>" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card mb-3">
                                            <div class="card-body text-center shadow">
                                                <div class="form-row">
                                                <input class="form-control-plaintext" type="hidden" placeholder="0" value="<?= $rs[0]->id; ?>" name="id">
                                                    <div class="col">
                                                        <div class="form-group text-left"><label for="site_id"><strong>Site ID</strong></label><input class="form-control" type="text" placeholder="" value="<?= $rs[0]->site_id; ?>" name="site_id" readonly></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group text-left"><label for="site_name"><strong>Site Name</strong></label><input class="form-control" type="text" placeholder="" value="<?= $rs[0]->site_name; ?>" name="site_name" readonly></div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group text-left"><label for="stamp_id"><strong>Stamp ID</strong></label><input class="form-control" id="stamp_id" type="text" placeholder="" value="<?= $rs[0]->stamp_id; ?>" name="stamp_id"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group text-left"><label for="stamp_title"><strong>Stamp Title</strong></label><input class="form-control" type="text" placeholder="<?= $rs[0]->stamp_title; ?>" value="Dpro car" name="stamp_title"></div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>        
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card mb-3">
                                        <div class="card-body text-center shadow">
                                            <div class="form-row px-3">
                                                <div class="col-sm-1 ml-3">
                                                    <div class="row" style="margin-bottom: 20px;">
                                                        <div class="form-check">
                                                            <?php if($rs[0]->choice == "f"){ ?>
                                                                <input class="form-check-input" type="radio" name="choice" id="gridRadios1" value="f" checked>
                                                            <?php }else{ ?>
                                                                <input class="form-check-input" type="radio" name="choice" id="gridRadios1" value="f">   
                                                            <?php } ?>
                                                            <label class="form-check-label" for="gridRadios1">
                                                                Free All
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="margin-bottom: 20px;"> 
                                                        <div class="form-check">
                                                            <?php if($rs[0]->choice == "t"){ ?>
                                                                <input class="form-check-input" type="radio" name="choice" id="gridRadios2" value="t" checked>
                                                            <?php }else{ ?>
                                                                <input class="form-check-input" type="radio" name="choice" id="gridRadios2" value="t">
                                                            <?php } ?>
                                                            <label class="form-check-label" for="gridRadios2">
                                                                Time
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row"> 
                                                        <div class="form-check">
                                                            <?php if($rs[0]->choice == "v"){ ?>
                                                                <input class="form-check-input" type="radio" name="choice" id="gridRadios3" value="v" checked>
                                                            <?php }else{ ?>
                                                                <input class="form-check-input" type="radio" name="choice" id="gridRadios3" value="v">
                                                                <?php } ?>
                                                            <label class="form-check-label" for="gridRadios3">
                                                                Value
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm3 ml-3">
                                                    <div class="row-left" style="margin-bottom: 15px;"> 
                                                        <label></label>
                                                    </div>
                                                    <div class="row-left"> 
                                                        <div class="form-group row">
                                                            <?php if($rs[0]->choice == "t"){ ?>
                                                                <input class="form-control col-8" style="font-size:12px;" type="text" placeholder="" value="<?= $rs[0]->value ?>" name="time">
                                                            <?php }else{ ?>
                                                                <input class="form-control col-8" style="font-size:12px;" type="text" placeholder="" value="" name="value">
                                                            <?php } ?>
                                                            <div class="col-4" style="margin-top: 3px;"><label>Hr</label></div>
                                                        </div>
                                                    </div>
                                                    <div class="row-left"> 
                                                        <div class="form-group row">
                                                            <?php if($rs[0]->choice == "v"){ ?>
                                                                <input class="form-control col-8" style="font-size:12px;" type="text" placeholder="" value="<?= $rs[0]->value ?>" name="value">
                                                            <?php }else{ ?>
                                                                <input class="form-control col-8" style="font-size:12px;" type="text" placeholder="" value="" name="value">
                                                            <?php } ?>
                                                            <div class="col-4" style="margin-top: 3px;"><label>Baht</label></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-center">
                                                <div class="text-center"><button class="btn btn-primary btn-sm" type="submit">Save Settings</button></div>
                                            </div>
                                        </div>
                                    </div>        
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="card mb-3">
                                <div class="card-body text-center shadow">
                                    <canvas id="qr-code"></canvas>
                                    <div class="mb-3"><button class="btn btn-primary btn-sm" onclick="checkDownload()" type="button">Download</button></div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-10"><h3 class="text-dark mb-4">จัดการตราประทับ</h3></div>
                </div>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">รายการตราประทับ</p>
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
                                        <th>Stamp ID</th>
                                        <th>Stamp Title</th>
                                        <th>Stamp Detail</th>
                                        <th>ลบ/แก้ไข</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
                                        foreach ($items as $item){
                                    ?>
                                        <tr>
                                            <td><?php echo $item->stamp_id;?></td>
                                            <td><?php echo $item->stamp_title;?></td>
                                            <td><?php if($item->choice=='f'){
                                                    echo "Free All";
                                                }else if($item->choice=='t'){
                                                    echo "Time ".$item->value." Hr";
                                                }else if($item->choice=='v'){
                                                    echo "Value ".$item->value." Baht";
                                                } ?></td>
                                            <td><button class="btn" onclick="deleteById(<?= $item->id ?>)"><i class="fa fa-trash"></i>
                                            <button class="btn" onclick="editStamp(<?= $item->id ?>)"><i class="fa fa-wrench"></i></button>
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
                        <div class="row">
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
                        </div>
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

<script>
    function deleteById(id){
        var yn=confirm("ต้องการลบใช่หรือไม่ ?");
        if(yn){
            postDel(id)
            location.href = "<?=site_url("welcome/stamp");?>";
        }
    }

    function postDel(id){			
			$.post( "<?=site_url("welcome/deleteStamp");?>", { 
			
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

    function PageAddBusiness(){
        location.href = "<?=site_url("welcome/newbusiness");?>";
    }

    function PageCar(){
        location.href = "<?=site_url("welcome/business");?>";
    }

    function editBusiness(id){
        var yn=confirm("ต้องการแก้ไขใช่หรือไม่ ?");
        if(yn){
            postEdit(id)
        }
    }
    function postEdit(id){
        window.location = "<?=site_url("welcome/editStamp/");?>"+id;	
    }


    var qr;
    qr = new QRious({
        element: document.getElementById('qr-code'), // canvas object
        size: 160, // size image qr code
        value: 'Event Me!!!' // value default text
    });
    function checkDownload(){
        let id = document.getElementById('stamp_id').value;
        // var date = new Date();
        // var year = date.getFullYear();
        // var month = date.getMonth();
        //let id = "s" + year + month + "0001";

        id = id.substring(1);
        id = "s"+id;

        console.log(id);

        if(id != ""){
            saveImageAndDownload();
        }else{
            alert("กรุณาใส่เลขบัตร")
        }
    }
    function saveImageAndDownload() {
        let id = document.getElementById('stamp_id').value;
        // var date = new Date();
        // var year = date.getFullYear();
        // var month = ("0" + (date.getMonth() + 1)).slice(-2);

        // let id = "s" + year + month + "0001";

        id = id.substring(1);
        id = "s"+id;

        console.log(id);

        let downloadLink = document.createElement('a');
        downloadLink.setAttribute('download', id+'.png');
        let canvas = document.getElementById('qr-code');
        let dataURL = canvas.toDataURL('image/png');
        let url = dataURL.replace(/^data:image\/png/, 'data:application/octet-stream');
        downloadLink.setAttribute('href', url);
        downloadLink.click();
    }
</script>

</html>
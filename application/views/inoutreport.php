<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
    <?=$this->app_module;?> - <?=$this->app_name;?></title>
    
    <meta name="description" content="ระบบบริหาร ควบคุมพื้นที่เข้าออก (TSWG System)">
    <link rel="stylesheet" href="<?=base_url();?>public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="<?=base_url();?>public/assets/fonts/fontawesome-all.min.css">

    <style>
	@media print { 

		body * {
            visibility: hidden;
        }
        #printDiv, #printDiv * {
        visibility: visible;
        }
        #printDiv {
            position: absolute;
            left: 0;
            top: 0;
        }
}
#printDiv { size: 210mm 270mm }
</style>

</head>

<body id="page-top">
    <div id="wrapper">
    <?php $this->load->view('nav'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            
            
            
            <div id="content">
                <?php $this->load->view('content_nav'); ?>

            <div class="container-fluid">

                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">ระบุข้อมูลค้นหา</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 text-nowrap">
                                
                            </div>
							<div class="col-md-6">
								<div class="form-group">
									<div class='input-group date' id='datetimepicker2'>
                                        <input type="hidden" id="business_id" name="business_id" value="<?=$business_id?>" />
									   <span style="width: 60px;padding-top: 5px;">วันที่เริ่ม:</span>
									   <input type='date' class="form-control" value="<?php echo date('Y-m-d'); ?>" id="date1" name="date1" />
									   <span class="input-group-addon">
									   <span class="glyphicon glyphicon-calendar"></span>
									   </span>
									</div>
									<div class='input-group date' id='datetimepicker2'>
									  <span style="width: 60px;padding-top: 5px;">ถึงวันที่:</span>
									  <input type='date' class="form-control"value="<?php echo date('Y-m-d'); ?>" id="date2" name="date2" />
									   <span class="input-group-addon">
									   <span class="glyphicon glyphicon-calendar"></span>
									   </span>
									</div>
								 </div>
							</div>
                            <div class="col-md-3">
								<button style="width: 150px; height: 70px; padding: 2px;margin-top: 2px;" 
                                type="button" class="btn btn-secondary btn-lg" id="btn_search">Search</button>
                            </div>
                        </div>

                        <div 
                        class="table-responsive table mt-2" 
                        id="dataTable"
                        role="grid"
                        aria-describedby="dataTable_info">
                             
                        </div>
                         
                    </div>
                </div>



 
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">รายการข้อมูล รถเข้า/ออก</p>
                    </div>
                    <div class="card-body">
                        
                        <div 
                        class="table-responsive table mt-2" 
                        id="dataTable"
                        role="grid"
                        aria-describedby="dataTable_info">
                            
                        <table id="datatable" class="table table-striped table-sm">
                            <thead>
                                <tr> 
                                    <th>ID</th>
                                    <th>Card Number</th>
                                   
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th></th>
                                   
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>



                        <!-- print modal -->


                        <div class="modal fade" id="trn_car_in_out" tabindex="-1" role="dialog" aria-labelledby="label_trn_car_in_out" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-slideout modal-lg" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="label_trn_car_in_out">รายละเอียด</h5>
                                    
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="printDiv">
                                    
                                        <table >
                                        <tr>
                                            <td width="120px;">ภาพประกอบ</td>
                                            <div class="row">
                                                <div class="col-4">
                                                    <img id="img_one" src="<?=base_url();?>/public/assets/img/empty.png" style="width:240px;" />
                                                </div>
                                                <div class="col-4">
                                                    <img id="img_two" src="<?=base_url();?>/public/assets/img/empty.png" style="width:240px;" />
                                                </div>
                                                <div class="col-4">
                                                    <img id="img_three" src="<?=base_url();?>/public/assets/img/empty.png" style="width:240px;" />
                                                </div>
                                            </div>
                                            
                                            
                                            </td>
                                            </tr>
                                        
                                            <tr>
                                                <td width="160px;">ID</td><td id="print_trn_car_in_out_id"></td>
                                            </tr>
                                            
                                            <tr>
                                                <td width="160px;">วันเวลาเข้า</td><td id="print_in_date"></td>
                                            </tr>

                                            <tr>
                                                <td width="160px;">วันเวลาออก</td><td id="print_out_date"></td>
                                            </tr>
                                            
                                            <tr>
                                                <td style="font-size:20px;">ทะเบียนรถ</td><td style="font-size:20px;" id="print_car_license_no"></td>
                                            </tr>
                                             
                                            <tr>
                                                <td style="font-size:20px;">เลขบัตรประชาชน</td><td style="font-size:20px;" id="print_card_id"></td>
                                            </tr>
                                            <tr>
                                                <td>ติดต่อ</td><td id="print_reason"></td>
                                            </tr>
                                            <tr>
                                                <td>หมายเหตุ</td><td id="print_remark"></td>
                                            </tr>
                                        </table>
                                        
                                    </div>

                                    <!-- end print modal -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"   data-dismiss="modal">ปิด</button>
                                    <button type="button" class="btn btn-primary"  onclick="printAssignTask();">พิมพ์</button>
                                </div>
                            </div>
                        </div>
                


                    



                       
                    </div>
                </div>
            </div>
        </div>
<?php include_once("_footer.php"); ?>
	
    </div>
    
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="<?=base_url();?>public/assets/js/jquery.min.js"></script>
	<script src="<?=base_url();?>public/assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?=base_url();?>public/assets/js/chart.min.js"></script>
	<script src="<?=base_url();?>public/assets/js/bs-init.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
	<script src="<?=base_url();?>public/assets/js/theme.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js">
	</script>


<script type="text/javascript">
        var myDataStore = {} // default data store;
        
		    var table = {};
            $(document).ready(function() {
              getDataStore();
             table = $('#datatable').DataTable({
				'paging': true,
                'ajax': {
                    'url':'<?=site_url('welcome/gets_trn_car_in_out_dt_json');?>'
                },
                'columns': [
                    { data: 'id' }, 
                    { data: 'card_number' }, 
                    { data: 'time_in' }, 
                    { data: 'time_out' },
                    { data: 'action' }
                ]
            });

            $("#btn_search").click(function(e){
                postSearch();
            });

          });

    setInterval(function() {
        table.ajax.reload();
      }, 600000);

    function validForm(){
		
		
		 
	}// .End validForm

    function viewCarInOut(el) {
        var index = el.getAttribute("data-index");
        getTrnPic(myDataStore[index].id);
        $("#print_trn_car_in_out_id").html(myDataStore[index].card_number);
        $("#print_in_date").html(myDataStore[index].time_in);
        $("#print_out_date").html(myDataStore[index].time_out);
        $("#print_card_id").html(myDataStore[index].id_card);
        $("#print_reason").html(myDataStore[index].reason);
        $("#print_car_license_no").html(myDataStore[index].province + " " + myDataStore[index].license_plate);
        $("#print_remark").html(myDataStore[index].remark);
    } // .End function

	function getDataStore() {
		$.get('<?=site_url('welcome/gets_trn_car_in_out_json');?>',
        function(response){
            console.log(response.success);
            if(response.success){
                myDataStore = response.data;
            }else{
                alert('ไม่สามารถเรียกข้อมูลใหม่ได้');
            }
        },'json');
  }

  function getTrnPic(id) {
    $("#img_one").attr("src","<?=base_url();?>/public/assets/img/empty.png");
    $("#img_two").attr("src","<?=base_url();?>/public/assets/img/empty.png");
    $("#img_three").attr("src","<?=base_url();?>/public/assets/img/empty.png");
		$.get('<?=site_url('welcome/gets_trn_pic_json');?>/?trn_id=' + id,
        function(response){
            
            // console.log(response.success);
            
            if(response.success){
                var trnPic = response.data;
                
                if(trnPic.length > 0) {
                    $("#img_one").attr("src","<?=base_url();?>/uploads/business/" + trnPic[0].driver_file);
                }else{
                    $("#img_one").attr("src","<?=base_url();?>/public/assets/img/empty.png");
                }
                if(trnPic.length > 1) {
                    $("#img_two").attr("src","<?=base_url();?>/uploads/business/" + trnPic[1].driver_file);
                }else{
                    $("#img_two").attr("src","<?=base_url();?>/public/assets/img/empty.png");
                }
                if(trnPic.length > 2) {
                    $("#img_three").attr("src","<?=base_url();?>/uploads/business/" + trnPic[2].driver_file);
                }else{
                    $("#img_three").attr("src","<?=base_url();?>/public/assets/img/empty.png");
                }
                
                
                

            }else{
                alert('ไม่สามารถเรียกข้อมูลใหม่ได้');
            }
        },'json');
  }
  

  function renderToOption(ds, id, k, v) {
    var el = "";
    if (ds.length > 0) {
      $("#" + id).html("");
      ds.forEach(function(e, i) {
          el += "<option value=" + eval("e." + k) + ">" + eval("e." + v) + "</option>";
      });
      $("#" + id).append(el);
    } // .End if
  } //.End renderToOption
  
  function renderDatatable() {
    var tds = "";
    if(myDataStore.length > 0) {
        $("#tbody").html("");

        myDataStore.forEach(function (e,i) {
        tds += "<tr>";
        tds += "<td>" + e.id + "</td>";
        tds += "<td>" + e.card_number + "</td>";
        tds += "<td>" + e.gate_in + "</td>";
        tds += "<td>" + e.user_in + "</td>";
        tds += "<td>" + e.time_in + "</td>";
        tds += "<td>" + e.gate_out + "</td>";
        tds += "<td>" + e.user_out + "</td>";
        tds += "<td>" + e.time_out + "</td>";
        tds += "<td>" + genButtonCommand(e.id) + "</td></tr>";
    }); 
        $("#tbody").append(tds); 
    }
        
    } //.End renderDatatable
  
    /**
     * Generate button Command for table view
     */
    function genButtonCommand(id){
        var html = "<div class=\"btn-group\">";
        html +="<button type=\"button\" class=\"btn btn-danger\">คำสั่ง</button>";
        
        html +="<button type=\"button\" class=\"btn btn-danger dropdown-toggle dropdown-toggle-split\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">";
        html +="<span class=\"sr-only\">Toggle Dropdown</span>";
        html +="</button>";

        html +="<div class=\"dropdown-menu\">";
        html +="<a class=\"dropdown-item\" onclick=\"view(" + id + ")\"  href=\"#\">เรียกดู</a>";
        html +="<a class=\"dropdown-item\" onclick=\"print(" + id + ")\"  href=\"#\">พิมพ์</a>";
        html +"<a class=\"dropdown-item\" onclick=\"edit(" + id + ")\"  href=\"#\">แก้ไข</a>";
        html +"<div class=\"dropdown-divider\"></div>";
        html +"<a class=\"dropdown-item\" href=\"#\" onclick=\"confirmDel(" + id + ")\">ลบ</a>";
		html +"</div>";
		html +="</div>";

      return html;
    }

    /** */
	function clearForm(){ 
        $("#id").val("");
        $("#card_number").val("");
        $("#gate_in").val("");
        $("#user_in").val("");
        $("#time_in").val("");
        $("#gate_out").val("");
        $("#user_out").val("");
        $("#time_out").val("");
	} // .End clearForm

    function postSearch(){
        table.ajax.url('<?=site_url('welcome/search_trn_car_in_out_dt_json');?>/?business_id='+ $("#business_id").val() + '&date1=' + $("#date1").val() +"&date2=" + $("#date2").val()).load();
    }// .End postSearch


function printAssignTask() {
    window.print();
}
    </script>

	
</body>

</html>
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
                        <p class="text-primary m-0 font-weight-bold">รายการข้อมูลราคา</p>
                    </div>
                    <div class="card-body">
                        
                        <div 
                        class="table-responsive table mt-2" 
                        id="dataTable"
                        role="grid"
                        aria-describedby="dataTable_info">
                            
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#profile_price" >เพิ่มใหม่</button>
                        <br/> <br/>
                  
                        <table id="datatable" class="table table-striped table-sm">
                            <thead>
                            <tr> 
							<th>พื้นที่ติดตั้งระบบ</th>
                                <th>id</th><th>ชนิดรถ</th><th>H</th><th>ราคา</th><th>V/M</th><th></th>
                            </tr>
                  
                                
                            </thead>
                            <tbody>

                            </tbody>
                        </table>



                         <!-- modal form --> 

    <div class="row">
      

      <div class="modal fade" id="profile_price" tabindex="-1" role="dialog" aria-labelledby="label_profile_price" aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideout modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="label_profile_price">ฟอร์มกำหนดราคาค่าจอดรถ</h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          </div>
          <div class="modal-body">

          <!-- input hmtl content here -->
          <form id="frm" name="frm" method="post">
	<div class="form-group">
      <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="">
    </div>

	<div class="form-group">
		<label for="car_type_id">ชนิดรถ</label>
		<select class="form-control" id="business_id" name="business_id">
		</select>
    </div>
	
	<div class="form-group">
      <label for="car_type_id">ชนิดรถ</label>
	
      <select class="form-control" id="car_type_id" name="car_type_id">
	<option value="1">รถกระบะ</option>
	<option value="2">รถเก๋ง</option>
	<option value="3">มอเตอร์ไซค์</option>
	</select>
	
    </div>
	<div class="form-group">
			  <label for="h">ชั่วโมงที่</label>
			  <input type="number" class="form-control" id="h" name="h" placeholder="" value="" >
			</div>

	<div class="form-group">
			  <label for="price">ค่าจอดรถ</label>
			  <input type="number" class="form-control" id="price" name="price" placeholder="" value="" >
			</div>

	<div class="form-check form-check-inline">
      <input  type="checkbox" class="form-check-input" id="for_member" name="for_member" placeholder=""  value="" >
      <label  class="form-check-label" for="for_member">ราคาสำหรับสมาชิก</label>
    </div>
</form>
          <!-- input hmtl content end here -->
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="clearForm();" data-dismiss="modal">ปิด</button>
          <button type="button" class="btn btn-primary"  onclick="validForm();">บันทึก</button>
          </div>
        </div>
        </div>
      </div>
    </div>

    <style>
      /*Not Required*/
      .btn{margin-bottom:15px;}
      /*Required*/
      @media (max-width: 576px){.modal-dialog.modal-dialog-slideout {width: 80%}}
      .modal-dialog-slideout {min-height: 100%; margin: 0 auto 0 0 ;background: #fff;}
      .modal.fade .modal-dialog.modal-dialog-slideout {-webkit-transform: translate(-100%,0);transform: translate(-100%,0);}
      .modal.fade.show .modal-dialog.modal-dialog-slideout {-webkit-transform: translate(0,0);transform: translate(0,0);flex-flow: column;}
      .modal-dialog-slideout .modal-content{border: 0;}
    </style>
	
            <!-- end modal form -->
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
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js" ></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" ></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js" ></script>

  <script type="text/javascript">
        var myDataStore = {} // default data store;
        var myCar_typeStore = []; // option datastore
            
		    var table = {};
            $(document).ready(function() {
              getDataStore();
             table = $('#datatable').DataTable({
              buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
              ],
				      'paging': true,

                'ajax': {
                    'url':'<?=site_url('welcome/gets_profile_price_dt_json');?>'
                },
                'columns': [
                    { data: 'id' },
                    { data: 'business_id' },
					{ data: 'business_name' },
                    { data: 'car_type' },
                    { data: 'h' },
                    { data: 'price' },
                    { data: 'for_member' },
                    { data: 'action' },
                ]
            });
          });

    setInterval(function() {
        table.ajax.reload();
      }, 30000);

            function validForm(){
		
					if($("#car_type_id option:selected").val() == "") {
						alert('Pls, select item');
						return;
					}// .End if
					

					if($("#h").val() == "") {
						alert('Pls, Entry h');
						$("#h").focus();
						return;
					}// .End if
					

					if($("#price").val() == "") {
						alert('Pls, Entry price');
						$("#price").focus();
						return;
					}// .End if
					

					
					

		postSave();

	}// .End validForm

	function getDataStore() {
		$.get('<?=site_url('welcome/gets_profile_price_json');?>'
				,function(response){
					console.log(response.success);
				  if(response.success){
            myDataStore = response.data;
				  }else{
					  alert('ไม่สามารถเรียกข้อมูลใหม่ได้');
				  }
				},'json');
  }

  
    function getCar_typeStore() {
      $.get('<?= site_url('welcome/gets_car_type_json'); ?>',
      function(response) {
        if (response.success) {
          myCar_typeStore = response.data;
          renderToOption(myCar_typeStore, "car_type_id", "id", "name");
        } else {
          alert('ไม่สามารถเรียกข้อมูลใหม่ได้');
        }
      }, 'json');
    }
    getCar_typeStore();
    

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
      tds += "<td>" + e.car_type_id + "</td>";
      tds += "<td>" + e.h + "</td>";
      tds += "<td>" + e.price + "</td>";
      tds += "<td>" + e.for_member + "</td>";

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
	html +="<a class=\"dropdown-item\"  onclick=\"view(" + id + ")\"  href=\"#\">เรียกดู</a>";
	html +="<a class=\"dropdown-item\"  onclick=\"print(" + id + ")\"  href=\"#\">พิมพ์</a>";
        html +"<a class=\"dropdown-item\"  onclick=\"edit(" + id + ")\"  href=\"#\">แก้ไข</a>";
        html +"<div class=\"dropdown-divider\"></div>";
        html +"<a class=\"dropdown-item\" href=\"#\" onclick=\"confirmDel(" + id + ")\">ลบ</a>";
		html +"</div>";

		html +="</div>";

      return html;
    }

	function clearForm(){
    $("#id").val("");
			
			$("#car_type_id option")[0].selected = true;$("#h").val("");
			$("#price").val("");
			
			$("#for_member").prop("checked",false);
	}

	function edit(el){
    var index = el.getAttribute("data-index");

				$("#id").val(myDataStore[index].id);

					$("#car_type_id").val(myDataStore[index].car_type_id);
				$("#h").val(myDataStore[index].h);

				$("#price").val(myDataStore[index].price);

					$("#for_member").prop("checked",(myDataStore[index].for_member == "y") ? true : false);
	} // .End edit

	

			/**
			  Change state to is lock or unlock.
			 */
			function update_for_member(/** int */id,/** string */ v){
			  let cc = confirm("Are you want to change this item?");
			  if(cc){

				$.post('<?=site_url('welcome/update_for_member_json');?>',{'id':id,'for_member':v}
				,function(response){
				  if(response.success){
            getDataStore();
			      alert('ทำรายการเรียบร้อย');
			      table.ajax.reload();
				  }else{
					  alert('ทำรายการไม่สำเร็จ');
				  }
				},'json');

			  } // .End if
			} //.end update_for_member()
			//////////////////////////////////////
			 /**
			  Change state to is lock or unlock.
			 */
			function confirmDel(/** int */el){
        var id = el.getAttribute("data-id");
			  let cc = confirm("ต้องการลบข้อมูล?");
			  if(cc){
          $.post("<?=site_url("welcome/delete_profile_price_json");?>",{"id":id}
          ,function(response){
            if(response.success){
              getDataStore();
              table.ajax.reload();
              alert('ทำรายการเรียบร้อย');
            }else{
              alert('ไม่สามารถปรับปรุงรายการได้');
            }
          },'json');

			  } // .End if
			} //.end confirmDel()
			
		function postSave(){
			$.post( "<?=site_url("welcome/update_profile_price_json");?>", {
			
					"id": $("#id").val(),
					"car_type_id": $("#car_type_id option:selected").val(),
					"h": $("#h").val(),
					"price": $("#price").val(),
					"for_member": ($("#for_member:checked").prop("checked")) ? "y" : "n", },
				function(response){
					if(response.msg = "success"){
						getDataStore();
						table.ajax.reload();
						alert('บันทึกเปลี่ยนแปลงข้อมูลเรียบร้อย');
					}else{
						alert('เกิดข้อผิดพลาด ทำรายการไม่สำเร็จ');
					}
				},
			"json" );
		}// .End postSave

    function postSearch(){
      table.ajax.url('<?=site_url('welcome/search_profile_price_dt_json');?>/?title='+ $("#title").val() + '&management_level=' + $("#management_level").val() +"&department=" + $("#department").val() + '&office='+ $("#office").val() + '&company_name='+ $("#company_name").val()).load();
   }// .End postSearch

          </script>
	
</body>

</html>
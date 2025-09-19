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
                        <p class="text-primary m-0 font-weight-bold">รายการข้อมูลจุดติดตั้ง TAG</p>
                    </div>
                    <div class="card-body">
                    <input type="hidden" id="hid_business_id" name="hid_business_id" value="<?=$business_id?>" />
                        <div 
                        class="table-responsive table mt-2" 
                        id="dataTable"
                        role="grid"
                        aria-describedby="dataTable_info">
                            
                        <table id="datatable" class="table table-striped table-sm">
                            <thead>
                                <tr> 
                                    <th>No.</th>
                                    <th>ลค.</th>
                                    <th>Tag No.</th>
                                    <th>จุด</th>
                                    <th>พื้นที่ติดตั้ง</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>



                        <!-- modal form --> 
    
                        <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#register_tag">
                                + เพิ่มใหม่
                            </button>
                        </div>
                            
                        <div class="modal fade" id="register_tag" tabindex="-1" role="dialog" aria-labelledby="label_register_tag" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-slideout modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="label_register_tag">ฟอร์มจัดการข้อมูล TAG</h5>
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            
                            <!-- input hmtl content here -->
                            <form id="frm" name="frm" method="post">
                              <div class="form-group">
                                      
                                      <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="" >
                                      </div>

                              <div class="form-group">
                              <label for="business_id">บ. จุดติดตั้ง</label>
                              
                              <select class="form-control" id="business_id" name="business_id" readonly>
                              
                              </select>
                              
                              </div>
                              <div class="form-group">
                                      <label for="tag_no">หมายเลขแท็ก</label>
                                      <input type="text" class="form-control" id="tag_no" name="tag_no" placeholder="" value="" readonly >
                                      </div>

                              <div class="form-group">
                                      <label for="name">ชื่อเรียกจุด</label>
                                      <input type="text" class="form-control" id="name" name="name" placeholder="" value="" >
                                      </div>

                              <div class="form-group">
                                      <label for="location">สถานที่</label>
                                      <input type="text" class="form-control" id="location" name="location" placeholder="" value="" >
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
                                    <button type="button" class="btn btn-primary"  onclick="validForm();">บันทึก</button>
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
        var myBusinessStore = []; // option datastore
            
		    var table = {};
        $(document).ready(function() {
          getDataStore();
          table = $('#datatable').DataTable({
            dom: 'Bfrtip',
            buttons: [
              'excel'
            ],
            'paging': true,
            'ajax': {
                'url':'<?=site_url('event/gets_register_tag_dt_json');?>/?business_id='+ $("#hid_business_id").val()
            },
            'columns': [ { data: 'id' }, 
                { data: 'business' }, 
                { data: 'tag_no' }, 
                { data: 'name' }, 
                { data: 'location' }, 
                { data: 'action' } ]
          });
        });

    setInterval(function() {
        table.ajax.reload();
      }, 30000);

          function validForm(){

					if($("#business_id option:selected").val() == "") {
						alert('Pls, select item');
						return;
					}// .End if
					
 
					if($("#tag_no").val() == "") {
						alert('Pls, Entry tag_no');
						$("#tag_no").focus();
						return;
					}// .End if
					
 
					if($("#name").val() == "") {
						alert('Pls, Entry name');
						$("#name").focus();
						return;
					}// .End if
					
 
					if($("#location").val() == "") {
						alert('Pls, Entry location');
						$("#location").focus();
						return;
					}// .End if
					

		postSave();
		 
	}// .End validForm

	function getDataStore() {
		$.get('<?=site_url('event/gets_register_tag_json');?>'
				,function(response){
					console.log(response.success);
				  if(response.success){
            myDataStore = response.data;
				  }else{
					  alert('ไม่สามารถเรียกข้อมูลใหม่ได้');
				  }
				},'json');
  }
  
   
    function getBusinessStore() {
      $.get('<?= site_url('event/gets_business_json'); ?>',
      function(response) {
        if (response.success) {
          myBusinessStore = response.data;
          renderToOption(myBusinessStore, "business_id", "id", "name");
        } else {
          alert('ไม่สามารถเรียกข้อมูลใหม่ได้');
        }
      }, 'json');
    }
    getBusinessStore();
    

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
      tds += "<td>" + e.business_id + "</td>";
      tds += "<td>" + e.tag_no + "</td>";
      tds += "<td>" + e.name + "</td>";
      tds += "<td>" + e.location + "</td>";

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
			
			$("#business_id option")[0].selected = true;$("#tag_no").val("");
			$("#name").val("");
			$("#location").val("");
			
	}

	function edit(el){
    var index = el.getAttribute("data-index");

				$("#id").val(myDataStore[index].id);

					$("#business_id").val(myDataStore[index].business_id);
				$("#tag_no").val(myDataStore[index].tag_no);

				$("#name").val(myDataStore[index].name);

				$("#location").val(myDataStore[index].location);
  
	} // .End edit
	
	 /**
			  Change state to is lock or unlock.
			 */
			function confirmDel(/** int */el){
        var id = el.getAttribute("data-id");
			  let cc = confirm("ต้องการลบข้อมูล?");
			  if(cc){		
          $.post("<?=site_url("event/delete_register_tag_json");?>",{"id":id}
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
			$.post( "<?=site_url("event/update_register_tag_json");?>", { 
			
					"id": $("#id").val(),
					"business_id": $("#business_id option:selected").val(),
					"tag_no": $("#tag_no").val(),
					"name": $("#name").val(),
					"location": $("#location").val(), }, 
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
      //table.ajax.url('<?=site_url('event/search_register_tag_dt_json');?>/?title='+ $("#title").val() + '&management_level=' + $("#management_level").val() +"&department=" + $("#department").val() + '&office='+ $("#office").val() + '&company_name='+ $("#company_name").val()).load();
      table.ajax.url('<?=site_url('event/search_event_status_dt_json');?>/?business_id='+ $("#hid_business_id").val()).load();
   }// .End postSearch
    </script>

	
</body>

</html>
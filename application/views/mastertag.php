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
                        
                        <div 
                        class="table-responsive table mt-2" 
                        id="dataTable"
                        role="grid"
                        aria-describedby="dataTable_info">
                            
                        <table id="datatable" class="table table-striped table-sm">
                            <thead>
                                <tr> 
                                    <th>No.</th>
                                    <th>Tag No.</th>
                                    <th>ของ บ.</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <!-- modal form --> 
                        <div class="row">
                          <div class="col">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#master_tag">
                                + เพิ่มใหม่
                            </button>
                          </div>
                        
                          <div class="modal fade" id="master_tag" tabindex="-1" role="dialog" aria-labelledby="label_master_tag" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-slideout modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                              <h5 class="modal-title" id="label_master_tag">คลัง Tag</h5>
                              
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                              </div>
                              <div class="modal-body">
                              
                              <!-- input hmtl content here -->
                              <form id="frm" name="frm" method="post">
                                <div class="form-group">
                                  <input type="hidden" class="form-control" id="id" name="id" value="" >
                                </div>

                                <div class="form-group">
                                  <label for="tag_no">Tag No.</label>
                                  <input type="text" maxlength="20" class="form-control" id="tag_no" name="tag_no" placeholder="" value="" >
                                </div>

                                <div class="form-group">
                                  <label for="is_own">
                                  <input type="checkbox"  id="is_own" name="is_own" placeholder="" value="y" >บ. เป็นเจ้าของ Tag</label>
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
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js">
	</script>


<script type="text/javascript">
         var myDataStore = {} // default data store;
        
		    var table = {};
            $(document).ready(function() {
              getDataStore();
             table = $('#datatable').DataTable({
              buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
              ],
				      'paging': true,
                
                'ajax': {
                    'url':'<?=site_url('event/gets_master_tag_dt_json');?>'
                },
                'columns': [
                     { data: 'id' }, 
             { data: 'tag_no' }, 
             { data: 'is_own' }, 
          
        { data: 'action' },
                ]
            });
          });

    setInterval(function() {
        table.ajax.reload();
      }, 30000);

            function validForm(){
		 
					if($("#tag_no").val() == "") {
						alert('Pls, Entry tag_no');
						$("#tag_no").focus();
						return;
					}// .End if
					
 
					if($("#is_own").val() == "") {
						alert('Pls, Entry is_own');
						$("#is_own").focus();
						return;
					}// .End if
					

		postSave();
		 
	}// .End validForm

	function getDataStore() {
		$.get('<?=site_url('event/gets_master_tag_json');?>'
				,function(response){
					console.log(response.success);
				  if(response.success){
            myDataStore = response.data;
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
      tds += "<td>" + e.tag_no + "</td>";
      tds += "<td>" + e.is_own + "</td>";

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
			$("#tag_no").val("");
			
			$("#is_own").prop("checked",false);
	}

	function edit(el){
    var index = el.getAttribute("data-index");

				$("#id").val(myDataStore[index].id);

				$("#tag_no").val(myDataStore[index].tag_no);

					$("#is_own").prop("checked",(myDataStore[index].is_own == "y") ? true : false);  
	} // .End edit
	
	
			
			/**
			  Change state to is lock or unlock.
			 */
			function update_is_own(/** int */id,/** string */ v){
			  let cc = confirm("Are you want to change this item?");
			  if(cc){
				
				$.post('<?=site_url('event/update_is_own_json');?>',{'id':id,'is_own':v}
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
			} //.end update_is_own()
			//////////////////////////////////////
			 /**
			  Change state to is lock or unlock.
			 */
			function confirmDel(/** int */el){
        var id = el.getAttribute("data-id");
			  let cc = confirm("ต้องการลบข้อมูล?");
			  if(cc){		
          $.post("<?=site_url("event/delete_master_tag_json");?>",{"id":id}
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
			$.post( "<?=site_url("event/update_master_tag_json");?>", { 
			
					"id": $("#id").val(),
					"tag_no": $("#tag_no").val(),
					"is_own": ($("#is_own:checked").prop("checked")) ? "y" : "n", }, 
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
      table.ajax.url('<?=site_url('event/search_master_tag_dt_json');?>/?title='+ $("#title").val() + '&management_level=' + $("#management_level").val() +"&department=" + $("#department").val() + '&office='+ $("#office").val() + '&company_name='+ $("#company_name").val()).load();
   }// .End postSearch
    </script>

	
</body>

</html>
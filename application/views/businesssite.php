<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title> <?= $this->app_module; ?> - <?= $this->app_name; ?></title>

	<meta name="description" content="Tidtor Service เครื่องมือค้นหา และจัดการข้อมูลผู้ติดต่อ">
	<link rel="stylesheet" href="<?= base_url(); ?>public/assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="<?= base_url(); ?>public/assets/fonts/fontawesome-all.min.css">
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
							<p class="text-primary m-0 font-weight-bold">รายการ ตั้ง ค่าเพื่อใช้งาน Application</p>
						</div>
						<div class="card-body">

							<div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">

								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#customer">เพิ่มใหม่</button>
								<br /><br />

								<table id="datatable" class="table table-striped table-sm">
									<thead>
										<tr>
											<th>id</th>
											<th>ลูกค้า</th>
											<th>license_key</th>
											<th>line notify key</th>
											<th></th>
										</tr>
									</thead>
									<tbody id="tbody">

									</tbody>
								</table>

								<!-- modal form -->
								<div class="row">
									<div class="col">
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#business_site">
											+ เพิ่มใหม่
										</button>
									</div>

									<div class="modal fade" id="business_site" tabindex="-1" role="dialog" aria-labelledby="label_business_site" aria-hidden="true">
										<div class="modal-dialog modal-dialog-slideout modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="label_business_site">ฟอร์มตั้งค่าการใช้งานจุดติดตั้ง</h5>

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
															<label for="business_id">ลูกค้า</label>

															<select class="form-control" id="business_id" name="business_id">

															</select>

														</div>
														<div class="form-group">

															<label for="header_slip">หัวกระดาษ</label>

															<textarea class="form-control" id="header_slip" name="header_slip" placeholder=""></textarea>

														</div>

														<div class="form-group">

															<label for="footer_slip">ท้ายกระดาษ</label>

															<textarea class="form-control" id="footer_slip" name="footer_slip" placeholder=""></textarea>

														</div>

														<div class="form-group">
															<label for="license_key">License Key</label>
															<input type="text" class="form-control" id="license_key" name="license_key" placeholder="" value="">
														</div>

														<div class="form-group">
															<label for="uname">Web Username</label>
															<input type="text" class="form-control" id="uname" name="uname" placeholder="" value="">
														</div>

														<div class="form-group">
															<label for="pword">Web Password</label>
															<input type="password" class="form-control" id="pword" name="pword" placeholder="" value="">
														</div>

														<div class="form-group">
															<label for="app_uname">App Username</label>
															<input type="text" class="form-control" id="app_uname" name="app_uname" placeholder="" value="">
														</div>

														<div class="form-group">
															<label for="app_pword">App Password</label>
															<input type="password" class="form-control" id="app_pword" name="app_pword" placeholder="" value="">
														</div>

														<div class="form-group">
															<label for="line_notify_key">Line Notify Keys</label>
															<input type="txt" class="form-control" id="line_notify_key" name="line_notify_key" placeholder="" value="">
														</div>
													</form>

												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" onclick="clearForm();" data-dismiss="modal">ปิด</button>
													<button type="button" class="btn btn-primary" onclick="validForm();">บันทึก</button>
												</div>
											</div>
										</div>
									</div>
								</div>



								<style>
									/*Not Required*/
									.btn {
										margin-bottom: 15px;
									}

									/*Required*/
									@media (max-width: 576px) {
										.modal-dialog.modal-dialog-slideout {
											width: 80%
										}
									}

									.modal-dialog-slideout {
										min-height: 100%;
										margin: 0 auto 0 0;
										background: #fff;
									}

									.modal.fade .modal-dialog.modal-dialog-slideout {
										-webkit-transform: translate(-100%, 0);
										transform: translate(-100%, 0);
									}

									.modal.fade.show .modal-dialog.modal-dialog-slideout {
										-webkit-transform: translate(0, 0);
										transform: translate(0, 0);
										flex-flow: column;
									}

									.modal-dialog-slideout .modal-content {
										border: 0;
									}
								</style>

								<!-- end modal form -->

							</div>

						</div>
					</div>
				</div>
			</div>

			<footer class="bg-white sticky-footer">
				<div class="container my-auto">
					<div class="text-center my-auto copyright"><span>Copyright © TSWG-VSM: Vehicle Security Management System 2020 - 2024</span></div>
				</div>
			</footer>

		</div>
		<a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
	</div>
	<script src="<?= base_url(); ?>public/assets/js/jquery.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/js/chart.min.js"></script>
	<script src="<?= base_url(); ?>public/assets/js/bs-init.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
	<script src="<?= base_url(); ?>public/assets/js/theme.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js">
	</script>
	<script type="text/javascript">
		var myDataStore = {};
		var myBusinessStore = [];
		var table = {};
		$(document).ready(function() {
			getDataStore();
			table = $('#datatable').DataTable({
				'paging': true,

				'ajax': {
					'url': '<?= site_url('welcome/gets_business_site_dt_json'); ?>'
				},
				'columns': [{
						data: 'id'
					},
					{
						data: 'business'
					},

					{
						data: 'license_key'
					},

					{
						data: 'line_notify_key'
					},


					{
						data: 'action'
					},
				]
			});
		});

		setInterval(function() {
			table.ajax.reload();
		}, 30000);

		function validForm() {

			if ($("#business_id option:selected").val() == "") {
				alert('Pls, select item');
				return;
			} // .End if


			if ($("#license_key").val() == "") {
				alert('Pls, Entry license_key');
				$("#license_key").focus();
				return;
			} // .End if


			if ($("#uname").val() == "") {
				alert('Pls, Entry uname');
				$("#uname").focus();
				return;
			} // .End if


			if ($("#pword").val() == "") {
				alert('Pls, Entry pword');
				$("#pword").focus();
				return;
			} // .End if


			if ($("#app_uname").val() == "") {
				alert('Pls, Entry app_uname');
				$("#app_uname").focus();
				return;
			} // .End if


			if ($("#app_pword").val() == "") {
				alert('Pls, Entry app_pword');
				$("#app_pword").focus();
				return;
			} // .End if

			// if($("#line_notify_key").val() == "") {
			// 	alert('Pls, Entry line_notify_key');
			// 	$("#line_notify_key").focus();
			// 	return;
			// }// .End if


			postSave();

		} // .End validForm

		function getDataStore() {
			$.get('<?= site_url('welcome/gets_business_site_json'); ?>', function(response) {
				console.log(response.success);
				if (response.success) {
					myDataStore = response.data;
				} else {
					alert('ไม่สามารถเรียกข้อมูลใหม่ได้');
				}
			}, 'json');
		}



		function getBusinessDataStore() {
			$.get('<?= site_url('welcome/gets_business_json'); ?>',
				function(response) {
					if (response.success) {
						myBusinessStore = response.data;
						renderToOption(myBusinessStore, "business_id", "id", "name");
					} else {
						alert('ไม่สามารถเรียกข้อมูลใหม่ได้');
					}
				}, 'json');
		}
		getBusinessDataStore();


		function renderToOption(ds, id, k, v) {
			var el = "";

			if (ds.length > 0) {
				$("#" + id).html("");

				ds.forEach(function(e, i) {
					el += "<option value=" + eval("e." + k) + ">" + eval("e." + v) + "</option>";
				});

				$("#" + id).append(el);
			}
		} //.End renderToOption

		function renderDatatable() {
			var tds = "";
			if (myDataStore.length > 0) {
				$("#tbody").html("");

				myDataStore.forEach(function(e, i) {
					tds += "<tr>";

					tds += "<td>" + e.id + "</td>";
					tds += "<td>" + e.business_id + "</td>";
					tds += "<td>" + e.header_slip + "</td>";
					tds += "<td>" + e.footer_slip + "</td>";
					tds += "<td>" + e.license_key + "</td>";
					tds += "<td>" + e.uname + "</td>";
					tds += "<td>" + e.pword + "</td>";
					tds += "<td>" + e.app_uname + "</td>";
					tds += "<td>" + e.app_pword + "</td>";
					tds += "<td>" + e.line_notify_key + "</td>";

					tds += "<td>" + genButtonCommand(e.id) + "</td></tr>";
				});
				$("#tbody").append(tds);
			}



		} //.End renderDatatable

		/**
		 * Generate button Command for table view
		 */
		function genButtonCommand(id) {
			var html = "<div class=\"btn-group\">";
			html += "<button type=\"button\" class=\"btn btn-danger\">คำสั่ง</button>";
			html += "<button type=\"button\" class=\"btn btn-danger dropdown-toggle dropdown-toggle-split\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">";
			html += "<span class=\"sr-only\">Toggle Dropdown</span>";
			html += "</button>";
			html += "<div class=\"dropdown-menu\">";
			html += "<a class=\"dropdown-item\"  onclick=\"view(" + id + ")\"  href=\"#\">เรียกดู</a>";
			html += "<a class=\"dropdown-item\"  onclick=\"print(" + id + ")\"  href=\"#\">พิมพ์</a>";
			html + "<a class=\"dropdown-item\"  onclick=\"edit(" + id + ")\"  href=\"#\">แก้ไข</a>";
			html + "<div class=\"dropdown-divider\"></div>";
			html + "<a class=\"dropdown-item\" href=\"#\" onclick=\"confirmDel(" + id + ")\">ลบ</a>";
			html + "</div>";
			html += "</div>";

			return html;
		}

		function clearForm() {
			$("#id").val("");
			$("#business_id option")[0].selected = true;
			$("#header_slip").val("");
			$("#footer_slip").val("");
			$("#license_key").val("");
			$("#uname").val("");
			$("#pword").val("");
			$("#app_uname").val("");
			$("#app_pword").val("");
			$("#line_notify_key").val("");
		}

		function edit(el) {
			var index = el.getAttribute("data-index");
			$("#id").val(myDataStore[index].id);
			$("#business_id").val(myDataStore[index].business_id);
			$("#header_slip").val(myDataStore[index].header_slip);
			$("#footer_slip").val(myDataStore[index].footer_slip);
			$("#license_key").val(myDataStore[index].license_key);
			$("#uname").val(myDataStore[index].uname);
			$("#pword").val(myDataStore[index].pword);
			$("#app_uname").val(myDataStore[index].app_uname);
			$("#app_pword").val(myDataStore[index].app_pword);
			$("#line_notify_key").val(myDataStore[index].line_notify_key);
		} // .End edit

		/**
	 Change state to is lock or unlock.
	*/
		function confirmDel( /** int */ el) {
			var id = el.getAttribute("data-id");
			let cc = confirm("ต้องการลบข้อมูล?");
			if (cc) {

				$.post("<?= site_url("welcome/delete_business_site_json"); ?>", {
					"id": id
				}, function(response) {
					if (response.success) {
						getDataStore();
						table.ajax.reload();
						alert('ทำรายการเรียบร้อย');
					} else {
						alert('ไม่สามารถปรับปรุงรายการได้');
					}
				}, 'json');
			} // .End if
		} //.end confirmDel()

		function postSave() {
			$.post("<?= site_url("welcome/update_business_site_json"); ?>", {

					"id": $("#id").val(),
					"business_id": $("#business_id option:selected").val(),
					"header_slip": $("#header_slip").val(),
					"footer_slip": $("#footer_slip").val(),
					"license_key": $("#license_key").val(),
					"uname": $("#uname").val(),
					"pword": $("#pword").val(),
					"app_uname": $("#app_uname").val(),
					"app_pword": $("#app_pword").val(),
					"line_notify_key": $("#line_notify_key").val(),
				},
				function(response) {
					if (response.msg = "success") {
						getDataStore();
						table.ajax.reload();
						alert('บันทึกเปลี่ยนแปลงข้อมูลเรียบร้อย');
					} else {
						alert('เกิดข้อผิดพลาด ทำรายการไม่สำเร็จ');
					}
				},
				"json");
		} // .End postSave
	</script>
</body>

</html>
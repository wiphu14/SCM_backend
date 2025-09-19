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
                        <div class="col-sm-10"><h3 class="text-dark mb-4">จัดการสมาชิกบ้าน</h3></div>
                        <div class="col-sm-4"><button id="addMemberBtn" class="btn btn-success"><i class="fa fa-plus"></i> Add New Member</button></div>
                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">รายการสมาชิกบ้าน</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table border="0">
                                    <thead>
                                        <tr>
                                            <th>พื้นที่/บ้านเลขที่</th>
                                            <th>หมายเลขติดต่อ</th>
                                            <th>Remark</th>
                                            <th>Zone Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($items as $member): ?>
                                        <tr>
                                            <td><?php echo $member->house_no; ?></td>
                                            <td><?php echo $member->mobile_no; ?></td> 
                                            <td><?php echo $member->remark; ?></td>
                                            <td><?php echo $member->zone_name; ?></td> 
                                            <td>
                                                <button class="btn btn-primary editBtn" data-id="<?php echo $member->id; ?>">Edit</button>
                                                <button class="btn btn-danger" onclick="deleteById(<?php echo $member->id; ?>)">Delete</button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Add/Edit Modal -->
                            <div class="modal fade" id="addEditModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel">Add/Edit Member</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="addEditForm">
                                                <input type="hidden" id="memberId" name="id" value="">

                                                <div class="form-group">
                                                    <label for="houseZone">เขตพื้นที่</label>
                                                    <select class="form-control" id="houseZone" name="house_zone_id" required>
                                                        <!-- Options will be loaded dynamically -->
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="houseNo">พื้นที่/บ้านเลขที่</label>
                                                    <input type="text" class="form-control" id="houseNo" name="house_no" placeholder="Enter house number" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="mobileNo">เบอร์ติดต่อ</label>
                                                    <input type="text" class="form-control" id="mobileNo" name="mobile_no" placeholder="Enter mobile number" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="housePassword">รหัสเข้าระบบ</label>
                                                    <input type="password" class="form-control" id="housePassword" name="house_password" placeholder="Enter house password" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="remark">Remark</label>
                                                    <textarea class="form-control" id="remark" name="remark" placeholder="Enter remark"></textarea>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include_once("_footer.php"); ?>
        </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="<?=base_url();?>public/assets/js/jquery.min.js"></script>
    <script src="<?=base_url();?>public/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=base_url();?>public/assets/js/chart.min.js"></script>
    <script src="<?=base_url();?>public/assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="<?=base_url();?>public/assets/js/theme.js"></script>
</body>
<script>
    $(document).ready(function() {
        // Load house zones into the dropdown
        $.get("<?=site_url('welcome/get_house_zones_json');?>", function(response) {
            if(response.success === true) {
                var houseZones = response.data;
                var houseZoneSelect = $('#houseZone');
                houseZoneSelect.empty();
                houseZones.forEach(function(zone) {
                    houseZoneSelect.append('<option value="' + zone.id + '">' + zone.name + '</option>');
                });
            }
        });

        // Show the modal for adding a new member
        $('#addMemberBtn').click(function() {
            $('#addEditForm')[0].reset();
            $('#memberId').val('');
            $('#addEditModal').modal('show');
        });

        // Show the modal for editing an existing member
        $('.editBtn').click(function() {
            var memberId = $(this).data('id');
            $.get("<?=site_url('welcome/gets_house_member_json');?>", {id: memberId}, function(response) {
                if(response.success === true) {
                    var member = response.data[0];
                    $('#memberId').val(member.id);
                    $('#houseZone').val(member.house_zone_id);
                    $('#houseNo').val(member.house_no);
                    $('#mobileNo').val(member.mobile_no);
                    $('#housePassword').val(member.house_password);
                    $('#remark').val(member.remark);
                    $('#addEditModal').modal('show');
                }
            });
        });

        // Handle form submission for adding/updating a member
        $('#addEditForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            var url = "<?=site_url('welcome/update_house_member_json');?>";
            if ($('#memberId').val()) {
                url = "<?=site_url('welcome/update_house_member_json');?>";
            }
            $.post(url, formData, function(response) {
                if(response.success === true) {
                    location.reload();
                } else {
                    alert('An error occurred while saving the member.');
                }
            });
        });

        // Handle delete member
        window.deleteById = function(id) {
            if(confirm('Are you sure you want to delete this member?')) {
                $.post("<?=site_url('welcome/delete_house_member_json');?>", {id: id}, function(response) {
                    if(response.success === true) {
                        location.reload();
                    } else {
                        alert('An error occurred while deleting the member.');
                    }
                });
            }
        }
    });
</script>
</html>

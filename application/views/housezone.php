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
                        <div class="col-sm-10"><h3 class="text-dark mb-4">จัดการโซนบ้าน</h3></div>
                        <div class="col-sm-2"><button id="addZoneBtn" class="btn btn-success"><i class="fa fa-plus"></i> Add New</button></div>
                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">รายการโซนบ้าน</p>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>โซนบ้าน</th>
                                            <th>วันที่บันทึกข้อมูล</th>
                                            <th>ลบ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($items as $item): ?>
                                            <tr>
                                                <td><?php echo $item->zone_name;?></td>
                                                <td><?php echo $item->created_at;?></td>

                                                <td><button class="btn btn-warning editBtn" data-id="<?php echo $item->id;?>"><i class="fa fa-edit"></i> Edit</button>
                 <button class="btn" onclick="deleteById(<?=$item->id;?>)"><i class="fa fa-trash"></i></button></td>
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
                                            <h5 class="modal-title" id="modalLabel">Add/Edit Zone</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="addEditForm">
                                                <input type="hidden" id="zoneId" name="id" value="">
                                                
                                                <div class="form-group">
                                                    <label for="zoneName">Zone Name</label>
                                                    <input type="text" class="form-control" id="zoneName" name="zone_name" placeholder="Enter zone name" required>
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
        // Show modal for adding a new zone
        $('#addZoneBtn').on('click', function() {
            $('#modalLabel').text('Add Zone');
            $('#addEditForm')[0].reset();
            $('#zoneId').val('');
            $('#addEditModal').modal('show');
        });

        // Show modal for editing an existing zone
        $('.editBtn').on('click', function() {
            var id = $(this).data('id');
            $.get("<?=site_url('welcome/gets_house_zone_json');?>", { id: id }, function(response) {
                
                if(response.success === true) {
                    var item = response.data[0];
                    $('#modalLabel').text('Edit Zone');
                    $('#zoneId').val(item.id);
                    $('#zoneName').val(item.zone_name); 
                    $('#addEditModal').modal('show');
                } else {
                    alert('Failed to retrieve data.');
                }
            }, "json");
        });

        // Form submission for add/edit
        $('#addEditForm').on('submit', function(e) {
            e.preventDefault();
            var id = $('#zoneId').val();
            var url = id ? "<?=site_url('welcome/update_house_zone_json');?>" : "<?=site_url('welcome/update_house_zone_json');?>";
            $.post(url, $(this).serialize(), function(response) {
                if(response.success === true) {
                    alert('Operation successful');
                    $('#addEditModal').modal('hide');
                    location.reload(); // Refresh the page to reflect changes
                } else {
                    alert('Operation failed');
                }
            }, "json");
        });
    });

    function deleteById(id) {
        var yn = confirm("ต้องการลบใช่หรือไม่ ?");
        if (yn) {
            postDel(id);
        }
    }

    function postDel(id) {
        $.post("<?=site_url('welcome/delete_house_zone_json');?>", { id: id }, function(response) {
            if (response.success === true) {
                alert('ทำรายการสำเร็จ');
                location.reload(); // Refresh the page to reflect changes
            } else {
                alert('เกิดข้อผิดพลาด ทำรายการไม่สำเร็จ');
            }
        }, "json");
    }
</script>
</html>



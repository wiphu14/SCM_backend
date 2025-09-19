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
        
        <?php 
        // load left menu
        $this->load->view('nav'); ?>
        
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
            
            <?php 
            // load menu content
            $this->load->view('content_nav'); ?>

            <div class="container-fluid">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0">ภาพรวมระบบ</h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;รายงาน</a></div>
                <div class="row">
                    <!-- <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>รายได้ทั้งเดือน</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>$40,000</span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-success py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>รายรับวันนี้</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>$21,500</span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-info py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>Tasks</span></div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="text-dark font-weight-bold h5 mb-0 mr-3"><span>50%</span></div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-info" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"><span class="sr-only">50%</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-warning py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>สมาชิก</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $count = $this->member->count(); ?></span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-success py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>จำนวนรถเข้า/ออก</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $count = $this->memberlicense->count(); ?></span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-car fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-info py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>จำนวนรถเข้า/ออก</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $count = $this->trn_car_in_out->countIn(); ?> / <?php echo $count = $this->trn_car_in_out->countToday(); ?></span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-car fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    <div class="col-lg-7 col-xl-10">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="text-primary font-weight-bold m-0" id="lb1">แผนภาพรายรับต่อเดือน</h6>
                                <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in"
                                        role="menu">
                                        <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" role="presentation" href="#">&nbsp;Action</a><a class="dropdown-item" role="presentation" href="#">&nbsp;Another action</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation" href="#">&nbsp;Something else here</a></div>
                                </div>
                            </div>
                            <div class="card-body">
                                    
                                    <button class="btn btn-primary btn-sm" onclick="toDay();">รายวัน</button>
                                    <button class="btn btn-success btn-sm" onclick="toMonth();">รายเดือน</button>
                                    
                                    <?php $yr = date("Y") ?>
                                    <div class="btn-group dropright " value="<?= $yr ?>">
                                    
                                        <button type="button" class="btn btn-warning btn-sm" onclick="toYear(<?= $yr ?>);"> รายปี </button>
                                        <button type="button" class="btn btn-warning btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropright</span>
                                        </button>
                                        <div class="dropdown-menu" id="dropdown" >
                                            <?php 
                                                $res = $this->trn_car_in_out->gets();
                                                $year = array();
                                                $i = 0;
                                                foreach($res as $ar){
                                                    if($ar->time_out != NULL){
                                                        $end = new DateTime($ar->time_out);
                                                        $year[$i] = $end->format('Y');
                                                        $i++;
                                                    }
                                                }
                                                $y = array_unique($year);
                                                foreach($y as $yr){
                                            ?>
                                            <option id="year" onclick="toYear(<?= $yr; ?>)"><?php echo $yr; ?></option>
                                            <?php 
                                                }
                                            ?>
                                        </div>
                                    </div>
                                <br/><br/>
                                <!-- <div class="chart-area"><canvas data-bs-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Jan&quot;,&quot;Feb&quot;,&quot;Mar&quot;,&quot;Apr&quot;,&quot;May&quot;,&quot;Jun&quot;,&quot;Jul&quot;,&quot;Aug&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Earnings&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;0&quot;,&quot;10000&quot;,&quot;5000&quot;,&quot;15000&quot;,&quot;10000&quot;,&quot;20000&quot;,&quot;15000&quot;,&quot;25000&quot;],&quot;backgroundColor&quot;:&quot;rgba(78, 115, 223, 0.05)&quot;,&quot;borderColor&quot;:&quot;rgba(78, 115, 223, 1)&quot;}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;],&quot;drawOnChartArea&quot;:false},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;padding&quot;:20}}],&quot;yAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;]},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;padding&quot;:20}}]}}}"></canvas></div> -->
		                        <canvas id="Chart" width="600" height="250"> 
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->
                

            
        </div>
    </div>
    <footer class="bg-white sticky-footer">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © TSWG-VSM: Vehicle Security Management System 2020 - 2024</span></div>
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

function getYear(year){			
    $.post( "<?=site_url("welcome/forYear");?>", { 
    
            "year": year
            },
            
        function(response){
            if(response.msg = "success"){
                toYear(year);
                console.log('success');
            }else{
                console.log('err');
            }
        },
    "json" );


}

var Canvas = document.getElementById("Chart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var yearLabel = ["January", "Febuary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var monthLabel = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'];
var dayLabel = ["0.00-0.59","1.00-1.59","2.00-2.59","3.00-3.59","4.00-4.59","5.00-5.59","6.00-6.59","7.00-7.59","8.00-8.59","9.00-9.59","10.00-10.59","11.00-11.59","12.00-12.59","13.00-13.59","14.00-14.59","15.00-15.59","16.00-16.59","17.00-17.59","18.00-18.59","19.00-19.59","20.00-20.59","21.00-21.59","22.00-22.59","23.00-23.59"];

var dayData = {
  label: 'รายรับ',
  data: [20, 40, 40, 20, 60],
  backgroundColor: "rgba(2, 117, 216, 0.6)",
  borderColor: "rgba(2, 117, 216, 1)",

  borderWidth: 2,
  hoverBorderWidth: 0
};
var chartType = 'bar';

var dataD = {
            labels: dayLabel,
            datasets: [dayData]
        };

var data = dataD;

var options = {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    },
    tooltips: {
        enabled: false
    },
    hover: {
        animationDuration: 0
    },
    animation: {
        duration: 1,
        onComplete: function () {
            var chartInstance = this.chart,
                ctx = chartInstance.ctx;
            ctx.font = Chart.helpers.fontString(14, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
            ctx.textAlign = 'left';
            ctx.textBaseline = 'center';

            this.data.datasets.forEach(function (dataset, i) {
                var meta = chartInstance.controller.getDatasetMeta(i);
                Chart.helpers.each(meta.data.forEach(function (bar, index) {
                    ctx.save();
                    // Translate 0,0 to the point you want the text
                    ctx.translate(bar._model.x, bar._model.y - 5);

                    // Rotate context by -90 degrees
                    ctx.rotate(-0.5 * Math.PI);

                    // Draw text
                    ctx.fillText(dataset.data[index], 0, 0);
                    ctx.restore();
                }),this)
            });
        }
    }
};
$.get("<?=site_url("welcome/forMonth");?>").done((res)=>{
    var monthData = {
        label: 'รายรับ',
        data: [20, 40, 40, 20, 60],
        backgroundColor: "rgba(2, 117, 216, 0.6)",
        borderColor: "rgba(2, 117, 216, 1)",
        borderWidth: 2,
        hoverBorderWidth: 0
    };

    var dataM = {
        labels: dayLabel,
        datasets: [dayData]
    };

    this.data = dataM;
    
    init();
});

function range(start, end) {
  return Array(end - start + 1).fill().map((_, idx) => start + idx)
}

function toYear(year) {
    barChart.destroy();
    $.post("<?=site_url("welcome/forYear");?>",{
        "year":year
    }).done((res)=>{
        console.log(res);

        label = "แผนภาพรายรับต่อปี " + res.year;
        changeLabel(label);
        var yearData = {
            label: 'รายรับ',
            data: res['m'],
            backgroundColor: "rgba(240, 173, 78, 0.6)",
            borderColor: "rgba(240, 173, 78, 1)",

            borderWidth: 2,
            hoverBorderWidth: 0
        };

        var dataY = {
            labels: yearLabel,
            datasets: [yearData]
        };

        this.data = dataY;

        init();
    });
}

function toMonth() {
    barChart.destroy();
    changeLabel("แผนภาพรายรับต่อเดือน");
    $.get("http://localhost/dprov3/welcome/forMonth").done((res)=>{
        var monthData = {
            label: 'รายรับ',
            data: res,
            backgroundColor: "rgba(92, 184, 92, 0.6)",
            borderColor: "rgba(92, 184, 92, 1)",

            borderWidth: 2,
            hoverBorderWidth: 0
        };

        var dataM = {
            labels: monthLabel,
            datasets: [monthData]
        };

        this.data = dataM;
        
        init();
    });
}

function toDay() {
    barChart.destroy();
    changeLabel("แผนภาพรายรับต่อวัน");
    $.get("http://localhost/dprov3/welcome/forDay").done((res)=>{
        var monthData = {
            label: 'รายรับ',
            data: [20, 40, 40, 20, 60],
            backgroundColor: "rgba(2, 117, 216, 0.6)",
            borderColor: "rgba(2, 117, 216, 1)",
            borderWidth: 2,
            hoverBorderWidth: 0
        };

        var dataD = {
            labels: dayLabel,
            datasets: [dayData]
        };

        this.data = dataD;
        
        init();
    });
}

function init() {
  // Chart declaration:
    barChart = new Chart(Canvas, {
    type: chartType,
    data: data,
    options: options,
    
  });
}

function changeLabel(txt) {
    let lbl = document.getElementById('lb1');

    lbl.innerText = txt;       // TREATS EVERY CONTENT AS TEXT.
}
</script>
<script>
    
</script>
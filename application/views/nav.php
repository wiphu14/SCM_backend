<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
    <div class="container-fluid d-flex flex-column p-0">
        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
            <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
            <div class="sidebar-brand-text mx-3" style="font-size:10px"><span>TSWG V1.4</span></div>
        </a>
        <hr class="sidebar-divider my-0">

        <ul class="nav navbar-nav text-light" id="accordionSidebar">
            <?php
            // Get the current URL segment
            $currentURL = uri_string();
            echo $currentURL;

            // Function to check if the current URL matches the provided URL
            function isActive($url) {
                global $currentURL;
                return $currentURL === $url ? 'active' : '';
            }

            // Detect roles
            if ($this->session->userdata('roles_id') == 0 || $this->session->userdata('roles_id') == 1 || $this->session->userdata('roles_id') == 2) {
            ?>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= isActive('welcome/inoutreport') ?>" href="<?= site_url("welcome/inoutreport"); ?>"><i class="fas fa-table"></i><span>ข้อมูลรถเข้าออก</span></a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= isActive('event/gardtour') ?>" href="<?= site_url("event/gardtour"); ?>"><i class="fas fa-table"></i><span>การเดินสำรวจ</span></a>
                </li>
            <?php } else { ?>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= isActive('welcome/housezone') ?>" href="<?= site_url("welcome/housezone"); ?>"><i class="fas fa-table"></i><span>ส่วนพื้นที่</span></a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= isActive('welcome/housemember') ?>" href="<?= site_url("welcome/housemember"); ?>"><i class="fas fa-table"></i><span>พื้นที่/บ้านเลขที่</span></a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= isActive('welcome/binoutreport') ?>" href="<?= site_url("welcome/binoutreport"); ?>"><i class="fas fa-table"></i><span>ข้อมูลรถเข้าออก</span></a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= isActive('welcome/binoutreportincome') ?>" href="<?= site_url("welcome/binoutreportincome"); ?>"><i class="fas fa-table"></i><span>ข้อมูลรายได้รถเข้าออก</span></a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= isActive('event/bgardtour') ?>" href="<?= site_url("event/bgardtour"); ?>"><i class="fas fa-table"></i><span>การเดินสำรวจ</span></a>
                </li>
            <?php } ?>

            <li class="nav-item" role="presentation">
                <a class="nav-link <?= isActive('event/register_tags') ?>" href="<?= site_url("event/register_tags"); ?>"><i class="fas fa-table"></i><span>ลงทะเบียนจุดใช้งาน TAG</span></a>
            </li>

            <?php
            if ($this->session->userdata('roles_id') == 1 || $this->session->userdata('roles_id') == 2) {
            ?>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= isActive('welcome/business') ?>" href="<?= site_url("welcome/business"); ?>"><i class="fas fa-table"></i><span>ลูกค้าติดตั้งระบบ</span></a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= isActive('welcome/business_sites') ?>" href="<?= site_url("welcome/business_sites"); ?>"><i class="fas fa-user-circle"></i><span>ตั้งค่าใช้ web/app</span></a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= isActive('event/master_tags') ?>" href="<?= site_url("event/master_tags"); ?>"><i class="fas fa-table"></i><span>NFC TAGs</span></a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= isActive('welcome/roles') ?>" href="<?= site_url("welcome/roles"); ?>"><i class="fas fa-user-circle"></i><span>สิทธิ์การเข้าถึงระบบ</span></a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= isActive('welcome/profileprice') ?>" href="<?= site_url("welcome/profileprice"); ?>"><i class="fas fa-user-circle"></i><span>เงื่อนไขค่าจอด</span></a>
                </li>
            <?php
            } // end if check menu
            ?>
        </ul>

        <div class="text-center d-none d-md-inline">
            <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
        </div>
    </div>
</nav>

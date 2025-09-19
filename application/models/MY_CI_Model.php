<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_CI_Model extends CI_Model { // คลาส Model_template สืบทอดคุณสมบัติของ CI_Model
	public $tblName;
    public function isFirstChange(&$d,$by = "system") {
        $d['created_at'] = date("Y-m-d H:i:s");
        $d['created_by'] = $by;
        $this->isNoFirstChange($d,$by);
    }

    public function isAddBusiness(&$d,$by = "system") {
        $d['created_at'] = date("Y-m-d H:i:s");
        $nextyear  = mktime(23, 59, 59, date("m"),   date("d"),   date("Y")+1);
        $d['expire_date'] = date("Y-m-d H:i:s",$nextyear);
    }

    public function isAddLocation(&$d,$by = "system") {
        $d['created_at'] = date("Y-m-d H:i:s");
        $nextyear  = mktime(23, 59, 59, date("m"),   date("d"),   date("Y")+1);
        $d['expire_date'] = date("Y-m-d H:i:s",$nextyear);
    }

    public function isNoFirstChange(&$d,$by = "system") {
            $d['updated_at'] = date("Y-m-d H:i:s");
            $d['updated_by'] = $by;
    }

    public function isAdd(&$d,$by = "system") {
        $d['created_at'] = date("Y-m-d H:i:s");
        $d['created_by'] = $by;
    }

    public function isCreate(&$d,$by = "system") {
        $d['created_at'] = date("Y-m-d H:i:s");
    }

    public function isUpdate(&$d,$by = "system") {
        $d['updated_at'] = date("Y-m-d H:i:s");
    }

    public function startEnd(&$d,$by = "system") {
        $d['start_date'] = date("Y-m-d H:i:s");
        $nextyear  = mktime(23, 59, 59, date("m"),   date("d"),   date("Y")+1);
        $d['end_date'] = date("Y-m-d H:i:s",$nextyear);
    }
    

    public function isRegister(&$d,$by = "system") {
        $d['regist_date'] = date("Y-m-d H:i:s");
    }
}

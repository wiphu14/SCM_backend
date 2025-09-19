<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{ 
    public $app_version;
    public $app_name;
    public $app_description;

    /**
     * Constuct
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library("session");

        $this->load->model('AdminUser', "adminUser");
        $this->load->model('Member', 'member');
        $this->load->model('MemberLicense', 'memberlicense');
        $this->load->model('TrnCarInOut', 'trn_car_in_out');
        $this->load->model('TrnPic', 'trn_pic');

        $this->load->model('ProfilePrice', 'profileprice');
        $this->load->model('ProfilePriceE', 'profile_price');
        $this->load->model('Gate', 'gate');
        $this->load->model('ReaderOut', 'readerout');
        $this->load->model('CarType', 'cartype');
        $this->load->model('CarType', 'car_type');
        $this->load->model('Roles', 'roles');
        $this->load->model('Business', 'business');
        $this->load->model('BusinessSite', 'business_site');
        $this->load->model('Stamp', 'stamp');
        $this->load->model('Location', 'location');
        $this->load->model('Employee', 'employee');
        $this->load->model('HouseZone', 'house_zone');
        $this->load->model('HouseMember', 'house_member');
        $this->load->model('Employee', 'employee');

        $this->app_version = " version : dev-1.0";
        $this->app_name = "TSWG-VSM: Vehicle Security Management System";
        $this->app_description = "";
    } //.End function


    public function dashboard()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Dashboard";
        $data['app_module'] = "Dashboard view";
        //$this->forMonth();

        $this->load->view('dashboard', $data);
    } // .End dashboard


    public function bdashboard()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Dashboard";
        $data['app_module'] = "Dashboard view";
        //$this->forMonth();

        $this->load->view('bdashboard', $data);
    } // .End dashboard



    public function forYear()
    {
        header('Content-Type:application/json');
        $year =  $this->input->post("year");
        $res = $this->trn_car_in_out->gets();
        $m = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($res as $ar) {
            if ($ar->time_out != NULL) {
                $start = new DateTime($ar->time_in);
                $end = new DateTime($ar->time_out);
                if ($end->format('Y') == $year) {
                    $time = $start->diff($end);
                    $hr = $time->d * 24;
                    $min = $time->i;
                    $h = $time->d * 24 + $time->h;
                    if ($time->i > 0) {
                        $h++;
                    }
                    $proPrice = $this->profileprice->gets();
                    $money = 0;
                    while ($h != 0) {
                        if ($h >= 24) {
                            $p = $this->profileprice->getByH(24);
                            $money = $money + ($p[0]->price);
                            $h = $h - 24;
                        } else {
                            $p = $this->profileprice->getByH($h);
                            $money = $money + ($p[0]->price);
                            $h = 0;
                        }
                    }
                    $month = intval($end->format('m')) - 1;
                    $m[$month] = $m[$month] + $money;
                }
            }
        }
        $data['m'] = $m;
        $data['year'] = $year;
        echo json_encode($data);
    }


    public function forMonth()
    {
        header('Content-Type:application/json');
        $res = $this->trn_car_in_out->gets();
        $d = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($res as $ar) {
            if ($ar->time_out != NULL) {
                $start = new DateTime($ar->time_in);
                $end = new DateTime($ar->time_out);
                if ($end->format('Y') == date("Y")) {
                    if ($end->format('m') == date("m")) {
                        $time = $start->diff($end);
                        $hr = $time->d * 24;
                        $min = $time->i;
                        $h = $time->d * 24 + $time->h;
                        if ($time->i > 0) {
                            $h++;
                        }
                        $proPrice = $this->profileprice->gets();
                        $money = 0;
                        while ($h != 0) {
                            if ($h >= 24) {
                                $p = $this->profileprice->getByH(24);
                                $money = $money + ($p[0]->price);
                                $h = $h - 24;
                            } else {
                                $p = $this->profileprice->getByH($h);
                                $money = $money + ($p[0]->price);
                                $h = 0;
                            }
                        }
                        $day = intval($end->format('d')) - 1;
                        $d[$day] = $d[$day] + $money;
                    }
                }
            }
        }
        echo json_encode($d);
    }

    public function forDay()
    {
        header('Content-Type:application/json');
        $res = $this->trn_car_in_out->gets();
        $hur = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($res as $ar) {
            if ($ar->time_out != NULL) {
                $start = new DateTime($ar->time_in);
                $end = new DateTime($ar->time_out);
                if ($end->format('Y') == date("Y")) {
                    if ($end->format('m') == date("m")) {
                        if ($end->format('d') == date("d")) {
                            $time = $start->diff($end);
                            $hr = $time->d * 24;
                            $min = $time->i;
                            $h = $time->d * 24 + $time->h;
                            if ($time->i > 0) {
                                $h++;
                            }
                            $proPrice = $this->profileprice->gets();
                            $money = 0;
                            while ($h != 0) {
                                if ($h >= 24) {
                                    $p = $this->profileprice->getByH(24);
                                    $money = $money + ($p[0]->price);
                                    $h = $h - 24;
                                } else {
                                    $p = $this->profileprice->getByH($h);
                                    $money = $money + ($p[0]->price);
                                    $h = 0;
                                }
                            }
                            $hour = intval($end->format('H')) - 1;
                            print_r($hour . " ");
                            $hur[$hour] = $hur[$hour] + $money;
                        }
                    }
                }
            }
        }
        echo json_encode($hur);
    }

    /**
     * Return view message
     */
    public function getMessage($m)
    {
        $view_msg = "";
        if ($m != "") {
            $view_msg = '<div class="alert alert-danger alert-dismissible show" role="alert">
            <strong>Info</strong> ' . $m . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> <!-- end div -->';
        }
        return $view_msg;
    } // .end div


    /**
     * Return view message
     */
    public function getErrMessage($msg)
    {
        $view_msg = "";

        if ($msg != "") {
            $view_msg = '<div class="alert alert-danger alert-dismissible show" role="alert">
            <strong>Info</strong> ' . $msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> <!-- end div -->';
        }
        return $view_msg;
    } // .end div

    public function setMessage($m)
    {
        $this->msg = $m;
    }

    public function setErrMessage($m)
    {
        $this->err_msg = $m;
    }

    public function clearMessage()
    {
        $this->msg = "";
        $this->err_msg = "";
    }


    /**
     * Index Page for this controller.
     *
     * 
     */
    public function index()
    {

        $this->validLogin();

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Dashboard";
        $data['app_module'] = "Dashboard view";

        $this->load->view('dashboard', $data);
    }

    /**
     * Test login
     */
    public function validLogin()
    {
        if ($this->session->userdata('fname') == "") {
            redirect(site_url("welcome/signout"));
        }
    } // .End validLogin

    /**
     * find member by user/pass
     * @return json string
     */
    public function authen()
    {
        $this->load->library("session");
        $this->load->helper('url');
        $user = $this->input->post("uname");
        $pass = $this->input->post("pword");
        $result = $this->adminUser->getByUnameAndPword($user, $pass);

        if (count($result) > 0) {
            $this->session->set_userdata("id", $result[0]->id);
            $this->session->set_userdata("fname", $result[0]->fname);
            $this->session->set_userdata("lname", $result[0]->lname);
            $this->session->set_userdata("email", $result[0]->email);
            $this->session->set_userdata("phone", $result[0]->phone);
            $this->session->set_userdata("uname", $result[0]->uname);
            $this->session->set_userdata("roles_id", $result[0]->roles_id);
            $this->session->set_userdata("err", "");
            redirect(site_url("welcome/inoutreport"));
        } else {
            $this->session->set_userdata("err", "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง");
            redirect(site_url("welcome/login"));
        }
    } // .End authen

    /**
     * find member by user/pass
     * @return json string
     */
    public function authen_json()
    {
        $this->load->helper('url');
        $user = $this->input->post("uname");
        $pass = $this->input->post("pword");
        $result = $this->adminUser->getByUnameAndPword($user, $pass);

        $data['status'] = "fail";
        $data['result'] = array();

        if (count($result) > 0) {
            $data['status'] = "success";
            $data['data'] = $result[0];
        }
        echo json_encode($data);
    } // .End authen_json


    public function signout()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $this->session->sess_destroy(); // clear all session.
        redirect(site_url("welcome/login"));
    }

    public function login()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $this->session->sess_destroy(); // clear all session.

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Login";
        $data['app_module'] = "Login";

        $this->load->view('login', $data);
    }

    public function adminlogin()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $this->session->sess_destroy(); // clear all session.

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Login";
        $data['app_module'] = "Login";

        $this->load->view('adminlogin', $data);
    }

    public function members()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Member";
        $data['app_module'] = "Members";

        $this->load->view('members', $data);
    }  // .End members

    /**
     * View trn car in out.
     */
    public function inoutreport()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "In Out Report";
        $data['app_module'] = $this->app_module;

        $memberCode = $this->input->get("c");

        $result = $this->trn_car_in_out->carInOutTime();
        $data['items'] = $result;
        $data['business_id'] = $this->input->get("business_id");

        $this->load->view('inoutreport', $data);
    }  // .End members


    /**
     * View trn car in out.
     */
    public function binoutreportincome()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "In Out Report";
        $data['app_module'] = $this->app_module;

        $memberCode = $this->input->get("c");

        $result = $this->trn_car_in_out->carInOutTime();
        $data['items'] = $result;
        $data['business_id'] = $this->session->userdata("business_id");

        $this->load->view('binoutreportincome', $data);
    }  // .End members


    /**
     * View trn car in out.
     */
    public function binoutreport()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "In Out Report";
        $data['app_module'] = $this->app_module;

        $memberCode = $this->input->get("c");

        $result = array(); //$this->trn_car_in_out->carInOutTime();
        $data['items'] = $result;
        $data['business_id'] = $this->session->userdata("business_id");

        $this->load->view('binoutreport', $data);
    }  // .End members

    public function inoutreportjson()
    {
        $this->load->helper('url');
        $this->load->library("session");

        header("Content-Type:text/html;charset=utf8");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "In Out Report";
        $data['app_module'] = "In Out Report";

        $memberCode = $this->input->get("c");
        $business_id = $this->input->get("business_id");
        $date1 = $this->input->get("date1");
        $date2 = $this->input->get("date2");

        $data['date1'] = $date1;
        $data['date2'] = $date2;

        $result = (array) $this->trn_car_in_out->carInOutTimeJson($data);
        $data['items'] = $result;

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }  // .End inoutreport 2 json

    /**
     * 
     */
    public function json_carin()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Car In";
        $data['app_module'] = $this->app_module;
        $business_id = $this->input->get("business_id");

        $result = $this->trn_car_in_out->carIn($business_id);
        $data['items'] = $result;

        echo json_encode($data);
    }  // .End members


    /**
     * Calculate time in and price
     */
    public function calcarinntime()
    {
        $this->load->helper('url');
        $this->load->library("session");
        header("Content-Type:application/json;charset=utf8");
        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $data['app_module'] = "Calculate Time";
        $c = $this->input->get("c");
        $car_type_id = $this->input->get("car_type_id");
        $have_stamp = $this->input->get("have_stamp");

        $result = $this->trn_car_in_out->carInOutTime_byCardNumber($c);
        if (count($result) > 0) {
            $origin = new DateTime($result[0]->time_in);
            $target = new DateTime($result[0]->ctime);
            $interval = $origin->diff($target);

            $result[0]->net_hour = $interval->format('%h');
            $result[0]->net_minute = $interval->format('%i');
            $result[0]->net_sec = $interval->format('%s');
            $result[0]->net_day = $interval->format('%a');

            if ($result[0]->net_hour == 0 && $result[0]->net_minute < 16) {
                $result[0]->net_price = $this->profile_price->getByH(0);
            } else {
                // if move position
                if (intval($result[0]->net_sec) > 0) {
                    $result[0]->net_minute = intval($result[0]->net_minute) + 1;
                    $result[0]->net_sec = 0;
                }

                if (intval($result[0]->net_minute) > 0) {
                    $result[0]->net_hour = intval($result[0]->net_hour) + 1;
                    $result[0]->net_minute = 0;
                }

                if (intval($result[0]->net_hour) > 24) {
                    $result[0]->net_day = intval($result[0]->net_day) + 1;
                    $result[0]->net_hour -= 24;
                }

                if ($have_stamp == "1" &&  $result[0]->net_hour > 3) {
                    $result[0]->net_hour = $result[0]->net_hour - 3;
                } else if ($have_stamp == "1" &&  $result[0]->net_hour <= 3) {
                    $result[0]->net_hour = 0;
                }

                $result[0]->net_price = $this->profile_price->getByH($result[0]->net_hour);
            }

            $data['items'] = $result;
            $data['status'] = "OK";
        } // End if

        echo json_encode($data);
    }  // .End calCarInTime


    /**
     * Calculate time in and price
     */
    public function calcarinntime_fee($c, $have_stamp, $car_type)
    {

        $origin = new DateTime($c->time_in);
        $target = new DateTime($c->time_out);

        if ($c->time_out == "") {
            return 0;
        }

        $interval = $origin->diff($target);

        $c->net_hour = $interval->format('%h');
        $c->net_minute = $interval->format('%i');
        $c->net_sec = $interval->format('%s');
        $c->net_day = $interval->format('%a');

        if ($c->net_hour == 0 && $c->net_minute < 16) {
            $c->net_price = $this->profile_price->getByH(0);
            return 0;
        } else {
            // if move position
            if (intval($c->net_sec) > 0) {
                $c->net_minute = intval($c->net_minute) + 1;
                $c->net_sec = 0;
            }

            if (intval($c->net_minute) > 0) {
                $c->net_hour = intval($c->net_hour) + 1;
                $c->net_minute = 0;
            }

            if (intval($c->net_hour) > 24) {
                $c->net_day = intval($c->net_day) + 1;
                $c->net_hour -= 24;
            }

            if ($have_stamp == "1" &&  $c->net_hour > 3) {
                $c->net_hour = $c->net_hour - 3;
            } else if ($have_stamp == "1" &&  $c->net_hour <= 3) {
                $c->net_hour = 0;
            }

            $c->net_price = $this->profile_price->getByH($c->net_hour);

            $fee_index = 0;
            if ($car_type == "จยย") {
                $fee_index = 1;
            }

            $fee = $c->net_price[$fee_index]->price;
            if ($have_stamp == "1") {
                $fee = $c->net_price[$fee_index]->price_stamp;
            }

            return $fee;
        }

        return 0;
    }  // .End calcarinntime_fee

    /**
     * Do out
     */
    public function carout()
    {
        $this->load->library("session");
        $this->load->helper('url');
        header("Content-Type:text/html;charset=utf8");
        $c = $this->input->get("card_number");
        $ct = $this->input->get("car_type");
        $hs = $this->input->get("have_stamp");

        if ($this->docarout_pos($c, $ct, $hs)) {
            $data['card_number'] = $c;
            $data['status'] = "OK";
        } else {
            $data['status'] = "FAIL";
        }
        echo json_encode($data);
    } //.memberout

    /**
     * Do out 
     */
    public function memberoutbackup()
    {
        $this->load->library("session");
        $this->load->helper('url');
        header("Content-Type:text/html;charset=utf8");
        $memberCode = $this->input->get("c");
        $resultMember = $this->validMemberOut($memberCode);
        $data['result'] = $resultMember;

        $data['status'] = "OK";
        if ($resultMember['code'] != 0) {
            $data['status'] = "FAIL";
        } else {
            $this->docarout($memberCode);
        }
        echo json_encode($data);
    } //.memberout

    public function signalout()
    {
        $this->load->library("session");
        $this->load->helper('url');

        header("Content-Type:text/html;charset=utf8");

        $data['result'] = $this->gate->getSignalOut('222');

        if (count($data['result']) > 0) {
            $data['status'] = "OK";
            $t['cmd'] = "";
            $t['id'] = $data['result'][0]->id;
            $t['gate_no'] = '222';
            $t['created_at'] = date('Y-m-d H:i:s');
            $this->gate->update($t);
        } else {
            $data['status'] = "FAIL";
        }
        echo json_encode($data);
    } // .end signalout

    /**
     * Do process car in
     */
    public function docarin()
    {
        $this->load->library("session");
        $this->load->helper('url');
        $business_id = $this->input->get_post("business_id");
        $license_plate = $this->input->get_post("license_plate");
        $province = $this->input->get_post("province");
        $id_card = $this->input->get_post("id_card");
        $reason = $this->input->get_post("reason");
        $remark = $this->input->get_post("remark");
        $house_no = $this->input->get_post("house_no");

        $data['card_number'] = $business_id . date("ymdHis");
        $data['user_in'] = '999';
        $data['gate_in'] = '111';
        $data['business_id'] = $business_id;
        $data['license_plate'] = $license_plate;
        $data['province'] = $province;
        $data['id_card'] = $id_card;
        $data['reason'] = $reason;
        $data['remark'] = $remark;
        $data['house_no'] = $house_no;

        $data['time_in'] = date("Y-m-d H:i:s");
        $json = array();

        if ($this->trn_car_in_out->update($data)) {
            $rs = $this->trn_car_in_out->getByCardNumber($data['card_number']);

            $json['status'] = "success";
            $data['trn_car_in_out_id'] = $rs[0]->id;
            $json['data'][] = $data;
        } else {
            $json['status'] = "fail";
            $json['data'][] = "{}";
        } // .End if

        echo json_encode($json);
    } // .end docarin

    /**
     * Do process car out
     */
    private function docarout($c)
    {
        $res = $this->trn_car_in_out->carInByCardNumber($c);
        if ($res) {
            $data['id'] = $res[0]->id;
            $data['gate_out'] = '222';
            $data['user_out'] = '777';
            $data['time_out'] = date('Y-m-d H:i:s');


            $this->trn_car_in_out->update($data);
            return true;
        }
        return false;
    } //.end docarout

    /**
     * Do process car out
     */
    private function docarout_pos($c, $ct, $hs)
    {
        $res = $this->trn_car_in_out->carInByCardNumber($c);
        if ($res) {
            $data['id'] = $res[0]->id;
            $data['gate_out'] = '222';
            $data['user_out'] = '777';
            $data['time_out'] = date('Y-m-d H:i:s');

            $data['car_type'] = $ct;
            $data['have_stamp'] = $hs;

            $this->trn_car_in_out->update($data);
            return true;
        }
        return false;
    } //.end docarout_pos

    private function doUpdateFrontOut($gate_out)
    {
        $this->frontOut->update(array("gate_out" => $gate_out, "" => "", "" => ""));
    }

    private function validMember($c)
    {
        // find member on system
        $res = $this->memberlicense->getByCardNumber($c);

        // if found card_number 
        if (count($res) > 0) {
            $mem = $this->member->getById($res[0]->member_id);

            /**
             * use data from result to verified
             */
            $res[0]->card_number;
            $res[0]->member_id;
            $res[0]->car_license;
            $res[0]->car_province;
            $res[0]->expire_date;

            $exp = explode(" ", $res[0]->expire_date);

            $date1 = new DateTime($exp[0]);
            $date2 = new DateTime(date("Y-m-d"));

            // Compare the dates 
            if ($date1 >= $date2) {

                $countIn = ''; // = $this->countCarInIsOver($c);

                if ($countIn < $res[0]->limit_car) {
                    $result['code'] = 0;
                    $result['msg'] = "Valid Member";
                    $result['data'] = $res[0];
                    return $result;
                } else {
                    $result['code'] = 3;
                    $result['msg'] = "Car Over Limit";
                    return $result;
                }
            } else {

                $result['code'] = 1;
                $result['msg'] = "Expired Member";
                return $result;
            }
        } // .End if

        $result['code'] = 2;
        $result['msg'] = "Not Found Member";
        return $result;
    }



    private function validMemberOut($c)
    {
        // find member on system
        $res = $this->memberlicense->getByCardNumber($c);

        // if found card_number 
        if (count($res) > 0) {
            $result['code'] = 0;
            $result['msg'] = "Valid Member";
            $result['data'] = $res[0];
            return $result;
        } // .End if

        $result['code'] = 2;
        $result['msg'] = "Not Found Member";
        return $result;
    }

    /**
     * Register view
     */
    public function newmember()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "New Member";
        $data['app_module'] = "New Member";

        $this->load->view('newmember', $data);
    } // .End newmember

    public function editprofile()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Edit Member";
        $data['app_module'] = "Edit Member";

        $this->load->view('editprofile', $data);
    } // .End editprofile

    public function newcar()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "New Car";
        $data['app_module'] = "New Car";

        $this->load->view('newcar', $data);
    } // .End newcar

    public function cars()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Cars";
        $data['app_module'] = "Cars";
        $data['items'] = $this->memberlicense->memberLicenses();
        $this->load->view('cars', $data);
    } // .End cars

    /**
     * Register view
     */
    public function myprofile()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "My Profile";
        $data['app_module'] = "My Profile";

        $this->load->view('myprofile', $data);
    } // .End register

    /**
     * Register view
     */
    public function memberprofile()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Member Profile";
        $data['app_module'] = "Member Profile";

        $this->load->view('myprofile', $data);
    } // .End register

    /**
     * Register view
     */
    public function addProfile()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $f_name = $this->input->post("first_name");
        $l_name = $this->input->post("last_name");
        $tel = $this->input->post("telephone");
        $email = $this->input->post("email");
        $line = $this->input->post("line");
        $address = $this->input->post("address");
        $city = $this->input->post("city");
        $country = $this->input->post("country");
        $type_member = $this->input->post("type_member");

        $data['name'] = $f_name;
        $data['surname'] = $l_name;
        $data['tel'] = $tel;
        $data['email'] = $email;
        $data['lineid'] = $line;
        $data['address'] = $address;
        $data['city'] = $city;
        $data['country'] = $country;
        if ($type_member == "บุคคล") {
            $data['type_member'] = 1;
        } else if ($type_member == "นิติบุคคล") {
            $data['type_member'] = 2;
        }

        $result = (array) $this->member->update($data);
        $tb = $this->member->getIdLastRec();
        $id = $tb[0]->id;
        $res = (array) $this->member->getById($id);
        $data['rs'] = $res;
        $this->load->view('editprofile', $data);
    } // .End register

    public function deleteProfile()
    {
        $this->load->helper('url');
        $this->load->library("session");

        header("content-Type:application/json; charset=utf8");
        $id = $this->input->post("id");

        $json['success'] = true;
        $json['msg'] = "success";

        $result = (array) $this->member->deleteById($id);

        echo json_encode($json);

        $this->load->view('members', $data);
    }

    public function editPro()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Edit Profile";
        $data['app_module'] = "Edit Profile";

        $id = $this->uri->segment(3);

        $result = (array) $this->member->getById($id);

        $data['rs'] = $result;

        #echo json_encode($json);

        $this->load->view('editprofile', $data);
    }

    // public function editCar(){
    //     $this->load->helper('url');
    //     $this->load->library("session");

    //     $data['app_name'] = $this->app_name;
    //     $data['app_version'] = $this->app_version;
    //     $this->app_module="ข้อมูลบัตรและรถ";
    //     $data['app_module'] = $this->app_module;

    //     // รับค่า id
    //     $id= $this->uri->segment(3);

    //     $result = (array) $this->memberlicense->getById($id);
    //     $data['rs'] = $result;
    //     $this->load->view('editprofile', $data);
    // }

    public function updateProfile()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $id = $this->input->post("id");
        $f_name = $this->input->post("first_name");
        $l_name = $this->input->post("last_name");
        $tel = $this->input->post("telephone");
        $email = $this->input->post("email");
        $line = $this->input->post("line");
        $address = $this->input->post("address");
        $city = $this->input->post("city");
        $country = $this->input->post("country");
        $type_member = $this->input->post("type_member");

        $data['id'] = $id;
        $data['name'] = $f_name;
        $data['surname'] = $l_name;
        $data['tel'] = $tel;
        $data['email'] = $email;
        $data['lineid'] = $line;
        $data['address'] = $address;
        $data['city'] = $city;
        $data['country'] = $country;
        if ($type_member == "บุคคล") {
            $data['type_member'] = 1;
        } else if ($type_member == "นิติบุคคล") {
            $data['type_member'] = 2;
        }

        $result = (array) $this->member->update($data);

        $this->load->view('members', $data);
    }

    public function addCar()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $card_number = $this->input->post("card_number");
        $member_id = explode(" ", $this->input->post("member_id"));
        $car_license = $this->input->post("car_license");
        $car_province = $this->input->post("car_province");
        $limit_car = $this->input->post("limit_car");
        $car_type = $this->input->post("car_type");

        $ct = $this->cartype->getByName($car_type);

        $data['card_number'] = $card_number;
        $data['member_id'] = $member_id[0];
        $data['car_license'] = $car_license;
        $data['car_province'] = $car_province;
        $data['limit_car'] = $limit_car;
        $data['car_type_id'] = (int) $ct[0]->id;

        $result = (array) $this->memberlicense->update($data);

        $tb = $this->memberlicense->getIdLastRec();
        $id = $tb[0]->id;

        redirect(site_url("welcome/editCar/{$id}"));
    } // .End addCar

    public function deleteCar()
    {
        $this->load->helper('url');
        $this->load->library("session");

        header("content-Type:application/json; charset=utf8");
        $id = $this->input->post("id");

        $json['success'] = true;
        $json['msg'] = "success";

        $result = (array) $this->memberlicense->deleteById($id);

        echo json_encode($json);

        $this->load->view('cars', $data);
    }

    public function editCar()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Edit Car";
        $data['app_module'] = "Edit Car";

        $id = $this->uri->segment(3);

        $result = (array) $this->memberlicense->getById($id);

        $data['rs'] = $result;

        $this->load->view('editcar', $data);
    }

    public function updateCar()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $id = $this->input->post("id");
        $card_number = $this->input->post("card_number");
        $member_id = explode(" ", $this->input->post("member_id"));
        $car_license = $this->input->post("car_license");
        $car_province = $this->input->post("car_province");
        $limit_car = $this->input->post("limit_car");
        $car_type = $this->input->post("car_type");

        $ct = $this->cartype->getByName($car_type);

        $data['id'] = $id;
        $data['card_number'] = $card_number;
        $data['member_id'] = $member_id[0];
        $data['car_license'] = $car_license;
        $data['car_province'] = $car_province;
        $data['limit_car'] = $limit_car;
        $data['car_type_id'] = (int) $ct[0]->id;

        $result = (array) $this->memberlicense->update($data);

        redirect(site_url("welcome/Cars/{$id}"));
    }

    /**
     * Upload file from setting view
     */
    public function douploadsettingMember()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $config = array(
            'upload_path' => "./uploads/product/",
            'allowed_types' => "gif|png|jpg|jpeg",
            'overwrite' => TRUE,
            'max_size' => "2048000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
        );

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file_pic')) {
            $ud = array('upload_data' => $this->upload->data());
            $fl = $ud['upload_data']['file_name'];

            $id = $this->input->post("id");
            $data['id'] = $id;
            $data['pic_file'] = $fl;

            $result = (array) $this->member->update($data);

            $this->setMessage("upload file completed.");

            $res = (array) $this->member->getById($id);
            $data['rs'] = $res;
            redirect(site_url("welcome/editPro/{$id}"));
        } else {
            $error = array('error' => $this->upload->display_errors());
            redirect(site_url("welcome/editPro/{$id}"));
        }
    } // .end douploadsetting

    /**
     * Upload picture for member license
     */
    public function douploadsettingCar()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $config = array(
            'upload_path' => "./uploads/member_licenses/",
            'allowed_types' => "gif|png|jpg|jpeg",
            'overwrite' => TRUE,
            'max_size' => "2048000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
        );
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file_pic')) {
            $ud = array('upload_data' => $this->upload->data());

            $fl = $ud['upload_data']['file_name'];

            $id = $this->input->post("id");
            $data['id'] = $id;
            $data['pic_file'] = $fl;

            $result = (array) $this->memberlicense->update($data);

            $this->setMessage("upload file completed.");

            $res = (array) $this->memberlicense->getById($id);
            $data['rs'] = $res;

            redirect(site_url("welcome/editCar/{$id}"));
        } else {
            $error = array('error' => $this->upload->display_errors());
            redirect(site_url("welcome/editCar/{$id}"));
        }
    } // .end douploadsetting

    public function cartype()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "CarType";
        $data['app_module'] = "CarType";
        $data['items'] = $this->cartype->gets();
        $this->load->view('cartype', $data);
    } // .End cartype

    public function newcartype()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "CarType";
        $data['app_module'] = "CarType";
        $data['items'] = $this->cartype->gets();
        $this->load->view('newcartype', $data);
    } // .End cartype

    public function addCarType()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $name = $this->input->post("name");

        $data['name'] = $name;

        $result = (array) $this->cartype->update($data);

        redirect(site_url("welcome/cartype/{$id}"));
    } // .End addCar

    public function deleteCarType()
    {
        $this->load->helper('url');
        $this->load->library("session");

        header("content-Type:application/json; charset=utf8");
        $id = $this->input->post("id");

        $json['success'] = true;
        $json['msg'] = "success";

        $result = (array) $this->cartype->deleteById($id);

        echo json_encode($json);

        $this->load->view('cartype', $data);
    }

    public function gate()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Gate";
        $data['app_module'] = "Gate";
        $data['items'] = $this->gate->gets();
        $this->load->view('gate', $data);
    } // .End cartype

    public function addGate()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $cmd = $this->input->post("cmd");
        $gate_no = $this->input->post("gate_no");

        $data['cmd'] = $cmd;
        $data['gate_no'] = $gate_no;

        $result = (array) $this->gate->update($data);

        redirect(site_url("welcome/gate/{$id}"));
        #echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } // .End addCar

    public function newgate()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "New gate";
        $data['app_module'] = "New gate";
        $data['items'] = $this->gate->gets();
        $this->load->view('newgate', $data);
    } // .End cartype

    public function deleteGate()
    {
        $this->load->helper('url');
        $this->load->library("session");

        header("content-Type:application/json; charset=utf8");
        $id = $this->input->post("id");

        $json['success'] = true;
        $json['msg'] = "success";

        $result = (array) $this->gate->deleteById($id);

        echo json_encode($json);

        $this->load->view('gate', $data);
    }

    public function reset()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $id = $this->uri->segment(3);

        $data['id'] = $id;
        $data['cmd'] = "";

        $result = (array) $this->gate->update($data);

        redirect(site_url("welcome/gate/{$id}"));
    }

    public function roles()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Roles";
        $data['app_module'] = "Roles";
        $data['items'] = $this->roles->gets();
        $this->load->view('roles', $data);
    } // .End cartype

    public function newrole()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "New role";
        $data['app_module'] = "New role";
        $data['items'] = $this->roles->gets();
        $this->load->view('newrole', $data);
    } // .End cartype

    public function addRole()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $name = $this->input->post("name");

        $data['name'] = $name;

        $result = (array) $this->roles->update($data);

        redirect(site_url("welcome/roles/{$id}"));
        #echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } // .End addCar

    public function deleteRole()
    {
        $this->load->helper('url');
        $this->load->library("session");

        header("content-Type:application/json; charset=utf8");
        $id = $this->input->post("id");

        $json['success'] = true;
        $json['msg'] = "success";

        $result = (array) $this->roles->deleteById($id);

        echo json_encode($json);

        $this->load->view('cartype', $data);
    }

    public function editRole()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Edit Role";
        $data['app_module'] = "Edit Role";

        $id = $this->uri->segment(3);

        $result = (array) $this->roles->getById($id);

        $data['rs'] = $result;

        #echo json_encode($json);

        $this->load->view('editrole', $data);
    }

    public function updateRole()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $id = $this->input->post("id");
        $name = $this->input->post("name");

        $data['id'] = $id;
        $data['name'] = $name;

        $result = (array) $this->roles->update($data);

        redirect(site_url("welcome/Roles/{$id}"));
    }

    public function profileprices()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Profile Price";
        $data['app_module'] = "Profile Price";

        $data['items'] = $this->profileprice->gets();
        $this->load->view('profileprice', $data);
    } // .End register

    public function newprofileprice()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "New Profile Price";
        $data['app_module'] = "New Profile Price";
        $data['items'] = $this->profileprice->gets();
        $this->load->view('newprofileprice', $data);
    } // .End cartype

    public function addProPrice()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $car_type = $this->input->post("car_type");
        $h = $this->input->post("h");
        $price = $this->input->post("price");
        $for_member = $this->input->post("for_member");

        $res = $this->cartype->getByName($car_type);

        $data['car_type_id'] = $res[0]->id;
        $data['h'] = $h;
        $data['price'] = $price;
        $data['for_member'] = $for_member;


        $result = (array) $this->profileprice->update($data);

        redirect(site_url("welcome/profileprice"));
        #echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } // .End addCar

    public function deleteProPrice()
    {
        $this->load->helper('url');
        $this->load->library("session");

        header("content-Type:application/json; charset=utf8");
        $id = $this->input->post("id");

        $json['success'] = true;
        $json['msg'] = "success";

        $result = (array) $this->profileprice->deleteById($id);

        echo json_encode($json);

        $this->load->view('profileprice', $data);
    }

    public function editProPrice()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Edit Profile Price";
        $data['app_module'] = "Edit Profile Price";

        $id = $this->uri->segment(3);

        $result = (array) $this->profileprice->getById($id);

        $data['rs'] = $result;

        #echo json_encode($json);

        $this->load->view('editprofileprice', $data);
    }

    public function updateProPrice()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $id = $this->input->post("id");
        $car_type = $this->input->post("car_type");
        $h = $this->input->post("h");
        $price = $this->input->post("price");
        $for_member = $this->input->post("for_member");

        $res = $this->cartype->getByName($car_type);

        $data['id'] = $id;
        $data['car_type_id'] = $res[0]->id;
        $data['h'] = $h;
        $data['price'] = $price;
        $data['for_member'] = $for_member;

        $result = (array) $this->profileprice->update($data);

        redirect(site_url("welcome/profileprice/{$id}"));
    }

    public function price()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Price";
        $data['app_module'] = "Price";

        $res = $this->trn_car_in_out->gets();
        $start = new DateTime($res[3]->time_in);
        $end = new DateTime($res[3]->time_out);
        $time = $start->diff($end);
        //echo $time->format('%h hours %i minutes %S seconds');
        $hr = $time->d * 24;
        $min = $time->i;
        $h = $time->d * 24 + $time->h;
        if ($time->i > 0) {
            $h++;
        }

        $proPrice = $this->profileprice->gets();
        $money = 0;
        while ($h != 0) {
            if ($h >= 24) {
                $p = $this->profileprice->getByH(24);
                $money = $money + ($p[0]->price);
                $h = $h - 24;
            } else {
                $p = $this->profileprice->getByH($h);
                $money = $money + ($p[0]->price);
                $h = 0;
            }
        }
        $data['hr'] = $hr;
        $data['min'] = $min;
        $data['items'] = $this->trn_car_in_out->gets();
        $data['price'] = $money;
        $this->load->view('price', $data);
    } // .End register


    public function register()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Register";
        $data['app_module'] = "Register";
        $data['items'] = $this->roles->gets();
        $this->load->view('register', $data);
    } // .End cartype

    public function addEmployee()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $name = $this->input->post("name");
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $lineid = $this->input->post("lineid");
        $tel = $this->input->post("tel");

        $data['name'] = $name;
        $data['username'] = $username;
        $data['password'] = $password;
        $data['lineid'] = $lineid;
        $data['tel'] = $tel;


        $result = (array) $this->employee->update($data);

        redirect(site_url("welcome/login"));
        #echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } // .End addCar

    public function jobs()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Jobs";
        $data['app_module'] = "Jobs";
        $data['items'] = $this->job->gets();
        $this->load->view('jobs', $data);
    } // .End cartype

    public function newjob()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "New job";
        $data['app_module'] = "New job";
        $data['items'] = $this->job->gets();
        $this->load->view('newjob', $data);
    } // .End cartype

    public function addJob()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $title = $this->input->post("title");
        $is_open = $this->input->post("is_open");
        $desc = $this->input->post("desc");

        $data['title'] = $title;
        $data['is_open'] = $is_open;
        $data['desc'] = $desc;


        $result = (array) $this->job->update($data);

        redirect(site_url("welcome/jobs"));
        #echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } // .End addCar

    public function login_emp()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $this->session->sess_destroy(); // clear all session.

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Login Employee";
        $data['app_module'] = "Login Employee";

        $this->load->view('login_emp', $data);
    }

    public function authen_emp()
    {
        $this->load->library("session");
        $this->load->helper('url');
        $user = $this->input->post("username");
        $pass = $this->input->post("password");
        $result = $this->employee->getByUnameAndPword($user, $pass);

        if (count($result) > 0) {
            $this->session->set_userdata("id", $result[0]->id);
            $this->session->set_userdata("name", $result[0]->name);
            $this->session->set_userdata("tel", $result[0]->tel);
            $this->session->set_userdata("lineid", $result[0]->lineid);
            $this->session->set_userdata("regist_date", $result[0]->regist_date);
            $this->session->set_userdata("username", $result[0]->username);
            $this->session->set_userdata("password", $result[0]->password);
            $this->session->set_userdata("err", "");
            redirect(site_url("welcome/index"));
        } else {
            $this->session->set_userdata("err", "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง");
            redirect(site_url("welcome/login_emp"));
        }
    } // .End authen

    /**
     * find member by user/pass
     * @return json string
     */
    public function authen_json_emp()
    {
        header("content-Type:application/json; charset=utf8");
        $this->load->helper('url');
        $username = $this->input->get("username");
        $password = $this->input->get("password");
        $result = $this->employee->getByUnameAndPword($username, $password);

        $data['status'] = "fail";
        $data['data'] = array();
        //$data['_POST'] = $_POST;
        //print_r($result);
        if (count($result) > 0) {

            $data['status'] = "success";
            $data['data'] = $result;
        }
        echo json_encode($data);
    } // .End authen_json

    public function business()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Business";
        $data['app_module'] = "Business";
        $data['items'] = $this->business->business();
        $this->load->view('business', $data);
    } // .End cartype

    public function newbusiness()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "New business";
        $data['app_module'] = "New business";
        //$data['items'] = $this->job->gets();
        $this->load->view('newbusiness', $data);
    } // .End cartype

    public function addBusiness()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $name = $this->input->post("name");
        $email = $this->input->post("email");
        $facebook = $this->input->post("facebook");
        $lineid = $this->input->post("lineid");
        $tax_no = $this->input->post("tax_no");
        $tel = $this->input->post("tel");
        $branch = $this->input->post("branch");

        $data['name'] = $name;
        $data['email'] = $email;
        $data['facebook'] = $facebook;
        $data['lineid'] = $lineid;
        $data['tax_no'] = $tax_no;
        $data['tel'] = $tel;
        $data['branch'] = $branch;

        $result = (array) $this->business->update($data);

        redirect(site_url("welcome/editbusiness"));
    } // .End addCar

    public function deleteBusiness()
    {
        $this->load->helper('url');
        $this->load->library("session");

        header("content-Type:application/json; charset=utf8");
        $id = $this->input->post("id");

        $json['success'] = true;
        $json['msg'] = "success";

        $result = (array) $this->business->deleteById($id);

        echo json_encode($json);

        $this->load->view('business', $data);
    }

    public function editBusiness()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Edit Business";
        $data['app_module'] = "Edit Business";

        $tb = $this->business->getIdLastRec();
        //print_r($tb);
        $id = $tb[0]->id;
        //print_r($id);
        $result = (array) $this->business->getById($id);

        $data['rs'] = $result;

        #echo json_encode($json);

        $this->load->view('editbusiness', $data);
    }

    public function updateBusiness()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $id = $this->input->post("id");
        $name = $this->input->post("name");
        $email = $this->input->post("email");
        $facebook = $this->input->post("facebook");
        $lineid = $this->input->post("lineid");
        $tax_no = $this->input->post("tax_no");
        $tel = $this->input->post("tel");
        $branch = $this->input->post("branch");

        $data['id'] = $id;
        $data['name'] = $name;
        $data['email'] = $email;
        $data['facebook'] = $facebook;
        $data['lineid'] = $lineid;
        $data['tax_no'] = $tax_no;
        $data['tel'] = $tel;
        $data['branch'] = $branch;

        $result = (array) $this->business->update($data);

        $res = (array) $this->business->getById($id);
        $data['rs'] = $res;

        redirect(site_url("welcome/editBusiness/{$id}"));
    }

    public function updateAddrBusiness()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $id = $this->input->post("id");
        $address = $this->input->post("address");
        $city = $this->input->post("city");
        $country = $this->input->post("country");

        $data['id'] = $id;
        $data['address'] = $address;
        $data['city'] = $city;
        $data['country'] = $country;


        $result = (array) $this->business->update($data);

        $res = (array) $this->business->getById($id);
        $data['rs'] = $res;

        redirect(site_url("welcome/editBusiness/{$id}"));
    }


    public function save_LicensePic() {}
    public function save_OtherPic() {}

    public function save_DriverPic()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $config = array(
            'upload_path' => "./uploads/business",
            'allowed_types' => "gif|png|jpg|jpeg",
            'overwrite' => TRUE,
            'max_size' => "2048000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
        );

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file_pic')) {
            $ud = array('upload_data' => $this->upload->data());

            $fl = $ud['upload_data']['file_name'];

            $trn_id = $this->input->get("trn_id");
            $b_id = $this->input->get("business_id");
            $forPic = $this->input->get("pic_for");

            $data['trn_car_in_out_id'] = $trn_id;
            $data['driver_file'] = $fl;
            //print_r($data);
            $affected = $this->trn_pic->update($data);

            $json['success'] = "OK";
            $json['msg'] = "success";
        } else {
            $json['success'] = "FAIL";
            $json['msg'] = "Can not complete process.";
        }
        echo json_encode($json);
    } // .end douploadsetting

    public function stamp()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Stamp";
        $data['app_module'] = "Stamp";
        $data['items'] = $this->stamp->gets();
        $this->load->view('stamp', $data);
    } // .End cartype

    public function addStamp()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $site_id = $this->input->post("site_id");
        $site_name = $this->input->post("site_name");
        $stamp_id = $this->input->post("stamp_id");
        $stamp_title = $this->input->post("stamp_title");
        $choice = $this->input->post("choice");

        if ($choice == "f") {
            $value = 0;
        } else if ($choice == "t") {
            $value = $this->input->post("time");
        } else if ($choice == "v") {
            $value = $this->input->post("value");
        }

        $data['site_id'] = $site_id;
        $data['site_name'] = $site_name;
        $data['stamp_id'] = $stamp_id;
        $data['stamp_title'] = $stamp_title;
        $data['choice'] = $choice;
        $data['value'] = $value;

        $result = (array) $this->stamp->update($data);

        // $res = (array) $this->business->getById($id);
        // $data['rs'] = $res;

        redirect(site_url("welcome/stamp/{$id}"));
    }

    public function deleteStamp()
    {
        $this->load->helper('url');
        $this->load->library("session");

        header("content-Type:application/json; charset=utf8");
        $id = $this->input->post("id");

        $json['success'] = true;
        $json['msg'] = "success";

        $result = (array) $this->stamp->deleteById($id);

        echo json_encode($json);

        $this->load->view('stamp', $data);
    }

    public function editStamp()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Edit Stamp";
        $data['app_module'] = "Edit Stamp";
        // $data['items'] = $this->stamp->gets();

        $id = $this->uri->segment(3);

        $result = (array) $this->stamp->getById($id);

        $data['items'] = $this->stamp->gets();
        $data['rs'] = $result;

        $this->load->view('editstamp', $data);
    } // .End cartype

    public function updateStamp()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $id = $this->input->post("id");
        $site_id = $this->input->post("site_id");
        $site_name = $this->input->post("site_name");
        $stamp_id = $this->input->post("stamp_id");
        $stamp_title = $this->input->post("stamp_title");
        $choice = $this->input->post("choice");

        if ($choice == "f") {
            $value = 0;
        } else if ($choice == "t") {
            $value = $this->input->post("time");
        } else if ($choice == "v") {
            $value = $this->input->post("value");
        }

        $data['id'] = $id;
        $data['site_id'] = $site_id;
        $data['site_name'] = $site_name;
        $data['stamp_id'] = $stamp_id;
        $data['stamp_title'] = $stamp_title;
        $data['choice'] = $choice;
        $data['value'] = $value;

        $result = (array) $this->stamp->update($data);

        //$res = (array) $this->stamp->getById($id);
        //$data['rs'] = $res;

        redirect(site_url("welcome/stamp/{$id}"));
    }

    public function location()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Location";
        $data['app_module'] = "Location";
        $data['items'] = $this->location->gets();
        $this->load->view('location', $data);
    }

    public function newlocation()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "New Profile Price";
        $data['app_module'] = "New Profile Price";
        $data['items'] = $this->location->gets();
        $this->load->view('newlocation', $data);
    }

    public function addLocation()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $site_name = $this->input->post("site_name");
        $license_key = $this->input->post("license_key");
        $address = $this->input->post("address");
        $city = $this->input->post("city");
        $country = $this->input->post("country");

        $data['site_name'] = $site_name;
        $data['license_key'] = $license_key;
        $data['address'] = $address;
        $data['city'] = $city;
        $data['country'] = $country;

        $result = (array) $this->location->update($data);

        // $res = (array) $this->business->getById($id);
        // $data['rs'] = $res;

        redirect(site_url("welcome/location/{$id}"));
    }

    public function deleteLocation()
    {
        $this->load->helper('url');
        $this->load->library("session");

        header("content-Type:application/json; charset=utf8");
        $id = $this->input->post("id");

        $json['success'] = true;
        $json['msg'] = "success";

        $result = (array) $this->location->deleteById($id);

        echo json_encode($json);

        $this->load->view('location', $data);
    }

    public function editLocation()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Edit Location";
        $data['app_module'] = "Edit Location";
        // $data['items'] = $this->stamp->gets();

        $id = $this->uri->segment(3);

        $result = (array) $this->location->getById($id);

        $data['items'] = $result;

        $this->load->view('editlocation', $data);
    } // .End cartype

    public function updateLocation()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $id = $this->input->post("id");
        $site_name = $this->input->post("site_name");
        $license_key = $this->input->post("license_key");
        $address = $this->input->post("address");
        $city = $this->input->post("city");
        $country = $this->input->post("country");

        $data['id'] = $id;
        $data['site_name'] = $site_name;
        $data['license_key'] = $license_key;
        $data['address'] = $address;
        $data['city'] = $city;
        $data['country'] = $country;

        $result = (array) $this->location->update($data);

        // $res = (array) $this->business->getById($id);
        // $data['rs'] = $res;

        redirect(site_url("welcome/location/{$id}"));
    }

    /**
     * Get data business return json format
     */
    public function gets_business_json()
    {
        header("content-Type:application/json; charset=utf8");
        $results = $this->business->business();

        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['pic_file']  = $results[$i]->pic_file;
            $dat['name']  = $results[$i]->name;
            $dat['email']  = $results[$i]->email;
            $dat['facebook']  = $results[$i]->facebook;
            $dat['lineid']  = $results[$i]->lineid;
            $dat['tax_no']  = $results[$i]->tax_no;
            $dat['tel']  = $results[$i]->tel;
            $dat['branch']  = $results[$i]->branch;
            $dat['address']  = $results[$i]->address;
            $dat['city']  = $results[$i]->city;
            $dat['country']  = $results[$i]->country;
            $dat['created_at']  = $results[$i]->created_at;
            $dat['expire_date']  = $results[$i]->expire_date;

            $data[] = $dat;
        }

        $json['success'] = true;
        $json['data'] = $data;

        echo json_encode($json);
    } // .end gets_business_json

    //////////////////////// business site //////////////////

    /**
     * List business_site table data
     * 
     */
    public function business_sites()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "business_site View";
        $data['app_module'] = $this->app_module;
        //$data['navmenus'] = $this->getNavMenus();
        $this->load->view('businesssite', $data);
    } // .End business_sites

    /**
     * Update business_site table data
     * 
     */
    public function update_business_site()
    {
        $this->load->helper("url");
        $this->load->library("session");

        if ($this->input->get_post("id")) {
            $dat['id']  = $this->input->post("id");
        }
        $dat['business_id'] = $this->input->get_post("business_id");
        $dat['header_slip'] = $this->input->get_post("header_slip");
        $dat['footer_slip'] = $this->input->get_post("footer_slip");
        $dat['license_key'] = $this->input->get_post("license_key");
        $dat['uname'] = $this->input->get_post("uname");
        $dat['pword'] = $this->input->get_post("pword");
        $dat['app_uname'] = $this->input->get_post("app_uname");
        $dat['app_pword'] = $this->input->get_post("app_pword");
        $dat['line_notify_key'] = $this->input->post("line_notify_key");

        if ($this->business_site->update($dat)) {
            $this->session->set_userdata("msg", "Update Success.");
        } else {
            $this->session->set_userdata("err_msg", "Update Fail.");
        } // .End if

        redirect(site_url("welcome/business_site"));
    } // .end update_business_site

    /**
     * Delete business_site table data
     * 
     */
    public function delete_business_site_json()
    {
        $this->load->helper("url");
        $this->load->library("session");
        header("content-Type:application/json; charset=utf8");

        $id  = $this->input->post("id");

        if ($this->business_site->delById($id)) {
            $json['success'] = true;
            $json['data'] = $id;
        } else {
            $json['success'] = false;
            $json['data'] = "{}";
        } // .End if

        echo json_encode($json);
    } // .end delete_business_site


    /**
     * Update data business_site return json format
     */
    public function update_business_site_json()
    {
        $this->load->helper("url");
        $this->load->library("session");
        header("content-Type:application/json; charset=utf8");

        if ($this->input->get_post("id")) {
            $dat['id']  = $this->input->post("id");
        }

        $json['data'] = array();
        $dat['business_id'] = $this->input->post("business_id");
        $dat['header_slip'] = $this->input->post("header_slip");
        $dat['footer_slip'] = $this->input->post("footer_slip");
        $dat['license_key'] = $this->input->post("license_key");
        $dat['uname'] = $this->input->post("uname");
        $dat['pword'] = $this->input->post("pword");
        $dat['app_uname'] = $this->input->post("app_uname");
        $dat['app_pword'] = $this->input->post("app_pword");
        $dat['line_notify_key'] = $this->input->post("line_notify_key");

        if ($this->business_site->update($dat)) {
            $json['success'] = true;
            $json['data'] = $dat;
        } else {
            $json['success'] = false;
            $json['data'] = "{}";
        } // .End if

        echo json_encode($json);
    } // .end update_business_site_json


    /**
     * Get data business_site return json format
     */
    public function gets_business_site_json()
    {
        header("content-Type:application/json; charset=utf8");
        $results = $this->business_site->gets();

        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['business_id']  = $results[$i]->business_id;
            $dat['header_slip']  = $results[$i]->header_slip;
            $dat['footer_slip']  = $results[$i]->footer_slip;
            $dat['license_key']  = $results[$i]->license_key;
            $dat['uname']  = $results[$i]->uname;
            $dat['pword']  = $results[$i]->pword;
            $dat['app_uname']  = $results[$i]->app_uname;
            $dat['app_pword']  = $results[$i]->app_pword;
            $dat['line_notify_key']  = $results[$i]->line_notify_key;

            $data[] = $dat;
        }

        $json['success'] = true;
        $json['data'] = $data;

        echo json_encode($json);
    } // .end update_business_site_json

    /**
     * Get data business_site return json format
     */
    public function gets_business_site_dt_json()
    {
        header("content-Type:application/json; charset=utf8");
        $results = $this->business_site->gets();
        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['business_id']  = $results[$i]->business_id;
            $b_res = $this->business->getById($results[$i]->business_id);
            if (count($b_res) > 0) {
                $dat['business']  = $b_res[0]->name;
            } else {
                $dat['business']  = "-";
            }

            $dat['header_slip']  = $results[$i]->header_slip;
            $dat['footer_slip']  = $results[$i]->footer_slip;
            $dat['license_key']  = $results[$i]->license_key;

            $dat['uname']  = $results[$i]->uname;
            $dat['pword']  = $results[$i]->pword;

            $dat['app_uname']  = $results[$i]->app_uname;
            $dat['app_pword']  = $results[$i]->app_pword;
            $dat['line_notify_key']  = $results[$i]->line_notify_key;
            // Update Button
            $updateButton = "
            <div class=\"btn-group\">
                <button type=\"button\" class=\"btn btn-danger\">คำสั่ง</button>
                <button type=\"button\" class=\"btn btn-danger dropdown-toggle dropdown-toggle-split\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                    <span class=\"sr-only\">Toggle Dropdown</span>
                </button>
                <div class=\"dropdown-menu\">
                <a class=\"dropdown-item\" data-index='" . $i . "' data-id='" . $results[$i]->id . "' onclick=\"view(this)\"  href=\"#\">เรียกดู</a>
                
                <a class=\"dropdown-item\" data-index='" . $i . "' data-id='" . $results[$i]->id . "' data-toggle='modal' data-target='#business_site' onclick='edit(this);'  href=\"#\">แก้ไข</a>
                <div class=\"dropdown-divider\"></div>
                <a class=\"dropdown-item\" href=\"#\" data-index='" . $i . "' data-id='" . $results[$i]->id . "' onclick=\"confirmDel(this)\">ลบ</a>
                </div>
            </div>";
            $dat['action'] = $updateButton;
            $data[] = $dat;
        }

        ## Response
        $response = array(
            "iTotalRecords" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data
        );

        echo json_encode($response);
    } // .end update_business_site_dt_json


    /**
     * List business_site table data
     * view on screen
     */
    public function business_site()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "ตั้งค้าการใช้งาน Web/App";
        $data['app_module'] = $this->app_module;
        //$data['navmenus'] = $this->getNavMenus(); 
        $this->load->view('business_site', $data);
    } // .End business_sites

    /**
     * Upload file from setting view
     */
    public function upload_business_site_json()
    {
        header("content-Type:application/json; charset=utf8");
        $this->load->helper('url');
        $this->load->library("session");

        $config = array(
            'upload_path' => "./uploads/business_site/",
            'allowed_types' => "gif|png|jpg|jpeg",
            'overwrite' => TRUE,
            'max_size' => "2048000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
        );

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('picture_file')) {
            $ud = array('upload_data' => $this->upload->data());
            $fl = $ud['upload_data']['file_name'];

            $id = $this->input->get("id");
            $data['id'] = $id;
            $data['app_pword'] = $fl;

            $this->business_site->update($data);

            $json['success'] = true;
            $res = (array) $this->business_site->getById($id);

            $json['data'] = $res;
            $json['filename'] = $fl;
        } else {
            $error = array('error' => $this->business_site->display_errors());
            $json['success'] = false;
            $json['data'] = $error;
        }

        echo json_encode($json);
    } // .end upload_business_site_json


    /**
     * List trn_car_in_out table data
     * 
     */
    public function trn_car_in_outs()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "trn_car_in_out View";
        $data['app_module'] = $this->app_module;
        $data['navmenus'] = $this->getNavMenus();
        $this->load->view('trn_car_in_out', $data);
    } // .End trn_car_in_outs

    /**
     * Update trn_car_in_out table data
     * 
     */
    public function update_trn_car_in_out()
    {
        $this->load->helper("url");
        $this->load->library("session");

        if ($this->input->get_post("id")) {
            $dat['id']  = $this->input->post("id");
        }
        $dat['card_number'] = $this->input->get_post("card_number");
        $dat['gate_in'] = $this->input->get_post("gate_in");
        $dat['user_in'] = $this->input->get_post("user_in");
        $dat['time_in'] = $this->input->get_post("time_in");
        $dat['gate_out'] = $this->input->get_post("gate_out");
        $dat['user_out'] = $this->input->get_post("user_out");
        $dat['time_out'] = $this->input->get_post("time_out");


        if ($this->trn_car_in_out->update($dat)) {
            $this->session->set_userdata("msg", "Update Success.");
        } else {
            $this->session->set_userdata("err_msg", "Update Fail.");
        } // .End if

        redirect(site_url("welcome/trn_car_in_out"));
    } // .end update_trn_car_in_out

    /**
     * Delete trn_car_in_out table data
     * 
     */
    public function delete_trn_car_in_out_json()
    {
        $this->load->helper("url");
        $this->load->library("session");
        header("content-Type:application/json; charset=utf8");

        $id  = $this->input->post("id");

        if ($this->trn_car_in_out->delById($id)) {
            $json['success'] = true;
            $json['data'] = $id;
        } else {
            $json['success'] = false;
            $json['data'] = "{}";
        } // .End if

        echo json_encode($json);
    } // .end delete_trn_car_in_out


    /**
     * Update data trn_car_in_out return json format
     */
    public function update_trn_car_in_out_json()
    {
        $this->load->helper("url");
        $this->load->library("session");
        header("content-Type:application/json; charset=utf8");

        if ($this->input->get_post("id")) {
            $dat['id']  = $this->input->post("id");
        }

        $json['data'] = array();
        $dat['card_number'] = $this->input->post("card_number");
        $dat['gate_in'] = $this->input->post("gate_in");
        $dat['user_in'] = $this->input->post("user_in");
        $dat['time_in'] = $this->input->post("time_in");
        $dat['gate_out'] = $this->input->post("gate_out");
        $dat['user_out'] = $this->input->post("user_out");
        $dat['time_out'] = $this->input->post("time_out");

        if ($this->trn_car_in_out->update($dat)) {
            $json['success'] = true;
            $json['data'] = $dat;
        } else {
            $json['success'] = false;
            $json['data'] = "{}";
        } // .End if

        echo json_encode($json);
    } // .end update_trn_car_in_out_json


    /**
     * Get data trn_car_in_out return json format
     */
    public function gets_trn_car_in_out_json()
    {
        header("content-Type:application/json; charset=utf8");
        $results = $this->trn_car_in_out->gets();

        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['card_number']  = $results[$i]->card_number;
            $dat['gate_in']  = $results[$i]->gate_in;
            $dat['user_in']  = $results[$i]->user_in;
            $dat['time_in']  = $results[$i]->time_in;
            $dat['gate_out']  = $results[$i]->gate_out;
            $dat['user_out']  = $results[$i]->user_out;
            $dat['time_out']  = $results[$i]->time_out;
            $dat['id_card']  = $results[$i]->id_card;
            $dat['license_plate']  = $results[$i]->license_plate;
            $dat['province']  = $results[$i]->province;
            $dat['remark'] = $results[$i]->remark;
            $dat['reason'] = $results[$i]->reason;
            $data[] = $dat;
        }

        $json['success'] = true;
        $json['data'] = $data;

        echo json_encode($json);
    } // .end gets_trn_car_in_out_json

    /**
     * Get data trn_car_in_out return json format
     */
    public function gets_business_trn_car_in_out_json()
    {
        header("content-Type:application/json; charset=utf8");
        //$results = $this->trn_car_in_out->gets();
        $results = $this->trn_car_in_out->gets_ByBusinessId($this->input->get("business_id"));

        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['card_number']  = $results[$i]->card_number;
            $dat['gate_in']  = $results[$i]->gate_in;
            $dat['user_in']  = $results[$i]->user_in;
            $dat['time_in']  = $results[$i]->time_in;
            $dat['gate_out']  = $results[$i]->gate_out;
            $dat['user_out']  = $results[$i]->user_out;
            $dat['time_out']  = $results[$i]->time_out;
            $dat['id_card']  = $results[$i]->id_card;
            $dat['license_plate']  = $results[$i]->license_plate;
            $dat['province']  = $results[$i]->province;
            $dat['remark'] = $results[$i]->remark;
            $dat['reason'] = $results[$i]->reason;

            $data[] = $dat;
        }

        $json['success'] = true;
        $json['data'] = $data;

        echo json_encode($json);
    } // .end gets_business_trn_car_in_out_json

    /**
     * Get data trn_car_in_out return json format
     */
    public function gets_business_trn_car_in_out_income_json()
    {
        header("content-Type:application/json; charset=utf8");
        //$results = $this->trn_car_in_out->gets();
        $results = $this->trn_car_in_out->gets_ByBusinessId($this->input->get("business_id"));

        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['card_number']  = $results[$i]->card_number;
            $dat['gate_in']  = $results[$i]->gate_in;
            $dat['user_in']  = $results[$i]->user_in;
            $dat['time_in']  = $results[$i]->time_in;
            $dat['gate_out']  = $results[$i]->gate_out;
            $dat['user_out']  = $results[$i]->user_out;
            $dat['time_out']  = $results[$i]->time_out;
            $dat['id_card']  = $results[$i]->id_card;
            $dat['license_plate']  = $results[$i]->license_plate;
            $dat['province']  = $results[$i]->province;
            $dat['remark'] = $results[$i]->remark;
            $dat['reason'] = $results[$i]->reason;

            $car_type = 1;
            if ($results[$i]->car_type == "จยย") {
                $car_type = 3;
            }

            $dat['fee'] = $this->calcarinntime_fee($results[$i], $results[$i]->have_stamp, $car_type);

            $dat['have_stamp'] = $results[$i]->have_stamp;
            $dat['car_type'] = $results[$i]->car_type;

            $data[] = $dat;
        }

        $json['success'] = true;
        $json['data'] = $data;

        echo json_encode($json);
    } // .end gets_business_trn_car_in_out_json

    /**
     * Get data trn_car_in_out return json format
     */
    public function gets_business_trn_car_in_out_dt_json()
    {
        header("content-Type:application/json; charset=utf8");
        $results = $this->trn_car_in_out->gets_ByBusinessId($this->input->get("business_id"));

        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['card_number']  = $results[$i]->card_number;

            $dat['gate_in']  = $results[$i]->gate_in;
            $dat['user_in']  = $results[$i]->user_in;
            $dat['time_in']  = $results[$i]->time_in;
            $dat['gate_out']  = $results[$i]->gate_out;
            $dat['user_out']  = $results[$i]->user_out;
            $dat['time_out']  = $results[$i]->time_out;
            $dat['id_card']  = $results[$i]->id_card;
            $dat['license_plate']  = $results[$i]->license_plate;
            $dat['province']  = $results[$i]->province;
            $dat['remark'] = $results[$i]->remark;

            // Update Button
            $updateButton = "
          <div class=\"btn-group\">
     <button type=\"button\" class=\"btn btn-danger\">คำสั่ง</button>
     
     <button type=\"button\" class=\"btn btn-danger dropdown-toggle dropdown-toggle-split\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
       <span class=\"sr-only\">Toggle Dropdown</span>
     </button>

     <div class=\"dropdown-menu\">
       <a class=\"dropdown-item\"  data-id='" . $results[$i]->id . "' data-index='" . $i . "' data-toggle='modal' data-target='#trn_car_in_out' onclick='viewCarInOut(this);'  href=\"#\">ดูข้อมูล</a>
     </div>
     
   </div>";


            $dat['action'] = $updateButton;

            $data[] = $dat;
        }


        ## Response
        $response = array(
            "iTotalRecords" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data
        );
        echo json_encode($response);
    } // .end gets_business_trn_car_in_out_dt_json


    /**
     * Get data trn_car_in_out return json format
     */
    public function gets_business_trn_car_in_out_income_dt_json()
    {
        header("content-Type:application/json; charset=utf8");
        $results = $this->trn_car_in_out->gets_ByBusinessId($this->input->get("business_id"));

        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['card_number']  = $results[$i]->card_number;

            $dat['gate_in']  = $results[$i]->gate_in;
            $dat['user_in']  = $results[$i]->user_in;
            $dat['time_in']  = $results[$i]->time_in;
            $dat['gate_out']  = $results[$i]->gate_out;
            $dat['user_out']  = $results[$i]->user_out;
            $dat['time_out']  = $results[$i]->time_out;
            $dat['id_card']  = $results[$i]->id_card;
            $dat['license_plate']  = $results[$i]->license_plate;
            $dat['province']  = $results[$i]->province;
            $dat['remark'] = $results[$i]->remark;
            $car_type = 1;
            if ($results[$i]->car_type == "จยย") {
                $car_type = 3;
            }

            //$dat['fee'] = $this->calcarinntime_fee($results[$i]->card_number, $results[$i]->have_stamp, $car_type);
            $dat['fee'] = $this->calcarinntime_fee($results[$i], $results[$i]->have_stamp, $car_type);

            $dat['have_stamp'] = $results[$i]->have_stamp;
            $dat['car_type'] = $results[$i]->car_type;

            // Update Button
            $updateButton = "
          <div class=\"btn-group\">
     <button type=\"button\" class=\"btn btn-danger\">คำสั่ง</button>
     
     <button type=\"button\" class=\"btn btn-danger dropdown-toggle dropdown-toggle-split\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
       <span class=\"sr-only\">Toggle Dropdown</span>
     </button>

     <div class=\"dropdown-menu\">
       <a class=\"dropdown-item\"  data-id='" . $results[$i]->id . "' data-index='" . $i . "' data-toggle='modal' data-target='#trn_car_in_out' onclick='viewCarInOut(this);'  href=\"#\">ดูข้อมูล</a>
     </div>
     
   </div>";


            $dat['action'] = $updateButton;

            $data[] = $dat;
        }


        ## Response
        $response = array(
            "iTotalRecords" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data
        );
        echo json_encode($response);
    } // .end gets_business_trn_car_in_out_income_dt_json




    public function gets_trn_pic_json()
    {
        header("content-Type:application/json; charset=utf8");
        $results = $this->trn_pic->getByTrnCarInOutId($this->input->get("trn_id"));

        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['trn_car_in_out_id']  = $results[$i]->trn_car_in_out_id;
            $dat['driver_file']  = $results[$i]->driver_file;

            $data[] = $dat;
        }

        $json['success'] = true;
        $json['data'] = $data;

        echo json_encode($json);
    } // .end gets_trn_pic_json


    /**
     * Get data trn_car_in_out return json format
     */
    public function search_trn_car_in_out_json()
    {
        header("content-Type:application/json; charset=utf8");

        $a_column['business_id'] = $this->input->get("business_id");
        $a_column['created_at'] = $this->input->get("date1");
        //$a_column['date2'] = $this->input->get("date2");
        $results = $this->trn_car_in_out->gets_ByBusinessId($a_column['business_id']);
        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['card_number']  = $results[$i]->card_number;
            $dat['gate_in']  = $results[$i]->gate_in;
            $dat['user_in']  = $results[$i]->user_in;
            $dat['time_in']  = $results[$i]->time_in;
            $dat['gate_out']  = $results[$i]->gate_out;
            $dat['user_out']  = $results[$i]->user_out;
            $dat['time_out']  = $results[$i]->time_out;
            $dat['id_card']  = $results[$i]->id_card;
            $dat['license_plate']  = $results[$i]->license_plate;
            $dat['province']  = $results[$i]->province;
            $dat['remark'] = $results[$i]->remark;
            $data[] = $dat;
        }

        $json['success'] = true;
        $json['data'] = $data;
        echo json_encode($json);
    } // .end search_trn_car_in_out_json

    /**
     * Get data trn_car_in_out return json format
     */
    public function gets_trn_car_in_out_dt_json()
    {
        header("content-Type:application/json; charset=utf8");
        $results = $this->trn_car_in_out->gets();
        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['card_number']  = $results[$i]->card_number;
            $dat['gate_in']  = $results[$i]->gate_in;
            $dat['user_in']  = $results[$i]->user_in;
            $dat['time_in']  = $results[$i]->time_in;
            $dat['gate_out']  = $results[$i]->gate_out;
            $dat['user_out']  = $results[$i]->user_out;
            $dat['time_out']  = $results[$i]->time_out;
            $dat['id_card']  = $results[$i]->id_card;
            $dat['license_plate']  = $results[$i]->license_plate;
            $dat['province']  = $results[$i]->province;
            $dat['remark'] = $results[$i]->remark;
            // Update Button
            $updateButton = "
     <div class=\"btn-group\">
    <button type=\"button\" class=\"btn btn-danger\">คำสั่ง</button>

    <button type=\"button\" class=\"btn btn-danger dropdown-toggle dropdown-toggle-split\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
    <span class=\"sr-only\">Toggle Dropdown</span>
    </button>

    <div class=\"dropdown-menu\">
    <a class=\"dropdown-item\"  data-id='" . $results[$i]->id . "' data-index='" . $i . "' data-toggle='modal' data-target='#trn_car_in_out' onclick='viewCarInOut(this);'  href=\"#\">ดูข้อมูล</a>
    </div>

    </div>";


            $dat['action'] = $updateButton;

            $data[] = $dat;
        }


        ## Response
        $response = array(
            "iTotalRecords" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data
        );

        echo json_encode($response);
    } // .end update_trn_car_in_out_dt_json

    /**
     * Get data trn_car_in_out return json format
     */
    public function search_trn_car_in_out_dt_json()
    {
        header("content-Type:application/json; charset=utf8");
        $a_column['business_id'] = $this->input->get("business_id");
        $a_column['created_at'] = $this->input->get("date1");
        //$a_column['date2'] = $this->input->get("date2");

        $results = $this->trn_car_in_out->gets_ByBusinessId($a_column['business_id']);


        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['card_number']  = $results[$i]->card_number;
            $dat['gate_in']  = $results[$i]->gate_in;
            $dat['user_in']  = $results[$i]->user_in;
            $dat['time_in']  = $results[$i]->time_in;
            $dat['gate_out']  = $results[$i]->gate_out;
            $dat['user_out']  = $results[$i]->user_out;
            $dat['time_out']  = $results[$i]->time_out;
            $dat['id_card']  = $results[$i]->id_card;
            $dat['license_plate']  = $results[$i]->license_plate;
            $dat['province']  = $results[$i]->province;
            $dat['remark'] = $results[$i]->remark;
            // Update Button
            $updateButton = "
              <div class=\"btn-group\">
         <button type=\"button\" class=\"btn btn-danger\">คำสั่ง</button>
         
         <button type=\"button\" class=\"btn btn-danger dropdown-toggle dropdown-toggle-split\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
           <span class=\"sr-only\">Toggle Dropdown</span>
         </button>
   
         <div class=\"dropdown-menu\">
           <a class=\"dropdown-item\"  data-id='" . $results[$i]->id . "' data-toggle='modal' data-target='#trn_car_in_out' onclick='view(this);'  href=\"#\">แก้ไข</a>
         </div>
         
       </div>";


            $dat['action'] = $updateButton;

            $data[] = $dat;
        }


        ## Response
        $response = array(
            "iTotalRecords" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data
        );

        echo json_encode($response);
    } // .end update_trn_car_in_out_dt_json

    /**
     * Get data trn_car_in_out return json format
     */
    public function search_business_trn_car_in_out_income_dt_json()
    {
        header("content-Type:application/json; charset=utf8");
        $a_column['business_id'] = $this->input->get("business_id");
        $a_column['date_start'] = $this->input->get("date1");
        $a_column['date_end'] = $this->input->get("date2");

        $results = $this->trn_car_in_out->gets_ByBusinessIdAndDateStartAndDateEnd($a_column['business_id'], $a_column['date_start'], $a_column['date_end']);
        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['card_number']  = $results[$i]->card_number;
            $dat['gate_in']  = $results[$i]->gate_in;
            $dat['user_in']  = $results[$i]->user_in;
            $dat['time_in']  = $results[$i]->time_in;
            $dat['gate_out']  = $results[$i]->gate_out;
            $dat['user_out']  = $results[$i]->user_out;
            $dat['time_out']  = $results[$i]->time_out;
            $dat['car_type']  = $results[$i]->car_type;
            $dat['id_card']  = $results[$i]->id_card;
            $dat['license_plate']  = $results[$i]->license_plate;
            $dat['province']  = $results[$i]->province;
            $dat['remark'] = $results[$i]->remark;
            $car_type = 1;
            if ($results[$i]->car_type == "จยย") {
                $car_type = 3;
            }

            //$dat['fee'] = $this->calcarinntime_fee($results[$i]->card_number, $results[$i]->have_stamp, $car_type);
            $dat['fee'] = $this->calcarinntime_fee($results[$i], $results[$i]->have_stamp, $car_type);

            $dat['have_stamp']  = $results[$i]->have_stamp;

            // Update Button
            $updateButton = "
              <div class=\"btn-group\">
         <button type=\"button\" class=\"btn btn-danger\">คำสั่ง</button>
         
         <button type=\"button\" class=\"btn btn-danger dropdown-toggle dropdown-toggle-split\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
           <span class=\"sr-only\">Toggle Dropdown</span>
         </button>
   
         <div class=\"dropdown-menu\">
           <a class=\"dropdown-item\"  data-id='" . $results[$i]->id . "' data-toggle='modal' data-target='#trn_car_in_out' onclick='view(this);'  href=\"#\">แก้ไข</a>
         </div>
         
       </div>";


            $dat['action'] = $updateButton;

            $data[] = $dat;
        }


        ## Response
        $response = array(
            "iTotalRecords" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data
        );

        echo json_encode($response);
    } // .end search_business_trn_car_in_out_income_dt_json

    /**
     * Upload file from setting view
     */
    public function upload_trn_car_in_out_json()
    {
        header("content-Type:application/json; charset=utf8");
        $this->load->helper('url');
        $this->load->library("session");

        $config = array(
            'upload_path' => "./uploads/trn_car_in_out/",
            'allowed_types' => "gif|png|jpg|jpeg",
            'overwrite' => TRUE,
            'max_size' => "2048000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
        );

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('picture_file')) {
            $ud = array('upload_data' => $this->upload->data());
            $fl = $ud['upload_data']['file_name'];

            $id = $this->input->get("id");
            $data['id'] = $id;
            $data['time_out'] = $fl;

            $this->trn_car_in_out->update($data);

            $json['success'] = true;
            $res = (array) $this->trn_car_in_out->getById($id);

            $json['data'] = $res;
            $json['filename'] = $fl;
        } else {
            $error = array('error' => $this->trn_car_in_out->display_errors());
            $json['success'] = false;
            $json['data'] = $error;
        }

        echo json_encode($json);
    } // .end upload_trn_car_in_out_json

    /**
     * find member by user/pass
     * @return json string
     */
    public function authen_business_site_json()
    {
        $this->load->helper('url');
        $user = $this->input->get("app_uname");
        $pass = $this->input->get("app_pword");
        $result = $this->business_site->getByUnameAndPword($user, $pass);

        $data['status'] = "fail";
        $data['result'] = array();

        if (count($result) > 0) {
            $data['status'] = "success";
            $data['data'] = $result;
        }
        echo json_encode($data);
    } // .End authen_json


    /**
     * find member by user/pass
     * @return json string
     */
    public function authen_business_site()
    {
        $this->load->library("session");
        $this->load->helper('url');
        $user = $this->input->post("uname");
        $pass = $this->input->post("pword");

        $result = $this->business_site->getByWebUnameAndWebPword($user, $pass);

        if (count($result) > 0) {
            $this->session->set_userdata("id", $result[0]->id);
            $this->session->set_userdata("fname", $result[0]->license_key);
            $this->session->set_userdata("lname", "");
            $this->session->set_userdata("business_id", $result[0]->business_id);

            $this->session->set_userdata("uname", $result[0]->uname);
            $this->session->set_userdata("roles_id", 3);
            $this->session->set_userdata("err", "");
            redirect(site_url("welcome/binoutreport"));
        } else {
            $this->session->set_userdata("err", "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง");
            redirect(site_url("welcome/login"));
        }
    } // .End authen_json

    // ///////////////////////////////////////////
    /**
     * List profile_price table data
     *
     */
    public function profileprice()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "profile_price View";
        $data['app_module'] = $this->app_module;
        // $data['navmenus'] = $this->getNavMenus(); //
        $this->load->view('profileprices', $data);
    } // .End profile_prices

    /**
     * Update profile_price table data
     *
     */
    public function update_profile_price()
    {
        $this->load->helper("url");
        $this->load->library("session");

        if ($this->input->get_post("id")) {
            $dat['id']  = $this->input->post("id");
        }
        $dat['car_type_id'] = $this->input->get_post("car_type_id");
        $dat['h'] = $this->input->get_post("h");
        $dat['price'] = $this->input->get_post("price");
        $dat['for_member'] = $this->input->get_post("for_member");


        if ($this->profile_price->update($dat)) {
            $this->session->set_userdata("msg", "Update Success.");
        } else {
            $this->session->set_userdata("err_msg", "Update Fail.");
        } // .End if

        redirect(site_url("welcome/profile_price"));
    } // .end update_profile_price

    /**
     * Delete profile_price table data
     *
     */
    public function delete_profile_price_json()
    {
        $this->load->helper("url");
        $this->load->library("session");
        header("content-Type:application/json; charset=utf8");

        $id  = $this->input->post("id");

        if ($this->profile_price->delById($id)) {
            $json['success'] = true;
            $json['data'] = $id;
        } else {
            $json['success'] = false;
            $json['data'] = "{}";
        } // .End if

        echo json_encode($json);
    } // .end delete_profile_price


    /**
     * Update data profile_price return json format
     */
    public function update_profile_price_json()
    {
        $this->load->helper("url");
        $this->load->library("session");
        header("content-Type:application/json; charset=utf8");

        if ($this->input->get_post("id")) {
            $dat['id']  = $this->input->post("id");
        }

        $json['data'] = array();
        $dat['car_type_id'] = $this->input->post("car_type_id");
        $dat['h'] = $this->input->post("h");
        $dat['price'] = $this->input->post("price");
        $dat['for_member'] = $this->input->post("for_member");

        if ($this->profile_price->update($dat)) {
            $json['success'] = true;
            $json['data'] = $dat;
        } else {
            $json['success'] = false;
            $json['data'] = "{}";
        } // .End if

        echo json_encode($json);
    } // .end update_profile_price_json


    /**
     * Get data profile_price return json format
     */
    public function gets_profile_price_json()
    {
        header("content-Type:application/json; charset=utf8");
        $results = $this->profile_price->gets();

        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['car_type_id']  = $results[$i]->car_type_id;
            $r = $this->car_type->getById($results[$i]->car_type_id);
            $dat['car_type']  = (count($r) > 0) ? $r[0]->name : "";
            
            
            $r = $this->business_site->getById($results[$i]->business_id);
            $dat['business_name']  = (count($r) > 0) ? $r[0]->name : "";
            
            $dat['h']  = $results[$i]->h;
            $dat['price']  = $results[$i]->price;
            $dat['for_member']  = $results[$i]->for_member;

            $data[] = $dat;
        }

        $json['success'] = true;
        $json['data'] = $data;

        echo json_encode($json);
    } // .end gets_profile_price_json

    /**
     * Get data profile_price return json format
     */
    public function search_profile_price_json()
    {
        header("content-Type:application/json; charset=utf8");

        $a_column['title'] = $this->input->get("title");


        $results = $this->profile_price->gets_WithLikeCondition($a_column);


        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['car_type_id']  = $results[$i]->car_type_id;
            $r = $this->car_type->getById($results[$i]->car_type_id);
            $dat['car_type']  = (count($r) > 0) ? $r[0]->name : "";
            $dat['h']  = $results[$i]->h;
            $dat['price']  = $results[$i]->price;
            $dat['for_member']  = $results[$i]->for_member;

            $data[] = $dat;
        }

        $json['success'] = true;
        $json['data'] = $data;

        echo json_encode($json);
    } // .end gets_profile_price_json

    /**
     * Get data profile_price return json format
     */
    public function gets_profile_price_dt_json()
    {
        header("content-Type:application/json; charset=utf8");
        $results = $this->profile_price->gets();
        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {

            $dat['id']  = $results[$i]->id;
            $dat['car_type_id']  = $results[$i]->car_type_id;
            $r = $this->car_type->getById($results[$i]->car_type_id);
            $dat['car_type']  = (count($r) > 0) ? $r[0]->name : "";
            $dat['h']  = $results[$i]->h;
            $dat['price']  = $results[$i]->price;
            $dat['for_member']  = $results[$i]->for_member;

            // Update Button
            $updateButton = "
             <div class=\"btn-group\">
        <button type=\"button\" class=\"btn btn-danger\">คำสั่ง</button>
  
        <button type=\"button\" class=\"btn btn-danger dropdown-toggle dropdown-toggle-split\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
          <span class=\"sr-only\">Toggle Dropdown</span>
        </button>
  
        <div class=\"dropdown-menu\">
          <a class=\"dropdown-item\"  data-index='" . $i . "' data-id='" . $results[$i]->id . "' onclick=\"view(this)\"  href=\"#\">เรียกดู</a>
          <a class=\"dropdown-item\"  data-index='" . $i . "' data-id='" . $results[$i]->id . "' onclick=\"print(this)\"  href=\"#\">พิมพ์</a>
          <a class=\"dropdown-item\"  data-index='" . $i . "' data-id='" . $results[$i]->id . "' data-toggle='modal' data-target='#profile_price' onclick='edit(this);'  href=\"#\">แก้ไข</a>
          <div class=\"dropdown-divider\"></div>
          <a class=\"dropdown-item\" href=\"#\" data-id='" . $results[$i]->id . "' onclick=\"confirmDel(this)\">ลบ</a>
        </div>
  
      </div>";


            $dat['action'] = $updateButton;

            $data[] = $dat;
        }


        ## Response
        $response = array(
            "iTotalRecords" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data
        );

        echo json_encode($response);
    } // .end update_profile_price_dt_json


    /**
     * Get data profile_price return json format
     */
    public function search_profile_price_dt_json()
    {
        header("content-Type:application/json; charset=utf8");
        $a_column['title'] = $this->input->get("title");
        $results = $this->profile_price->gets_WithCondition($a_column);


        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['car_type_id']  = $results[$i]->car_type_id;
            $dat['h']  = $results[$i]->h;
            $dat['price']  = $results[$i]->price;
            $dat['for_member']  = $results[$i]->for_member;

            // Update Button
            $updateButton = "
              <div class=\"btn-group\">
         <button type=\"button\" class=\"btn btn-danger\">คำสั่ง</button>
  
         <button type=\"button\" class=\"btn btn-danger dropdown-toggle dropdown-toggle-split\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
           <span class=\"sr-only\">Toggle Dropdown</span>
         </button>
  
         <div class=\"dropdown-menu\">
           <a class=\"dropdown-item\" data-index='" . $i . "' data-id='" . $results[$i]->id . "' onclick=\"view(this)\"  href=\"#\">เรียกดู</a>
           <a class=\"dropdown-item\" data-index='" . $i . "' data-id='" . $results[$i]->id . "' onclick=\"print(this)\"  href=\"#\">พิมพ์</a>
           <a class=\"dropdown-item\" data-index='" . $i . "' data-id='" . $results[$i]->id . "' data-toggle='modal' data-target='#profile_price' onclick='edit(this);'  href=\"#\">แก้ไข</a>
           <div class=\"dropdown-divider\"></div>
           <a class=\"dropdown-item\" href=\"#\" data-id='" . $results[$i]->id . "' onclick=\"confirmDel(this)\">ลบ</a>
         </div>
  
       </div>";


            $dat['action'] = $updateButton;

            $data[] = $dat;
        }


        ## Response
        $response = array(
            "iTotalRecords" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data
        );

        echo json_encode($response);
    } // .end update_profile_price_dt_json

    ///////////////////////////////////////
    /**
     * List car_type table data
     *
     */
    public function car_types()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "car_type View";
        $data['app_module'] = $this->app_module;
        // $data['navmenus'] = $this->getNavMenus(); //
        $this->load->view('admin/car_type', $data);
    } // .End car_types

    /**
     * Update car_type table data
     *
     */
    public function update_car_type()
    {
        $this->load->helper("url");
        $this->load->library("session");

        if ($this->input->get_post("id")) {
            $dat['id']  = $this->input->post("id");
        }
        $dat['name'] = $this->input->get_post("name");


        if ($this->car_type->update($dat)) {
            $this->session->set_userdata("msg", "Update Success.");
        } else {
            $this->session->set_userdata("err_msg", "Update Fail.");
        } // .End if

        redirect(site_url("welcome/car_type"));
    } // .end update_car_type

    /**
     * Delete car_type table data
     *
     */
    public function delete_car_type_json()
    {
        $this->load->helper("url");
        $this->load->library("session");
        header("content-Type:application/json; charset=utf8");

        $id  = $this->input->post("id");

        if ($this->car_type->delById($id)) {
            $json['success'] = true;
            $json['data'] = $id;
        } else {
            $json['success'] = false;
            $json['data'] = "{}";
        } // .End if

        echo json_encode($json);
    } // .end delete_car_type


    /**
     * Update data car_type return json format
     */
    public function update_car_type_json()
    {
        $this->load->helper("url");
        $this->load->library("session");
        header("content-Type:application/json; charset=utf8");

        if ($this->input->get_post("id")) {
            $dat['id']  = $this->input->post("id");
        }

        $json['data'] = array();
        $dat['name'] = $this->input->post("name");

        if ($this->car_type->update($dat)) {
            $json['success'] = true;
            $json['data'] = $dat;
        } else {
            $json['success'] = false;
            $json['data'] = "{}";
        } // .End if

        echo json_encode($json);
    } // .end update_car_type_json


    /**
     * Get data car_type return json format
     */
    public function gets_car_type_json()
    {
        header("content-Type:application/json; charset=utf8");
        $results = $this->car_type->gets();

        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['name']  = $results[$i]->name;
            $dat['created_at']  = $results[$i]->created_at;
            $dat['created_by']  = $results[$i]->created_by;
            $data[] = $dat;
        }
        $json['success'] = true;
        $json['data'] = $data;

        echo json_encode($json);
    } // .end gets_car_type_json

    /**
     * Get data car_type return json format
     */
    public function search_car_type_json()
    {
        header("content-Type:application/json; charset=utf8");
        $a_column['title'] = $this->input->get("title");
        $results = $this->car_type->gets_WithLikeCondition($a_column);

        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['name']  = $results[$i]->name;
            $dat['created_at']  = $results[$i]->created_at;
            $dat['created_by']  = $results[$i]->created_by;

            $data[] = $dat;
        }
        $json['success'] = true;
        $json['data'] = $data;

        echo json_encode($json);
    } // .end gets_car_type_json

    /**
     * Get data car_type return json format
     */
    public function gets_car_type_dt_json()
    {
        header("content-Type:application/json; charset=utf8");
        $results = $this->car_type->gets();
        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {

            $dat['id']  = $results[$i]->id;
            $dat['name']  = $results[$i]->name;
            $dat['created_at']  = $results[$i]->created_at;
            $dat['created_by']  = $results[$i]->created_by;

            // Update Button
            $updateButton = "
           <div class=\"btn-group\">
      <button type=\"button\" class=\"btn btn-danger\">คำสั่ง</button>

      <button type=\"button\" class=\"btn btn-danger dropdown-toggle dropdown-toggle-split\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
        <span class=\"sr-only\">Toggle Dropdown</span>
      </button>

      <div class=\"dropdown-menu\">
        <a class=\"dropdown-item\"  data-index='" . $i . "' data-id='" . $results[$i]->id . "' onclick=\"view(this)\"  href=\"#\">เรียกดู</a>
        <a class=\"dropdown-item\"  data-index='" . $i . "' data-id='" . $results[$i]->id . "' onclick=\"print(this)\"  href=\"#\">พิมพ์</a>
        <a class=\"dropdown-item\"  data-index='" . $i . "' data-id='" . $results[$i]->id . "' data-toggle='modal' data-target='#car_type' onclick='edit(this);'  href=\"#\">แก้ไข</a>
        <div class=\"dropdown-divider\"></div>
        <a class=\"dropdown-item\" href=\"#\" data-id='" . $results[$i]->id . "' onclick=\"confirmDel(this)\">ลบ</a>
      </div>

    </div>";


            $dat['action'] = $updateButton;

            $data[] = $dat;
        }


        ## Response
        $response = array(
            "iTotalRecords" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data
        );

        echo json_encode($response);
    } // .end update_car_type_dt_json


    /**
     * Get data car_type return json format
     */
    public function search_car_type_dt_json()
    {
        header("content-Type:application/json; charset=utf8");
        $a_column['title'] = $this->input->get("title");
        $results = $this->car_type->gets_WithCondition($a_column);


        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['name']  = $results[$i]->name;
            $dat['created_at']  = $results[$i]->created_at;
            $dat['created_by']  = $results[$i]->created_by;

            // Update Button
            $updateButton = "
            <div class=\"btn-group\">
       <button type=\"button\" class=\"btn btn-danger\">คำสั่ง</button>

       <button type=\"button\" class=\"btn btn-danger dropdown-toggle dropdown-toggle-split\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
         <span class=\"sr-only\">Toggle Dropdown</span>
       </button>

       <div class=\"dropdown-menu\">
         <a class=\"dropdown-item\" data-index='" . $i . "' data-id='" . $results[$i]->id . "' onclick=\"view(this)\"  href=\"#\">เรียกดู</a>
         <a class=\"dropdown-item\" data-index='" . $i . "' data-id='" . $results[$i]->id . "' onclick=\"print(this)\"  href=\"#\">พิมพ์</a>
         <a class=\"dropdown-item\" data-index='" . $i . "' data-id='" . $results[$i]->id . "' data-toggle='modal' data-target='#car_type' onclick='edit(this);'  href=\"#\">แก้ไข</a>
         <div class=\"dropdown-divider\"></div>
         <a class=\"dropdown-item\" href=\"#\" data-id='" . $results[$i]->id . "' onclick=\"confirmDel(this)\">ลบ</a>
       </div>

     </div>";
            $dat['action'] = $updateButton;
            $data[] = $dat;
        }

        ## Response
        $response = array(
            "iTotalRecords" => count($data),
            "recordsFiltered" => count($data),
            "data" => $data
        );

        echo json_encode($response);
    } // .end update_car_type_dt_json

    ///////////////////////////////////////


    /**
     * List house_zone table data
     *
     */
    public function housezone()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "car_type View";
        $data['app_module'] = $this->app_module;
        // $data['navmenus'] = $this->getNavMenus(); //
        $data['business_id'] = $this->session->userdata("business_id");
        $result = $this->house_zone->getsByBusinessId($data['business_id']);
        $data['items'] = $result;
        $this->load->view('housezone', $data);
    } // .End house_zone

    /**
     * Update house_zone table data
     */
    public function update_house_zone()
    {
        $this->load->helper("url");
        $this->load->library("session");



        if ($this->input->get_post("id")) {
            $dat['id']  = $this->input->post("id");
        }

        $dat['zone_name'] = $this->input->post("zone_name");
        $dat['description'] = $this->input->post("description");
        $dat['business_id'] = $this->session->userdata("business_id");


        if ($this->house_zone->update($dat)) {
            $this->session->set_userdata("msg", "Update Success.");
        } else {
            $this->session->set_userdata("err_msg", "Update Fail.");
        }

        redirect(site_url("welcome/housezone"));
    }

    /**
     * Delete house_zone table data
     */
    public function delete_house_zone_json()
    {
        $this->load->helper("url");
        $this->load->library("session");
        header("Content-Type: application/json; charset=utf8");

        $id = $this->input->post("id");

        if ($this->house_zone->deleteById($id)) {
            $json['success'] = true;
            $json['data'] = $id;
        } else {
            $json['success'] = false;
            $json['data'] = "{}";
        }

        echo json_encode($json);
    }

    /**
     * Update data house_zone and return json format
     */
    public function update_house_zone_json()
    {
        $this->load->helper("url");
        $this->load->library("session");
        header("Content-Type: application/json; charset=utf8");

        if ($this->input->get_post("id")) {
            $dat['id']  = $this->input->post("id");
        }
        $dat['zone_name'] = $this->input->post("zone_name");
        $dat['description'] = $this->input->post("description");
        $dat['business_id'] = $this->session->userdata("business_id");

        if ($this->house_zone->update($dat)) {
            $json['success'] = true;
            $json['data'] = $dat;
        } else {
            $json['success'] = false;
            $json['data'] = "{}";
        }

        echo json_encode($json);
    }

    /**
     * Get data house_zone and return json format
     */
    public function gets_house_zone_json()
    {
        header("Content-Type: application/json; charset=utf8");
        $results = $this->house_zone->gets();

        $json['data'] = array();
        foreach ($results as $result) {
            $dat['id'] = $result->id;
            $dat['zone_name'] = $result->zone_name;
            $dat['description'] = $result->description;
            $dat['created_at'] = $result->created_at;
            $dat['created_by'] = $result->created_by;
            $json['data'][] = $dat;
        }

        $json['success'] = true;
        echo json_encode($json);
    }

    /**
     * Search data house_zone and return json format
     */
    public function search_house_zone_json()
    {
        header("Content-Type: application/json; charset=utf8");
        $zone_name = $this->input->get("zone_name");
        $results = $this->house_zone->gets_WithLikeCondition(array('zone_name' => $zone_name));

        $json['data'] = array();
        foreach ($results as $result) {
            $dat['id'] = $result->id;
            $dat['zone_name'] = $result->zone_name;
            $dat['description'] = $result->description;
            $dat['created_at'] = $result->created_at;
            $dat['created_by'] = $result->created_by;
            $json['data'][] = $dat;
        }

        $json['success'] = true;
        echo json_encode($json);
    }

    /**
     * Get data house_zone and return json format for DataTables
     */
    public function gets_house_zone_dt_json()
    {
        header("Content-Type: application/json; charset=utf8");
        $results = $this->house_zone->gets();

        $json['data'] = array();
        foreach ($results as $result) {
            $dat['id'] = $result->id;
            $dat['zone_name'] = $result->zone_name;
            $dat['description'] = $result->description;
            $dat['created_at'] = $result->created_at;
            $dat['created_by'] = $result->created_by;

            // Update Button
            $updateButton = "
            <div class=\"btn-group\">
                <button type=\"button\" class=\"btn btn-danger\">คำสั่ง</button>
                <button type=\"button\" class=\"btn btn-danger dropdown-toggle dropdown-toggle-split\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                    <span class=\"sr-only\">Toggle Dropdown</span>
                </button>
                <div class=\"dropdown-menu\">
                    <a class=\"dropdown-item\" data-index='{$result->id}' data-id='{$result->id}' onclick=\"view(this)\" href=\"#\">เรียกดู</a>
                    <a class=\"dropdown-item\" data-index='{$result->id}' data-id='{$result->id}' onclick=\"print(this)\" href=\"#\">พิมพ์</a>
                    <a class=\"dropdown-item\" data-index='{$result->id}' data-id='{$result->id}' data-toggle='modal' data-target='#house_zone' onclick='edit(this);' href=\"#\">แก้ไข</a>
                    <div class=\"dropdown-divider\"></div>
                    <a class=\"dropdown-item\" href=\"#\" data-id='{$result->id}' onclick=\"confirmDel(this)\">ลบ</a>
                </div>
            </div>";
            $dat['action'] = $updateButton;
            $json['data'][] = $dat;
        }

        $response = array(
            "iTotalRecords" => count($json['data']),
            "recordsFiltered" => count($json['data']),
            "data" => $json['data']
        );

        echo json_encode($response);
    }

    /**
     * Search data house_zone and return json format for DataTables
     */
    public function search_house_zone_dt_json()
    {
        header("Content-Type: application/json; charset=utf8");
        $zone_name = $this->input->get("zone_name");
        $results = $this->house_zone->gets_WithCondition(array('zone_name' => $zone_name));

        $json['data'] = array();
        foreach ($results as $result) {
            $dat['id'] = $result->id;
            $dat['zone_name'] = $result->zone_name;
            $dat['description'] = $result->description;
            $dat['created_at'] = $result->created_at;
            $dat['created_by'] = $result->created_by;

            // Update Button
            $updateButton = "
            <div class=\"btn-group\">
                <button type=\"button\" class=\"btn btn-danger\">คำสั่ง</button>
                <button type=\"button\" class=\"btn btn-danger dropdown-toggle dropdown-toggle-split\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                    <span class=\"sr-only\">Toggle Dropdown</span>
                </button>
                <div class=\"dropdown-menu\">
                    <a class=\"dropdown-item\" data-index='{$result->id}' data-id='{$result->id}' onclick=\"view(this)\" href=\"#\">เรียกดู</a>
                    <a class=\"dropdown-item\" data-index='{$result->id}' data-id='{$result->id}' onclick=\"print(this)\" href=\"#\">พิมพ์</a>
                    <a class=\"dropdown-item\" data-index='{$result->id}' data-id='{$result->id}' data-toggle='modal' data-target='#house_zone' onclick='edit(this);' href=\"#\">แก้ไข</a>
                    <div class=\"dropdown-divider\"></div>
                    <a class=\"dropdown-item\" href=\"#\" data-id='{$result->id}' onclick=\"confirmDel(this)\">ลบ</a>
                </div>
            </div>";
            $dat['action'] = $updateButton;
            $json['data'][] = $dat;
        }

        $response = array(
            "iTotalRecords" => count($json['data']),
            "recordsFiltered" => count($json['data']),
            "data" => $json['data']
        );

        echo json_encode($response);
    }



    /**
     * Get data from the house_zone table and return it in JSON format
     */
    public function xxx_gets_house_zone_json()
    {
        header("Content-Type: application/json; charset=utf-8");

        $business_id = @$_GET['business_id'];
        if ($business_id !== null) {
            $results = $this->house_zone->getsByBusinessId($business_id);
        } else {
            $results = $this->house_zone->gets();
        }

        // Initialize an array to hold the data
        $json['data'] = array();
        $data = array();

        // Loop through the results and format the data
        for ($i = 0; $i < count($results); $i++) {
            $dat['id'] = $results[$i]->id;
            $dat['zone_name'] = $results[$i]->zone_name;
            $dat['description'] = $results[$i]->description;
            $dat['created_at'] = $results[$i]->created_at;
            $dat['created_by'] = $results[$i]->created_by;
            $dat['updated_at'] = $results[$i]->updated_at;
            $dat['updated_by'] = $results[$i]->updated_by;
            $dat['business_id'] = $results[$i]->business_id;

            $data[] = $dat;
        }

        // Set the response data
        $json['success'] = true;
        $json['data'] = $data;

        // Output the JSON response
        echo json_encode($json);
    } // .end gets_house_zone_json



    /**
     * List house_member table data
     *
     */
    public function housemember()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "car_type View";
        $data['app_module'] = $this->app_module;
        // $data['navmenus'] = $this->getNavMenus(); //

        // $memberCode = $this->input->get("c");

        $data['business_id'] = $this->session->userdata("business_id");
        $result = $this->house_member->getHouseMembersByBusinessId($data['business_id']);
        $data['items'] = $result;

        $this->load->view('housemember', $data);
    } // .End house_member


    public function app_gets_house_member_json()
    {
        header("Content-Type: application/json; charset=utf-8");

        $business_id = @$_GET['business_id'];
        $results = $this->house_member->getsByBusinessId($business_id);


        $json['data'] = array();
        $data = array();

        // Loop through the results and format the data
        for ($i = 0; $i < count($results); $i++) {
            $dat['id'] = $results[$i]->id;
            $dat['business_id'] = $results[$i]->business_id;
            $dat['house_zone_id'] = $results[$i]->house_zone_id;
            $dat['house_no'] = $results[$i]->house_no;
            $dat['remark'] = $results[$i]->remark;

            $data[] = $dat;
        }

        // Set the response data
        $json['success'] = true;
        $json['data'] = $data;

        // Output the JSON response
        echo json_encode($json);
    } // .end gets_house_member_json


    /**
     * Update house_member table data
     */
    public function update_house_member()
    {
        $this->load->helper("url");
        $this->load->library("session");

        if ($this->input->get_post("id")) {
            $dat['id']  = $this->input->post("id");
        }
        $dat['member_name'] = $this->input->post("member_name");
        $dat['description'] = $this->input->post("description");
        $dat['business_id'] = $this->session->userdata("business_id");

        if ($this->house_member->update($dat)) {
            $this->session->set_userdata("msg", "Update Success.");
        } else {
            $this->session->set_userdata("err_msg", "Update Fail.");
        }

        redirect(site_url("welcome/housemember"));
    }

    /**
     * Delete house_member table data
     */
    public function delete_house_member_json()
    {
        $this->load->helper("url");
        $this->load->library("session");
        header("Content-Type: application/json; charset=utf8");

        $id = $this->input->post("id");

        if ($this->house_member->deleteById($id)) {
            $json['success'] = true;
            $json['data'] = $id;
        } else {
            $json['success'] = false;
            $json['data'] = "{}";
        }

        echo json_encode($json);
    }

    /**
     * Update data house_member and return json format
     */
    public function update_house_member_json()
    {
        $this->load->helper("url");
        $this->load->library("session");
        header("Content-Type: application/json; charset=utf8");

        if ($this->input->get_post("id")) {
            $dat['id']  = $this->input->post("id");
        }
        $dat['member_name'] = $this->input->post("member_name");
        $dat['description'] = $this->input->post("description");
        $dat['business_id'] = $this->session->userdata("business_id");

        if ($this->house_member->update($dat)) {
            $json['success'] = true;
            $json['data'] = $dat;
        } else {
            $json['success'] = false;
            $json['data'] = "{}";
        }

        echo json_encode($json);
    }

    /**
     * Get data house_member and return json format
     */
    public function gets_house_member_json2()
    {
        header("Content-Type: application/json; charset=utf8");
        $results = $this->house_member->gets();

        $json['data'] = array();
        foreach ($results as $result) {
            $dat['id'] = $result->id;
            $dat['member_name'] = $result->member_name;
            $dat['description'] = $result->description;
            $dat['created_at'] = $result->created_at;
            $dat['created_by'] = $result->created_by;
            $json['data'][] = $dat;
        }

        $json['success'] = true;
        echo json_encode($json);
    }

    /**
     * Get data house_member and return json format
     */
    public function gets_house_member_json()
    {
        header("Content-Type: application/json; charset=utf8");

        //$data['business_id'] = $this->session->userdata("business_id");
        //$result = $this->house_member->getHouseMembersByBusinessId($data['business_id']);

        // Fetch house member data
        $results = $this->house_member->getById($_GET['id']);

        // Initialize JSON response array
        $json['data'] = array();

        // Iterate over results and format them for JSON response
        foreach ($results as $result) {
            $dat = array(
                'id' => $result->id,
                'house_no' => $result->house_no,
                'mobile_no' => $result->mobile_no,
                'house_password' => $result->house_password,
                'remark' => $result->remark,
                'house_zone_id' => $result->house_zone_id
            );
            $json['data'][] = $dat;
        }

        // Set success status and encode JSON response
        $json['success'] = true;
        echo json_encode($json);
    }
}

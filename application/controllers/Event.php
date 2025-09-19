<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
{
    //var $yrs = "2020"; 
    public $app_version;

    public $app_name;
    public $app_module;

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
        $this->load->model('Gate', 'gate');
        $this->load->model('ReaderOut', 'readerout');
        $this->load->model('CarType', 'cartype');
        $this->load->model('Roles', 'roles');
        $this->load->model('Business', 'business');
        $this->load->model('BusinessSite', 'business_site');
        $this->load->model('Stamp', 'stamp');
        $this->load->model('Location', 'location');
        $this->load->model('Employee', 'employee');

        $this->load->model('MasterTag', 'master_tag');
        $this->load->model('RegisterTag', 'register_tag');
        $this->load->model('EventStatus', 'event_status');
        $this->load->model('EventPic', 'event_pic');

        $this->app_version = " version : dev-1.0";
        $this->app_name = "TSWG-VSM: Vehicle Security Management System";
    } //.End function

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
     * Maps to the following URL
     * 		http://example.com/welcome
     *	- or -
     * 		http://example.com/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
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
            redirect(site_url("welcome/index"));
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

        $result = $this->trn_car_in_out->carInOutTime();
        $data['items'] = $result;
        $data['business_id'] = $this->session->userdata("business_id");

        $this->load->view('binoutreport', $data);
    }  // .End members


    public function gardtour()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Gard Tour Report";
        $data['app_module'] = $this->app_module;

        $result = $this->event_status->gets();
        $data['items'] = $result;
        $data['business_id'] = $this->session->userdata("business_id");

        $this->load->view('gardtour', $data);
    }  // .End bgardtour

    /**
     * View trn car in out.
     */
    public function bgardtour()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "Gard Tour Report";
        $data['app_module'] = $this->app_module;


        $result = $this->event_status->getsByBusinessId($this->session->userdata("business_id"));
        $data['items'] = $result;
        $data['business_id'] = $this->session->userdata("business_id");

        $this->load->view('bgardtour', $data);
    }  // .End bgardtour

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
     * Do process car in
     */
    public function updateeventstatus()
    {
        $this->load->library("session");
        $this->load->helper('url');
        $business_id = $this->input->get_post("business_id");

        $tag_no = $this->input->get_post("tag_no");
        $event_status = $this->input->get_post("event_status");
        $remark = $this->input->get_post("remark");
        $man_name = $this->input->get_post("man_name");
        $man_shift = $this->input->get_post("man_shift");

        $data['business_id'] = $business_id;
        $data['tag_no'] = $tag_no;
        $data['event_status'] = $event_status;
        $data['remark'] = $remark;
        $data['man_name'] = $man_name;
        $data['man_shift'] = $man_shift;

        $json = array();

        if ($this->event_status->update($data)) {
            $rs = $this->event_status->getLastByTagNo($data['tag_no']);

            $json['status'] = "success";
            $data['id'] = $rs[0]->id;
            $json['data'][] = $data;

            $res = $this->business_site->getByBusinessId($business_id);
            $resTag = $this->register_tag->gets_ByBusinessIdAndTagNo($business_id, $tag_no);


            if (trim($res[0]->line_notify_key) != "") {
                // Usage example
                $token =  $res[0]->line_notify_key;
                $lineNotify = new LineNotify($token);

                $message = 'จุด: ' . $resTag[0]->name . "\n";
                $message .= 'ผลัด: ' . $man_shift . "\n";
                $message .= 'ชื่อ: ' . $man_name . "\n";
                $message .= 'เหตุการณ์: ' . $event_status . " " . $remark;
                //$imageFilePath = '/path/to/your/image.jpg'; // Local file path
                // OR
                //$imageURL = 'https://example.com/path/to/your/image.jpg'; // URL of the image

                // Send notification with a local image
                $lineNotify->send($message);

                // OR send notification with an image URL
                // $lineNotify->send($message, null, $imageURL);
            }
        } else {
            $json['status'] = "fail";
            $json['data'][] = "{}";
        } // .End if

        echo json_encode($json);
    } // .end docarin

    /**
     * Do process car in
     */
    public function updateregistertag()
    {
        $this->load->library("session");
        $this->load->helper('url');
        $business_id = $this->input->get_post("business_id");
        $tag_no = $this->input->get_post("tag_no");
        $location = $this->input->get_post("location");
        $name = $this->input->get_post("name");

        $data['business_id'] = $business_id;
        $data['tag_no'] = $tag_no;
        $data['location'] = $location;
        $data['name'] = $name;

        $json = array();

        if ($this->register_tag->update($data)) {
            $rs = $this->register_tag->getLastByTagNo($data['tag_no']);

            $json['status'] = "success";
            $data['id'] = $rs[0]->id;
            $json['data'][] = $data;
        } else {
            $json['status'] = "fail";
            $json['data'][] = "{}";
        } // .End if

        echo json_encode($json);
    } // .end updateregistertag

    public function hastagno()
    {
        $this->load->library("session");
        $this->load->helper('url');
        $tag_no = $this->input->get_post("tag_no");
        $data['tag_no'] = $tag_no;
        $json = array();
        $rs = $this->register_tag->getLastByTagNo($data['tag_no']);
        if (count($rs) > 0) {
            $json['status'] = "success";
            $data['id'] = $rs[0]->id;
            $json['data'][] = $data;
        } else {
            $json['status'] = "fail";
            $json['data'][] = "{}";
        } // .End if

        echo json_encode($json);
    } // .end hastagno

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

                $countIn = $this->countCarInIsOver($c);

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
        #echo json_encode($data, JSON_UNESCAPED_UNICODE);
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

        #echo json_encode($json);

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
        #echo json_encode($data, JSON_UNESCAPED_UNICODE);
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

    public function profileprice()
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

        redirect(site_url("welcome/profileprice/{$id}"));
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

    public function save_EventPic()
    {
        $this->load->helper('url');
        $this->load->library("session");

        $config = array(
            'upload_path' => "./uploads/event",
            'allowed_types' => "gif|png|jpg|jpeg",
            'overwrite' => TRUE,
            'max_size' => "2048000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
        );

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file_pic')) {
            $ud = array('upload_data' => $this->upload->data());

            $fl = $ud['upload_data']['file_name'];

            $event_id = $this->input->get("event_id");
            $b_id = $this->input->get("business_id");
            $forPic = $this->input->get("pic_for");

            $data['event_id'] = $event_id;
            $data['pic_file'] = $fl;
            //print_r($data);
            $affected = $this->event_pic->update($data);

            $json['success'] = "OK";
            $json['msg'] = "success";
        } else {
            $json['success'] = "FAIL";
            $json['msg'] = "Can not complete process.";
        }
        echo json_encode($json);
    } // .end douploadsetting

    /**
     * Get data business_site return json format
     */
    public function gets_event_status_dt_json()
    {
        header("content-Type:application/json; charset=utf8");
        $a_column['business_id'] = $this->input->get("business_id");
        $a_column['date1'] = $this->input->get("date1");
        $a_column['date2'] = $this->input->get("date2");

        //print_r($a_column);

        $results = $this->event_status->gets_ByWhere($a_column);
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

            $dat['tag_no']  = $results[$i]->tag_no;
            $dat['created_at']  = $results[$i]->created_at;

            $rs = $this->register_tag->getByTagNo($results[$i]->tag_no);
            if (count($rs) > 0) {
                $dat['name']  = $rs[0]->name;
                $dat['location']  = $rs[0]->location;
            } else {
                $dat['name']  = "";
                $dat['location']  = "";
            }

            $dat['event_status'] = $results[$i]->event_status;
            $dat['remark'] = $results[$i]->remark;
            $dat['man_shift'] = $results[$i]->man_shift;
            $dat['man_name'] = $results[$i]->man_name;

            // Update Button
            $updateButton = "
            <div class=\"btn-group\">
                <button type=\"button\" class=\"btn btn-danger\">คำสั่ง</button>
                <button type=\"button\" class=\"btn btn-danger dropdown-toggle dropdown-toggle-split\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                    <span class=\"sr-only\">Toggle Dropdown</span>
                </button>
                <div class=\"dropdown-menu\">
                <a class=\"dropdown-item\" data-index='" . $i . "' data-id='" . $results[$i]->id . "' data-toggle='modal' data-target='#event_status' onclick='viewEventInfo(this);'  href=\"#\">ดูเหตุการณ์ ณ จุดตรวจ</a>
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
     * Get data business_site return json format
     */
    public function search_event_status_dt_json()
    {
        header("content-Type:application/json; charset=utf8");
        $a_column['business_id'] = $this->input->get("business_id");
        $a_column['date1'] = $this->input->get("date1");
        $a_column['date2'] = $this->input->get("date2");

        $results = $this->event_status->gets_ByWhere($a_column);	
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

            $dat['tag_no']  = $results[$i]->tag_no;
            $dat['created_at']  = $results[$i]->created_at;

            $rs = $this->register_tag->getByTagNo($results[$i]->tag_no);
            if (count($rs) > 0) {
                $dat['name']  = $rs[0]->name;
                $dat['location']  = $rs[0]->location;
            } else {
                $dat['name']  = "";
                $dat['location']  = "";
            }

            $dat['event_status'] = $results[$i]->event_status;
            $dat['remark'] = $results[$i]->remark;
            $dat['man_shift'] = $results[$i]->man_shift;
            $dat['man_name'] = $results[$i]->man_name;

            // Update Button
            $updateButton = "
            <div class=\"btn-group\">
                <button type=\"button\" class=\"btn btn-danger\">คำสั่ง</button>
                <button type=\"button\" class=\"btn btn-danger dropdown-toggle dropdown-toggle-split\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                    <span class=\"sr-only\">Toggle Dropdown</span>
                </button>
                <div class=\"dropdown-menu\">
                
                <a class=\"dropdown-item\" data-index='" . $i . "' data-id='" . $results[$i]->id . "' data-toggle='modal' data-target='#event_status' onclick='viewEventInfo(this);'  href=\"#\">ดูเหตุการณ์ ณ จุดตรวจ</a>
                
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
     * Get data trn_car_in_out return json format
     */
    public function gets_event_status_json()
    {
        header("content-Type:application/json; charset=utf8");

        $a_column['business_id'] = $this->input->get("business_id");
        $a_column['date1'] = $this->input->get("date1");
        $a_column['date2'] = $this->input->get("date2");

        $results = $this->event_status->gets_ByWhere($a_column);

        $json['data'] = array();
        $data = array();

        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['tag_no']  = $results[$i]->tag_no;
            $dat['created_at']  = $results[$i]->created_at;

            $rs = $this->register_tag->getByTagNo($results[$i]->tag_no);
            if (count($rs) > 0) {
                $dat['name']  = $rs[0]->name;
                $dat['location']  = $rs[0]->location;
            } else {
                $dat['name']  = "";
                $dat['location']  = "";
            }

            $dat['event_status'] = $results[$i]->event_status;
            $dat['remark'] = $results[$i]->remark;
            $dat['man_shift'] = $results[$i]->man_shift;
            $dat['man_name'] = $results[$i]->man_name;
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



    public function gets_event_pic_json()
    {
        header("content-Type:application/json; charset=utf8");
        $results = $this->event_pic->getByEventId($this->input->get("event_id"));

        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['event_id']  = $results[$i]->event_id;
            $dat['pic_file']  = $results[$i]->pic_file;

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
     * List register_tag table data
     * 
     */
    public function register_tags()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "register_tag View";
        $data['app_module'] = $this->app_module;
        // $data['navmenus'] = $this->getNavMenus(); // 
        $data['business_id'] = $this->session->userdata("business_id");
        $this->load->view('registertag', $data);
    } // .End register_tags

    /**
     * Update register_tag table data
     * 
     */
    public function update_register_tag()
    {
        $this->load->helper("url");
        $this->load->library("session");

        if ($this->input->get_post("id")) {
            $dat['id']  = $this->input->post("id");
        }
        $dat['business_id'] = $this->input->get_post("business_id");
        $dat['tag_no'] = $this->input->get_post("tag_no");
        $dat['name'] = $this->input->get_post("name");
        $dat['location'] = $this->input->get_post("location");


        if ($this->register_tag->update($dat)) {
            $this->session->set_userdata("msg", "Update Success.");
        } else {
            $this->session->set_userdata("err_msg", "Update Fail.");
        } // .End if

        redirect(site_url("event/register_tag"));
    } // .end update_register_tag

    /**
     * Delete register_tag table data
     * 
     */
    public function delete_register_tag_json()
    {
        $this->load->helper("url");
        $this->load->library("session");
        header("content-Type:application/json; charset=utf8");

        $id  = $this->input->post("id");

        if ($this->register_tag->delById($id)) {
            $json['success'] = true;
            $json['data'] = $id;
        } else {
            $json['success'] = false;
            $json['data'] = "{}";
        } // .End if

        echo json_encode($json);
    } // .end delete_register_tag


    /**
     * Update data register_tag return json format
     */
    public function update_register_tag_json()
    {
        $this->load->helper("url");
        $this->load->library("session");
        header("content-Type:application/json; charset=utf8");

        if ($this->input->get_post("id")) {
            $dat['id']  = $this->input->post("id");
        }

        $json['data'] = array();
        $dat['business_id'] = $this->input->post("business_id");
        $dat['tag_no'] = $this->input->post("tag_no");
        $dat['name'] = $this->input->post("name");
        $dat['location'] = $this->input->post("location");

        if ($this->register_tag->update($dat)) {
            $json['success'] = true;
            $json['data'] = $dat;
        } else {
            $json['success'] = false;
            $json['data'] = "{}";
        } // .End if

        echo json_encode($json);
    } // .end update_register_tag_json


    /**
     * Get data register_tag return json format
     */
    public function gets_register_tag_json()
    {
        header("content-Type:application/json; charset=utf8");
        $a_column['business_id'] = $this->input->get("business_id");
        $results = $this->register_tag->gets_ByBusinessId($a_column['business_id']);
        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['business_id']  = $results[$i]->business_id;
            $r = $this->business->getById($results[$i]->business_id);
            $dat['business']  = (count($r) > 0) ? $r[0]->name : "";
            $dat['tag_no']  = $results[$i]->tag_no;
            $dat['name']  = $results[$i]->name;
            $dat['location']  = $results[$i]->location;
            $dat['created_at']  = $results[$i]->created_at;
            $dat['created_by']  = $results[$i]->created_by;
            $dat['updated_at']  = $results[$i]->updated_at;
            $dat['updated_by']  = $results[$i]->updated_by;
            $data[] = $dat;
        }

        $json['success'] = true;
        $json['data'] = $data;

        echo json_encode($json);
    } // .end gets_register_tag_json

    /**
     * Get data register_tag return json format
     */
    public function search_register_tag_json()
    {
        header("content-Type:application/json; charset=utf8");

        $a_column['title'] = $this->input->get("title");


        $results = $this->register_tag->gets_WithLikeCondition($a_column);


        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['business_id']  = $results[$i]->business_id;
            $r = $this->business->getById($results[$i]->business_id);
            $dat['business']  = (count($r) > 0) ? $r[0]->name : "";
            $dat['tag_no']  = $results[$i]->tag_no;
            $dat['name']  = $results[$i]->name;
            $dat['location']  = $results[$i]->location;
            $dat['created_at']  = $results[$i]->created_at;
            $dat['created_by']  = $results[$i]->created_by;
            $dat['updated_at']  = $results[$i]->updated_at;
            $dat['updated_by']  = $results[$i]->updated_by;

            $data[] = $dat;
        }

        $json['success'] = true;
        $json['data'] = $data;

        echo json_encode($json);
    } // .end gets_register_tag_json

    /**
     * Get data register_tag return json format
     */
    public function gets_register_tag_dt_json()
    {
        header("content-Type:application/json; charset=utf8");

        $a_column['business_id'] = $this->input->get("business_id");
        //print_r($a_column);
        $results = $this->register_tag->gets_ByBusinessId($a_column['business_id']);
        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {

            $dat['id']  = $results[$i]->id;
            $dat['business_id']  = $results[$i]->business_id;
            $r = $this->business->getById($results[$i]->business_id);
            $dat['business']  = (count($r) > 0) ? $r[0]->name : "";
            $dat['tag_no']  = $results[$i]->tag_no;
            $dat['name']  = $results[$i]->name;
            $dat['location']  = $results[$i]->location;
            $dat['created_at']  = $results[$i]->created_at;
            $dat['created_by']  = $results[$i]->created_by;
            $dat['updated_at']  = $results[$i]->updated_at;
            $dat['updated_by']  = $results[$i]->updated_by;

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
          <a class=\"dropdown-item\"  data-index='" . $i . "' data-id='" . $results[$i]->id . "' data-toggle='modal' data-target='#register_tag' onclick='edit(this);'  href=\"#\">แก้ไข</a>
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
    } // .end update_register_tag_dt_json


    /**
     * Get data register_tag return json format
     */
    public function search_register_tag_dt_json()
    {
        header("content-Type:application/json; charset=utf8");
        $a_column['title'] = $this->input->get("title");


        $results = $this->register_tag->gets_WithCondition($a_column);


        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['business_id']  = $results[$i]->business_id;
            $dat['tag_no']  = $results[$i]->tag_no;
            $dat['name']  = $results[$i]->name;
            $dat['location']  = $results[$i]->location;
            $dat['created_at']  = $results[$i]->created_at;
            $dat['created_by']  = $results[$i]->created_by;
            $dat['updated_at']  = $results[$i]->updated_at;
            $dat['updated_by']  = $results[$i]->updated_by;

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
           <a class=\"dropdown-item\" data-index='" . $i . "' data-id='" . $results[$i]->id . "' data-toggle='modal' data-target='#register_tag' onclick='edit(this);'  href=\"#\">แก้ไข</a>
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
    } // .end update_register_tag_dt_json

    /**
     * List master_tag table data
     * 
     */
    public function master_tags()
    {
        $this->load->helper('url');
        $this->load->library("session");
        $data['app_name'] = $this->app_name;
        $data['app_version'] = $this->app_version;
        $this->app_module = "master_tag View";
        $data['app_module'] = $this->app_module;
        // $data['navmenus'] = $this->getNavMenus(); // 
        $this->load->view('mastertag', $data);
    } // .End master_tags

    /**
     * Update master_tag table data
     * 
     */
    public function update_master_tag()
    {
        $this->load->helper("url");
        $this->load->library("session");

        if ($this->input->get_post("id")) {
            $dat['id']  = $this->input->post("id");
        }
        $dat['tag_no'] = $this->input->get_post("tag_no");
        $dat['is_own'] = $this->input->get_post("is_own");

        if ($this->master_tag->update($dat)) {
            $this->session->set_userdata("msg", "Update Success.");
        } else {
            $this->session->set_userdata("err_msg", "Update Fail.");
        } // .End if

        redirect(site_url("event/master_tag"));
    } // .end update_master_tag

    /**
     * Delete master_tag table data
     * 
     */
    public function delete_master_tag_json()
    {
        $this->load->helper("url");
        $this->load->library("session");
        header("content-Type:application/json; charset=utf8");

        $id  = $this->input->post("id");

        if ($this->master_tag->delById($id)) {
            $json['success'] = true;
            $json['data'] = $id;
        } else {
            $json['success'] = false;
            $json['data'] = "{}";
        } // .End if

        echo json_encode($json);
    } // .end delete_master_tag


    /**
     * Update data master_tag return json format
     */
    public function update_master_tag_json()
    {
        $this->load->helper("url");
        $this->load->library("session");
        header("content-Type:application/json; charset=utf8");

        if ($this->input->get_post("id")) {
            $dat['id']  = $this->input->post("id");
        }

        $json['data'] = array();
        $dat['tag_no'] = $this->input->post("tag_no");
        $dat['is_own'] = $this->input->post("is_own");

        if ($this->master_tag->update($dat)) {
            $json['success'] = true;
            $json['data'] = $dat;
        } else {
            $json['success'] = false;
            $json['data'] = "{}";
        } // .End if

        echo json_encode($json);
    } // .end update_master_tag_json


    /**
     * Get data master_tag return json format
     */
    public function gets_master_tag_json()
    {
        header("content-Type:application/json; charset=utf8");
        $results = $this->master_tag->gets();

        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['tag_no']  = $results[$i]->tag_no;
            $dat['is_own']  = $results[$i]->is_own;

            $data[] = $dat;
        }

        $json['success'] = true;
        $json['data'] = $data;

        echo json_encode($json);
    } // .end gets_master_tag_json

    /**
     * Get data master_tag return json format
     */
    public function search_master_tag_json()
    {
        header("content-Type:application/json; charset=utf8");

        $a_column['title'] = $this->input->get("title");


        $results = $this->master_tag->gets_WithLikeCondition($a_column);


        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['tag_no']  = $results[$i]->tag_no;
            $dat['is_own']  = $results[$i]->is_own;

            $data[] = $dat;
        }

        $json['success'] = true;
        $json['data'] = $data;

        echo json_encode($json);
    } // .end gets_master_tag_json

    /**
     * Get data master_tag return json format
     */
    public function gets_master_tag_dt_json()
    {
        header("content-Type:application/json; charset=utf8");
        $results = $this->master_tag->gets();
        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['tag_no']  = $results[$i]->tag_no;
            $dat['is_own']  = $results[$i]->is_own;

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
        <a class=\"dropdown-item\"  data-index='" . $i . "' data-id='" . $results[$i]->id . "' data-toggle='modal' data-target='#master_tag' onclick='edit(this);'  href=\"#\">แก้ไข</a>
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
    } // .end update_master_tag_dt_json


    /**
     * Get data master_tag return json format
     */
    public function search_master_tag_dt_json()
    {
        header("content-Type:application/json; charset=utf8");
        $a_column['title'] = $this->input->get("title");


        $results = $this->master_tag->gets_WithCondition($a_column);


        $json['data'] = array();
        $data = array();
        for ($i = 0; $i < count($results); $i++) {
            $dat['id']  = $results[$i]->id;
            $dat['tag_no']  = $results[$i]->tag_no;
            $dat['is_own']  = $results[$i]->is_own;

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
         <a class=\"dropdown-item\" data-index='" . $i . "' data-id='" . $results[$i]->id . "' data-toggle='modal' data-target='#master_tag' onclick='edit(this);'  href=\"#\">แก้ไข</a>
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
    } // .end update_master_tag_dt_json

}


/**
    * Class line notify service 
    * ravatna@gmail.com, yasupada53@gmail.com
    */
class LineNotify
{
    private $token;

    // Constructor to set the token
    public function __construct($token)
    {
        $this->token = $token;
    }

    // Function to send a notification with an optional image
    public function send($message, $imageFilePath = null, $imageURL = null)
    {
        $url = 'https://notify-api.line.me/api/notify';
        $data = ['message' => $message];
        $headers = [
            'Content-Type: multipart/form-data',
            'Authorization: Bearer ' . $this->token
        ];

        $postfields = $data;

        if ($imageFilePath && file_exists($imageFilePath)) {
            $postfields['imageFile'] = new CURLFile($imageFilePath);
        } elseif ($imageURL) {
            $postfields['imageThumbnail'] = $imageURL;
            $postfields['imageFullsize'] = $imageURL;
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            //echo 'Error:' . curl_error($ch);
        } else {
            //echo 'Response: ' . $result;
        }

        curl_close($ch);
    }
}

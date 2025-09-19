<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."/models/MY_CI_Model.php");
class AdminUser extends MY_CI_Model { // คลาส Model_template สืบทอดคุณสมบัติของ CI_Model
	
    /**
     * Constuct
     */
    public function __construct()
    {
		parent::__construct();
		
        $this->tblName="admin_users";

	} //.End function
    

    
    /**
     * update member or new register
     * @return int
     */
    public function update($data){

        if(!array_key_exists("id",$data)){
            $this->isFirstChange($data);
            $this->db->insert($this->tblName,$data);
        } else { 
            $this->isNoFirstChange($data);
            $this->db->where("id",$data['id']);
            $this->db->update($this->tblName,$data);
        }

        if($this->db->affected_rows()>0){
            return true;
        }   
    } // .End updateAdminUser


    public function getByUnameAndPword($u,$p){
        $query = $this->db->where('uname',$u)->where('pword',$p)->get($this->tblName);
        return $query->result();
    } // .End findMemberByUnameAndPword



    public function getById($id){
        $query = $this->db->where('id',$id)->get($this->tblName);
        return $query->result();
    } // .End AdminUserById()
	
}
?>
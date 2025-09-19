<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."/models/MY_CI_Model.php");

class MemberLicense extends MY_CI_Model { // คลาส Model_template สืบทอดคุณสมบัติของ CI_Model
    
    
	/**
     * Constuct
     */
    public function __construct()
    {
		parent::__construct();
		$this->tblName=TBL_MEMBER_LICENSE;
	} //.End function

    /**
     * get list result
     */
    
    public function memberLicenses(){
        $query = $this->db->get($this->tblName);
        return $query->result();
    }


    public function getByCardNumber($code){
        $query=$this->db->where('card_number',$code)->get($this->tblName);
        return $query->result();
    } // .End getByCardNumber()

    /**
     * update member or new register
     * @return int
     */
    public function update($data){
        if(!array_key_exists("id",$data)){
            $this->isFirstChange($data);
            $this->db->insert($this->tblName,$data);
        }else{ 
            $this->isNoFirstChange($data);
            $this->db->where("id",$data['id']);
            $this->db->update($this->tblName,$data);
        }

        if($this->db->affected_rows()>0){
            return true;
        }
    } // .End updateMember


    public function getById($id){
        $query = $this->db->where('id',$id)->get($this->tblName);
        return $query->result();
    } // .end getById()

    public function deleteById($id){
        $query = $this->db->where('id',$id)->delete($this->tblName);
        return $query->result();
    } // .end deleteById()

    public function getIdLastRec(){
        $query = $this->db->order_by('id','DESC')->limit(1)->get($this->tblName);
        return $query->result();
    } // .end deleteByName()

    public function count(){
        $result = $this->db->count_all_results($this->tblName);
        return $result;
    } // .end deleteByName()
}
?>
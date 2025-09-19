<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."/models/MY_CI_Model.php");

class ProfilePrice extends MY_CI_Model { // คลาส Model_template สืบทอดคุณสมบัติของ CI_Model
    
	/**
     * Constuct
     */
    public function __construct()
    {
		parent::__construct();
		$this->tblName=TBL_PROFILE_PRICE;
	} //.End function
    
    /**
     * get list of members
     */
    public function gets(){
        $query = $this->db->get($this->tblName);
        return $query->result();
    }

    /**
     * update member or new register
     * @return int
     */
    public function update($data){
        if(!array_key_exists("id",$data)){
            //$this->isFirstChange($data);
            $this->db->insert($this->tblName,$data);
        }else{ 
            //$this->isNoFirstChange($data);
            $this->db->where("id",$data['id']);
            $this->db->update($this->tblName,$data);
        }

        if($this->db->affected_rows()>0){
            return true;
        }
    } // .End updateMember

    public function getByCarTypeAndH($carTypeId,$hours){
        $query = $this->db->where('car_type_id',$carTypeId)->where('h',$hours)->get($this->tblName);
        return $query->result();
    } // .End getByUnameAndPword

    public function getById($id){
        $query = $this->db->where('id',$id)->get($this->tblName);
        return $query->result();
    } // .end getById()

    public function getByH($h){
        $query = $this->db->where('h',$h)->get($this->tblName);
        return $query->result();
    } // .end getById()

    /**
     * member ban or not
     */
    public function memberban($data){
        $b = false;
        $this->db->where("id",$data['id']);
        $this->db->update($this->tblName,$data);

        if($this->db->affected_rows()>0){
            $b = true;
        }

        return $b;
    } // .End memberban()	
    
    public function deleteById($id){
        $query = $this->db->where('id',$id)->delete($this->tblName);
        return $query->result();
    } // .end deleteByName()
}
?>
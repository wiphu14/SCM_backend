<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."/models/MY_CI_Model.php");

class HouseZone extends MY_CI_Model { // คลาส Model_template สืบทอดคุณสมบัติของ CI_Model
    
	/**
     * Constuct
     */
    public function __construct()
    {
		parent::__construct();
		$this->tblName=TBL_HOUSE_ZONE;
	} //.End function
    
    /**
     * get list of House Zone
     */
    public function gets(){
        $query = $this->db->get($this->tblName);
        return $query->result();
    }

    /**
     * update table
     * @return int
     */
    public function update($data){
        if(!array_key_exists("id",$data)){
              $data['created_at'] = date("Y-m-d H:i:s");
          $data['created_by'] = $_SESSION['uname'];
          $data['updated_at'] = date("Y-m-d H:i:s");
          $data['updated_by'] = $_SESSION['uname'];
            $this->isCreate($data);
            $this->db->insert($this->tblName,$data);
        }else{ 
            
          $data['updated_at'] = date("Y-m-d H:i:s");
          $data['updated_by'] = $_SESSION['uname'];
            $this->db->where("id",$data['id']);
            $this->db->update($this->tblName,$data);
        }

        if($this->db->affected_rows() > 0){
            return true;
        }
    } // .End update

    public function getById($id){
        $query = $this->db->where('id',$id)->get($this->tblName);
        return $query->result();
    } // .end getById()

    public function getsByBusinessId($id){
        $query = $this->db->where('business_id',$id)->get($this->tblName);
        return $query->result();
    } // .end getsByBusinessId()

    public function deleteById($id){
        $query = $this->db->where('id',$id)->delete($this->tblName);
        return $query;
    } // .end deleteById()
}

?>
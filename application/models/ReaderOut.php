<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."/models/MY_CI_Model.php");

class ReaderOut extends MY_CI_Model { // คลาส Model_template สืบทอดคุณสมบัติของ CI_Model
    
	/**
     * Constuct
     */
    public function __construct()
    {
		parent::__construct();
		$this->tblName="reader_out";
	} //.End function
    
    /**
     * get list of reader_outs
     */
    public function reader_outs(){
        $query = $this->db->get($this->tblName);
        return $query->result();
    }

    /**
     * update member or new register
     * @return int
     */
    public function update($data){
        if(!array_key_exists("id",$data)){
            $this->isNoFirstChange($data);
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
	
	public function updateReaderOut($id,$c){
            //$this->isNoFirstChange($data);
			$data['updated_at'] = date('Y-m-d H:i:s');
			$data['updated_by'] ='222';
            $data['card_code']= $c;
            $this->db->where("id",$id);
			//print_r($data);
            $this->db->update($this->tblName,$data);
        

        if($this->db->affected_rows()>0){
            return true;
        }
    }

    public function getById($id){
        $query = $this->db->where('id',$id)->get($this->tblName);
        return $query->result();
    } // .end getById()

    
}
?>
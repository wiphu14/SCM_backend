<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."/models/MY_CI_Model.php");

class HouseMember extends MY_CI_Model {

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->tblName = TBL_HOUSE_MEMBER; 
    }

    /**
     * Get all house members
     * @return array
     */
    public function gets(){
        $query = $this->db->get($this->tblName);
        return $query->result();
    }

    /**
     * Update table
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
        } else { 
            $data['updated_at'] = date("Y-m-d H:i:s");
            $data['updated_by'] = $_SESSION['uname'];
            $this->db->where("id",$data['id']);
            $this->db->update($this->tblName,$data);
        }

        if($this->db->affected_rows() > 0){
            return true;
        }
        return false;
    } // .End updateMember

    public function getById($id){
        $query = $this->db->where('id',$id)->get($this->tblName);
        return $query->result();
    } // .end getById()

    public function getsByBusinessId($id){
        $query = $this->db->where('business_id',$id)->get($this->tblName);
        return $query->result();
    } // .end getsByBusinessId()

    public function getHouseMembersByBusinessId($business_id) {
        $this->db->select('hm.id, hm.house_no, hm.mobile_no, hm.house_password, hm.remark, 
                           hm.created_at, hm.created_by, hm.updated_at, hm.updated_by, 
                           hz.zone_name, hz.description');
        $this->db->from('house_member hm');
        $this->db->join('house_zone hz', 'hm.house_zone_id = hz.id');
        $this->db->where('hm.business_id', $business_id);
        $query = $this->db->get();
        return $query->result();
    }

    

    public function deleteById($id){
        $query = $this->db->where('id',$id)->delete($this->tblName);
        return $query;
    } // .end deleteById()
}
?>

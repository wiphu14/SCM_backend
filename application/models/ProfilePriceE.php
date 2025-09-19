<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class ProfilePriceE extends CI_Model { // คลาส Model_template สืบทอดคุณสมบัติของ CI_Model
    
	/**
	  * member
	  */
      private $tableName = "profile_price";

	  /**
	  * Get All record with LIKE condition
    * @params array $a_condition
    * @return array
	  */
    public function gets_WithLikeCondition($a_condition) {
      foreach ($a_condition as $k => $v){
        if($v != "")
          $this->db->like($k,$v);
      } // .End for

      $query = $this->db->get($this->tableName);
      return $query->result();
    } // .End function

    /**
	  * Get All record
    * @return array
	  */
    public function gets() {
      $query = $this->db->get($this->tableName);
      return $query->result();
    } // .End function

    /**
     * Get record from  table data by spec field and value
     *
     */
    public function getByField($f, $v){
      $query = $this->db->where($f,$v)->get($this->tableName);
      return $query->result();
    } // .End getByField

    /**
     * Get top last data.
     * @return array
     */
    public function getTopLast() {
      $query = $this->db->query("select * from {$this->tableName} limit 0,1;");
      return $query->result();
    }

	  /**
	  * Get list id,value select option
    * @return array
	  */
	  public function get_select_options() {
      $query = $this->db->get($this->tableName);
      $rs = $query->result();

      $options = Array();
      foreach($rs as $k => $v){
        $options[$v->id] = $v->name;
      }

      return $options;
	  } // .End get_select_options

      public function update($data){
        if(!array_key_exists("id",$data)){
        //   $data['created_at'] = date("Y-m-d H:i:s");
        //   $data['created_by'] = $_SESSION['uname'];
        //   $data['updated_at'] = date("Y-m-d H:i:s");
        //   $data['updated_by'] = $_SESSION['uname'];
          $this->db->insert($this->tableName,$data);
          if($this->db->affected_rows() > 0){
              return true;
          }
        }else{
        //   $data['updated_at'] = date("Y-m-d H:i:s");
        //   $data['updated_by'] = $_SESSION['uname'];
          $this->db->where("id",$data['id']);
          $this->db->update($this->tableName,$data);
          if($this->db->affected_rows() > 0){
              return true;
          }
        }
      } // .End update

		  /**
		  * Update value for_member by id field
		  * @param $v is 'n' or 'y'
		  */
		  public function update_for_memberById($id,$v){

        $data['for_member'] = $v;
        $data['updated_at'] = date("Y-m-d H:i:s");
        $data['updated_by'] = $_SESSION['uname'];
        $this->db->where("id",$id);
        $this->db->update($this->tableName,$data);
        if($this->db->affected_rows()>0){
            return true;
        }

      } // .End update

	  /**
     * Get record from  table data by id
     *
     */
      public function getById($id){
          $query = $this->db->where('id',$id)->get($this->tableName);
          return $query->result();
      } // .End getById

	  /**
     * Delete record from table data by id
     *
     */
      public function delById($id){
        $query = $this->db->where('id',$id)->delete($this->tableName);
        return $query;
      } //.End delById



    public function getByCarTypeAndH($carTypeId,$hours){
        $query = $this->db->where('car_type_id',$carTypeId)->where('h',$hours)->get($this->tableName);
        return $query->result();
    } // .End getByCarTypeAndH

    public function getByH($hours){
        $query = $this->db->where('h',$hours)->get($this->tableName);
        return $query->result();
    } // .End getByCarTypeAndH
}
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."/models/MY_CI_Model.php");

class TrnCarInOut extends MY_CI_Model { // คลาส Model_template สืบทอดคุณสมบัติของ CI_Model
    
	 /**
	  * member
	  */
      private $tableName = "trn_car_in_out";
	  
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
	  * Get All record
    * @return array
	  */
      public function gets_ByBusinessId($bid) {
          $this->db->where("business_id",$bid);
        $query = $this->db->get($this->tableName);
        return $query->result();
      } // .End function


      public function gets_ByBusinessIdAndDateStartAndDateEnd($bid,$date_start,$date_end){
         
		$query = $this->db->query("select * from trn_car_in_out
        
        where 
             ( date(time_in) between  '".$date_start."' AND '".$date_end."') and business_id = ".$bid." 
            
        ;");

        
        return $query->result();
    } // .End carInOutTimeJson()

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
        
          $this->db->insert($this->tableName,$data);
          if($this->db->affected_rows() > 0){
              return true;
          }
        }else{ 
          
          $this->db->where("id",$data['id']);
          $this->db->update($this->tableName,$data);
          if($this->db->affected_rows() > 0){
              return true;
          }
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
    
    public function getByCardNumber($code){
        $query=$this->db->where('card_number',$code)->get($this->tableName);
        return $query->result();
    } // .End getByCardNumber()

    public function carInByCardNumber($code){
        $query = $this->db->query("select id,card_number,gate_in,user_in,time_in,gate_out,user_out,time_out from {$this->tableName} where card_number ='{$code}' and (time_out is null or time_out = '');");
        return $query->result();
    } // countCarInByCardNumber()

    public function carIn($business_id){
        $query = $this->db->query("select 
        m.id,m.name,m.surname,
            tcio.id,tcio.card_number,gate_in,user_in,time_in,gate_out,user_out,time_out, id_card,license_plate,province,remark,reason
        from ((trn_car_in_out tcio left join member_license ml on tcio.card_number = ml.card_number)
        left join member m on ml.member_id = m.id)
        
        where 
            (tcio.gate_out is null or tcio.gate_out = '') and 
            (tcio.user_out is null or tcio.user_out = '') and
            (tcio.time_out is null or tcio.time_out = '')and
            (tcio.business_id = '".$business_id."')  
        ;");
        return $query->result();
    } // countCarInByCardNumber()

    /**
     * list car in out
     */
    public function carInOutTime(){
        /*$query = $this->db->query("select 
        m.id,m.name,m.surname,
            tcio.id,tcio.card_number,gate_in,user_in,time_in,gate_out,user_out,time_out 
        from ((trn_car_in_out tcio left join member_license ml on tcio.card_number = ml.card_number)
        left join member m on ml.member_id = m.id)
        
        where 
            (tcio.gate_out is null or tcio.gate_out = '') and 
            (tcio.user_out is null or tcio.user_out = '') and
            (tcio.time_out is null or tcio.time_out = '')
        ;");*/
		$query = $this->db->query("select 
        m.id,m.name,m.surname,
            tcio.id,tcio.card_number,gate_in,user_in,time_in,gate_out,user_out,time_out 
        from ((trn_car_in_out tcio left join member_license ml on tcio.card_number = ml.card_number)
        left join member m on ml.member_id = m.id)
        
        where 
            (tcio.gate_out is not null or tcio.gate_out != '') and 
            (tcio.user_out is not null or tcio.user_out != '') and
            (tcio.time_out is not null or tcio.time_out != '')
        ;");
        return $query->result();
    } // .End carInOutTime()
	
	
	public function carInOutTimeJson($data){
        /*$query = $this->db->query("select 
        m.id,m.name,m.surname,
            tcio.id,tcio.card_number,gate_in,user_in,time_in,gate_out,user_out,time_out 
        from ((trn_car_in_out tcio left join member_license ml on tcio.card_number = ml.card_number)
        left join member m on ml.member_id = m.id)
        
        where 
            (tcio.gate_out is null or tcio.gate_out = '') and 
            (tcio.user_out is null or tcio.user_out = '') and
            (tcio.time_out is null or tcio.time_out = '')
        ;");*/
		$query = $this->db->query("select 
        m.id,m.name,m.surname,
            tcio.id,tcio.card_number,gate_in,user_in,time_in,gate_out,user_out,time_out 
        from ((trn_car_in_out tcio left join member_license ml on tcio.card_number = ml.card_number)
        left join member m on ml.member_id = m.id)
        
        where 
             ( `time_in` >=  '".$data['date1']." 00:00:00' AND `time_in` <= '".$data['date1']." 59:59:59') and
             ( `time_out` >=  '".$data['date2']." 00:00:00' AND `time_out` <= '".$data['date2']." 59:59:59') and 
            (tcio.gate_out is not null or tcio.gate_out != '') and 
            (tcio.user_out is not null or tcio.user_out != '') and
            (tcio.time_out is not null or tcio.time_out != '') 
        ;");
        return $query->result();
    } // .End carInOutTimeJson()

     /**
     * list car in out
     */
    public function carInOutTime_byCardNumber($c){
        $query = $this->db->query("select 
        m.id,m.name,m.surname,
            tcio.id,tcio.card_number,gate_in,user_in,time_in,gate_out,user_out,time_out ,now() as ctime
        from ((trn_car_in_out tcio left join member_license ml on tcio.card_number = ml.card_number)
        left join member m on ml.member_id = m.id)
        
        where
            (tcio.card_number  = '{$c}') and  
            (tcio.gate_out is null or tcio.gate_out = '') and 
            (tcio.user_out is null or tcio.user_out = '') and
            (tcio.time_out is null or tcio.time_out = '') 
        ;");
        return $query->result();
    } // .End carInOutTime_byCardNumber()

    public function countToday(){
        // $date = new DateTime($date_range);
        
        // $date->modify('start')->setTime(00,00,00);
        // $date_start = $date->format('Y-m-d G:i:s');

        // $date->modify('end')->setTime(23,59,59);
        // $date_end = $date->format('Y-m-d G:i:s');

        $date_start = date("Y-m-d 00:00:00");
        //print_r($date_start);
        $date_end = date("Y-m-d 23:59:59");
        
        $result = $this->db->from($this->tableName)
                        ->where('time_in >=', $date_start)
                        ->where('time_in <=', $date_end)
                        ->count_all_results();

        return $result;
    } // .end deleteByName()

    public function countIn(){
        $result = $this->db->from($this->tableName)
                        ->where('time_out', NULL)
                        ->count_all_results();
        return $result;
    } // .end deleteByName()
}

?>
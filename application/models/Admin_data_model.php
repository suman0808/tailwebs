<?php
class Admin_data_model extends CI_Model {
  function __construct(){
    parent::__construct();
  }
  function saveData($table='',$inputs='') {
    $this->db->insert($table,$inputs);
    return $this->db->insert_id();
  }
  function updateData($table='',$where='',$inputs='') {
    $this->db->where($where);
    $query = $this->db->update($table,$inputs);
    return $query;
  }
  function deleteData($table='',$where='',$where_not='') {
    $this->db->where($where);
    if(@$where_not){
      foreach ($where_not as $where_no) {
        $where_not_arr = explode(",", $where_no);
        if(@$where_not_arr){ 
          $where_not_in = $where_not_arr[0];
          $where_not_val = $where_not_arr[1];
          $this->db->where_not_in($where_not_in,$where_not_val);
        }
      }
    } 
    $query = $this->db->delete($table);
    return $query;
  }
  function getRow($table='',$where='',$where_not='',$join_table='',$order_by='',$limit='',$offset='',$like='',$group_by='',$select='',$where_or='',$like_match_specific='',$find_in_set='',$where_in_array=''){
    if(@$select){
      $this->db->select($select, FALSE);
    }else{
      $this->db->select("*", FALSE);
    }
    if(@$table){
      $this->db->from($table);
    }
    if(@$where){
      $this->db->where($where);
    }  
    if(@$where_in_array){
      foreach ($where_in_array as $where_in) {
        $where_in_arr = explode(",", $where_in);
        if(@$where_in_arr){ 
          $where_in_col = $where_in_arr[0];
          $where_in_val = explode("||", $where_in_arr[1]);
          $this->db->where_in($where_in_col,$where_in_val);
        }
      }
    }  
    if(@$where_or){
      $this->db->or_where($where_or);
    }    
    if(@$find_in_set){
      foreach ($find_in_set as $find_in) {
        $this->db->where("FIND_IN_SET(".$find_in.")!=",0);
      }
    }  
    if(@$where_not){
      foreach ($where_not as $where_no) {
        $where_not_arr = explode(",", $where_no);
        if(@$where_not_arr){ 
          $where_not_in = $where_not_arr[0];
          $where_not_val = $where_not_arr[1];
          $this->db->where_not_in($where_not_in,$where_not_val);
        }
      }
    }      
    if(@$limit){ 
      $this->db->limit($limit);
    }
    if(@$limit && @$offset){
      $this->db->limit($limit,$offset);
    }
    if(@$order_by == 1){
      $this->db->order_by('rand()');
    }else if(@$order_by){
      $this->db->order_by($order_by); 
    }
    if(@$like){
      $this->db->where($like);
    }
    if(@$like_match_specific){
      $i=0;
      foreach ($like_match_specific as $like_match) {
        $like_match_arr = explode("|:|", $like_match);
        if(@$like_match_arr){
          if(@$i==0){
            $this->db->like($like_match_arr[0],$like_match_arr[1],$like_match_arr[2]);
          }else{
            $this->db->or_like($like_match_arr[0],$like_match_arr[1],$like_match_arr[2]);
          }
        }
        $i++;
      }
    }
    if(@$group_by){
      $this->db->group_by($group_by);
    }
    if(@$join_table){
      foreach ($join_table as $join) {
        $join_arr = explode(",", $join);
        if(@$join_arr){
          $wr_id = $join_arr[2];
          $from_wr_id = $join_arr[2];
          $to_table = $join_arr[1];
          $from_table = $join_arr[0];
          if(@$join_arr[3]){
            $from_wr_id = $join_arr[3];
          }
          $this->db->join($to_table,$to_table.'.'.$wr_id.'='.$from_table.'.'.$from_wr_id,'left');
        }
      }
    }
    $query = $this->db->get();
    return $query->result();        
  }
  function getSingleRow($table='',$where='',$where_not='',$join_table='',$order_by='',$like='',$group_by='',$select='',$where_or='',$like_match_specific='',$find_in_set='',$where_in_array=''){
    if(@$select){
      $this->db->select($select, FALSE);
    }else{
      $this->db->select("*", FALSE);
    }
    if(@$table){
      $this->db->from($table);
    }
    if(@$where){
      $this->db->where($where);
    }   
    if(@$where_in_array){
      foreach ($where_in_array as $where_in) {
        $where_in_arr = explode(",", $where_in);
        if(@$where_in_arr){ 
          $where_in_col = $where_in_arr[0];
          $where_in_val = explode("||", $where_in_arr[1]);
          $this->db->where_in($where_in_col,$where_in_val);
        }
      }
    }  
    if(@$where_not){
      foreach ($where_not as $where_no) {
        $where_not_arr = explode(",", $where_no);
        if(@$where_not_arr){ 
          $where_not_in = $where_not_arr[0];
          $where_not_val = $where_not_arr[1];
          $this->db->where_not_in($where_not_in,$where_not_val);
        }
      }
    }   
    if(@$where_or){
      $this->db->or_where($where_or);
    }   
    if(@$find_in_set){
      foreach ($find_in_set as $find_in) {
        $this->db->where("FIND_IN_SET(".$find_in.")!=",0);
      }
    }   
    if(@$order_by == 1){
      $this->db->order_by('rand()');
    }else if(@$order_by){
      $this->db->order_by($order_by); 
    }
    if(@$like){
      $this->db->where($like);
    }
    if(@$like_match_specific){
      $i=0;
      foreach ($like_match_specific as $like_match) {
        $like_match_arr = explode("|:|", $like_match);
        if(@$like_match_arr){
          if(@$i==0){
            $this->db->like($like_match_arr[0],$like_match_arr[1],$like_match_arr[2]);
          }else{
            $this->db->or_like($like_match_arr[0],$like_match_arr[1],$like_match_arr[2]);
          }
        }
        $i++;
      }
    }
    if(@$group_by){
      $this->db->group_by($group_by);
    }
    if(@$join_table){
      foreach ($join_table as $join) {
        $join_arr = explode(",", $join);
        if(@$join_arr){
          $wr_id = $join_arr[2];
          $from_wr_id = $join_arr[2];
          $to_table = $join_arr[1];
          $from_table = $join_arr[0];
          if(@$join_arr[3]){
            $from_wr_id = $join_arr[3];
          }
          $this->db->join($to_table,$to_table.'.'.$wr_id.'='.$from_table.'.'.$from_wr_id,'left');
        }
      }
    }
    $query = $this->db->get();
    return $query->row();     
  }
}
?>
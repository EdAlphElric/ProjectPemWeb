<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {
  var $table = 'user';
  var $column_order = array('user_foto','user_nama','user_telp','user_kota','logged_in',null); //set column field database for datatable orderable
  var $column_search = array('user_nama','user_telp','user_kota'); //set column field database for datatable searchable just firstname , lastname , address are searchable
  var $order = array('user_nama' => 'desc'); // default order 
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
 function login($user_nama,$user_pass)
 {
      $this->db->where("user_nama",$user_nama);
      $this->db->where("user_pass",$user_pass);
      $query=$this->db->get("user");
      if($query->num_rows()>0)
      {
        foreach($query->result() as $rows)
        {
          //add all data to session
          $newdata = array(
              'user_id'  => $rows->user_id,
              'user_nama'  => $rows->user_nama,
              'user_email'  => $rows->user_email,
              'user_telp' => $rows->user_telp,
              'user_kota' => $rows->user_kota,
              'user_jenis' => $rows->user_jenis,
              'user_saldo' => $rows->user_saldo,
              'user_status' => $rows->user_status,
              'logged_in'  => 'TRUE',
          );
        }
        $this->session->set_userdata($newdata);
        return true;
      }
      return false;
 }

 function getUser($user_nama)
 {
  $this->db->where("user_nama",$user_nama);
  $query=$this->db->get("user");
      if($query->num_rows()>0)
      {
        foreach($query->result() as $rows)
        {
          //add all data to session
          $profile = array(
              'user_id'  => $rows->user_id,
              'user_nama'  => $rows->user_nama,
              'user_email'  => $rows->user_email,
              'user_telp' => $rows->user_telp,
              'user_kota' => $rows->user_kota,
              'user_jenis' => $rows->user_jenis,
              'user_saldo' => $rows->user_saldo,
              'user_status' => $rows->user_status,
              'logged_in'  => $rows->logged_in,
              'user_join' => $rows->user_join,
          );
        }
        $data = $profile;
        return $data;
      }
 }
  public function add_user()
 {
  $data=array(
    'user_nama'=>$this->input->post('user_nama'),
    'user_email'=>$this->input->post('user_email'),
    'user_pass'=>md5($this->input->post('user_pass')),
    'user_jenis'=> 'Guest',
    'user_saldo' => 0,
    'user_status' => 'Active',
    'user_telp' => $this->input->post('user_telp'),
    'user_kota' => $this->input->post('user_kota'),
    'logged_in'=> 'FALSE'
  );
  $this->db->insert('user',$data);
 }

  private function _get_datatables_query()
  {
    
    $this->db->from($this->table);

    $i = 0;
  
    foreach ($this->column_search as $item) // loop column 
    {
      if($_POST['search']['value']) // if datatable send POST for search
      {
        
        if($i===0) // first loop
        {
          $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
          $this->db->like($item, $_POST['search']['value']);
        }
        else
        {
          $this->db->or_like($item, $_POST['search']['value']);
        }

        if(count($this->column_search) - 1 == $i) //last loop
          $this->db->group_end(); //close bracket
      }
      $i++;
    }
    
    if(isset($_POST['order'])) // here order processing
    {
      $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } 
    else if(isset($this->order))
    {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }
  function get_datatables()
  {
    $this->_get_datatables_query();
    if($_POST['length'] != -1)
    $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }
  function count_filtered()
  {
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }
  public function count_all()
  {
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }
  public function get_by_id($user_id)
  {
    $this->db->from($this->table);
    $this->db->where('user_id',$user_id);
    $query = $this->db->get();

    return $query->row();
  }
  public function save($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }

  public function update($where, $data)
  {
    $this->db->update($this->table, $data, $where);
    return $this->db->affected_rows();
  }

  public function delete_by_id($user_id)
  {
    $this->db->where('user_id', $user_id);
    $this->db->delete($this->table);
  }
}
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller{
 public function __construct()
 {
  parent::__construct();
  $this->load->model('user_model');
 }
 public function index()
 {
  if(($this->session->userdata('user_nama')!=""))
  {
   redirect(base_url(),'refresh');
  }
  else{
   $data['title']= 'Registration';
   $this->load->view('header',$data);
   $this->load->view("registration_view.php", $data);
   $this->load->view('footer',$data);
  }
 }
 public function welcome()
 {
  $data['title']= 'Welcome';
  $this->load->view('header',$data);
  $this->load->view('welcome_view.php', $data);
  $this->load->view('footer',$data);
 }
 public function login()
 {
  $user_nama=$this->input->post('user_nama');
  $user_pass=md5($this->input->post('user_pass'));

  $result=$this->user_model->login($user_nama,$user_pass);
  if($result){ 
    if($this->session->userdata('user_status')=='Banned'){
      echo "<script>alert('User telah di nonaktifkan, silahkan menghubungi admin')</script>";
      $this->logout();
    }else{
      $this->welcome();
    }
  }else{     
    $this->index();
  }
 }
 public function login_page()
 {
  $data['title']= 'login_page';
  $this->load->view('header',$data);
  $this->load->view('login_view.php', $data);
  $this->load->view('footer',$data);
 }
 public function registration()
 {
  $this->load->library('form_validation');
  // field name, error message, validation rules
      $this->form_validation->set_rules('user_nama', 'User Name', 'trim|required|min_length[4]');
      $this->form_validation->set_rules('user_pass', 'Password', 'trim|required|min_length[4]|max_length[32]');
      $this->form_validation->set_rules('user_email', 'Your Email', 'trim|required|valid_email');
      $this->form_validation->set_rules('user_telp', 'Your Telephone', 'trim|required');
      $this->form_validation->set_rules('user_kota', 'Your Location', 'trim|required');

  if($this->form_validation->run() == FALSE)
  {
   $this->index();
  }
  else
  {
   $this->user_model->add_user();
   $this->login_page();
  }
 }


 public function logout()
 {
      $newdata = array(
        'user_id'   =>'',
        'user_nama'  =>'',
        'user_email'     => '',
        'user_telp' => '',
        'user_kota' => '',
        'user_jenis' => '',
        'user_saldo' => '',
        'user_status' => '',
        'logged_in' => 'FALSE',
  );
  $this->session->unset_userdata($newdata );
  $this->session->sess_destroy();
  $this->index();
 }
  public function profile($user_nama){
    $profile = $this->user_model->getUser($user_nama);
    $this->load->view('header');
    $this->load->view('profile_view', $profile);
    $this->load->view('footer');

}
}
?>
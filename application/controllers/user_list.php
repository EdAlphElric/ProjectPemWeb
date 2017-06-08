<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_list extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('user_model','user');
	}

	public function index()
	{

		$this->load->view('header');
		$this->load->view('user_list_view');
		$this->load->view('footer');
	}


	public function ajax_list()
	{
		$list = $this->user->get_datatables();
		$data = array();
		$user_id = $_POST['start'];
		foreach ($list as $user) {
			$user_id++;
			$row = array();
			$row[] = '<center><img class="img-circle" style="height:50px; width:50px" src="<?php $user->user_foto>"></center>';
			$row[] = $user->user_nama;
			$row[] = $user->user_telp;
			$row[] = $user->user_kota;
			$row[] = $user->logged_in;

			if($this->session->userdata('user_jenis')=="Admin"){//add html for action
				$row[] = $user->user_jenis;
				$row[] = $user->user_status;
				$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_user('."'".$user->user_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$user->user_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
					  <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="rating_user('."'".$user->user_id."'".')"><i class="glyphicon glyphicon-star"></i> Beri Rating</a>';

			}else if($this->session->userdata('user_nama')!=""){
				$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Like" onclick="like('."'".$user->user_id."'".')"><i class="glyphicon glyphicon-star"></i> Beri Rating</a>';
			}
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->user->count_all(),
						"recordsFiltered" => $this->user->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($user_id)
	{
		$data = $this->user->get_by_id($user_id);
		echo json_encode($data);
	}

/*	public function ajax_add()
	{
		$data = array(
				'posting_judul' => $this->input->post('posting_judul'),
				'posting_artikel' => $this->input->post('posting_artikel'),
				'posting_rating' => $this->input->post('posting_rating'),
				'posting_mkn_foto' => $this->input->post('posting_mkn_foto'),
				'posting_user_id' => $this->input->post('posting_user_id'),
				'posting_user_nama' => $this->input->post('posting_user_nama'),
			);
		$insert = $this->user->save($data);
		echo json_encode(array("status" => TRUE));
	}
*/
	public function ajax_update()
	{

		$data = array(
				'user_status' => $this->input->post('user_status'),
				'user_jenis' => $this->input->post('user_jenis'),
				'user_saldo' => $this->input->post('user_saldo'),
			);
		$this->user->update(array('user_id' => $this->input->post('user_id')), $data);
		echo json_encode(array("status" => TRUE));
	}


	public function ajax_delete($user_id)
	{
		$this->user->delete_by_id($user_id);
		echo json_encode(array("status" => TRUE));
	}

}

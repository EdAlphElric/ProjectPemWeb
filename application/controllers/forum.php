<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('forum_model','forum');
	}

	public function index()
	{

		$this->load->view('header');
		$this->load->view('forum_view');
		$this->load->view('footer');
	}


	public function ajax_list()
	{
		$list = $this->forum->get_datatables();
		$data = array();
		$posting_id = $_POST['start'];
		foreach ($list as $forum) {
			$posting_id++;
			$row = array();
			$row[] = '<center><img class="img-circle" style="height:50px; width:50px" src="<?php $forum->posting_mkn_foto?>"></center>';
			$row[] = $forum->posting_judul;
			$row[] = $forum->posting_user_nama;
			$row[] = $forum->posting_rating;
			

			if($this->session->userdata('user_jenis')=="Admin"){//add html for action
				$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_thread('."'".$forum->posting_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_thread('."'".$forum->posting_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
					  <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="rating_thread('."'".$forum->posting_id."'".')"><i class="glyphicon glyphicon-star"></i> Beri Rating</a>';

			}else{
				$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="like('."'".$forum->posting_id."'".')"><i class="glyphicon glyphicon-star"></i> Beri Rating</a>';
			}
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->forum->count_all(),
						"recordsFiltered" => $this->forum->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($posting_id)
	{
		$data = $this->forum->get_by_id($posting_id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				'posting_judul' => $this->input->post('posting_judul'),
				'posting_artikel' => $this->input->post('posting_artikel'),
				'posting_rating' => $this->input->post('posting_rating'),
				'posting_mkn_foto' => $this->input->post('posting_mkn_foto'),
				'posting_user_id' => $this->input->post('posting_user_id'),
				'posting_user_nama' => $this->input->post('posting_user_nama'),
			);
		$insert = $this->forum->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{

		$data = array(
				'posting_judul' => $this->input->post('posting_judul'),
				'posting_artikel' => $this->input->post('posting_artikel'),
				'posting_rating' => $this->input->post('posting_rating'),
				'posting_mkn_foto' => $this->input->post('posting_mkn_foto'),
				'posting_user_id' => $this->input->post('posting_user_id'),
				'posting_user_nama' => $this->input->post('posting_user_nama'),
			);
		$this->forum->update(array('posting_id' => $this->input->post('posting_id')), $data);
		echo json_encode(array("status" => TRUE));
	}


	public function ajax_rating($posting_id)
	{
		$data = $this->forum->get_by_id($posting_id);

		$temp = array(
				'posting_rating' => $data['posting_rating']+1,
			);
		$this->forum->update(array('posting_id' => $posting_id), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($posting_id)
	{
		$this->forum->delete_by_id($posting_id);
		echo json_encode(array("status" => TRUE));
	}

	public function upload_file()
	{
    $status = "";
    $msg = "";
    $file_element_name = 'userfile';
     
    if (empty($_POST['title']))
    {
        $status = "error";
        $msg = "Please enter a title";
    }
     
    if ($status != "error")
    {
        $config['upload_path'] = './files/';
        $config['allowed_types'] = 'gif|jpg|png|doc|txt';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;
 
        $this->load->library('upload', $config);
 
        if (!$this->upload->do_upload($file_element_name))
        {
            $status = 'error';
            $msg = $this->upload->display_errors('', '');
        }
        else
        {
            $data = $this->upload->data();
            $file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
            if($file_id)
            {
                $status = "success";
                $msg = "File successfully uploaded";
            }
            else
            {
                unlink($data['full_path']);
                $status = "error";
                $msg = "Something went wrong when saving the file, please try again.";
            }
        }
        @unlink($_FILES[$file_element_name]);
    }
    echo json_encode(array('status' => $status, 'msg' => $msg));
}
}

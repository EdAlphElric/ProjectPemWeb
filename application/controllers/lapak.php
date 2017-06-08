<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lapak extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Lapak_model','lapak');
	}

	public function index()
	{

		$this->load->view('header');
		$this->load->view('lapak_view');
		$this->load->view('footer');
	}


	public function ajax_list()
	{
		$list = $this->lapak->get_datatables();
		$data = array();
		$lapak_id = $_POST['start'];
		foreach ($list as $lapak) {
			$lapak_id++;
			$row = array();
			$row[] = '<center><img class="img-circle" style="height:50px; width:50px" src="<?php $lapak->lapak_foto?>"></center>';
			$row[] = $lapak->lapak_nama_mkn;
			$row[] = $lapak->lapak_harga;
			$row[] = $lapak->lapak_user_nama;
			$row[] = $lapak->lapak_user_lokasi;
			$row[] = $lapak->lapak_rating;
			

			if($this->session->userdata('user_jenis')=="Admin"){//add html for action
				$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_lapak('."'".$lapak->lapak_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_lapak('."'".$lapak->lapak_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
					  <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="rating_lapak('."'".$lapak->lapak_id."'".')"><i class="glyphicon glyphicon-star"></i> Beri Rating</a>';

			}else{
				$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="like('."'".$lapak->lapak_id."'".')"><i class="glyphicon glyphicon-star"></i> Beri Rating</a>';
			}
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->lapak->count_all(),
						"recordsFiltered" => $this->lapak->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($lapak_id)
	{
		$data = $this->lapak->get_by_id($lapak_id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				'lapak_nama_mkn' => $this->input->post('lapak_nama_mkn'),
				'lapak_deskripsi' => $this->input->post('lapak_deskripsi'),
				'lapak_rating' => $this->input->post('lapak_rating'),
				'lapak_foto' => $this->input->post('lapak_foto'),
				'lapak_user_id' => $this->input->post('lapak_user_id'),
				'lapak_user_nama' => $this->input->post('lapak_user_nama'),
				'lapak_user_lokasi' => $this->input->post('lapak_user_lokasi'),
			);
		$insert = $this->lapak->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{

		$data = array(
				'lapak_nama_mkn' => $this->input->post('lapak_nama_mkn'),
				'lapak_deskripsi' => $this->input->post('lapak_deskripsi'),
				'lapak_rating' => $this->input->post('lapak_rating'),
				'lapak_foto' => $this->input->post('lapak_foto'),
			);
		$this->lapak->update(array('lapak_id' => $this->input->post('lapak_id')), $data);
		echo json_encode(array("status" => TRUE));
	}


	public function ajax_rating($lapak_id)
	{
		$data = $this->lapak->get_by_id($lapak_id);

		$temp = array(
				'lapak_rating' => $data['lapak_rating']+1,
			);
		$this->lapak->update(array('lapak_id' => $lapak_id), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($lapak_id)
	{
		$this->lapak->delete_by_id($lapak_id);
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

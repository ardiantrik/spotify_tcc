<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main_controller extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('main_model');
        $this->load->library('session');
    }

	public function index(){
		//$this->load->view('testing');
        $this->testGetData();
    }

    public function login(){
        $this->load->view('view_login');
    }

    public function do_login(){
        $log['username'] = $this->input->post('username');
        $log['password'] = $this->input->post('password');

        $data = $this->main_model->cek_login('admin',$log);
        $cek = $data->num_rows();
        if ($cek==1) {
            $data_session = array(
                'nama'=>$log['username'],
                'status'=>"login",
            );
            $this->session->set_userdata($data_session);
            redirect(base_url("index.php/Main_controller/testGetData"));
            
        } else {
            redirect(base_url("index.php"));
        }
    }

    public function do_logout()
    {
        $this->session->sess_destroy();
        redirect(base_url("index.php"));
    }

    // public function viewInput(){
    //     $this->load->view('view_input');
    // }

    // public function inputData(){
    //     $data['nama'] = $this->input->post('nama');
    //     $data['nim'] = $this->input->post('nim');
    //     $this->model_mahasiswa->insertData($data);
    //     // redirect(base_url('index.php/mahasiswa'));
    //     $this->index();
    // }

    public function initUpload()
    {
        $config['upload_path'] = './assets/temp/';
        $config['allowed_types'] = 'mp3|mp4';
        $config['max_size']     = 5242880000000000000;
        //print_r($config);
        $this->load->library('upload', $config);

        // Alternately you can set preferences by calling the ``initialize()`` method. Useful if you auto-load the class:
        $this->upload->initialize($config);
        
    }

    public function initFtp()
    {
        $this->load->library('ftp');
        $config['hostname'] = '192.168.91.128';
        $config['username'] = 'root';
        $config['password'] = '123160035';
        $config['debug']    = TRUE;

        $this->ftp->connect($config);
    }

    public function testGetData()
    {
        $data = $this->main_model->selectAllData();
        $this->initFtp();

        $temp_loc = sys_get_temp_dir();
	// echo $temp_loc.'<br>';
        $temp_loc= str_replace("\\", "/", $temp_loc);
	// echo $temp_loc.'/sdadad<br>';
        foreach ($data as $temp) {
            //echo $temp['file_name'];
         $this->ftp->download('/mnt/assets/'.$temp['file_name'],'./assets/'.$temp['file_name'],'auto');
        }
        print_r($this->session->userdata());
        if (isset($this->session->nama)) {
            $user='admin';
        }else{
            $user='user';
        }

        $this->load->view($user."/view_home",array(
            'data' => $data
        ));

        $this->ftp->close();

        //foreach ($data as $temp) {
            //unlink('/var/www/html/assets/'.$temp['file_name']);
        //}
        
    }

    public function view_update()
    {
        // $data = $this->MainModel->selectSpecify('catatanharian_test',array(
        //     'id_catatanharian' => $value
        // ));
        // foreach ($data as $data) {
        //     $tanggal = $data['tanggal']."-".$data['bulan']."-".$data['tahun'];
        // }
        
        // $this->load->view("view_editcatatan",array(
        //     'data' => $data,
        //     'id_catatanharian' => $value,
        //     'tanggal' => $tanggal
        // ));
    }

    public function do_update()
    {
        // $id_karyawan = $_SESSION['id_karyawan'];
        // $nama = $_SESSION['nama'];
        // $tanggal=$_POST['tanggal'];
        // $nosurat = $_POST['nosurat'];
        // $namaka = $_POST['namaka'];
        // $catatan = $_POST['catatan'];
        // $jobdesc = $_POST['jobdesc'];
        // $lamp = $_FILES['lampiran']['tmp_name'];

        // if(empty($tanggal) or empty($nosurat) or empty($namaka) or empty($catatan)){
        //     echo"<script>window.alert('Maaf, kembali cek form kembali');</script>";
        //  }else{
        //      if (empty($lamp)) {
        //         $tgl = explode("-", $tanggal);

        //         $data = array(
        //             'tanggal' => $tgl[0],
        //             'bulan' => $tgl[1],
        //             'tahun' => $tgl[2],
        //             'nosurat' => $nosurat,
        //             'namakegiatan' => $namaka,
        //             'catatan' => $catatan,
        //             'nama' => $nama,
                    
        //         );


    
        //         $res = $this->MainModel->updateData('catatanharian_test',$data,array(
        //             'nama' => $nama,
        //             'id_karyawan' => $id_karyawan,
        //             'id_catatanharian' => $id_ctt
        //         ));

                
        //         if ($res>=1) {
        //             $error = 0 ;
        //         }else{
        //             $error = 1 ;
        //         }
            
        //      }else{
        //          $img = file_get_contents($lamp);
        //         $tgl = explode("-", $tanggal);

        //         $data = array(
        //             'tanggal' => $tgl[0],
        //             'bulan' => $tgl[1],
        //             'tahun' => $tgl[2],
        //             'nosurat' => $nosurat,
        //             'namakegiatan' => $namaka,
        //             'lampiran' => $img,
        //             'catatan' => $catatan,
        //             'nama' => $nama,
                    
        //         );


        //         $res = $this->MainModel->updateData('catatanharian_test',$data,array(
        //             'nama' => $nama,
        //             'id_karyawan' => $id_karyawan,
        //             'id_catatanharian' => $id_ctt
        //         ));
                
        //         if ($res>=1) {
        //             $error = 0 ;
        //         }else{
        //             $error = 1 ;
        //         }

        //      }
        //  }

        // if ($error==0) {
        //    redirect(base_url()."index.php/MainController/viewListJobdesc/");
        // }else{
        //     echo"<script>window.alert('Maaf, terjadi kesalahan! Harap cek form kembali');history.go(-1);</script>";
        // }
    }

    public function do_delete($id)
    {
	$data = $this->main_model->cek_delete('list_music',array('id' => $id));
        $cek = $data->num_rows();
        if ($cek==1) {
		$filename = $data->result_array()[0]['file_name'];
		$this->initFtp();
        	$res = $this->ftp->delete_file('/mnt/assets/'.$filename);

		if($res){
			$res = $this->main_model->deleteData('list_music',array('id' => $id));
			if($res){
				redirect(base_url("index.php"));
			}
		}
        } else {
            redirect(base_url("index.php"));
        }

    }

    public function testUpData()
    {
        $this->initUpload();
        
        $dt['title'] = $this->input->post('title');
        $dt['artist'] = $this->input->post('artist');
        $dt['categories'] = $this->input->post('categories');
        $dt['song'] = $this->input->post('song');
        $songName = $_FILES["song"]["name"];
        var_dump($_FILES);
        if (!$this->upload->do_upload('song')) {
            echo $this->upload->display_errors();
            var_dump($_FILES);
            print_r($dt);
        }else{
            // echo 'success <br>';
            // var_dump($_FILES);
            $songName = str_replace(" ", "_", $songName);
            $this->initFtp();

            $goUpload = $this->ftp->upload('./assets/temp/'.$songName,'/mnt/assets/'.$songName,'auto');
            if ($goUpload) {
                $list_data = array(
                    'title' => $dt['title'],
                    'artist' => $dt['artist'],
                    'categories' => $dt['categories'],
                    'file_name' => $songName
                );

                //var_dump($list_data);
                if($this->main_model->insertData('list_music',$list_data) > 0) {
                    $data_view = $this->main_model->selectAllData();
                    $this->load->view("admin/view_home",array(
                        'data' => $data_view
                    ));
                }else{
                    echo 'gagal insert';
                }
            }else{
                echo 'gagal upload ftp';
            }
            $this->ftp->close();
            unlink('./assets/temp/'.$songName);
        }
        
    }
    
}

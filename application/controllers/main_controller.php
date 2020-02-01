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

    public function getMusic($url)
    {

        $ch = curl_init();// persiapkan curl
        curl_setopt($ch, CURLOPT_URL, $url);// set url 
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);// return the transfer as a string 
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $response = curl_exec($ch);// $output contains the output string 
        curl_close($ch);// tutup curl 

        //header('Content-Type: application/json');
        //echo $response;
        return $response;
        
    }

    public function setMusic($data)
    {
        
        # Create a connection
        $url = 'http://192.168.91.131/api_insert_music.php?';
        $ch = curl_init();
        # Form data string
        $postString = http_build_query($data);

        # Setting our options
        curl_setopt($ch, CURLOPT_URL, $url.$postString);// set url 
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        # Get the response
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
        
    }

    public function testGetData()
    {
        $url = 'http://192.168.91.131/api_read_music.php';
        //$data = $this->main_model->selectAllData();
        $data = json_decode($this->getMusic($url), TRUE);
        $this->initFtp();

        $temp_loc = sys_get_temp_dir();
	// echo $temp_loc.'<br>';
        $temp_loc= str_replace("\\", "/", $temp_loc);
	// echo $temp_loc.'/sdadad<br>';
        $i = 0;

        while($i < count($data)) {
            //echo $data[$i]['file_name'];
          $this->ftp->download('/mnt/assets/'.$data[$i]['file_name'],'./assets/'.$data[$i]['file_name'],'auto');
         $i++;
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

	    //$data = $this->main_model->cek_delete('list_music',array('id' => $id));
        $data = json_decode($this->getMusic("http://192.168.91.131/api_search_music.php?id=".$id), TRUE);
        
        //echo $data;
        $cek = count($data);
        //$cek = $data->num_rows();
        if ($cek==1) {
		    $filename = $data[0]['file_name'];
            
    		$this->initFtp();
        	$res = $this->ftp->delete_file('/mnt/assets/'.$filename);

    		if($res){
    			$resp = json_decode($this->getMusic("http://192.168.91.131/api_delete_music.php?id=".$id), TRUE);
    			if($resp == 'fail'){
    				echo 'gagal hapus';
    			}else{
                    $url = 'http://192.168.91.131/api_read_music.php';
                    
                    $data_view = json_decode($this->getMusic($url), TRUE);
                    $this->load->view("admin/view_home",array(
                        'data' => $data_view
                    ));
                }
    		}
            //echo 'here';
        } else {
            echo 'hore';
            //redirect(base_url("index.php"));
        }
        $this->ftp->close();
    }

    public function testUpData()
    {
        $this->initUpload();
        
        $dt['title'] = $this->input->post('title');
        $dt['artist'] = $this->input->post('artist');
        $dt['categories'] = $this->input->post('categories');
        $dt['song'] = $this->input->post('song');

        
        $songName = $_FILES["song"]["name"];
        //var_dump($_FILES);
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
                $resp = json_decode($this->setMusic($list_data), TRUE);
                if($resp == "succes") {
                    //$data_view = $this->main_model->selectAllData();
                    $url = 'http://192.168.91.131/api_read_music.php';
                    
                    $data_view = json_decode($this->getMusic($url), TRUE);
                    $this->load->view("admin/view_home",array(
                        'data' => $data_view
                    ));

                }else{
                    echo 'gagal insert because : '.$resp;
                }
            }else{
                echo 'gagal upload ftp';
            }
            $this->ftp->close();
            unlink('./assets/temp/'.$songName);
        }
        
    }
    
}

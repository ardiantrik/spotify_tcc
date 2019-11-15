<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main_controller extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('main_model');
    }

	public function index(){
		//$this->load->view('view_home');
        $this->testGetData();
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

        foreach ($data as $temp) {
            $this->ftp->download('/mnt/assets/'.$temp['file_name'],'./assets/'.$temp['file_name'],'auto');
        }

        $this->load->view("admin/view_home",array(
            'data' => $data
        ));

        $this->ftp->close();
    }

    public function testUpData()
    {
        $this->initUpload();
        
        $dt['title'] = $this->input->post('title');
        $dt['artist'] = $this->input->post('artist');
        $dt['song'] = $this->input->post('song');
        $songName = $_FILES["song"]["name"];
        
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
            unlink('C:/xampp/htdocs/spotify_tcc/assets/temp/'.$songName);
        }
        
    }
    
}

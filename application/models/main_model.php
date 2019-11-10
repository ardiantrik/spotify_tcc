<?php
    class main_model extends CI_Model{
        public function __construct(){
            parent::__construct();
        }

        public function selectAllData($value='')
        {
        	$data = $this->db->get('list_music');
        	return $data->result_array();
        }

        public function insertData($tableName, $data){
            $resp = $this->db->insert($tableName,$data);
            return $resp;
        }
    }
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CarteraClientesModel extends CI_Model {
    private $sbio_db;
    private $wssp_db;
    private $empresa_db;

    public function __construct(){
        parent::__construct();
        $this->codeDB = $this->session->userdata('codedatabase');
        $this->sbio_db = $this->load->database('sbio', TRUE);
        $this->wssp_db = $this->load->database('wssp', TRUE);

        if ($this->codeDB) { 
            $this->empresa_db = $this->load->database($this->codeDB, TRUE);
        }else {
            $this->empresa_db = $this->load->database('default', TRUE);
        }
        
    }

    public function getMarcas() {
		$query = $this->empresa_db->get('INV_MARCAS');
		$resultSet = $query->result_array();
		return $resultSet;
    }

}
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

    public function generaNewCodigo() {
        $query = $this->wssp_db->query("SELECT 'CLI'+RIGHT('000000'+ISNULL(CONVERT (Varchar , (SELECT COUNT(*)+1 FROM dbo.carteracliente_nuevos)),''),6) as codigo");
        $resultset = $query->row();
        return $resultset->codigo;
    }

    public function saveCliente($data) {
       
        $this->wssp_db->insert('carteracliente_nuevos', $data);
        return $this->wssp_db->insert_id();
    }


    public function getCliente($RUC) {
		$query = $this->empresa_db->query("
        SELECT TOP 1 
            RUC, NOMBRE, FECHAALTA 
        FROM 
            dbo.COB_CLIENTES 
        WHERE RUC = '$RUC'    
       
        ");
		return $query->row();
	
       
    }


}
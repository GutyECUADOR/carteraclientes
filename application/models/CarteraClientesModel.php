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

    public function getClientesRegistrados($fechaINI, $fechaFIN, $dbcode='008', $tipoInforme='') {

        $this->empresa_db = $this->load->database($dbcode, TRUE);
        $sessionUSER = $this->session->userdata('cedula');

        if ($tipoInforme == 'porBodega') {
            $query = $this->empresa_db->query("
                SELECT 
                    TOP 1000
                    carteraClientes.*,
                    bodega.NOMBRE as BodegaName,
                    vendedor.Nombre + vendedor.Apellido as VendedorName
                FROM 
                    dbo.INV_BODEGAS AS Bodega
                INNER JOIN 
                    KAO_wssp.dbo.carteracliente_nuevos as carteraClientes on carteraClientes.bodega COLLATE Modern_Spanish_CI_AS = Bodega.CODIGO
                INNER JOIN 
                    SBIOKAO.dbo.Empleados as vendedor on vendedor.Cedula = carteraClientes.asesor 
                WHERE
                    fecha BETWEEN '$fechaINI' AND '$fechaFIN'
                    AND empresa = '$dbcode'
                ORDER BY codigo
                ");   
        }else {
            $query = $this->empresa_db->query("
                SELECT 
                    TOP 1000
                    carteraClientes.*,
                    bodega.NOMBRE as BodegaName,
                    vendedor.Nombre + vendedor.Apellido as VendedorName
                FROM 
                    dbo.INV_BODEGAS AS Bodega
                INNER JOIN 
                    KAO_wssp.dbo.carteracliente_nuevos as carteraClientes on carteraClientes.bodega COLLATE Modern_Spanish_CI_AS = Bodega.CODIGO
                INNER JOIN 
                    SBIOKAO.dbo.Empleados as vendedor on vendedor.Cedula = carteraClientes.asesor 
                WHERE
                    fecha BETWEEN '$fechaINI' AND '$fechaFIN'
                    AND empresa = '$dbcode'
                    AND asesor = '$sessionUSER'
                ORDER BY codigo
                ");   
        }
		
		return $query->result_array();
	
    }


}
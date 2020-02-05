<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CarteraCliente extends CI_Controller {


	private $codeDB;

	public function __constructor() {
		parent::__construct();
    }
    
    public function test() {
        echo 'Controller registro listo';
    }

	public function index(){

		if ($this->session->userdata('logged_in')) { 
				$marcasArray = $this->CarteraClientesModel->getMarcas();
				$this->load->view('carteraclientes_view', compact('marcasArray'));
				
			}else{
				$databasesArray = $this->usuario->getAllDataBaseList();
				$this->load->view('login', compact('databasesArray'));
		}
			
	}


	public function lista(){

		if ($this->session->userdata('logged_in')) { 
			$databasesArray = $this->usuario->getAllDataBaseList();
			$this->load->view('carteraclientes_list_view',  compact('databasesArray'));
			
		}else{
			$databasesArray = $this->usuario->getAllDataBaseList();
			$this->load->view('login', compact('databasesArray'));
		}

		
			
	}

	public function reporteExcel(){
		
	}

	public function getTopClientes(){
		$fechaINI = $this->input->get('fechaINI');
		$fechaFIN = $this->input->get('fechaFIN');
		$dbcode = $this->input->get('dbcode');
		$tipoInforme = $this->input->get('tipoInforme');

		if ($fechaINI && $fechaFIN && $dbcode) {
			$resultSet = $this->CarteraClientesModel->getClientesRegistrados($fechaINI, $fechaFIN, $dbcode, $tipoInforme);
        	echo json_encode(array('ERROR' => FALSE, 'data' => $resultSet));
		}else{
			echo json_encode(array('ERROR' => TRUE, 'data' => '', 'message' => 'No se han indicado todos los datos de busqueda'));
		}
		
	}
	

	public function register() {
		
		if (!empty($_POST)) {
			$isfacturado = $this->input->post('isfacturado');
			$isNuevoCliente = $this->input->post('isNuevoCliente');
			
			$asesor = $this->input->post('asesor');
			$asesor = $this->input->post('asesor');
			$clienteCI = $this->input->post('clienteCI');
			$apellidos = $this->input->post('apellidos');
			$nombres = $this->input->post('nombres');
			$clienteEmail = $this->input->post('clienteEmail');
			$clienteTelefono = $this->input->post('clienteTelefono');
			$clienteFecha = $this->input->post('clienteFecha');
			$clienteEstadoCivil = $this->input->post('clienteEstadoCivil');
			$clienteHijos = $this->input->post('clienteHijos');
			$sexo = $this->input->post('sexo');
			$deporte = $this->input->post('deporte');
			$tipoinformacion = $this->input->post('tipoinformacion');
			$marca = $this->input->post('marca');
			$comentarios = $this->input->post('comentarios');
		
			/*Sesion data */
			$sessionUSER = $this->session->userdata('cedula');
			$codedatabaseUSER = $this->session->userdata('codedatabase');
			$codebodegaUSER = $this->session->userdata('codebodega');
			$codigo = $this->newCodigo(); //Generar un nuevo codigo personalizado

            // Checking important data
            if ($clienteCI && $codigo && $codedatabaseUSER && $codebodegaUSER ) {

				$data = array(
					'codigo' => $codigo,
					'fecha' => date('Ymd'),
					'empresa' => $codedatabaseUSER,
					'bodega' => $codebodegaUSER,
					'isfacturado' => $isfacturado,
					'isNuevoCliente' => $isNuevoCliente,
					'asesor' => $sessionUSER,
					'clienteCI' => $clienteCI,
					'cliente' => $apellidos.' '.$nombres,
					'clienteFecha' => $clienteFecha,
					'clienteTelefono' => $clienteTelefono,
					'clienteEmail' => $clienteEmail,
					'clienteEstadoCivil' => $clienteEstadoCivil,
					'clienteHijos' => $clienteHijos,
					'sexo' => $sexo,
					'deporte' => $deporte,
					'tipoinformacion' => $tipoinformacion,
					'marca' => $marca,
					'comentarios' => $comentarios,
                );
                
                if ($ID = $this->CarteraClientesModel->saveCliente($data)) {
					
					$response = array(
						'error'     => FALSE, 
						'message'     => 'Registro exitoso.', 
						'nuevo_id'  => $ID,
						'registro'	=> $data
						);
              
					echo json_encode($response);
				}
				
			}else{
				$response = array('error'=> TRUE, 'message' => 'Lo sentimos, no se han ingresado todos los parametros, reintente');
				echo json_encode($response);
			}
			
        }else{
			$response = array('error'=> TRUE, 'message' => 'Lo sentimos, peticion nula, reintente');
			echo json_encode($response);
		}
        
		
	}
	
	public function update() {
		
		if (!empty($_POST)) {
			
			$procedimiento = $this->input->post('txt_procedimiento');
			$solucion = $this->input->post('txt_solucion');
			$autorizado = $this->input->post('txt_autorizado');
			$ticket = $this->input->post('ticket');
		
            // Checking if everything is there
            if ( $ticket && $procedimiento && $autorizado) {

                $data = array(
					'procedimiento' => $procedimiento,
					'solucion' => $solucion,
					'autorizado' => $autorizado
                );
                
                if ($ID = $this->usuario->updateTicket($data, $ticket)) {
					
					$response = array(
						'error'     => FALSE, 
						'message'     => 'Registro actualizado correctamente. ', 
						'nuevo_id'  => $ID
						);
              
					echo json_encode($response);
				}
				
			}else{
				$response = array('error'=> TRUE, 'message' => 'Lo sentimos, no se han ingresado todos los parametros, reintente');
				echo json_encode($response);
			}
			
        }else{
			$response = array('error'=> TRUE, 'message' => 'Lo sentimos, peticion nula, reintente');
			echo json_encode($response);
		}
        
		
	}

	public function generaExcel(){
		$filename = 'cartera-clientes'; // set filename for excel file to be exported
		$fechaINI = $this->input->get('fechaINI');
		$fechaFIN = $this->input->get('fechaFIN');
		$dbcode = $this->input->get('dbcode');
		$tipoInforme = $this->input->get('tipoInforme');
		$resultSet = $this->CarteraClientesModel->getClientesRegistrados($fechaINI, $fechaFIN, $dbcode, $tipoInforme);
		
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$spreadsheet->getActiveSheet()->setAutoFilter('A1:W1');
		
		/* Config Sheet */
		
		$cont = 1;
		/* Print Headers */
		$sheet->setCellValue('A'.$cont, 'ID'); //Nombre de las columnas segun DB
			$sheet->setCellValue('B'.$cont, 'CodigoRegistro')
					->setCellValue('C'.$cont, 'Fecha Registro')
					->setCellValue('D'.$cont, 'CodigoEmpresa')
					->setCellValue('E'.$cont, 'CodigoLocal')
					->setCellValue('F'.$cont, 'Local')
					->setCellValue('G'.$cont, 'Facturado')
					->setCellValue('H'.$cont, 'Nuevo Cliente')
					->setCellValue('I'.$cont, 'CI Vendedor')
					->setCellValue('J'.$cont, 'Nombre Vendedor')
					->setCellValue('K'.$cont, 'CI Cliente')
					->setCellValue('L'.$cont, 'Nombre Cliente')
					->setCellValue('M'.$cont, 'clienteFecha')
					->setCellValue('N'.$cont, 'clienteTelefono')
					->setCellValue('O'.$cont, 'clienteEmail')
					->setCellValue('P'.$cont, 'clienteEstadoCivil')
					->setCellValue('Q'.$cont, 'clienteHijos')
					->setCellValue('R'.$cont, 'sexo')
					->setCellValue('S'.$cont, 'deporte')
					->setCellValue('T'.$cont, 'tipoinformacion')
					->setCellValue('U'.$cont, 'Codigo Marca')
					->setCellValue('V'.$cont, 'marca')
					->setCellValue('W'.$cont, 'Comentarios');
			
		/* Print DATA */
		$cont = 2;
		foreach ($resultSet as $row)
		{
			$sheet->setCellValue('A'.$cont, $row['id']); //Nombre de las columnas segun DB
			$sheet->setCellValue('B'.$cont, $row['codigo']); 
			$sheet->setCellValue('C'.$cont, $row['fecha']); 
			$sheet->setCellValue('D'.$cont, $row['empresa']); 
			$sheet->setCellValue('E'.$cont, $row['bodega']); 
			$sheet->setCellValue('F'.$cont, $row['BodegaName']); 
			$sheet->setCellValue('G'.$cont, $row['isfacturado'] ? 'Facturado': 'No se le facturo');
			$sheet->setCellValue('H'.$cont, $row['isNuevoCliente'] ? 'Nuevo Cliente': 'No es nuevo cliente'); 
			$sheet->setCellValue('I'.$cont, $row['asesor']); 
			$sheet->setCellValue('J'.$cont, $row['VendedorName']);
			$sheet->setCellValue('K'.$cont, $row['clienteCI']);
			$sheet->setCellValue('L'.$cont, $row['cliente']);
			$sheet->setCellValue('M'.$cont, $row['clienteFecha']);
			$sheet->setCellValue('N'.$cont, $row['clienteTelefono']);
			$sheet->setCellValue('O'.$cont, $row['clienteEmail']);
			$sheet->setCellValue('P'.$cont, $row['clienteEstadoCivil']);
			$sheet->setCellValue('Q'.$cont, $row['clienteHijos']);
			$sheet->setCellValue('R'.$cont, $row['sexo'] == 'M' ? 'Masculino' : 'Femenino');
			$sheet->setCellValue('S'.$cont, $row['deporte']);
			$sheet->setCellValue('T'.$cont, $row['tipoinformacion']);
			$sheet->setCellValue('U'.$cont, $row['marca']);
			$sheet->setCellValue('V'.$cont, $row['marca']);
			$sheet->setCellValue('W'.$cont, $row['comentarios']);
			$cont++;
		}
		
		/* Create Document XLSX */

		$writer = new Xlsx($spreadsheet);

		/* Display or output */
		header('Content-Type: application/vnd.ms-excel'); // generate excel file
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');
		
		$writer->save('php://output');
	}
	
	public function sendEmailCliente() {

		$codigo = $this->input->get('ticket'); //Ticket KAO00000X
		$ticketINFO = $this->usuario->getTicketByCodigo($codigo);

		$email = trim($ticketINFO->emailCliente);
		$solucion = trim($ticketINFO->solucion);

		if (empty($email)) {
			$response = array('error' => TRUE, 'message' => 'Email vacio, indique correo valido para enviar notificacion' );
			echo json_encode($response);
			return;
		}

		// Remover luego de modificar los HTML Email
			/* $response = array('error' => TRUE, 'message' => 'Envio de email ha sido negado' );
			echo json_encode($response);
			return; */
		// Fin Remover

        $mail = $this->customemail->load();

        $pcID = php_uname('n'); // Obtiene el nombre del PC
        $correoCliente = $email;

        try {
            //Server settings
            $mail->SMTPDebug = false;                                 // Enable verbose debug output 0->off 2->debug
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'mail.sudcompu.net';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'noreply@kaosportcenter.com';                 // SMTP username
            $mail->Password = 'noreply2019$·';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;  
        
            //Recipients
            $mail->setFrom('noreply@kaosportcenter.com');
            $mail->addAddress($correoCliente);
            $mail->addCC('soporteweb@sudcompu.net');
           
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Notificacion de ticket # '.$codigo;
			$mail->AltBody = 'Notificacion de ticket';
			
			if (!empty($solucion)) {
				$mail->Body    =  $this->load->view('emailTicketSolucionadoHTML', '', true);
			}else {
				$mail->Body    =  $this->load->view('emailNoSolucionTickerHTML', '', true);
			}
           
            
        
            $mail->send();
            $detalleMail = 'Email enviado a : ' . $correoCliente;
            $log  = "User: ".' - '.date("F j, Y, g:i a").PHP_EOL.
                "PCid: ".$pcID.PHP_EOL.
                "Detail: ".$detalleMail.PHP_EOL.
                "-------------------------".PHP_EOL;
                //Save string to log, use FILE_APPEND to append.

                if (!is_dir('logs/')) {
                    // dir doesn't exist, make it
                    mkdir('logs/');
                  }
                file_put_contents('logs/logMailOK.txt', $log, FILE_APPEND );
            
            $response = array('error' => FALSE, 'message' => $detalleMail );
            echo json_encode($response);

        } catch (Exception $e) {
          
            
                $log  = "User: ".' - '.date("F j, Y, g:i a").PHP_EOL.
                "PCid: ".$pcID.PHP_EOL.
                "Detail: ".$mail->ErrorInfo .' No se pudo enviar correo a: ' . $correoCliente . PHP_EOL.
                "-------------------------".PHP_EOL;
                //Save string to log, use FILE_APPEND to append.
                file_put_contents('logs/logMailError.txt', $log, FILE_APPEND);
                $detalleMail = 'Error al enviar el correo. Mailer Error: '. $mail->ErrorInfo;
               
            $response = array('error' => TRUE, 'message' => $detalleMail ); 
            echo json_encode($response);
        }
    }

    public function gettickets($search='KAO'){
		$resultSet = $this->usuario->gettickets($search);
	
        echo json_encode(array('data' => $resultSet));
	}

	public function getticket($codigo){
		$resultSet = $this->usuario->getTicketByCodigo($codigo);
	
        echo json_encode(array('data' => $resultSet));
	}

	public function newCodigo(){
		$resultSet = $this->CarteraClientesModel->generaNewCodigo();
		return $resultSet;
	}
	
	
	public function getbodegas(){
		$resultSet = $this->usuario->getBodegasByEmpresa();
        return $resultSet;
    }
	
	public function verificaCliente(){
		$RUC = $this->input->get('RUC');
		$resultSet = $this->CarteraClientesModel->getCliente($RUC);
		echo json_encode($resultSet);
			
	}
	
	
	


}

<?php
$sessionUSERNAME = $this->session->userdata('nombreusuario');
?>

<!DOCTYPE html>
<!-- saved from url=(0014)about:internet -->
<html lang="es"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">

   
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url()?>assets/css/dashboard.css" rel="stylesheet">

    <!-- Plugins style -->
    <link href="<?php echo base_url()?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">
  
  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0">
      <img src="<?php echo base_url()?>assets/img/logo.png" alt="logo" width="100" height="25">
    </a>
  
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link"  href="<?php echo base_url().'login/logout'?>">
         Cerrar Sesion
      </a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1">
          <span>Usuario: <?php echo $sessionUSERNAME?></span>
        </h6>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Formularios</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
          </a>
        </h6>

        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
              Cartera Clientes 
            </a>
          </li>
        </ul>

      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
     
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3>Cartera Clientes </h3>
       
      </div>

      <div class="row">
        
        <div class="col-md-10 order-md-1 offset-md-1">
          <h4 class="mb-3">Registro de Nuevo Cliente</h4>
          <form id="registerForm">
           
            <div class="row">
              <div class="col-md-4 mb-3">
                <label>Cedula del Cliente</label>
                <input type="text" class="form-control" id="clienteCI" name="clienteCI" placeholder="170000000000" minlength="10" maxlength="13" required="">
                
              </div>
              <div class="col-md-4 mb-3">
                <label>Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" required="">
                
              </div>
              <div class="col-md-4 mb-3">
                <label>Nombres</label>
                <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres" required="">
              </div>
            </div>  

            <div class="row">
              <div class="col-md-6 mb-3">
              <label for="email">Email </label>
                <input type="email" class="form-control" id="clienteEmail" name="clienteEmail" placeholder="email@ejemplo.com" required>
              </div>
              <div class="col-md-6 mb-3">
                <label>Fecha Nacimiento <span class="text-muted">(Optional)</span></label>
                <input type="date" class="form-control" id="clienteFecha" name="clienteFecha" value="<?php echo date('Y-m-d')?>">
                
              </div>
            </div>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label>Estado Civil</label>
                <select class="custom-select d-block w-100" id="clienteEstadoCivil" name="clienteEstadoCivil" required="">
                  <option value="">Seleccione</option>
                  <option value="SOL">Soltero/a</option>
                  <option value="CAS">Casado/a</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label>Numero de Hijos</label>
                <select class="custom-select d-block w-100" id="clienteHijos" name="clienteHijos" required="">
                  <option value="">Seleccione</option>
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3+">3 o mas</option>
                </select>
                
              </div>
              <div class="col-md-4 mb-3">
                <label>Sexo</label>
                <select class="custom-select d-block w-100" id="sexo" name="sexo" required="">
                  <option value="">Seleccione</option>
                  <option value="M">Masculino</option>
                  <option value="F">Femenino</option>
                </select>
              </div>
            </div>

            <div class="mb-3">
              <label>Deporte que mas practica</label>
                <select class="custom-select d-block w-100" id="deporte" name="deporte" required="">
                  <option value="">Seleccione</option>
                  <option value="FUT">Futbol</option>
                  <option value="TEN">Tenis</option>
                  <option value="BAS">Basket</option>
                  <option value="NAT">Natacion</option>
                  <option value="CIC">Ciclismo</option>
                </select>
            </div>

            <div class="mb-3">
              <label>Informacion que le gustaria recibir</label>
              <select class="custom-select d-block w-100" id="tipoinformacion" name="tipoinformacion" required="">
                  <option value="">Seleccione</option>
                  <option >Promociones</option>
                  <option >Productos nuevos</option>
                  <option >Eventos y Actividades deportivas</option>
                  <option >Sorteos</option>
                  <option >Demostraciones</option>
                </select>
           
            </div>
           
            <div class="mb-3">
              <label>Preferencias de Marca</label>
              <select class="custom-select d-block w-100" id="marca" name="marca" required="">
                  <option value="">Seleccione</option>
                  <?php 
                        foreach ($marcasArray as $row) {
                          $codigo = $row['CODIGO']; 
                          $detalle = $row['NOMBRE']; 
                          echo "<option value='$codigo'>$detalle</option>";
                        }
                    ?>
                </select>
            </div>
           

            <div class="mb-3">
              <label>Comentarios u Observaciones</label>
              <textarea class="form-control" id="comentarios" name="comentarios"  maxlength="200" rows="3"></textarea>
            </div>
           

            <div class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Guardar nuevo cliente</button>
            </div>
           
          </form>
        </div>
      </div>
      
     
    </main>
  </div>
</div>

<!-- Mainly scripts -->
<script src="<?php echo base_url()?>assets/js/jquery-3.4.1.min.js"></script>
<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>

<!-- Toastr script -->
<script src="<?php echo base_url()?>assets/js/plugins/toastr/toastr.min.js"></script>

<!-- Page-Level Scripts -->
<script src="<?php echo base_url()?>assets/js/pages/carteraclientes.js"></script>



</body>
</html>
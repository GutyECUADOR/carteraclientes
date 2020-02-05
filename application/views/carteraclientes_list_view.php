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
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
          </a>
        </h6>

        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('carteracliente/') ?>">
              <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
              Nuevo registro de cliente
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('carteracliente/lista') ?>">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
              Lista de registros
            </a>
          </li>
        </ul>

      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
     
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3>Lista de clientes registrados </h3>
       
      </div>

      <div class="row">
        
        <div class="col-md-12 order-md-1">
          <div class="toolbar">
          <form id="filtrosForm">
            <div class="input-group">
              <div class="input-group">
                <input id="fechaINI" name="fechaINI" type="date" class="form-control" value="<?php echo date('Y-m-d')?>">
                <input id="fechaFIN" name="fechaFIN" type="date" class="form-control" value="<?php echo date('Y-m-d')?>">
                <select class="form-control m-b" id="dbcode" name="dbcode">
                  <option value="">Seleccione empresa</option>
                      <?php 
                          foreach ($databasesArray as $row) {
                              echo "<option value='$row->Codigo'>$row->Nombre</option>";
                          }
                      ?>
                    
                </select>
                <select class="form-control m-b" id="tipoInforme" name="tipoInforme">
                  <option value="porUsuario">Simple - Por Usuario</option>
                  <option value="porBodega">General - Por Local</option>
                  
                </select>
                <div class="input-group-append">
                  <button id="btnSearch" type="button" class="btn btn-primary">Buscar</button>
                  <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" id="btnGeneraExcel"> Exportar a excel</a>
                  
                </div>
              </div>
            </div>
          </form>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Fecha</th>
                  <th>Empresa</th>
                  <th>Local</th>
                  <th>Facturado</th>
                  <th>Cliente Nuevo</th>
                  <th>CI Vendedor</th>
                  <th>Nombre Vendedor</th>
                  <th>CI Cliente</th>
                  <th>Nombre Cliente</th>
                  <th>Telefono</th>
                  <th>Nacimiento</th>
                  <th>email</th>
                  <th>Comentario</th>

                </tr>
              </thead>
              <tbody id="tableNuevosClientes">
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
     
    </main>
  </div>
</div>

<!-- Mainly scripts -->
<script src="<?php echo base_url()?>assets/js/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>

<!-- Toastr script -->
<script src="<?php echo base_url()?>assets/js/plugins/toastr/toastr.min.js"></script>

<!-- Page-Level Scripts -->
<script src="<?php echo base_url()?>assets/js/pages/carteraclientes_list.js"></script>



</body>
</html>
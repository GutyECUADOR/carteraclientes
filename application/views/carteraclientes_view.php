<!DOCTYPE html>
<!-- saved from url=(0014)about:internet -->
<html lang="es"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    
    
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url()?>assets/css/dashboard.css" rel="stylesheet">
  <style type="text/css">/* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style></head>
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
        <h1 class="h2">Cartera Clientes</h1>
       
      </div>

      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Compras realizadas</span>
           
          </h4>
          <ul class="list-group mb-3">
            
            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Promo code</h6>
                <small>EXAMPLECODE</small>
              </div>
              <span class="text-success">-$5</span>
            </li>
           
          </ul>

         
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Registro de Nuevo Cliente</h4>
          <form>
            <div class="mb-3">
                <label for="username">Asesor KAO</label>
                <div class="input-group">
                  
                  <input type="text" class="form-control" id="username" placeholder="Cedula del Asesor" required="">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Sin identificar</span>
                  </div>
                </div>
              </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label>Nombres y apellidos</label>
                <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Fecha Nacimiento <span class="text-muted">(Optional)</span></label>
                <input type="date" class="form-control" id="lastName" placeholder="" value="">
                
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email </label>
              <input type="email" class="form-control" id="email" placeholder="email@ejemplo.com" required>
            </div>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label>Estado Civil</label>
                <select class="custom-select d-block w-100" id="estadocivil" required="">
                  <option value="">Seleccione</option>
                  <option>Soltero/a</option>
                  <option>Casado/a</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label>Numero de Hijos</label>
                <select class="custom-select d-block w-100" id="numhijos" required="">
                  <option value="">Seleccione</option>
                  <option>0</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3 o mas</option>
                </select>
                
              </div>
              <div class="col-md-4 mb-3">
                <label>Sexo</label>
                <select class="custom-select d-block w-100" id="deporte" required="">
                  <option value="">Seleccione</option>
                  <option>Masculino</option>
                  <option>Femenino</option>
                </select>
              </div>
            </div>

            <div class="mb-3">
              <label>Deporte que mas practica</label>
                <select class="custom-select d-block w-100" id="deporte" required="">
                  <option value="">Seleccione</option>
                  <option>Futbol</option>
                  <option>Tenis</option>
                  <option>Basket</option>
                  <option>Natacion</option>
                  <option>Ciclismo</option>
                </select>
            </div>

            <div class="mb-3">
              <label>Informacion que le gustaria recibir</label>
              <input type="text" class="form-control" id="tipoinformacion" required>
            </div>
           
            <div class="mb-3">
              <label>Preferencias de Marca</label>
              <input type="text" class="form-control" id="preferenciaMarca" required>
            </div>
           

            <div class="mb-3">
              <label>Comentarios u Observaciones</label>
              <textarea class="form-control" id="comentarios" rows="3"></textarea>
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

</body></html>
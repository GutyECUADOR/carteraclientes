<?php

?>

<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login · KAO Sport</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="icon" href="<?php echo base_url()?>assets/img/favicons/favicon.ico">
    
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
    <link href="<?php echo base_url()?>assets/css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">

    
    <?php echo form_open('login/checklogin', array('id' => 'registerForm', 'autocomplete' => 'off', 'class'=> 'form-signin',  'role'=> 'form' )); ?>
    
        <img src="<?php echo base_url()?>assets/img/logo_dark.png" alt="logo" width="200" height="50">
        <h1 class="h3 mb-3 font-weight-normal">Ingrese al sistema</h1>

        <?php 
            if($this->session->flashdata('errormassage')){
                echo '<div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        '.$this->session->flashdata('errormassage').'
                    </div>';
            }
        ?>

        <div class="form-group">
            <select class="form-control m-b" id="tipoinstitucion" name="tipoinstitucion" required="">
                <option value="">Seleccione empresa por favor</option>
                    <?php 
                        foreach ($databasesArray as $row) {
                            echo "<option value='$row->Codigo'>$row->Nombre</option>";
                        }
                    ?>
            </select>
            <select class="form-control m-b" id="bodega" name="bodega" required="">
                <option value="">Seleccione local por favor</option>
                  
            </select>
        </div>
        <label class="sr-only">Usuario</label>
        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario" required autofocus>
        </br>
        <button class="btn btn-lg btn-primary btn-block " type="submit">Ingresar</button>
        <a class="btn btn-lg btn-danger btn-block" href="../" role="button">Regresar</a>
        <p class="mt-5 mb-3 text-muted">Derechos reservados &copy; <?php echo date('Y')?></small></p>
    </form>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url()?>assets/js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>

    <!-- Toastr script -->
    <script src="<?php echo base_url()?>assets/js/plugins/toastr/toastr.min.js"></script>

    <!-- Page-Level Scripts -->
    <script src="<?php echo base_url()?>assets/js/pages/login.js"></script>
</body>
</html>
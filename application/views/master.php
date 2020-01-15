<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="<?php echo base_url(); ?>css/dashboard.css" rel="stylesheet" id="bootstrap-css">
	<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" id="bootstrap-css">
	<script src="<?php echo base_url(); ?>js/jquery-3.4.1.min.js"></script>
	<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
	<!--<script src="<?php echo base_url(); ?>js/popcalendar.js"></script>-->
	<script src="<?php echo base_url(); ?>js/script_flash.js"></script>
	<script src="<?php echo base_url(); ?>js/cor_fundo.js"></script>
	<script src="<?php echo base_url(); ?>js/desenpenho.js"></script>
	<script src="<?php echo base_url(); ?>js/angularjs.min.js"></script>
	<script src="<?php echo base_url(); ?>js/chart.min.js"></script>	
	<script src="<?php echo base_url(); ?>js/angular-chart.min.js"></script>
	<script src="<?php echo base_url(); ?>js/chartjs-plugin-annotation.min.js"></script>	
	<script src="<?php echo base_url(); ?>js/app/app.js"></script>	
	<script src="<?php echo base_url(); ?>js/app/service/serviceRelatorioAjax.js"></script>
	<script src="<?php echo base_url(); ?>js/app/controller/desenpenhoController.js"></script>

</head>
<body>
<div class="container-fluid">
	<div class="row">
	<div class="col-md-11">
		<hr>
	</div>
		<div class="col-md-1">
			<a href="http://www.agence.com.br/" target="_blank" class="pull-right">
				<img alt="" src="http://localhost:8080/prueba_dev/images/logo.gif" border="0">
			</a>
		</div>		
	</div>
	<div class="row" style="border-top: 1px solid;">
		<div class="col-md-6" >
			<nav class="navbar navbar-icon-top navbar-expand-lg">
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"><i class="fa fa-sliders"></i></span>
			  </button>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav mr-auto">

			      <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          <i class="fa fa-home"></i>
			          Agence
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          <a class="dropdown-item" href="#">Undefined</a>
			        </div>
			      </li>
			      <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          <i class="fa fa-tasks"></i>
			          Projects
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          <a class="dropdown-item" href="#">Undefined</a>
			        </div>
			      </li>
			      <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          <i class="fa fa-edit"></i>
			          Administrativo
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          <a class="dropdown-item" href="#">Undefined</a>
			        </div>
			      </li> 
			      <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          <i class="fa fa-building"></i>
			          Comercial
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          <a class="dropdown-item" href="#">Undefined</a>
			        </div>
			      </li> 
			      <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          <i class="fa fa-address-card"></i>
			          Financeiro
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          <a class="dropdown-item" href="#">Undefined</a>
			        </div>
			      </li>  
			      <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          <i class="fa fa-user"></i>
			          Usuario
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          <a class="dropdown-item" href="#">Undefined</a>
			        </div>
			      </li>  
			      <li class="nav-item active">
			        <a class="nav-link" href="#">
			          <i class="fa fa-sign-out"></i>
			          Salir
			          <span class="sr-only">(current)</span>
			          </a>
			      </li>                                    

			    </ul>
			</nav>		
		</div>	
	</div>
</div>

<?php $this->load->view($content); ?>	
</body>
</html>



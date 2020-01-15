<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desenpenho extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		$this->load->helper('url');
    	$data = array('content'=> "index_desempenho" );
    	$this->load->view('master',$data);
	}

	/**
	 *
	 * Metodo que obtiene la lista de consultores desde una llamada ajax
	 *
	 */
	
	public function ajax_obtener_consultores()
	{
		$this->load->model('DesenpenhoModel_model');

		$model = new DesenpenhoModel_model();

		$consultores = $model->obtener_consultores();

    	header('Content-Type: application/json');
    	echo json_encode( $consultores );

	}

	/**
	 *
	 * Ajax que es usado desde la vista para retornar las ganancias de los empleados seleccionados
	 *
	 */
	
	public function ajax_relatorio()
	{
		$parametros = array();
		//obtengo la lista de usuarios y los separo en coma
		$usuarios = $_GET['usuarios'];
		$desde = $_GET['desde'];
		$hasta = $_GET['hasta'];		

		$parametros["usuarios"] = $usuarios;
		$parametros["desde"] = $desde;
		$parametros["hasta"] = $hasta;

		$this->load->model('DesenpenhoModel_model');
		$model = new DesenpenhoModel_model();
		$relatorio = $model->obtener_relatorio($parametros);
		$arrayJson = array();
			$meses = json_decode(MESES);

		foreach ($relatorio as $value) {

			$arrayJson[$value->co_usuario]["nombre"] = $value->no_usuario;

			if(!isset($arrayJson[$value->co_usuario]["fila"]) || count($arrayJson[$value->co_usuario]["fila"])==0){
				$arrayJson[$value->co_usuario]["fila"] = array();
			}
			//}else{
			$receita_liquida = ($value->receita_liquida > 0)? "R$ ". number_format($value->receita_liquida, 2,",","."):"-R$ ". number_format( $value->receita_liquida, 2, ",",".");
			$custo_fixo = ($value->custo_fixo > 0)? "R$ ". number_format($value->custo_fixo, 2,",","."):"-R$ ". number_format($value->custo_fixo, 2,",",".");
			$comissao = ($value->comissao > 0)? "R$ ". number_format($value->comissao, 2,",","."):"-R$ ". number_format($value->comissao, 2,",",".");
			$lucro = ($value->lucro > 0)? "R$ ". number_format($value->lucro, 2,",","."):"-R$ ". number_format($value->lucro, 2, ",",".");



			array_push($arrayJson[$value->co_usuario]["fila"], array(
																	"Periodo"=> $meses->{date('m',strtotime($value->data_emissao ))}." de " .date('Y',strtotime($value->data_emissao )), 
																	"receita_liquida"=> $receita_liquida,
																	"custo_fixo" => $custo_fixo,
																	"comissao" => $comissao,
																	"lucro"=> $lucro 					
																));


			//Obtengo el saldo resultante
			$parametros["usuarios"] = "'".$value->co_usuario."'";

			$saldo = $model->obtener_saldo($parametros);
			foreach ($saldo as $value) {
				$receita_liquida = ($value->receita_liquida > 0)? "R$ ". number_format($value->receita_liquida, 2,",","."):"-R$ ". number_format($value->receita_liquida, 2,",",".");
				$custo_fixo = ($value->custo_fixo > 0)? "R$ ". number_format($value->custo_fixo, 2,",","."):"-R$ ". number_format($value->custo_fixo, 2,",",".");
				$comissao = ($value->comissao > 0)? "R$ ". number_format($value->comissao, 2,",","."):"-R$ ". number_format($value->comissao, 2,",",".");
				$lucro = ($value->lucro > 0)? "R$ ". number_format($value->lucro, 2,",","."):"-R$ ". number_format($value->lucro, 2,",",".");

				$arrayJson[$value->co_usuario]["saldo"] = array(
					"receita_liquida"=> $receita_liquida,
					"custo_fixo" => $custo_fixo,
					"comissao" => $comissao,
					"lucro"=> $lucro 					
				);
			}
			//}

		}


   		//add the header here
    	header('Content-Type: application/json');
    	echo json_encode( $arrayJson );
	}

	/**
	*
	* 
	*
	*/
	public function view_relatorico()
	{
		$this->load->helper('url');
		$this->load->view('relatorico');
	}	

	public function ajax_obtener_grafico()
	{
		$jsonResult = array();
		$desde = $_GET["desde"];
		$hasta = $_GET["hasta"];

		$usuarios = $_GET["usuarios"];

		$this->load->model('DesenpenhoModel_model');
		$model = new DesenpenhoModel_model();
		$meses = json_decode(MESES2, true);
		$resultRango = $model->obtener_rango_barra($usuarios, $desde, $hasta);
		$rango = array();
		foreach ($meses as $key=> $value) {
			# code...
			$rango[] = $value;
		}

		/*Obtengo la lista de series disponibles*/
		$series = array();
		$arrayUsuarios = explode(",", $usuarios);

		$matrisSeries = array();

		foreach ($arrayUsuarios as $item) {
			# code...
            $series[] = $model->obtener_nombre_usuario($item);
            $parametros = array();
            $parametros["nombre"] = $item;
            $parametros["desde"] = $desde;
            $parametros["hasta"] = $hasta;

			$result = $model->obtener_graficos_barra($parametros);

			$rowSerie = array();

				foreach ($rango as $item2) {

				$valor = "0";				

			foreach ($result as $row) {

					$fechaAux = $meses[$row->mes];
					if( $fechaAux == $item2){
						$valor = number_format( $row->receita_liquida, 2, ".","");
						break;
					}
				}
				$rowSerie[] = $valor;
			}
			$matrisSeries[] = $rowSerie;

		}

		$jsonResult["rangoFecha"] = $rango;
		$jsonResult["series"] = $series;
		$jsonResult["matris"] = $matrisSeries;

		$contadorPromedio = 0;
		foreach ($matrisSeries as $item) {
			$promedio = array_sum($item)/count($item);
			$contadorPromedio = $contadorPromedio+$promedio;
		}

		$jsonResult["promedio"] = number_format( $contadorPromedio, 2, ".","");

    	header('Content-Type: application/json');
    	echo json_encode( $jsonResult );		

	}	

	public function ajax_obtener_grafico_pizza()
	{

		$jsonResult = array();
		$desde = $_GET["desde"];
		$hasta = $_GET["hasta"];
		$usuarios = $_GET["usuarios"];

		$this->load->model('DesenpenhoModel_model');

		$model = new DesenpenhoModel_model();

		$result = $model->obtener_graficos_pizza($usuarios, $desde, $hasta);
		$usuario = array();
		$totales = array();

		foreach ($result as $row) {
			# code...
			$usuario[] = $row->no_usuario;
			$totales[] = number_format( $row->receita_liquida, 2, ".","");

		}


		$jsonResult["usuarios"] = $usuario;
		$jsonResult["totales"] = $totales;
		$jsonResult["suma"] = array_sum($totales);


    	header('Content-Type: application/json');
    	echo json_encode( $jsonResult );	
	}

}

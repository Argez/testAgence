<?php

 class DesenpenhoModel_model extends CI_Model 
 {

 	function __construct() {
    parent::__construct();
	}


 		public function obtener_consultores()
 		{
 			# code...

        	$query = $this->db->query("select a.co_usuario,a.no_usuario, b.co_sistema from cao_usuario a join  permissao_sistema b on a.co_usuario= b.co_usuario
									   where b.co_sistema = 1 and b.in_ativo = 'S' and b.co_tipo_usuario in( 0,1, 2); ");

                return $query->result();


 		}


        public function obtener_relatorio($parametros)
        {

        	$desde = $parametros["desde"];
        	$hasta = $parametros["hasta"];

        	$query = $this->db->query("select f.*, f.receita_liquida-(f.comissao+f.custo_fixo) as lucro
										from ( 
										select sum(a.valor-(a.valor*a.total_imp_inc/100)) as receita_liquida,
											   sum(((a.valor-(a.valor*a.TOTAL_IMP_INC/100))*(a.COMISSAO_CN/100))) as comissao,
										       e.brut_salario as custo_fixo,
										       a.data_emissao, 
										       d.co_usuario,
										       h.no_usuario, year(a.data_emissao) as anho, month(a.data_emissao) as mes        
										from cao_fatura a join cao_cliente b on a.co_cliente = b.co_cliente
														  join cao_sistema c on a.co_sistema = c.co_sistema
										                  join cao_os d on a.co_os = d.co_os      
										                  join cao_salario e on d.co_usuario = e.co_usuario
										                  join cao_usuario h on h.co_usuario = d.co_usuario
										where d.co_usuario in (".$parametros["usuarios"].") and concat(year(a.data_emissao), month(a.data_emissao)) between ".$desde." and ".$hasta." 
										group by d.co_usuario, anho, mes 
										order by d.co_usuario) as f;");

                return $query->result();
        }

        public function obtener_saldo($parametros)
        {
    	    $desde = $parametros["desde"];
    	    $hasta = $parametros["hasta"];

	    /*	$query = $this->db->query("select sum(g.receita_liquida) as receita_liquida, sum(g.comissao) as comissao, sum(g.custo_fixo) as custo_fixo,sum(g.lucro) as lucro, g.data_emissao, g.co_usuario
										from(
										select f.*, f.receita_liquida-(f.comissao+f.custo_fixo) as lucro
										from ( 
										select sum(a.valor-(a.valor*a.total_imp_inc/100)) as receita_liquida,
											   ((a.valor-(a.valor*a.TOTAL_IMP_INC/100))*(a.COMISSAO_CN/100)) as comissao,
										       e.brut_salario as custo_fixo,
										       a.data_emissao, 
										       d.co_usuario, year(a.data_emissao) as anho, month(a.data_emissao) as mes              
										from cao_fatura a join cao_cliente b on a.co_cliente = b.co_cliente
														  join cao_sistema c on a.co_sistema = c.co_sistema
										                  join cao_os d on a.co_os = d.co_os      
										                  join cao_salario e on d.co_usuario = e.co_usuario
										where d.co_usuario in (".$parametros["usuarios"].") and concat(year(a.data_emissao), month(a.data_emissao)) between ".$desde." and ".$hasta."  
										group by anho, mes 
										order by d.co_usuario) as f
										) as g
										group by g.co_usuario;");*/


	    	$query = $this->db->query("select sum(m.receita_liquida) as receita_liquida, sum(m.comissao) as comissao, sum(m.custo_fixo) as custo_fixo,sum(m.lucro) as lucro, m.co_usuario                                        
from                                        
(select f.*, f.receita_liquida-(f.comissao+f.custo_fixo) as lucro
										from ( 
										select sum(a.valor-(a.valor*a.total_imp_inc/100)) as receita_liquida,
											   sum(((a.valor-(a.valor*a.TOTAL_IMP_INC/100))*(a.COMISSAO_CN/100))) as comissao,
										       e.brut_salario as custo_fixo,
										       a.data_emissao, 
										       d.co_usuario,
										       h.no_usuario, year(a.data_emissao) as anho, month(a.data_emissao) as mes        
										from cao_fatura a join cao_cliente b on a.co_cliente = b.co_cliente
														  join cao_sistema c on a.co_sistema = c.co_sistema
										                  join cao_os d on a.co_os = d.co_os      
										                  join cao_salario e on d.co_usuario = e.co_usuario
										                  join cao_usuario h on h.co_usuario = d.co_usuario
										where d.co_usuario in (".$parametros["usuarios"].") and concat(year(a.data_emissao), month(a.data_emissao)) between ".$desde." and ".$hasta." 
										group by anho, mes 
										order by d.co_usuario) as f) m  
order by m.co_usuario;    ");




            return $query->result();
        }        


		public function obtener_graficos_barra($parametros)
		{

    	    $desde = $parametros["desde"];
    	    $hasta = $parametros["hasta"];
    	    $usuario = $parametros["nombre"];    	    

	    	$query = $this->db->query("select g.receita_liquida as receita_liquida, year(g.data_emissao) as anho,  month(g.data_emissao) as mes, g.co_usuario
										from(
										select f.*, f.receita_liquida-(f.comissao+f.custo_fixo) as lucro
										from ( 
										select sum(a.valor-(a.valor*a.total_imp_inc/100)) as receita_liquida,
											   sum(((a.valor-(a.valor*a.TOTAL_IMP_INC/100))*(a.COMISSAO_CN/100))) as comissao,
										       e.brut_salario as custo_fixo,
										       a.data_emissao, 
										       d.co_usuario, year(a.data_emissao) as anho, month(a.data_emissao) as mes             
										from cao_fatura a join cao_cliente b on a.co_cliente = b.co_cliente
														  join cao_sistema c on a.co_sistema = c.co_sistema
										                  join cao_os d on a.co_os = d.co_os      
										                  join cao_salario e on d.co_usuario = e.co_usuario
										where d.co_usuario in ('".$usuario."') and concat(year(a.data_emissao), month(a.data_emissao)) between ".$desde." and ".$hasta."
										group by d.co_usuario, anho, mes 										  
										order by d.co_usuario) as f
										) as g
                                        group by anho, mes
										order by anho, mes asc;");

            return $query->result();


			return array();
		}

		public function obtener_rango_barra($usuarios, $desde, $hasta)
		{

	    	$query = $this->db->query("select g.receita_liquida as receita_liquida, year(g.data_emissao) as anho,  month(g.data_emissao) as mes, g.co_usuario
										from(
										select f.*, f.receita_liquida-(f.comissao+f.custo_fixo) as lucro
										from ( 
										select a.valor-(a.valor*a.total_imp_inc/100) as receita_liquida,
											   sum(((a.valor-(a.valor*a.TOTAL_IMP_INC/100))*(a.COMISSAO_CN/100))) as comissao,
										       e.brut_salario as custo_fixo,
										       a.data_emissao, 
										       d.co_usuario, year(a.data_emissao) as anho, month(a.data_emissao) as mes              
										from cao_fatura a join cao_cliente b on a.co_cliente = b.co_cliente
														  join cao_sistema c on a.co_sistema = c.co_sistema
										                  join cao_os d on a.co_os = d.co_os      
										                  join cao_salario e on d.co_usuario = e.co_usuario
										where d.co_usuario in ('".$usuarios."') and concat(year(a.data_emissao), month(a.data_emissao)) between ".$desde." and ".$hasta." 
									    group by d.co_usuario, anho, mes 									 
										order by d.co_usuario) as f
										) as g
                                        group by anho, mes
										order by anho, mes asc;");


            return $query->result();
	
	}



		public function obtener_graficos_pizza($usuarios, $desde, $hasta)
		{    	    

	    	$query = $this->db->query("select sum(g.receita_liquida) as receita_liquida, g.co_usuario, g.no_usuario
										from(
										select f.*, f.receita_liquida-(f.comissao+f.custo_fixo) as lucro
										from ( 
										select sum(a.valor-(a.valor*a.total_imp_inc/100)) as receita_liquida,
											   sum(((a.valor-(a.valor*a.TOTAL_IMP_INC/100))*(a.COMISSAO_CN/100))) as comissao,
										       e.brut_salario as custo_fixo,
										       a.data_emissao, 
										       d.co_usuario,
										       h.no_usuario, year(a.data_emissao) as anho, month(a.data_emissao) as mes       
										from cao_fatura a join cao_cliente b on a.co_cliente = b.co_cliente
														  join cao_sistema c on a.co_sistema = c.co_sistema
										                  join cao_os d on a.co_os = d.co_os      
										                  join cao_salario e on d.co_usuario = e.co_usuario
										                  join cao_usuario h on d.co_usuario = h.co_usuario
										where d.co_usuario in (".$usuarios.") and concat(year(a.data_emissao), month(a.data_emissao)) between ".$desde." and ".$hasta."
										group by d.co_usuario, anho, mes  
										order by d.co_usuario) as f
										) as g
										group by g.co_usuario;");

            return $query->result();

		}


		public function obtener_nombre_usuario($cod_usuario)
		{
	    	$query = $this->db->query("select no_usuario from cao_usuario where co_usuario ='".$cod_usuario."';");

            $result = $query->result();

            return $result[0]->no_usuario;

		}


}
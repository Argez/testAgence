<div class="container-fluid" ng-app="desenpenho">
<div ng-controller="relatorio">	
  <div class="row" >

		<div class="col-sm-12">
			<td class="index" style="PADDING-RIGHT: 10px; PADDING-LEFT: 10px; PADDING-BOTTOM: 10px; PADDING-TOP: 10px" valign="top">
			<table border="0" width="100%" cellspacing="0" cellpadding="0" id="tableParam">
	            <tbody>
	            <tr>
	                  <!--
	    
	    Para as abas ficarem com o visual apresentado na p&aacute;gina, &eacute; necess&aacute;rio colocar os inputs
	    dentro de uma tabela. Essa tabela faz o papel de grade e gera algumas linhas pra completar
	    o layout. 
	    
	    Importante:
	    Note the a c&eacute;lula onde consta o botao principal (selecionado) n&atilde;o leva a classe CEL_TAB.
	    
	    Recomendo criar uma funcao/classe para gerar essas Abas com esse layout.
	    
	    -->
	                  <td nowrap="" valign="bottom" align="center" class="cel_tab" height="35"><input type="submit" value="" name="nothing2" class="nothing">
	&nbsp;&nbsp;	</td>
					  <form action="con_desempenho.htm"></form>
	                  <td nowrap="" valign="bottom" align="center">
	                  	<span class="cel_tab">
	                    	<input type="submit" value="Por Consultor" name="act22223" class="tab_current">
	                  	</span>
	                  </td>
					  
	                  <td nowrap="" valign="bottom" align="center" class="cel_tab">&nbsp;&nbsp;</td>
					  <form action="con_desempenho_aba_cliente.htm"></form>
	                  <td nowrap="" valign="bottom" align="center"><input type="submit" value="Por Cliente" name="act2" class="tab">                  </td>
					  
	                  <td nowrap="" valign="bottom" align="center" class="cel_tab">&nbsp;&nbsp;</td>
					  <form action="cadastro_boleto_carregado_cancelado.htm"></form>
	                  <td nowrap="" valign="bottom" align="center" class="cel_tab">&nbsp;</td>
					  
	                  <td nowrap="" valign="bottom" align="center" class="cel_tab">&nbsp;&nbsp;</td>
	                  <td nowrap="" valign="bottom" align="center" class="cel_tab">&nbsp;</td>
	                  <td nowrap="" valign="bottom" align="center" class="cel_tab">&nbsp;&nbsp;</td>
	                  <td nowrap="" valign="bottom" align="center" class="cel_tab">&nbsp;</td>
	                  <td nowrap="" valign="bottom" align="center" class="cel_tab">&nbsp;&nbsp;</td>
	                  <td nowrap="" valign="bottom" align="center" class="cel_tab">&nbsp;</td>
	                  <td valign="bottom" class="cel_tab" width="100%">&nbsp;</td>
	             </tr>
	           </tbody>
		    </table>
			<br>
          <table width="100%" cellpadding="3" cellspacing="1" bgcolor="#cccccc" id="pesquisaAvancada">
            <tbody>
              <tr bgcolor="#fafafa">
                <td width="10%" nowrap="nowrap" bgcolor="#efefef"><div align="right"><strong>Período</strong></div></td>
                <td><font color="black">
                  <select name="select5" ng-model="mesDesde" ng-init="mesDesde='1'" ng-options="item.id as item.text for item in listaMeses">
                  </select>
                  <select name="select" ng-model="anhoDesde" ng-init="anhoDesde='2003'" ng-options="item.id as item.text for item in listaAnhos">
                  </select>
                  a
                  <select name="select3" ng-model="mesHasta" ng-init="mesHasta='1'" ng-options="item.id as item.text for item in listaMeses"></select>
                  <select name="select4" ng-model="anhoHasta" ng-init="anhoHasta='2003'" ng-options="item.id as item.text for item in listaAnhos">
                  </select>
                </font></td>
                <td width="20%" rowspan="2"><div align="center"><font color="black">
                      <input style="width: 50%; margin: 2%; BORDER-RIGHT: 1px outset; BORDER-TOP: 1px outset; FONT-SIZE: 8pt; BACKGROUND-POSITION-Y: center; LEFT: 120px; BACKGROUND-IMAGE: url(<?php echo base_url(); ?>images/icone_relatorio.png); BORDER-LEFT: 1px outset; BORDER-BOTTOM: 1px outset; BACKGROUND-REPEAT: no-repeat; FONT-FAMILY: Tahoma, Verdana, Arial; HEIGHT: 22px; BACKGROUND-COLOR: #CCCCCC" type="button" name="btSalvar22" ng-click="buttonRelatorio()" value="Relatorio" />
                    <input style="width: 50%; margin: 2%; BORDER-RIGHT: 1px outset; BORDER-TOP: 1px outset; FONT-SIZE: 8pt; BACKGROUND-POSITION-Y: center; LEFT: 120px; BACKGROUND-IMAGE: url(<?php echo base_url(); ?>images/icone_grafico.png); BORDER-LEFT: 1px outset; BORDER-BOTTOM: 1px outset; BACKGROUND-REPEAT: no-repeat; FONT-FAMILY: Tahoma, Verdana, Arial; HEIGHT: 22px; BACKGROUND-COLOR: #CCCCCC" type="button" value="Gráfico" ng-click="botonGraficoBarra()" name="btSalvar222">
                    <input style=" width: 50%; margin: 2%; BORDER-RIGHT: 1px outset; BORDER-TOP: 1px outset; FONT-SIZE: 8pt; BACKGROUND-POSITION-Y: center; LEFT: 120px; BACKGROUND-IMAGE: url(<?php echo base_url(); ?>images/icone_pizza.png); BORDER-LEFT: 1px outset; BORDER-BOTTOM: 1px outset; BACKGROUND-REPEAT: no-repeat; FONT-FAMILY: Tahoma, Verdana, Arial; HEIGHT: 22px; BACKGROUND-COLOR: #CCCCCC" type="button" value="Pizza" name="btSalvar222" ng-click="botonGraficoCircular()">
                  
                </font></div></td>
              </tr>
              <tr bgcolor="#fafafa">
                <td nowrap="nowrap" bgcolor="#efefef"><div align="right"><strong>Consultores</strong></div></td>
                <td>
	                <table align="center">
	                    <tbody>
		                    <tr>
		                      <td>
		                      <select multiple="" size="8" name="selectConsultor" id="selectConsultor" ng-model="selectConsultor" style="width:30em;" ng-options="item.no_usuario for item in jsonConsultores track by item.co_usuario">
		                        </select>
		                      </td>
		                      <td align="center" valign="middle"><input name="button" type="button" ng-click="botonAgregar()" value=">>">
		                          <br>
		                          <input name="button" type="button"  value="<<" ng-click="botonQuitar()">
		                      </td>
		                      <td><select multiple="" size="8" name="list2" id="list2" style="width:30em;" ng-model="selectConsultor2" ng-options="item.no_usuario for item in consultoresSeleccionados track by item.co_usuario"">
		                        </select>
		                          <input type="hidden" name="lista_analista" value="">
		                      </td>
		                    </tr>
	                	</tbody>
	                </table>
                </td>
              </tr>
            </tbody>
          </table>
			</td>	
		</div>
	</div>
  <br>

  <div class="row" >
    <div class="col-sm-12" ng-show="jsonRelatorio.length > 0">

      <div ng-repeat="element in jsonRelatorio">
        <table cellspacing=1 cellpadding=3 width="100%" bgcolor=#cccccc  id="pesquisaAvancada">
          <tbody>
            <tr bgcolor=#efefef>
              <td colspan=5><span class="style3">{{element.nombre}}</span> </td>
            </tr>
            <tr bgcolor=#fafafa>
              <td nowrap><div align="center"><strong>Per&iacute;odo</strong></div></td>
              <td><div align="center"><strong>Receita L&iacute;quida </strong></div></td>
              <td><div align="center"><strong>Custo Fixo </strong></div></td>
              <td><div align="center"><strong>Comiss&atilde;o</strong></div></td>
              <td><div align="center"><strong>Lucro</strong></div></td>
            </tr>
            <tr bgcolor=#fafafa ng-repeat="row in element.fila">
              <td nowrap>{{row.Periodo}}</td>
              <td><div align="right">{{row.receita_liquida}}</div></td>
              <td><div align="right">{{row.custo_fixo}}</div></td>
              <td><div align="right">{{row.comissao}}</div></td>
              <td><div align="right">
                <font ng-show="row.lucro.indexOf('-') === -1">{{row.lucro}}</font>
                <font color="#FF0000" ng-style="styleLucro" ng-show="row.lucro.indexOf('-') !== -1">{{row.lucro}}</font></div>
              </td>
            </tr>
            <tr bgcolor=#efefef>
              <td nowrap bgcolor="#efefef"><strong>SALDO</strong></td>
              <td><div align="right"><font color="#000000">{{element.saldo.receita_liquida}}</font></div></td>
              <td><div align="right"><font color="#000000">{{element.saldo.custo_fixo}}</font></div></td>
              <td><div align="right"><font color="#000000">{{element.saldo.comissao}}</font></div></td>
              <td><div align="right"><font color="#0000FF">{{element.saldo.lucro}}</font></div></td>
            </tr>            
          </tbody>
        </table>
        <br>        
      </div> 
    </div>
  </div>
  <div ng-show="data.length> 0">
  <h3 style="text-align: center;">{{desdeSeleccion}} de {{anhoDesde}} a {{hastaSeleccion}} de {{anhoHasta}}</h3>
    <canvas id="bar" class="chart chart-bar" height="300px" width="600px" 
      chart-data="data" chart-labels="labels" chart-series="series" chart-options="options" chart-dataset-override="datasetOverride" >
    </canvas>    
  </div>
  <div ng-show="data2.length> 0">
  <h3 style="text-align: center;">{{desdeSeleccion}} de {{anhoDesde}} a {{hastaSeleccion}} de {{anhoHasta}}</h3>  
    <canvas id="pie" class="chart chart-pie"
      chart-data="data2" chart-labels="labels2" chart-options="options">
    </canvas>    
  </div>

</div>  
</div>
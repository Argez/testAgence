var desenpenhoController = angular.module("desenpenho");

desenpenhoController.service("RelatorioAjaxSer", ["$http", function(h){
		this.jsonRelatorio = [];

	this.ObtenerRelatorio = function()
	{

		this.jsonRelatorio = [];

		h.get("/prueba_dev/index.php/desenpenho/ajax_relatorio").then(function(data){
		 	this.jsonRelatorio = angular.copy(data.data);
		}).catch(function(err){
		 	//this.jsonRelatorio = [];
			
		});
		console.log(this.jsonRelatorio);
		//return resultado;
	}

}]);
var desenpenhoController = angular.module("desenpenho");

desenpenhoController.controller("relatorio",["$http","$scope", "$filter", function( h, s, f){

	/*Declaro la lista de meses abreviados*/
	s.listaMeses = [
          {id : "1", text : "Jan", textoLargo: "Janeiro"},
          {id : "2", text : "Fev", textoLargo: "Fevereiro"},
          {id : "3", text : "Mar", textoLargo: "Março"},
          {id : "4", text : "Abr", textoLargo: "Abril"},
          {id : "5", text : "Mai", textoLargo: "Maio"},
          {id : "6", text : "Jun", textoLargo: "Junho"},
          {id : "7", text : "Jul", textoLargo: "Julho"},
          {id : "8", text : "Ago", textoLargo: "Agosto"},
          {id : "9", text : "Set", textoLargo: "Setembro"},
          {id : "10", text : "Out", textoLargo: "Outubro"},
          {id : "11", text : "Nov", textoLargo: "Novembro"},
          {id : "12", text : "Dez", textoLargo: "Dezembro"}
        ];
	/*Declaro la lista de anhos */
	s.listaAnhos = [
          {id : "2003", text : "2003"},
          {id : "2004", text : "2004"},
          {id : "2005", text : "2005"},
          {id : "2006", text : "2006"},
          {id : "2007", text : "2007"}
        ];        

    s.consultoresSeleccionados = [];
	s.jsonRelatorio = [];
	s.options = { legend: { display: true } };

	h.get("/prueba_dev/index.php/desenpenho/ajax_obtener_consultores")
	 .then(function(data, status, xhr){
	 	s.jsonConsultores = data.data;

	 	console.log(s.jsonConsultores);
	});

	s.buttonRelatorio = function(){

		//console.log(s.consultoresSeleccionados);

		s.series = [];
		s.labels = [];	
		s.data = [];

		//inicializo el grafico de barra en cero

		//inicializo el grafi de pizza en cero
		s.series2 = [];
		s.data2 = [];

		s.relatorioVisible = true;
		var arrayConsultores = "";
		angular.forEach(s.consultoresSeleccionados, function(value, key) {
		  if(key < s.consultoresSeleccionados.length - 1)
		  	arrayConsultores =arrayConsultores + "'"+value.co_usuario+"',";
		  if(key == s.consultoresSeleccionados.length - 1)
		  	arrayConsultores =arrayConsultores + "'"+value.co_usuario+"'";		  
		});

		var desde= s.anhoDesde+ s.mesDesde;
		var hasta = s.anhoHasta+ s.mesHasta;

		//Obtengo los datos que se introdujeron en el formulario
		h.get("/prueba_dev/index.php/desenpenho/ajax_relatorio?usuarios="+arrayConsultores+"&desde="+desde+"&hasta="+hasta)
		 .then(function(data, status, xhr){

			s.jsonRelatorio = [];
			console.log(data.data);
		 	angular.forEach(s.consultoresSeleccionados, function function_name(value, key) {
		 		console.log(data.data[value.co_usuario]);
		 		if(data.data[value.co_usuario] !== undefined)
		 			s.jsonRelatorio.push(data.data[value.co_usuario]);

		 	});
		 	
		});
	}

	s.botonAgregar = function(){
		if(s.selectConsultor[0] !== undefined){
			s.consultoresSeleccionados.push({co_usuario: s.selectConsultor[0].co_usuario, no_usuario: s.selectConsultor[0].no_usuario, co_sistema: s.selectConsultor[0].co_sistema});
			s.selectConsultor2 = s.selectConsultor.co_usuario;

			s.jsonConsultores = f('filter')(s.jsonConsultores, function(item) {
			    return !(s.selectConsultor[0].co_usuario == item.co_usuario);
			 });
		}


	}

	s.botonQuitar = function(){
		if(s.selectConsultor2[0] !== undefined){
			s.jsonConsultores.push(s.selectConsultor2[0]);
			s.selectConsultor = s.selectConsultor2.co_usuario;

			s.consultoresSeleccionados = f('filter')(s.consultoresSeleccionados, function(item) {
			    return !(s.selectConsultor2[0].co_usuario == item.co_usuario);
			 });
		}

	}	


	s.botonGraficoBarra = function () {


		//inicializo el boton relatorio en cero
		  s.jsonRelatorio = [];
		//inicializo la grafica pizza en cero
		 s.series2 = [];
	     s.data2 = [];

		var desde= s.anhoDesde+ s.mesDesde;
		var hasta = s.anhoHasta+ s.mesHasta;


		angular.forEach(s.listaMeses, function(value, key) {

			if(value.id==s.mesDesde){
				s.desdeSeleccion = value.textoLargo;
			}
			if(value.id==s.mesHasta){
				s.hastaSeleccion = value.textoLargo;
			}				
		});

		s.labels = [];
		s.data = [];
		s.datasetOverride = [];

		var arrayConsultores = "";
		angular.forEach(s.consultoresSeleccionados, function(value, key) {
		  if(key < s.consultoresSeleccionados.length - 1)
		  	arrayConsultores =arrayConsultores +value.co_usuario+",";
		  if(key == s.consultoresSeleccionados.length - 1)
		  	arrayConsultores =arrayConsultores +value.co_usuario;		  
		});

		//Obtengo los datos que se introdujeron en el formulario
		h.get("/prueba_dev/index.php/desenpenho/ajax_obtener_grafico?usuarios="+arrayConsultores+"&desde="+desde+"&hasta="+hasta)
		 .then(function(data, status, xhr){
		 	console.log(data.data);
		 	s.labels = data.data.rangoFecha;
		 	s.series = data.data.series;
		 	s.data = data.data.matris;
            
		 	angular.forEach(s.series, function function_name(value, key) {
		 		s.datasetOverride.push({
		        label: value,
		        borderWidth: 1,
		        type: 'bar'
		      });
		 	});

		 	/*Muestro el grafico del promedio*/

		 	s.series.push("Promedio");
		 	var arrayPromedio = [];
		 	angular.forEach(s.labels, function function_name(value, key) {
		 		arrayPromedio.push(data.data.promedio);
		 	});
		 	s.data.push(arrayPromedio);

		 	s.datasetOverride.push({
		        label: "Promedio",
		        borderWidth: 1,
		        type: 'line'
		    });		 	

		 });

	}

	s.botonGraficoCircular = function () {
		// body...
		//inicializo el boton relatorio en cero
		 s.jsonRelatorio = [];

		 //inicializo la grafica barra en cero
		 s.series = [];
	     s.data = [];


		 s.data2 = [];

		var desde= s.anhoDesde+ s.mesDesde;
		var hasta = s.anhoHasta+ s.mesHasta;

		angular.forEach(s.listaMeses, function(value, key) {

			if(value.id==s.mesDesde){
				s.desdeSeleccion = value.textoLargo;
			}
			if(value.id==s.mesHasta){
				s.hastaSeleccion = value.textoLargo;
			}			
		});

		var arrayConsultores = "";
		angular.forEach(s.consultoresSeleccionados, function(value, key) {
		  if(key < s.consultoresSeleccionados.length - 1)
		  	arrayConsultores =arrayConsultores +"'"+value.co_usuario+"',";
		  if(key == s.consultoresSeleccionados.length - 1)
		  	arrayConsultores =arrayConsultores +"'"+value.co_usuario+"'";		  
		});

		h.get("/prueba_dev/index.php/desenpenho/ajax_obtener_grafico_pizza?usuarios="+arrayConsultores+"&desde="+desde+"&hasta="+hasta)
		 .then(function(data, status, xhr){

		 	s.labels2 = data.data.usuarios;

		 	var suma = data.data.suma;

			angular.forEach(data.data.totales, function(value, key) {
				s.data2.push((value / suma) * 100);
			});

		 });


	}


	/*Graficas*/



}]);
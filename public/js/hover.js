$(document).ready(function(){
	jQuery(".texto-encima").hide();
 	/*=================================
 	=            que hacer            =
 	=================================*/
 	//imagen1
 	$('.quehacer').mouseover(function() {   
 		$(".quehacertext").show();

 	});

 	$('.quehacer').mouseout(function() {   
 		$(".quehacertext").hide();

 	});
	//imagen2
	$('.quehacer2').mouseover(function() {   
	$(".quehacertext2").show();

	});

	$('.quehacer2').mouseout(function() {   
	$(".quehacertext2").hide();

	});
	//imagen3
	$('.quehacer3').mouseover(function() {   
	$(".quehacertext3").show();

	});

	$('.quehacer3').mouseout(function() {   
	$(".quehacertext3").hide();

	});
	//imagen4
	$('.quehacer4').mouseover(function() {   
	$(".quehacertext4").show();

	});

	$('.quehacer4').mouseout(function() {   
	$(".quehacertext4").hide();

	});


	/*=====  End of que hacer  ======*/
	/*==================================

	=            que sucede            =
	==================================*/
	//imagen1
 	$('.quesucede').mouseover(function() {   
 		$(".quesucedetext").show();

 	});

 	$('.quesucede').mouseout(function() {   
 		$(".quesucedetext").hide();

 	});
	//imagen2
	$('.quesucede2').mouseover(function() {   
	$(".quesucedetext2").show();

	});

	$('.quesucede2').mouseout(function() {   
	$(".quesucedetext2").hide();

	});


	/*=====  End of que sucede  ======*/
	/*=            conoce lerma            =
	==================================*/
	//imagen1
 	$('.conocelerma').mouseover(function() {   
 		$(".conocelermatext").show();

 	});

 	$('.conocelerma').mouseout(function() {   
 		$(".conocelermatext").hide();

 	});
	

	/*=====  End of conoce lerma  ======*/
	/*==================================

	=            festival y cultura            =
	==================================*/
	//imagen1
 	$('.festivalycultura').mouseover(function() {   
 		$(".festivalyculturatext").show();

 	});

 	$('.festivalycultura').mouseout(function() {   
 		$(".festivalyculturatext").hide();

 	});
	//imagen2
	$('.festivalycultura2').mouseover(function() {   
	$(".festivalyculturatext2").show();

	});

	$('.festivalycultura2').mouseout(function() {   
	$(".festivalyculturatext2").hide();

	});


	/*=====  End of festival y cultura  ======*/

	/*=            artesanias            =
	==================================*/
	//imagen1
 	$('.artesanias').mouseover(function() {   
 		$(".artesaniastext").show();

 	});

 	$('.artesanias').mouseout(function() {   
 		$(".artesaniastext").hide();

 	});
	

	/*=====  End of artesanias  ======*/

	/*=            actividades            =
	==================================*/
	//imagen1
 	$('.actividades').mouseover(function() {   
 		$(".actividadestext").show();

 	});

 	$('.actividades').mouseout(function() {   
 		$(".actividadestext").hide();

 	});
	//imagen2
	$('.actividades2').mouseover(function() {   
	$(".actividadestext2").show();

	});

	$('.actividades2').mouseout(function() {   
	$(".actividadestext2").hide();

	});


	/*=====  End of actividades  ======*/
	/*===========================================
	=            nivel dos que hacer            =
	===========================================*/
	/*===========================================
	=            Actividad principal            =
	===========================================*/
	//imagen1
 	$('.actividadprincipal').mouseover(function() {

 		$(".principaltext").show();

 	});

 	$('.actividadprincipal').mouseout(function() {   
 		$(".principaltext").hide();

 	});
	
	/*=====  End of Actividad principal  ======*/
	/*===========================================
	=            Actividad principal            =
	===========================================*/
	//imagen1
 	
	
	/*=====  End of Actividad principal  ======*/
	
	
	
	/*=====  End of nivel dos que hacer  ======*/
	});
	
	/*==============================================
	=            EVENTOS TOUCH V. MOVIL            =
	==============================================*/
	// Inicialize the variables

	$(document).on('touchstart', function() { detectTap = true;  
	 	$(".texto-encima").show();
	 });

	 $(document).on('click touchend', function(event) {
	  if (event.type == "click") detectTap = true; 
		$(".texto-encima").hide();
	});
	/*=====  End of EVENTOS TOUCH V. MOVIL  ======*/
	/*==============================================================================================
	=            FUNCION PARA MOSTRAR O OCULTAR TEXTO EN NIVEL DOS IMAGENES SECUNDARIAS            =
	==============================================================================================*/
	function show(elemento) {
   	
   	$(elemento).find(".secundariotexto").show();
   };
function hide(elemento) {
   	
   	$(elemento).find(".secundariotexto").hide();
   };
	
	
	/*=====  End of FUNCION PARA MOSTRAR O OCULTAR TEXTO EN NIVEL DOS IMAGENES SECUNDARIAS  ======*/
	
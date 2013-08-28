<?php

	require("auxiliarySQL.php");

function validarPonencias($idsubcategory,$areaPRI){
    $response = new RegisterInput();
    $check["Error"]=0;    
    if(isset($_SESSION["edit"])){
        $recuperar=$_SESSION["edit"];
    }
    elseif(isset($_SESSION["tmp"])){
        $recuperar=$_SESSION["tmp"];
    }



		/*Titulo Tipo Ponencia Presentado Por*/
        $title=isset($recuperar["titulo"])?$recuperar["titulo"]:"";
        $title=(str_replace("'","*",$title));
        $tipoPonencia_id=isset($recuperar["idtipoPonencia"])?$recuperar["idtipoPonencia"]:"";
        $tipoPonencia_description=isset($recuperar["tipoPonencia_description"])?$recuperar["tipoPonencia_description"]:"";
        $prePorNombre=isset($recuperar["prePorNombre"])?$recuperar["prePorNombre"]:"";        
        $prePorApellido=isset($recuperar["prePorApellido"])?$recuperar["prePorApellido"]:"";
        $prePorApellido=(str_replace("'","*",$prePorApellido));
		/***************/

        /* Formato de libro - id*/
        $idfbook = isset($recuperar["idfbook"])?$recuperar["idfbook"]:""; 
         /* Formato de libro  descripcion*/
        $fbook_des = isset($recuperar["fbook_descripcion"])?$recuperar["fbook_descripcion"]:"";         

        /* Codigo ISBN*/
        $ISBN = isset($recuperar["ISBN"])?$recuperar["ISBN"]:"";

        //codigo CallNumber
        $CallNumber = isset($recuperar["CallNumber"])?$recuperar["CallNumber"]:"";

             
        /*descripcion phisica*/
        $description_physical = isset($recuperar["description_physical"])?$recuperar["description_physical"]:"";

        /*edition*/
        $edition = isset($recuperar["edition"])?$recuperar["edition"]:"";        

        /*description*/
        $summary = isset($recuperar["summary"])?$recuperar["summary"]:"";
        
        /* ISSN*/ 
        if ($_SESSION["required"]==1) {                  
                     
                      


            /* Languaje*/
            $languaje = isset($recuperar["languaje"])?$recuperar["languaje"]:"";

            /* Numero LC*/
            $numLC = isset($recuperar["numLC"])?$recuperar["numLC"]:"";

            /* Numero Dewey*/
            $numDewey = isset($recuperar["numDewey"])?$recuperar["numDewey"]:"";
        } 

		/*Lugar Pais */
        // $lugar=isset($recuperar["lugar"])?$recuperar["lugar"]:"";
        // $pais_description=isset($recuperar["pais_description"])?$recuperar["pais_description"]:"";
                /************/
        
                /*Nombre Evento*/
        $evento_description=isset($recuperar["evento_description"])?$recuperar["evento_description"]:"";
        $idcategoriaEvento=isset($recuperar["idcategoriaEvento"])?$recuperar["idcategoriaEvento"]:0;
        $categoriaEvento_description=isset($recuperar["categoriaEvento_description"])?$recuperar["categoriaEvento_description"]:"";
        $idclaseEvento=isset($recuperar["idclaseEvento"])?$recuperar["idclaseEvento"]:0;
        $claseEvento_description=isset($recuperar["claseEvento_description"])?$recuperar["claseEvento_description"]:"";
        
		/************/


        $date_ing=isset($recuperar["date_ing"])?$recuperar["date_ing"]:"";
        //$date_pub=isset($recuperar["date_pub"])?$recuperar["date_pub"]:"";
        $month_pub=isset($recuperar["month_pub"])?$recuperar["month_pub"]:"";
        $year_pub=isset($recuperar["year_pub"])?$recuperar["year_pub"]:"";

            if($year_pub==""){
                $check["Msg"]="Seleccione el Año de Aquisición";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('fecha_permisos','titulo6')";
            }           
            else{                
                $check["year_pub"]=$year_pub;
            }
    
            if($month_pub==""){
                $check["Msg"]="Seleccione el Mes de Aquisición";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('fecha_permisos','titulo6')";
            }           
            else{                
                $check["month_pub"]=$month_pub;
            }
            if (!isset($recuperar["authorPRI"]["idauthor"])){
                $check["Msg"]="Seleccione Autor Principal";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('author','titulo2')";
            }
        
            // if ($summary=="") {
            //     $check["Error"] = 1;
            //     $check["Msg"] = "Ingrese un Resumen";
            //     $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1')";
            //     $check["focus"]="$('#summary').focus()";
            // }
            // else{
            //     $check["summary"] = $summary;
            // }

            // if ($edition=="") {
            //     $check["Error"] = 1;
            //     $check["Msg"] = "Ingrese la edición";
            //     $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1')";
            //     $check["focus"]="$('#edition').focus()";
            // }
            // else{
            //     $check["edition"] = $edition;
            // }
            // // $check = $response->check_values($edition,"Edicion","edition");

            // if ($description_physical=="") {
            //     $check["Error"] = 1;
            //     $check["Msg"] = "Ingrese la descripción Física";
            //     $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1')";
            //     $check["focus"]="$('#description_physical').focus()";
            // }
            // else{
            //     $check["description_physical"] = $description_physical;
            // }

            // if ($CallNumber=="") {
            //     $check["Msg"]="Ingrese el codigo de ubicación";
            //     $check["Error"]=1;
            //     $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1')";
            //     $check["focus"]="$('#CallNumber').focus()";
            // }
            // else{
            //     $check["CallNumber"]=$CallNumber;

            // }

            // if ($ISBN=="") {
            //     $check["Msg"]="Ingrese ISBN";
            //     $check["Error"]=1;
            //     $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1')";
            //     $check["focus"]="$('#ISBN').focus()";
            // }
            // else{
            //     $check["ISBN"]=$ISBN;
            // }
            //formato de material bibliografico
            // if($idfbook=="" or $idfbook==999){ 
            //     $check["Msg"]="Seleccione un formato del material bibliográfico ";
            //     $check["Error"]=1;
            //     $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
            //     $check["focus"]="$('#list_fbook').val('').focus()";
                
            // }
            // else{
            //     $check["idfbook"]=$idfbook;
            //     $check["fbook_descripcion"]=$fbook_des;

            // }         
            
            if($title==""){ 
                $check["Msg"]="Ingrese Título";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#title').focus()";
            }
            else{
                $check["title"]=$title;

            }

        /*campos insertados dinamicamente*/
        //verificar si esta checkeado 
        // $objResponse->script("
        //         $('#ListCampos').find(':input').each(function()
        //             {
        //               if($(this).is(':checked')) {
        //                  xajax_Query_input(id);                                           
        //               } else {                                            
        //                  xajax_delCampos(id);  
        //               }  
        //             });
        //     ");
        // $result = Query_input();
        if ($_SESSION["required"]["ISSN"]==1 || isset($recuperar["ISSN"]) ) {

             $ISSN = (isset($recuperar["ISSN"]))?$recuperar["ISSN"]:""; 
        
            if($ISSN==""){ 
                $check["Msg"]="Ingrese ISSN";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#ISSN').focus()";
            }
            else{
                $check["ISSN"]=$ISSN;                
            } 
        }
        if ($_SESSION["required"]["languaje"]==1 || isset($recuperar["languaje"])) {
            $languaje = isset($recuperar["languaje"])?$recuperar["languaje"]:"";
            
            $check["languaje"]=array();
            foreach ($languaje as  $value) {
                if($value==""){ 
                    $check["Msg"]="Ingrese Idioma";
                    $check["Error"]=1;
                    $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                    $check["focus"]="$('#languaje').focus()";
                }
                else{                    
                    array_push($check["languaje"], $value);
                }                
            }            
            
        }
        if ($_SESSION["required"]["NumLC"]==1 || isset($recuperar["NumLC"])) {
            $NumLC = isset($recuperar["NumLC"])?$recuperar["NumLC"]:"";
            if($NumLC==""){ 
                $check["Msg"]="Ingrese Numero de Clasificación LC ";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#NumLC').focus()";
            }
            else{
                $check["NumLC"]=$NumLC;
            }
        }   
        if ($_SESSION["required"]["NumDewey"]==1 || isset($recuperar["NumDewey"])) {
            $NumDewey = isset($recuperar["NumDewey"])?$recuperar["NumDewey"]:"";
            if($NumDewey==""){ 
                $check["Msg"]="Ingrese Numero de Clasificación Dewey";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#NumDewey').focus()";
            }
            else{
                $check["NumDewey"]=$NumDewey;
            }
        } 
        if ($_SESSION["required"]["Class_IGP"]==1 || isset($recuperar["Class_IGP"])) {
            $Class_IGP = isset($recuperar["Class_IGP"])?$recuperar["Class_IGP"]:"";
            if($Class_IGP==""){ 
                $check["Msg"]="Ingrese Numero de Clasificación IGP";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#Class_IGP').focus()";
            }
            else{
                $check["Class_IGP"]=$Class_IGP;
            }
        }  

        if ($_SESSION["required"]["EncMat"]==1 || isset($recuperar["EncMat"])) {
            $EncMat = isset($recuperar["EncMat"])?$recuperar["EncMat"]:"";
            if($EncMat==""){ 
                $check["Msg"]="Ingrese Encabezameinto de Materia";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#EncMat').focus()";
            }
            else{
                $check["EncMat"]=$EncMat;
            }
        }  
        if ($_SESSION["required"]["OtherTitles"]==1 || isset($recuperar["OtherTitles"])) {
            $OtherTitles = isset($recuperar["OtherTitles"])?$recuperar["OtherTitles"]:"";
            if($OtherTitles==""){ 
                $check["Msg"]="Ingrese Otros Títulos";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#OtherTitles').focus()";
            }
            else{
                $check["OtherTitles"]=$OtherTitles;
            }
        }   
        if ($_SESSION["required"]["Periodicidad"]==1 || isset($recuperar["Periodicidad"])) {
            $Periodicidad = isset($recuperar["Periodicidad"])?$recuperar["Periodicidad"]:"";
            if($Periodicidad==""){ 
                $check["Msg"]="Ingrese Periodicidad";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#Periodicidad').focus()";
            }
            else{
                $check["Periodicidad"]=$Periodicidad;
            }
        }   
        if ($_SESSION["required"]["Serie"]==1 || isset($recuperar["Serie"])) {
            $Serie = isset($recuperar["Serie"])?$recuperar["Serie"]:"";
            if($Serie==""){ 
                $check["Msg"]="Ingrese Numero de Clasificación IGP";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#Serie').focus()";
            }
            else{
                $check["Serie"]=$Serie;
            }
        }   
        if ($_SESSION["required"]["NoteGeneral"]==1 || isset($recuperar["NoteGeneral"])) {
            $NoteGeneral = isset($recuperar["NoteGeneral"])?$recuperar["NoteGeneral"]:"";
            if($NoteGeneral==""){ 
                $check["Msg"]="Ingrese Numero de Clasificación IGP";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#NoteGeneral').focus()";
            }
            else{
                $check["NoteGeneral"]=$NoteGeneral;
            }
        }

        if ($_SESSION["required"]["NoteTesis"]==1 || isset($recuperar["NoteTesis"])) {
            $NoteTesis = isset($recuperar["NoteTesis"])?$recuperar["NoteTesis"]:"";
            if($NoteTesis==""){ 
                $check["Msg"]="Ingrese Numero de Clasificación IGP";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#NoteTesis').focus()";
            }
            else{
                $check["NoteTesis"]=$NoteTesis;
            }
        }
        if ($_SESSION["required"]["NoteBiblio"]==1 || isset($recuperar["NoteBiblio"])) {
            $NoteBiblio = isset($recuperar["NoteBiblio"])?$recuperar["NoteBiblio"]:"";
            if($NoteBiblio==""){ 
                $check["Msg"]="Ingrese Numero de Clasificación IGP";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#NoteBiblio').focus()";
            }
            else{
                $check["NoteBiblio"]=$NoteBiblio;
            }
        } 
        if ($_SESSION["required"]["NoteConte"]==1 || isset($recuperar["NoteConte"])) {
            $NoteConte = isset($recuperar["NoteConte"])?$recuperar["NoteConte"]:"";
            if($NoteConte==""){ 
                $check["Msg"]="Ingrese Numero de Clasificación IGP";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#NoteConte').focus()";
            }
            else{
                $check["NoteConte"]=$NoteConte;
            }
        } 
        if ($_SESSION["required"]["DesPersonal"]==1 || isset($recuperar["DesPersonal"])) {
            $DesPersonal = isset($recuperar["DesPersonal"])?$recuperar["DesPersonal"]:"";
            if($DesPersonal==""){ 
                $check["Msg"]="Ingrese Numero de Clasificación IGP";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#DesPersonal').focus()";
            }
            else{
                $check["DesPersonal"]=$DesPersonal;
            }
        } 
        if ($_SESSION["required"]["MatEntidad"]==1 || isset($recuperar["MatEntidad"])) {
            $MatEntidad = isset($recuperar["MatEntidad"])?$recuperar["MatEntidad"]:"";
            if($MatEntidad==""){ 
                $check["Msg"]="Ingrese Numero de Clasificación IGP";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#MatEntidad').focus()";
            }
            else{
                $check["MatEntidad"]=$MatEntidad;
            }
        } 

        if ($_SESSION["required"]["Descriptor"]==1 || isset($recuperar["Descriptor"])) {
            $Descriptor = isset($recuperar["Descriptor"])?$recuperar["Descriptor"]:"";
            if($Descriptor==""){ 
                $check["Msg"]="Ingrese Numero de Clasificación IGP";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#Descriptor').focus()";
            }
            else{
                $check["Descriptor"]=$Descriptor;
            }
        } 
        if ($_SESSION["required"]["Descriptor_geo"]==1 || isset($recuperar["Descriptor_geo"])) {
            $Descriptor_geo = isset($recuperar["Descriptor_geo"])?$recuperar["Descriptor_geo"]:"";
            if($Descriptor_geo==""){ 
                $check["Msg"]="Ingrese Numero de Clasificación IGP";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#Descriptor_geo').focus()";
            }
            else{
                $check["Descriptor_geo"]=$Descriptor_geo;
            }
        } 
        if ($_SESSION["required"]["CongSec"]==1 || isset($recuperar["CongSec"])) {
            $CongSec = isset($recuperar["CongSec"])?$recuperar["CongSec"]:"";
            if($CongSec==""){ 
                $check["Msg"]="Ingrese Numero de Clasificación IGP";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#CongSec').focus()";
            }
            else{
                $check["CongSec"]=$CongSec;
            }
        } 
        if ($_SESSION["required"]["TitSec"]==1 || isset($recuperar["TitSec"])) {
            $TitSec = isset($recuperar["TitSec"])?$recuperar["TitSec"]:"";
            if($TitSec==""){ 
                $check["Msg"]="Ingrese Numero de Clasificación IGP";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#TitSec').focus()";
            }
            else{
                $check["TitSec"]=$TitSec;
            }
        } 
        if ($_SESSION["required"]["Fuente"]==1 || isset($recuperar["Fuente"])) {
            $Fuente = isset($recuperar["Fuente"])?$recuperar["Fuente"]:"";
            if($Fuente==""){ 
                $check["Msg"]="Ingrese Numero de Clasificación IGP";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#Fuente').focus()";
            }
            else{
                $check["Fuente"]=$Fuente;
            }
        } 
        if ($_SESSION["required"]["NumIng"]==1 || isset($recuperar["NumIng"])) {
            $NumIng = isset($recuperar["NumIng"])?$recuperar["NumIng"]:"";
            if($NumIng==""){ 
                $check["Msg"]="Ingrese Numero de Clasificación IGP";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#NumIng').focus()";
            }
            else{
                $check["NumIng"]=$NumIng;
            }
        } 
        if ($_SESSION["required"]["UbicElect"]==1 || isset($recuperar["UbicElect"])) {
            $UbicElect = isset($recuperar["UbicElect"])?$recuperar["UbicElect"]:"";
            if($UbicElect==""){ 
                $check["Msg"]="Ingrese Numero de Clasificación IGP";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#UbicElect').focus()";
            }
            else{
                $check["UbicElect"]=$UbicElect;
            }
        } 
        if ($_SESSION["required"]["ModAdqui"]==1 || isset($recuperar["ModAdqui"])) {
            $ModAdqui = isset($recuperar["ModAdqui"])?$recuperar["ModAdqui"]:"";
            if($ModAdqui==""){ 
                $check["Msg"]="Ingrese Numero de Clasificación IGP";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#ModAdqui').focus()";
            }
            else{
                $check["ModAdqui"]=$ModAdqui;
            }
        } 
        if ($_SESSION["required"]["Catalogador"]==1 || isset($recuperar["Catalogador"])) {
            $Catalogador = isset($recuperar["Catalogador"])?$recuperar["Catalogador"]:"";
            if($Catalogador==""){ 
                $check["Msg"]="Ingrese Numero de Clasificación IGP";
                $check["Error"]=1;
                $check["funcion"]="xajax_displaydiv('titulo_tipo_prepor','titulo1');";
                $check["focus"]="$('#Catalogador').focus()";
            }
            else{
                $check["Catalogador"]=$Catalogador;
            }
        } 

            
    return $check;
}

 /*********************************************************************************************************
	
	**********************************************************************************************************/
	function mostrarBusquedaAutores(){
		$respuesta = new xajaxResponse();
                
                $respuesta->Assign("div_autor","style.display","block");
                $respuesta->Assign("mensaje","innerHTML","");
                $respuesta->Assign("rq_authorPRI","style.display","none");
                $respuesta->Assign("paginatorPRI","style.display","none");
                $respuesta->Assign("sAuthor","value","");
                
                
		return $respuesta;
	}

        /*********************************************************************************************************
	
	**********************************************************************************************************/
	function ocultarBusquedaAutores(){
		$respuesta = new xajaxResponse();
                
                $respuesta->Assign("div_autor","style.display","none");
                $respuesta->Assign("mensaje","innerHTML","");
                $respuesta->Assign("rq_authorPRI","style.display","blobk");
                $respuesta->Assign("paginatorPRI","style.display","block");
                //$respuesta->Assign("sAuthor","value","");
                
                
		return $respuesta;
	}

        /*********************************************************************************************************
	
	**********************************************************************************************************/
	function cargaScriptMostrarAutores(){
		$respuesta = new xajaxResponse();
		                
                $respuesta->script('
                    
                $(function() {
                

$("#sAuthor").keypress(function(event) {
  if ( event.which == 13 ) {
     event.preventDefault();
     /*alert("Hola");*/
     runEffect();
   }
   /*
   xTriggered++;
   var msg = "Handler for .keypress() called " + xTriggered + " time(s).";
  $.print( msg, "html" );
  $.print( event );*/
});

$("#other").click(function() {
    /*alert("Hola");*/
  $("#sAuthor").keypress();
});



		// run the currently selected effect
		function runEffect() {
                var options = {};
                    //Ejecuta una funcion xajax de frente o un conjunto de 
                    //funciones xajax mediante un javascript callback ejm. funcion hola
                    $( "#div_autor" ).switchClass( "showForm", "hideForm", 0 );
                    $("#rq_authorPRI").show("drop", { direction: "left" }, 500);
                    $("#paginatorPRI").show("drop", { direction: "left" }, 500,xajax_auxAuthorPriShow(5,1,xajax.getFormValues("autorPRI")));
		};

		// set effect from select menu value
		$( "#boton_buscar" ).click(function() {
			runEffect();
			return false;
		});
                

                //callback function to bring a hidden box back
		function hola() {
                        setTimeout(function() {
				$( "#div_autor" ).removeAttr( "style" ).hide().fadeIn();
			}, 1000 );                        
		};
                

                });                
                '                        
                );
                
                //$respuesta->Assign("div_autor","style.display","block");
                //$respuesta->Assign("rq_authorPRI","style.display","none");
                //$respuesta->Assign("paginatorPRI","style.display","none");
                //$respuesta->Assign("sAuthor","value","");
                
                               
		return $respuesta;
	}

        /*********************************************************************************************************
	
	**********************************************************************************************************/
	function cargaScriptOcultarAutores(){
		$respuesta = new xajaxResponse();
		                
                $respuesta->script('
                    
                $(function() {
		// run the currently selected effect
		function runEffect() {
                    //Ejecuta una funcion xajax de frente o un conjunto de 
                    //funciones xajax mediante un javascript callback ejm. funcion hola
                    $( "#div_autor" ).switchClass( "hideForm", "showForm", 500 );
                    $("#rq_authorPRI").hide("drop", { direction: "right" }, 500);
                    $("#paginatorPRI").hide("drop", { direction: "right" }, 500,xajax_auxAuthorPriShow(5,1,xajax.getFormValues("autorPRI")));
                    document.getElementById("sAuthor").value="";
                    
		};

		// set effect from select menu value
		$( "#boton_regreso" ).click(function() {
			runEffect();                        
			return false;
		});
                
                //callback function to bring a hidden box back
		function hola() {
                        setTimeout(function() {
				$( "#div_autor" ).removeAttr( "style" ).hide().fadeIn();
			}, 1000 );                        
		};
                
                });                
                '                        
                );
                
                //$respuesta->Assign("div_autor","style.display","block");
                //$respuesta->Assign("rq_authorPRI","style.display","none");
                //$respuesta->Assign("paginatorPRI","style.display","block");
                //$respuesta->Assign("sAuthor","value","");
                
                               
		return $respuesta;
	}
        
        /*********************************************************************************************************
	
	**********************************************************************************************************/
	function cargaScriptDates(){
		$respuesta = new xajaxResponse();
		
                $respuesta->script('$(function() {
		$( "#date_pub, #date_ing_tesis, #date_pub_tesis,#date_ini,#date_fin"   ).datepicker({
			changeMonth: true,
			changeYear: true,
                        yearRange: "1945:2021",
                        dateFormat: "yy-mm-dd",
                        showButtonPanel: true
                        /*showAnim: "drop"*/
                        
		});
                                
                });'
                        
                        );
		return $respuesta;
	}

        /*********************************************************************************************************
	
	**********************************************************************************************************/
	function cargaScriptDatesRange(){
		$respuesta = new xajaxResponse();
		
                $respuesta->script('$(function() {
		var dates = $( "#date_ini, #date_fin" ).datepicker({
			/*defaultDate: "+1w",*/
			changeMonth: true,
                        changeYear: true,
			numberOfMonths: 1,
                        yearRange: "1958:2021",
                        showButtonPanel: true,
                        dateFormat: "yy-mm-dd",
			onSelect: function( selectedDate ) {
				var option = this.id == "date_ini" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
	});'
                        
                        );
		return $respuesta;
	}
        
        /*********************************************************************************************************
	
	**********************************************************************************************************/
	function cargaScriptReferencia(){
            $respuesta = new xajaxResponse();

            $respuesta->script('
                $(document).ready(function() {
                    $("#selectReferencia").change(function() {                    
                        var id=$(this).val();
                        var texto=$("#selectReferencia option:selected").html();
                        xajax_registerReference(id,texto);
                    });
                });
            ');
            return $respuesta;
	}

        /*********************************************************************************************************
	
	**********************************************************************************************************/
	function obtenerIdDescripcion($nombreObjeto,$funcion){
            $respuesta = new xajaxResponse();

            $respuesta->script('                
                var descripcion=document.getElementById("'.$nombreObjeto.'").options[document.getElementById("'.$nombreObjeto.'").selectedIndex].text;
                var id=document.getElementById("'.$nombreObjeto.'").value;


                xajax_'.$funcion.'(id,descripcion);
            ');
            return $respuesta;
	}
        
	/*********************************************************************************************************
	
	**********************************************************************************************************/
	function comboAreaResult(){
		$resultSql= comboAreaSQL();
        
		//Cambiar la funcion deacuaerdo la sesion area
		$desc = $resultSql[0];
		$id = $resultSql[1];
	               
		if (is_array($desc) and is_array($id)){
			$cboMaestro=new combo();
			$combo=$cboMaestro->comboList($desc,$id,"OnChange","xajax_pasaValor(this.value)","Todas las &aacute;reas ","0","selectAreas",0,"combo-buscador-1");
		}
		else{
			$combo= "No data available";
		}
		
		return $combo;
	}
	
	/*********************************************************************************************************
	
	**********************************************************************************************************/
	
	function comboAreaShow(){
		$objResponse = new xajaxResponse();
		$combo=comboAreaResult();
		$objResponse->assign('divArea', 'innerHTML', $combo);
		return $objResponse;
	}
	
	/*********************************************************************************************************
	
	**********************************************************************************************************/
	function pasaValor($idarea){
	    $objResponse = new xajaxResponse();
            //$objResponse->alert($idarea);
	    if($idarea==8){
                
			$html="";
			$result=searchSubcategorySQL(3);
			$desc=$result["subcategory_description"];
			$id=$result["idsubcategory"];
			$iniCombo="Seleccione Subcategoria";
			$funcion="xajax_comboTipoFechasShow(this.value);xajax_seccionShow(this.value)";
			$cboasuntosAcademicos=new combo();
			$html=$cboasuntosAcademicos->comboList($desc,$id,"OnChange",$funcion,"$iniCombo","0","selectTypeAcademicos",0,"combo-buscador-1");
			$html=$html."</br></br>";
			$objResponse->assign("divCategory", "innerHTML",$html);
			$objResponse->assign("optionsSubcategory", "innerHTML","");
	    }
	    elseif($idarea==11 or $idarea==12 or $idarea==13 or $idarea==14){                
			$html="";
			$result=searchSubcategorySQL(4,"","",$idarea);
			$desc=$result["subcategory_description"];
			$id=$result["idsubcategory"];
			$iniCombo="Seleccione Categoria";
			$funcion="xajax_comboTipoFechasShow(this.value);xajax_seccionShow(this.value)";
			$cboasuntosAcademicos=new combo();
			$html=$cboasuntosAcademicos->comboList($desc,$id,"OnChange",$funcion,"$iniCombo","0","selectTypeGeofisica",0,"combo-buscador-1");
			//$html=$html."</br></br>";
			$objResponse->assign("divCategory", "innerHTML",$html);
			$objResponse->assign("optionsSubcategory", "innerHTML","");
	    }            
	    else{
			$objResponse->script("xajax_comboCategoryShow($idarea)");
			$objResponse->assign("referenceStatus", "style.display","none");
			$objResponse->assign("searchStatus", "innerHTML","");
			$objResponse->assign("searchReference", "innerHTML","");
			$objResponse->assign("moreOptions", "innerHTML","");
			
			$objResponse->assign("searchTypePublication", "innerHTML","");
			$objResponse->assign("optionsSubcategory", "innerHTML","");
			$objResponse->assign("optionsSubcategory", "style.display","none");
			$objResponse->assign("divMonth", "style.display","inline");
			
	    }
	    return $objResponse;
	}
	
	/*********************************************************************************************************
	
	**********************************************************************************************************/
	function comboDepartamentoResult($idDpto=0,$idRegion=0){
	        $resultSql= comboDepartamentoSQL($idDpto,$idRegion);
	        
	        return $resultSql;
	}
	
	/*********************************************************************************************************
	Funcion que muestra una lista de las tabla Deparatmento y que la posición depende del orden de la consulta
	**********************************************************************************************************/
	function comboDepartamentoShow($idDpto=0,$idRegion=0,$seccion=0){
		$objResponse = new xajaxResponse();
	
	      
	        switch($seccion){
	            case 1:
	                $div="registerDepartamentoBoletines";
                        $funcion="xajax_obtenerIdDescripcion('selectDepartamento','registerDepartamento');";
	                //$funcion="departamentoText();xajax_registerDepartamento(this.value,departamento_description.value)";
	            break;
	            case 2:
	                $funcion="";
	                $div="searchDepartamentoBoletines";
	            break;
	        }
	          
		$resultSql= comboDepartamentoResult($idDpto,$idRegion);
	        
	        
		$desc = $resultSql[0];
		$id = $resultSql[1];
	               
	        if($idDpto!=0){
	            //buscar la posición de la variable $tipo recuperada
	            //para mostrarla como valor inicial del combo
	            $pos = array_search($idDpto,$id);
	            $pos=$pos+1;
	        }
	        else{
	            $pos=0;
	        }
	
		if (is_array($desc) and is_array($id)){
			$cboMaestro=new combo();
			$combo=$cboMaestro->comboList($desc,$id,"OnChange",$funcion,"Todos los Departamentos ","0","selectDepartamento",$pos,"combo-buscador-1");
			$objResponse->assign($div, 'innerHTML', $combo);
		}
		else{
	
			$objResponse->assign($div, 'innerHTML', 'No data available');
		}
	
	
		return $objResponse;
	}
	

	/*********************************************************************************************************
	
	**********************************************************************************************************/
	function comboReferenciaAutorShow($idsubcategory){
		$objResponse = new xajaxResponse();
	    
	    
	    if($idsubcategory<>2){
	    	$html = comboReferenciaAutorResult($idsubcategory);
			$objResponse->assign('searchReference', 'innerHTML', $html);
			$objResponse->assign('moreOptions', 'innerHTML', '');
			$objResponse->assign('titReference', 'innerHTML','Referencia:');
			$objResponse->assign('titStatus', 'innerHTML','Estado:');
			$objResponse->script("xajax_comboEstadoShow('searchEstado',0)");			
	    }
		else{	
			$objResponse->script("xajax_seccionShow('$idsubcategory')");
		}
		return $objResponse;
	}
	
	
	
	/*********************************************************************************************************
	
	**********************************************************************************************************/
	function comboReferenciaAutorResult($idsubcategory){

	    $resultSql = comboReferenciaAutorSQL($idsubcategory);
	    
	    if($resultSql["Error"]==0){
                        $idreference = $resultSql["idreference"];
			$reference_description = $resultSql["reference_description"];

	    	if (is_array($reference_description) and is_array($idreference)){
	           	$cboMaestro=new combo();
	           	$combo=$cboMaestro->comboList($reference_description,$idreference,"OnChange","","Todas las referencias","0","selectReferencia",0,"combo-buscador-1");
			}
			else{
				$combo='Sin datos';
			}
	    }
	    else{
			$combo='Error: comboReferenciaAutorResult';
	    }
	        
		return $combo;
	}
	
	
	/*********************************************************************************************************
	
	**********************************************************************************************************/
	function comboReferenciaResult($idarea,$idsubcategory=0,$codReferencia=0){
	        $resultSql= comboReferenciaSQL($idarea,$idsubcategory,$codReferencia);
	        return $resultSql;
     
	}
	
	/*********************************************************************************************************
	Funcion que muestra el Select Referencia
	**********************************************************************************************************/
	function comboReferenciaShow($idarea,$idsubcategory=0,$codReferencia=0,$seccion=0){
		$objResponse = new xajaxResponse();
		$funcion="";
		$funcion2="";
		$iniCombo="";
		$divCombo="";
                
		switch($seccion){
		    case 1:
			    $iniCombo="Todas las referencias";
			    $divCombo="registerReference";
                            //$funcion="";
			    $funcion="xajax_obtenerIdDescripcion('selectReferencia','registerReference')";
			    //$funcion2="xajax_registerReference(this.value,referencia_txt.value)";
			    break;
		    case 2:
			    $iniCombo="Todas las referencias";
			    $divCombo="searchReference";
			    $funcion="";
			    break;
		    case 3:
			    $iniCombo="";
			    $divCombo="";
			    $funcion="";
			    break;
		}
	
	    $resultSql = comboReferenciaResult($idarea,$idsubcategory,$codReferencia);
	    
	    if($resultSql["Error"]==0){

                    $reference_description = $resultSql["reference_description"];
                    $idreference = $resultSql["idreference"];
	
		    if($codReferencia!=0){
	            /*buscar la posición de la variable $tipo recuperada
	            para mostrarla como valor inicial del combo*/
	            $pos = array_search($codReferencia,$idreference);
	            $pos=$pos+1;
		    }
		    else{
		            $pos=0;
		    }

	    		if (is_array($reference_description) and is_array($idreference)){
	            	$cboMaestro=new combo();
	            	$combo=$cboMaestro->comboList($reference_description,$idreference,"OnChange",$funcion."".$funcion2 ,$iniCombo,"0","selectReferencia",$pos,"combo-buscador-1");
	            	$objResponse->assign($divCombo, 'innerHTML', $combo);
                        }
                        else{
                                $objResponse->assign($divCombo, 'innerHTML', 'Sin datos');
                        }
	    }
	    else{
			//$objResponse->alert($resultSql["Query"]);
                        $objResponse->assign($divCombo, 'innerHTML', 'Ingrese una referencia');
	    }

	        
	        //$objResponse->alert($seccion);
		return $objResponse;
	}
	
	/*********************************************************************************************************
	
	**********************************************************************************************************/
	function comboRegionResult($dbid=0){
	        $resultSql= comboRegionSQL($dbid);
	
	        return $resultSql;
	}
	
	/**************************************************
	Funcion que muestra un combo
	***************************************************/
	function comboRegionShow($dbid=0,$seccion=0){
	$objResponse = new xajaxResponse();
	
	switch($seccion){
	    case 1:
	        $div="registerRegionBoletines";
                $funcion="xajax_obtenerIdDescripcion('selectRegion','registerRegion');";
	        $funcion.="xajax_comboDepartamentoShow(0,this.value,1)";
	    break;
	    case 2:
	        $div="searchRegionBoletines";
	        $funcion="xajax_comboDepartamentoShow(0,this.value,2)";        
	    break;
	}
	
	    /*
		$desc = array("NORTE","CENTRO","SUR");
		$id = array("1","2","3");
	    */
	
	        $resultSql= comboRegionResult($dbid);
	
		$desc = $resultSql[0];
		$id = $resultSql[1];
	
	        if($dbid!=0){
	                /*buscar la posición de la variable $tipo recuperada
	                para mostrarla como valor inicial del combo*/
	                $pos = array_search($dbid,$id);
	                $pos=$pos+1;
	
	        }
	        else{
	                $pos=0;
	        }
	
		if (is_array($desc) and is_array($id)){
			$cboPubRef=new combo();
			$comboPubRef=$cboPubRef->comboList($desc,$id,"OnChange",$funcion,"Todas las Regiones","0","selectRegion",$pos,"combo-buscador-1");
			$objResponse->assign($div, 'innerHTML',$comboPubRef);
		}
		else{
			$objResponse->assign($div, 'innerHTML', 'No data available');
		}
	
	        //$objResponse->alert(print_r($desc, true));
	return $objResponse;
	}
	
	
	function downloadLink($iddata,$seccion="",$form=""){
		$objResponse = new xajaxResponse();
		        
		if(isset($_SESSION["idfrom"])){
			
			$idfrom=$_SESSION["idfrom"];			
			
			//Verificar en la base de datos los permisos
			$result=permissionSQL($iddata);
		               
			libxml_use_internal_errors(true);
			$xmlt = simplexml_load_string($result["data_content"][0]);
			if (!$xmlt) {
				echo "Error cargando XML\n";
				foreach(libxml_get_errors() as $error) {
					echo "\t", $error->message;
				}
				exit;
			}

			//Definimos parametros segun la subcategoria			
			$idsubcategory=$result["idsubcategory"][0];
			
			
			if (isset($xmlt->pdf)){
				$pdf=(string)$xmlt->pdf;
			}
                        else{
                            $pdf="";
                        }


                        
			switch ($idsubcategory) {
				case 1:
					$categoria="publicaciones";
					$subcategoria="articulos_indexados";
					break;
				case 2:
					$categoria="publicaciones";
					$subcategoria="tesis";                                    
					break;
				case 3:
					$categoria="publicaciones";
					$subcategoria="otras_publicaciones";
					break;
				case 4:
					$categoria="ponencias";
					$subcategoria="";
					break;
				case 5:
					$categoria="asuntos_academicos";
					$subcategoria="charlas_internas";                                    
					break;
				case 6:
					$categoria="informacion_interna";
					$subcategoria="reportes_tecnicos";                                    
					break;
				case 7:
					$categoria="informacion_interna";
					$subcategoria="informes_trimestrales";
					break;
				case 8:
					$categoria="informacion_interna";
					$subcategoria="boletines";
					break;
				case 11:
					$categoria="asuntos_academicos";
					$subcategoria="compendios";
					break;
				case 12:
					$categoria="asuntos_academicos";
					$subcategoria="informes_trimestrales";
					break;
				case 13:
					$categoria="informacion_interna";
					$subcategoria="informes_trimestrales";
					break;
                                    
			}
			
			$ruta="data/$categoria/$subcategoria/$pdf";

            // Creamos un array de permisos
            for($j=1;$j<4;$j++){
                eval('if (isset($xmlt->permisos->idpermission'.$j.')){$xmlflag=TRUE; $idpermission=(string)$xmlt->permisos->idpermission'.$j.';} else {$xmlflag=FALSE;}');

                if($xmlflag){
                    $arrayidpermission[$j]=$idpermission;
                }
                else{
                    $arrayidpermission[$j]=array();
                }
            }

            // Creamos un array de claves
            for($j=1;$j<4;$j++){                    
                eval('if (isset($xmlt->claves->idkey'.$j.')){$xmlflag=TRUE; $idkey=(string)$xmlt->claves->idkey'.$j.';} else {$xmlflag=FALSE;}');
                if($xmlflag){
                    $arrayidkey[$j]=$idkey;
                }
                else{
                    $arrayidkey[$j]=array();
                }
            }
		        
            // Buscamos los permisos para un $idfrom 
            $idfromsession = array_search($idfrom,$arrayidpermission);

    if (!is_file($ruta)){
            if (!file_exists($ruta)){
                //$link="<a class='mostaza' href=# onclick=\"alert('El archivo no se encuentra disponible')\">Archivo no disponible</a>";
                $link="";
            }
            elseif($form!=""){ 
                //$link= "<br /><br /><a href='#upload' onclick='xajax_verFile()'><b>Subir Archivo</b></a> ";
                //$link="<br /><br /><span id='no_file'><font color='red'>No se ha subido ningún archivo</font><span>";
                $link="";
           }
    }
            else{

                // Verificamos si hay permisos para su descarga desde este sitio
                $archiveSize=size($ruta);
                
                if(array_search($idfrom,$arrayidpermission)){


                    // Verificamos si tiene clave
                    if(array_search($idfrom,$arrayidkey)){
                        // si esta con clave debemos verificar que esta logueado
                        // o si esta en la pagina del autor
                        // o si esta logeado como admin
                        if(isset($_SESSION["loginDownload"]) OR $idfrom==3 or $seccion=="admin"){
                            /***********Mostrar el enlace en color azul solo cuando se edita la publicación******/
                            //if(isset($_SESSION["edit"])){
                                if($form!=""){
                                    $class='blue';
                                }
                                else{
                                    $class='';                                    
                                }
                            /*}
                            else{
                                $class='';
                            }*/
                            /****************************************/
                            $link="<a class='$class' href=file.php?nf=".(string)$xmlt->pdf."&sub=".$result["idsubcategory"][0].">Descarga ($archiveSize)</a>";
                            if($form!=""){                                
                                    $link.= "<br /><br /><a href='#upload' onclick='xajax_verFile()'><b>Reemplazar Archivo</b></a> ";

                            }
                        }
                        else{
                            $link="<a id='autor_".md5($iddata)."' class='mostaza' href=# >Descarga ($archiveSize)</a>";
                        }   

                    }
                    else{
                                if($form!=""){
                                    $class='blue';
                                }
                                else{
                                    $class='';                                    
                                }
                        
                        $link="<a class='$class' href=file.php?nf=".(string)$xmlt->pdf."&sub=".$result["idsubcategory"][0].">Descarga ($archiveSize)</a>";
                        if($form!=""){
                            //$link.="<br><br>Reemplazar Archivo";
                            $link.= "<br /><br /><a href='#upload' onclick='xajax_verFile()'><b>Reemplazar Archivo</b></a> ";
                        }
                    }
                    
                }
                else{
                        if($form!=""){
                            $class='blue';
                        }
                        else{
                            $class='';                                    
                        }
                    
                    //$link="<a class='mostaza' href=# onclick=\"alert('Este archivo no tiene asignado permisos para su descarga, contacte al autor');\">Descarga ($archiveSize)</a>";
                    if($subcategoria=="boletines"){
                        $link="<a class='$class' href=file.php?nf=".(string)$xmlt->pdf."&sub=".$result["idsubcategory"][0].">Descarga ($archiveSize)</a>";
                        
                    }
                    else{
                        $link="<a id='autor_".md5($iddata)."' class='mostaza' href=# >Descarga ($archiveSize)</a>";
                    }
                    
                    if($form!=""){                                
                            $link.= "<br /><br /><a href='#upload' onclick='xajax_verFile()'><b>Reemplazar Archivo</b></a> ";

                    }
                    
                }
                

            }

        }
        return $link;
    }
	
	
	
	
		function downloadPDF($iddata){
			$objResponse = new xajaxResponse();
		        
			if(isset($_SESSION["idfrom"])){
			//Verificar en la base de datos los permisos
				$result=permissionSQL($iddata);
		               
				libxml_use_internal_errors(true);
				$xmlt = simplexml_load_string($result["data_content"][0]);
				if (!$xmlt) {
					echo "Error cargando XML\n";
					foreach(libxml_get_errors() as $error) {
						echo "\t", $error->message;
					}
					exit;
				}
		
		                            //$pdf=(string)$xmlt->pdf;
				$idsubcategory=$result["idsubcategory"][0];
		                            //$objResponse->alert($idsubcategory);
		                                                       
				switch ($idsubcategory) {
					case 1:
						$categoria="publicaciones";
						$subcategoria="articulos_indexados";                                    
						break;
					case 2:
						$categoria="publicaciones";
						$subcategoria="tesis";                                    
						break;
					case 3:
						$categoria="publicaciones";
						$subcategoria="otras:publicaciones";
						break;
					case 4:
						$categoria="ponencias";
						$subcategoria="";
						break;
					case 5:
						$categoria="asuntos_academicos";
						$subcategoria="charlas_internas";                                    
						break;
					case 6:
						$categoria="informacion_interna";
						$subcategoria="reportes_tecnicos";                                    
						break;
					case 7:
						$categoria="informacion_interna";
						$subcategoria="informes_trimestrales";                                    
						break;
					case 8:
						$categoria="informacion_interna";
						$subcategoria="boletines";
						break;
					case 11:
						$categoria="asuntos_academicos";
						$subcategoria="compendios";
						break;
                                        case 12:
                                                $categoria="asuntos_academicos";
                                                $subcategoria="informes_trimestrales";
                                                break;                                            
					case 13:
						$categoria="geofisica_sociedad";
						$subcategoria="informes_trimestrales";
						break;
                                            
				}
		                            
				$redirect=0;
				$idfrom=$_SESSION["idfrom"];
		
				for($j=1;$j<4;$j++){
					eval('if (isset($xmlt->permisos->idpermission'.$j.')){$xmlflag=TRUE; $idpermission=(string)$xmlt->permisos->idpermission'.$j.';} else {$xmlflag=FALSE;}');
		                    if($xmlflag){
		                        $arrayidpermission[$j]=$idpermission;
		                    }
		                    else{
		                        $arrayidpermission[$j]=array();
		                    }
		                }
		        
		                //$objResponse->alert(print_r($idfrom, true));
		                //$objResponse->alert(print_r($arrayidpermission, true));
		                
		                $idfromsession = array_search($idfrom,$arrayidpermission);
		                //$idfromsession = $idfromsession+1;
		
		                //$objResponse->alert(print_r($idfromsession, true));
		                               
		                if($idfromsession==1){
		                    //Falta verificar si tiene permisos
		                    
		                    //$objResponse->alert("idfromsession= ".$idfromsession);
		                    eval('if (isset($xmlt->permisos->idpermission1)){$xmlflag=TRUE; $idpermission=(string)$xmlt->permisos->idpermission1;} else {$xmlflag=FALSE;}');
		                    
		                    /*if($xmlflag){
		                        if($idpermission==1){
		                            $objResponse->alert("idpermissionDB= ".$idpermission);
		                        }
		                    }*/
		                    if($xmlflag && $idpermission!=1){
		                      
		                            //$objResponse->alert("idfrom 1 sin permisos");
		                        
		                    }
		                    else{
		                    
		                    
		                    eval('if (isset($xmlt->claves->idkey1)){$xmlflagkey=TRUE; $idkey=(string)$xmlt->claves->idkey1;} else {$xmlflagkey=FALSE; $idkey=0;}');
		
		                    if($idkey==1){     //pide clave
		                        //$objResponse->alert("idkey= ".$idkey);
		                        //$objResponse->alert("pide clave");
		                        
		                        if(isset($_SESSION["loginDownload"])){
		                            //$objResponse->alert("Esta Logeado");
		                            //$objResponse->redirect("file.php?nf=".(string)$xmlt->pdf."&sub=".$result["idsubcategory"][0]);
		                            //$redirect=1;                                      
		
		                        	/*Verifica si existe el archivo*/
		                        	eval('if (isset($xmlt->pdf)){$xmlflag=TRUE; $pdf=(string)$xmlt->pdf;} else {$xmlflag=FALSE;}');
		                            if(($xmlflag) and ($pdf!="")){
		
		                                $ruta="/datos/its/$categoria/$subcategoria/$pdf";
		                            
		                            //$objResponse->alert((string)$xmlt->pdf);
		
		                                if (!file_exists($ruta)){
		                                    $objResponse->alert("El Archivo no existe");
		                                    //$objResponse->alert($ruta);                                
		                                }
		                                else{
		                                    $objResponse->redirect("file.php?nf=".(string)$xmlt->pdf."&sub=".$result["idsubcategory"][0]);
		                                    $redirect=1;                                      
		                                }
		                            }
		                            else{
		                                $objResponse->alert("La publicación no tiene asignado ningún pdf");
		                            }                    
		                            
		                        }
		                        else{
		                            $objResponse->alert("Este Archivo requiere permisos para su descarga, contacte al autor");
		                        }
		                    }
		                    else{
		                            //$objResponse->alert("No pide clave");
		                            //$objResponse->redirect("file.php?nf=".(string)$xmlt->pdf."&sub=".$result["idsubcategory"][0]);
		                            //$redirect=1;                                                             
		                        /*Verifica si existe el archivo*/
		                        eval('if (isset($xmlt->pdf)){$xmlflag=TRUE; $pdf=(string)$xmlt->pdf;} else {$xmlflag=FALSE;}');
		                            if(($xmlflag) and ($pdf!="")){
		
		                                $ruta="/datos/its/$categoria/$subcategoria/$pdf";
		                            
		                            //$objResponse->alert((string)$xmlt->pdf);
		
		                                if (!file_exists($ruta)){
		                                    $objResponse->alert("El Archivo no existe");
		                                    //$objResponse->alert($ruta);                                
		                                }
		                                else{
		                                    $objResponse->redirect("file.php?nf=".(string)$xmlt->pdf."&sub=".$result["idsubcategory"][0]);
		                                    $redirect=1;                                      
		                                }
		                            }
		                            else{
		                                $objResponse->alert("La publicación no tiene asignado ningún pdf");
		                            }                    
		                        
		                    }
		                    }
		                }
		                        
		                if($idfromsession==2){
		                    
		                    //$objResponse->alert("idfromsession= ".$idfromsession);
		                    eval('if (isset($xmlt->claves->idkey2)){$xmlflagkey=TRUE; $idkey=(string)$xmlt->claves->idkey2;} else {$xmlflagkey=FALSE; $idkey=0;}');
		
		                    if($idkey==2){     //pide clave
		                        //$objResponse->alert("idkey= ".$idkey);
		                        //$objResponse->alert("pide clave");
		                        
		                        if(isset($_SESSION["loginDownload"])){
		                            //$objResponse->alert("Esta Logeado");
		                            //$objResponse->redirect("file.php?nf=".(string)$xmlt->pdf."&sub=".$result["idsubcategory"][0]);
		                            //$redirect=1;                                      
		                        /*Verifica si existe el archivo*/
		                        eval('if (isset($xmlt->pdf)){$xmlflag=TRUE; $pdf=(string)$xmlt->pdf;} else {$xmlflag=FALSE;}');
		                            if(($xmlflag) and ($pdf!="")){
		
		                                $ruta="/datos/its/$categoria/$subcategoria/$pdf";
		                            
		                            //$objResponse->alert((string)$xmlt->pdf);
		
		                                if (!file_exists($ruta)){
		                                    $objResponse->alert("El Archivo no existe");
		                                    //$objResponse->alert($ruta);                                
		                                }
		                                else{
		                                    $objResponse->redirect("file.php?nf=".(string)$xmlt->pdf."&sub=".$result["idsubcategory"][0]);
		                                    $redirect=1;                                      
		                                }
		                            }
		                            else{
		                                $objResponse->alert("La publicación no tiene asignado ningún pdf");
		                            }                    
		                            
		                        }
		                        else{
		                            //$objResponse->alert("Key = 2 pero No Esta Logeado");
		                            $objResponse->alert("Este Archivo requiere permisos para su descarga, contacte al autor");                            
		                        }
		                    }
		                    else{
		                            //$objResponse->alert("No pide clave");
		                            //$objResponse->redirect("file.php?nf=".(string)$xmlt->pdf."&sub=".$result["idsubcategory"][0]);
		                            //$redirect=1;                                      
		                        /*Verifica si existe el archivo*/
		                        eval('if (isset($xmlt->pdf)){$xmlflag=TRUE; $pdf=(string)$xmlt->pdf;} else {$xmlflag=FALSE;}');
		                            if(($xmlflag) and ($pdf!="")){
		
		                                $ruta="/datos/its/$categoria/$subcategoria/$pdf";
		                            
		                            //$objResponse->alert((string)$xmlt->pdf);
		
		                                if (!file_exists($ruta)){
		                                    $objResponse->alert("El Archivo no existe");
		                                    //$objResponse->alert($ruta);                                
		                                }
		                                else{
		                                    $objResponse->redirect("file.php?nf=".(string)$xmlt->pdf."&sub=".$result["idsubcategory"][0]);
		                                    $redirect=1;                                      
		                                }
		                            }
		                            else{
		                                $objResponse->alert("La publicación no tiene asignado ningún pdf");
		                            }                    
		                        
		                        
		                    }
		                    
		                }
		                
		                if($idfromsession==3){
		                    
		                    //$objResponse->alert("idfromsession= ".$idfromsession);
		                    eval('if (isset($xmlt->claves->idkey3)){$xmlflagkey=TRUE; $idkey=(string)$xmlt->claves->idkey3;} else {$xmlflagkey=FALSE; $idkey=0;}');
		
		                    if($idkey==3){     //pide clave
		                        //$objResponse->alert("idkey= ".$idkey);
		                        //$objResponse->alert("pide clave");
		                        
		                        if(isset($_SESSION["loginDownload"])){
		                            //$objResponse->alert("Esta Logeado");
		                            //$objResponse->redirect("file.php?nf=".(string)$xmlt->pdf."&sub=".$result["idsubcategory"][0]);
		                            //$redirect=1;                                      
		                        /*Verifica si existe el archivo*/
		                        eval('if (isset($xmlt->pdf)){$xmlflag=TRUE; $pdf=(string)$xmlt->pdf;} else {$xmlflag=FALSE;}');
		                            if(($xmlflag) and ($pdf!="")){
		
		                                $ruta="/datos/its/$categoria/$subcategoria/$pdf";
		                            
		                            //$objResponse->alert((string)$xmlt->pdf);
		
		                                if (!file_exists($ruta)){
		                                    $objResponse->alert("El Archivo no existe");
		                                    //$objResponse->alert($ruta);                                
		                                }
		                                else{
		                                    $objResponse->redirect("file.php?nf=".(string)$xmlt->pdf."&sub=".$result["idsubcategory"][0]);
		                                    $redirect=1;                                      
		                                }
		                            }
		                            else{
		                                $objResponse->alert("La publicación no tiene asignado ningún pdf");
		                            }                    
		                            
		                        }
		                        else{
		                            //$objResponse->alert("No Esta Logeado");
		                            $objResponse->alert("Este Archivo requiere permisos para su descarga, contacte al autor");
		                        }
		                    }
		                    else{
		                        eval('if (isset($xmlt->pdf)){$xmlflag=TRUE; $pdf=(string)$xmlt->pdf;} else {$xmlflag=FALSE;}');
		                            if(($xmlflag) and ($pdf!="")){
		
		                                $ruta="/datos/its/$categoria/$subcategoria/$pdf";
		                            
		                            //$objResponse->alert((string)$xmlt->pdf);
		
		                                if (!file_exists($ruta)){
		                                    $objResponse->alert("El Archivo no existe");
		                                    //$objResponse->alert($ruta);                                
		                                }
		                                else{
		                                    $objResponse->redirect("file.php?nf=".(string)$xmlt->pdf."&sub=".$result["idsubcategory"][0]);
		                                    $redirect=1;                                      
		                                }
		                            }
		                            else{
		                                $objResponse->alert("La publicación no tiene asignado ningún pdf");
		                            }                    
		                    }
		                }
		
		                if($idfromsession==4){
		                    
		                    //$objResponse->alert("idfromsession= ".$idfromsession);
		                    eval('if (isset($xmlt->claves->idkey4)){$xmlflagkey=TRUE; $idkey=(string)$xmlt->claves->idkey4;} else {$xmlflagkey=FALSE; $idkey=0;}');
		
		                    if($idkey==4){     //pide clave
		                        //$objResponse->alert("idkey= ".$idkey);
		                        //$objResponse->alert("pide clave");
		                        
		                        if(isset($_SESSION["loginDownload"])){
		                            //$objResponse->alert("Esta Logeado");
		                            //$objResponse->redirect("file.php?nf=".(string)$xmlt->pdf."&sub=".$result["idsubcategory"][0]);
		                            //$redirect=1;
		                        /*Verifica si existe el archivo*/
		                        eval('if (isset($xmlt->pdf)){$xmlflag=TRUE; $pdf=(string)$xmlt->pdf;} else {$xmlflag=FALSE;}');
		                            if(($xmlflag) and ($pdf!="")){
		
		                                $ruta="/datos/its/$categoria/$subcategoria/$pdf";
		                            
		                            //$objResponse->alert((string)$xmlt->pdf);
		
		                                if (!file_exists($ruta)){
		                                    $objResponse->alert("El Archivo no existe");
		                                    //$objResponse->alert($ruta);                                
		                                }
		                                else{
		                                    $objResponse->redirect("file.php?nf=".(string)$xmlt->pdf."&sub=".$result["idsubcategory"][0]);
		                                    $redirect=1;                                      
		                                }
		                            }
		                            else{
		                                $objResponse->alert("La publicación no tiene asignado ningún pdf");
		                            }                    
		                            
		                        }
		                        else{
		                            //$objResponse->alert("No Esta Logeado");
		                            $objResponse->alert("Este Archivo requiere permisos para su descarga, contacte al autor");                            
		                        }
		                    }
		                    else{
		                            //$objResponse->alert("No pide clave");
		                            //$objResponse->redirect("file.php?nf=".(string)$xmlt->pdf."&sub=".$result["idsubcategory"][0]);
		                            //$redirect=1;
		                        /*Verifica si existe el archivo*/
		                        eval('if (isset($xmlt->pdf)){$xmlflag=TRUE; $pdf=(string)$xmlt->pdf;} else {$xmlflag=FALSE;}');
		                            if(($xmlflag) and ($pdf!="")){
		
		                                $ruta="/datos/its/$categoria/$subcategoria/$pdf";
		                            
		                            //$objResponse->alert((string)$xmlt->pdf);
		
		                                if (!file_exists($ruta)){
		                                    $objResponse->alert("El Archivo no existe");
		                                    //$objResponse->alert($ruta);                                
		                                }
		                                else{
		                                    $objResponse->redirect("file.php?nf=".(string)$xmlt->pdf."&sub=".$result["idsubcategory"][0]);
		                                    $redirect=1;                                      
		                                }
		                            }
		                            else{
		                                $objResponse->alert("La publicación no tiene asignado ningún pdf");
		                            }
		                        
		                    }
		                    
		                }
				if($idfromsession==""){
		                        $objResponse->alert("Este Archivo no tiene asignado ningún permiso para su descarga, contacte al autor");
				}
		                
		
		}
			return $objResponse;
		}
	
	

	/**************************************************
	Funcion que muestra un combo
	***************************************************/
	function comboMonth($dbMonth=0,$funcion="",$name="month"){

		$mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre");
		$id = array("1","2","3","4","5","6","7","8","9","10","11","12");
	
		if($dbMonth!=0){
			/*buscar la posición de la variable $dbidMonth recuperada
			para mostrarla como valor inicial del combo*/
			$pos = array_search($dbMonth,$id);
			$pos=$pos+1;
		}
		else{
			$pos=0;
		}
	
		if (is_array($mes) and is_array($id)){
			$cboPubRef=new combo();
			$comboPubRef=$cboPubRef->comboList($mes,$id,"OnChange","$funcion","Mes","0","$name",$pos,"combo-buscador-2");
			
		}
		else{
			$comboPubRef= "No data available";
		}
	
		return $comboPubRef;
	}
		
		
		
	/**************************************************
	Funcion que muestra un combo
	***************************************************/
	function comboMonthShow($dbMonth=0){
		$objResponse = new xajaxResponse();
		$comboPubRef=comboMonth($dbMonth);
		$objResponse->assign('divMonth', 'innerHTML',$comboPubRef);
		return $objResponse;
	}
	
	/**************************************************
	Funcion que muestra un combo
	***************************************************/
	function comboYear($dbyear=0,$funcion="",$name=""){

            if($name==""){
                $name="year";
            }
               
                
	    $anoActual=date('Y');
	    $k=0;
	    for ($i=$anoActual;$i>=1958;$i--){
	
			$desc[$k] = $i;
			$k++;
		}
	
		if($dbyear!=0){
			/*buscar la posición de la variable $tipo recuperada
			para mostrarla como valor inicial del combo*/
			$pos = array_search($dbyear,$desc);
			$pos=$pos+1;
		}
		else{
			$pos=0;
		}
	
		if (is_array($desc)){
			$cboPubRef=new combo();
			$comboPubRef=$cboPubRef->comboList($desc,$desc,"OnChange","$funcion","Año","0","$name",$pos,"combo-buscador-2");

		}
		else{
			$comboPubRef='No data available';
		}
	
	return $comboPubRef;
	}
	

	
	function comboYearShow($dbyear=0){
		$objResponse = new xajaxResponse();
		$comboPubRef=comboYear($dbyear=0);
		$objResponse->assign('divYear', 'innerHTML',$comboPubRef);
	
		return $objResponse;
	}	
	

	function comboDay($dbdia=0,$funcion="",$name=""){

            if($name==""){
                $name="dia";
            }
               
                
	    //$diaActual=date('j');
	    $k=0;
	    for ($i=1;$i<=31;$i++){
	
			$desc[$k] = $i;
			$k++;
            }
	
		if($dbdia!=0){
			/*buscar la posición de la variable $tipo recuperada
			para mostrarla como valor inicial del combo*/
			$pos = array_search($dbdia,$desc);
			$pos=$pos+1;
		}
		else{
			$pos=0;
		}
	
		if (is_array($desc)){
			$cboPubRef=new combo();
			$comboPubRef=$cboPubRef->comboList($desc,$desc,"OnChange","$funcion","Dia","0","$name",$pos,"combo-buscador-2");

		}
		else{
			$comboPubRef='No data available';
		}
	
	return $comboPubRef;
	}
        
	/**************************************************
	Funcion que muestra un combo
	***************************************************/
	function comboTipoFechas($idsubcategory){
	
	          
	    $result=templateSQL($idsubcategory);
	    $html="";	$combo="";
	    
		if (isset($result["subcategory_template"])){
		    if (is_array($result["subcategory_template"])){
			$subcategory_template = $result["subcategory_template"][0];
			$xmlt = simplexml_load_string($subcategory_template);
			$i=0;
		
			foreach ($xmlt->field as $templatefield){
		
				$fechas[$i]=$templatefield;
				$i++;
		
			}
		    }    
		}

	    if($result["Error"]==0){
	        if($result["Count"]>0){
				$cboAreas=new combo();
	
				for($n=0;$n<count($fechas);$n++){
					if($fechas[$n]=="Fecha de ingreso"){
						$valfechas[$n]=1;
					}
					if($fechas[$n]=="Fecha de publicacion"){
						$valfechas[$n]=2;
					}
					if($fechas[$n]=="Fecha de presentacion"){
						$valfechas[$n]=3;
					}
					if($fechas[$n]=="Fecha de sismo"){
						$valfechas[$n]=4;
					}
                                        if($fechas[$n]=="Fecha de evento"){
						$valfechas[$n]=5;
					}
	                                        
				}
	
	            $combo=$cboAreas->comboList($fechas,$valfechas,"onchange","","Tipo de fecha","0","selectTypeDate",0,"combo-buscador-1");
	        }
			else{
				//$combo="Elija Tipo Publicaci&oacute;n";
				$combo=$cboAreas->comboList("Fecha de ingreso",1,"onchange","","Tipo de fecha","0","selectTypeDate",0,"combo-buscador-1");
			}
	    }
	    else{
	        $html="Error SQL";
	    }
		$html=$combo;
	
		return $html;
	}
	
	
	
	function comboTipoFechasShow($idsubcategory){
		$objResponse = new xajaxResponse();
	    $html=comboTipoFechas($idsubcategory);
	    
		$objResponse->assign("divTipoFecha","innerHTML",$html);
	
		return $objResponse;
	}
	
	/**************************************************
	Funcion que muestra un combo
	***************************************************/
	function comboTipoPublicacionShow($dbid=0,$idcategory=0,$idarea=0,$seccion=0){
		$objResponse = new xajaxResponse();
		$objResponse->assign("moreOptions", 'innerHTML','');
		//$objResponse->assign("divAuthor", "style.display","inline");
                
		$in_notin="";
		$rango="";
		if($idarea==5){
		    //$in_notin="in";
		    //$rango="8";
		}
		else{
		    $in_notin="not in";
		    $rango="8";   
		}
                
		switch($idcategory){
			case 1:
                                
                                $objResponse->assign("searchDate", 'style.display','block');
				$iniCombo="Todas las publicaciones";
				
				$result=searchSubcategorySQL($idcategory);
				$desc=$result["subcategory_description"];
				$id=$result["idsubcategory"];

				if (isset($_SESSION["idautor"]) and $idarea==0){
					$funcion="xajax_comboTipoFechasShow(this.value);xajax_comboReferenciaAutorShow(this.value)";						
				}
				else{
					$funcion="xajax_comboTipoFechasShow(this.value);xajax_seccionShow(this.value,$idarea)";
				}
				
				$cboPubRef=new combo();
				$comboPubRef=$cboPubRef->comboList($desc,$id,"OnChange",$funcion,$iniCombo,"10","selectTypePublication",0,"combo-buscador-1");
				$html="<div class='campo-buscador'>Tipo publicaci&oacute;n :</div><div class='contenedor-combo-buscador-1' id='searchTypePublication'>$comboPubRef</div>";
				$html.="<div style='clear:both'></div>";
				$html.="<div id='referenceStatus'>";
				$html.="<div id='titReference' class='campo-buscador'>Referencia :</div><div class='contenedor-combo-buscador-1' id='searchReference'></div>";				
				$html.="<div style='clear:both'></div>";
				$html.="<div id='titStatus' class='campo-buscador'>Estado :</div><div class='contenedor-combo-buscador-1' id='searchEstado'></div>";				
				$html.="<div style='clear:both'></div>";
				$html.="</div>";				
				$cboNull="<select class='combo-buscador-1'></select>";
                                
				$objResponse->assign("optionsSubcategory", 'innerHTML',$html);
				$objResponse->assign("searchReference", 'innerHTML',$cboNull);
				$objResponse->assign("searchEstado", 'innerHTML',$cboNull);
                                
				break;
			case 2:
                                
				$objResponse->assign("searchTypePublication", 'innerHTML','');
				$objResponse->assign("searchReference", 'innerHTML','');
				$objResponse->assign("searchEstado", 'innerHTML','');
				$objResponse->assign("searchDate", 'style.display','block');
                                //$objResponse->assign("divTipoFecha", 'style.display','none');
                                $objResponse->script("xajax_comboTipoFechasShow(4);");
                                
				$html="<div class='campo-buscador'>Apellido presentador:</div>";
				$html.="<div class='contenedor-caja-buscador-1'>";
				$html.="<input type='text' id='prePorApellido' name='prePorApellido' class='caja-buscador-1' />";
				$html.="</div><div style='clear:both'></div>";
                                
				$html.="</div><div style='clear:both'></div>";
				$html.="<div class='campo-buscador'>Nombre del evento:</div>";
				$html.="<div class='contenedor-caja-buscador-1'>";
				$html.="<input type='text' id='evento' name='evento' class='caja-buscador-1' />";
                                $html.="</div><div style='clear:both'></div>";
                                
				$html.="<div class='campo-buscador'>Lugar:</div>";
				$html.="<div class='contenedor-caja-buscador-1'>";
				$html.="<input type='text' id='lugar' name='lugar' class='caja-buscador-1' />";
                                $html.="</div><div style='clear:both'></div>";

				$html.="<div class='campo-buscador'>Pa&iacute;s:</div>";
				$html.="<div class='contenedor-caja-buscador-1'>";
				$html.="<input type='text' id='pais' name='pais' class='caja-buscador-2' />";
                                $html.="</div><div style='clear:both'></div>";
                                
				$html.="<div class='campo-buscador'>Tipo de ponencia:</div>";
				$html.="<div class='contenedor-combo-buscador-1'>";
				$html.="<select class='combo-buscador-1' id='tipoPonencia' name='tipoPonencia'><option value='0'>Todos los tipos</option><option value='1'>Oral</option><option value='2'>Poster</option></select>";
				$html.="</div><div style='clear:both'></div>";
                                /*
				//$html.="<div class='campo-buscador'>Nombre presentador:</div>";
				//$html.="<div class='contenedor-caja-buscador-1'>";
				//$html.="<input type='text' maxlength='1' id='prePorNombre' name='prePorNombre' class='caja-buscador-1' />";
				//$html.="</div><div style='clear:both'></div>";
                                 
                                if($seccion=="admin"){
                                    
				$html.="<div class='campo-buscador'>Apellido presentador:</div>";
				$html.="<div class='contenedor-caja-buscador-1'>";
				$html.="<input type='text' id='prePorApellido' name='prePorApellido' class='caja-buscador-1' />";
				$html.="</div><div style='clear:both'></div>";
                                
                                }
                                */
                                $comboCategoria=comboCategoriaEvento(0,"search");
                                $html.="<div class='campo-buscador'>Categor&iacute;a del evento:</div>";
                                $html.="<div class='contenedor-combo-buscador-1' id='categoria_evento'>$comboCategoria</div>";
                                $html.="</div><div style='clear:both'></div>";

                                $comboClase=comboClaseEvento(0,"search");
                                $html.="<div class='campo-buscador'>Clase del evento:</div>";
                                $html.="<div class='contenedor-combo-buscador-1' id='clase_evento'>$comboClase</div>";
                                $html.="</div><div style='clear:both'></div>";
                                
				$objResponse->assign("optionsSubcategory", "innerHTML",$html);
				break;
			case 3:
                                $objResponse->assign("searchDate", 'style.display','block');
				$objResponse->assign("divAuthor", "style.display","none");
                                
				$html="";
				$result=searchSubcategorySQL($idcategory);
				$desc=$result["subcategory_description"];
				$id=$result["idsubcategory"];
				$iniCombo="Todos las tipos";
				$funcion="'xajax_comboTipoFechasShow(this.value); xajax_seccionShow(this.value)'";
				$cboasuntosAcademicos=new combo();
				$html="<div class='campo-buscador'>Tipos de informaci&oacute;n</div>";
				$html.="<div class='contenedor-combo-buscador-1'>";				
				$html.=$cboasuntosAcademicos->comboList($desc,$id,"OnChange",$funcion,"$iniCombo","0","selectTypeAcademicos",0,"combo-buscador-1");
				$html.="</div><div style='clear:both'></div>";
				$objResponse->assign("optionsSubcategory", "innerHTML",$html);
				break;
			case 4:
				$html="";
				//$result=searchSubcategorySQL($idcategory);
                                
                                $objResponse->assign("searchDate", 'style.display','block');
                                
                                
				$result=searchSubcategorySQL($idcategory,$in_notin,$rango);
				$desc=$result["subcategory_description"];
				$id=$result["idsubcategory"];
				$iniCombo="Todos los tipos";
				$funcion="xajax_comboTipoFechasShow(this.value);xajax_seccionShow(this.value)";
				$cboinformacionInterna=new combo();
				$html="<div class='campo-buscador'>Tipo de informaci&oacute;n</div>";
				$html.="<div class='contenedor-combo-buscador-1'>";								
				$html.=$cboinformacionInterna->comboList($desc,$id,"OnChange",$funcion,"$iniCombo","40","selectTypeCategory",0,"combo-buscador-1");
				$html.="</div><div style='clear:both'></div>";
				$objResponse->assign("optionsSubcategory", "innerHTML",$html);
                                //$objResponse->assign("optionsSubcategory", "innerHTML",$result["Query"]);
				break;
		}
		
		$objResponse->assign("divMonth", "style.display","inline");		
		$objResponse->assign("optionsSubcategory", "style.display","block");
		return $objResponse;
	}
	
	
	
	function comboEstadoShow($div,$selectIdx=0){
	
		$respuesta = new xajaxResponse();
	
	    $result=searchStatus();
	    $html="";
		$combo="";
	
	
	    if($result["Error"]==0){
	        if($result["Count"]>0){
				$cboAreas=new combo();
	            $combo=$cboAreas->comboList($result["status_description"],$result["idstatus"],"onchange","","Todos los estados","0","selectStatus",$selectIdx,"combo-buscador-1");
	        }
			else{
				$combo="No hay registros";
			}
	    }
	    else{
	        $html="Error SQL";
	    }
		$html=$combo;
		$respuesta->Assign($div,"innerHTML",$html);
	    return $respuesta;
	}
	
	function comboCategoryResult($idarea=0,$seccion=""){
       	$resultSql= comboCategorySQL($idarea);
		$desc = $resultSql[0];
		$id = $resultSql[1];
                
                if(isset($seccion)){
                    if($seccion==""){
                        $seccion="''";
                    }
                }
                
        if($idarea!=0){
            //buscar la posición de la variable $tipo recuperada
            //para mostrarla como valor inicial del combo
            $pos = array_search($idarea,$id);
            $pos=$pos+1;
        }
        else{
            $pos=0;
        }
	
		if (is_array($desc) and is_array($id)){
			$cboMaestro=new combo();
			$combo=$cboMaestro->comboList($desc,$id,"OnChange","xajax_comboTipoPublicacionShow(0,this.value,$idarea,$seccion)","Todas las categorias","0","idcategory",0,"combo-buscador-1");
			
		}
		else{
			$combo='No data available';
		}
	        
		return $combo;
	    
	}
	
	function comboCategoryShow($idarea){
		$respuesta = new xajaxResponse();
		$html = comboCategoryResult($idarea);
		$respuesta->assign("divCategory", 'innerHTML', $html);	        
		return $respuesta;
	}
	

	/**************************************************
	
	***************************************************/
	function comboMagnitudShow($dbmagnitud=0,$seccion=0){
	$objResponse = new xajaxResponse();
	
	        switch($seccion){
	            case 1:
	                $funcion="xajax_registerMagnitud(this.value)";
	            break;
	            case 2:
	                $funcion="";
	            break;
	        }
	
	    $k=0;
	    for ($i=3;$i<=12;$i++){
	
	            $desc[$k] = $i;
	            $k++;
	        }
	
	        if($dbmagnitud!=0){
	                /*buscar la posición de la variable $tipo recuperada
	                para mostrarla como valor inicial del combo*/
	                $pos = array_search($dbmagnitud,$desc);
	                $pos=$pos+1;
	        }
	        else{
	                $pos=0;
	        }
	
	        if (is_array($desc)){
			$cboPubRef=new combo();
                        //combo-buscador-#: mas alto el numero mas pequeño el combo limite 3
			$comboPubRef=$cboPubRef->comboList($desc,$desc,"OnChange",$funcion,"Todas","0","selectMagnitud",$pos,"combo-buscador-3");
			$objResponse->assign('divMagnitud', 'innerHTML',$comboPubRef);
		}
		else{
			$objResponse->assign('divMagnitud', 'innerHTML', 'No data available');
		}
	
	return $objResponse;
	}
	
	

	/**************************************************

	***************************************************/
	function comboQuarter($dbid=0){
		//$objResponse = new xajaxResponse();
		$desc = array("Primero","Segundo","Tercero","Cuarto");
		$id = array(1,2,3,4);
	
                $funcion="xajax_obtenerIdDescripcion('selectQuarter','registerQuarter')";
                
        if($dbid!=0){
                /*buscar la posición de la variable $tipo recuperada
                para mostrarla como valor inicial del combo*/
                $pos = array_search($dbid,$id);
                $pos=$pos+1;
        }
        else{
                $pos=0;
        }
	
		if (is_array($desc) and is_array($id)){
			$cboPubRef=new combo();
			$html=$cboPubRef->comboList($desc,$id,"OnChange",$funcion,"Elige","0","selectQuarter",$pos,"combo-buscador-1");
		}
		else{
			$html="Error: comboQuarter";
			
		}
		//$html="<p><label class='left'>Trimestre:</label>$comboPubRef<br></p>";
		//$objResponse->Assign("divQuarter","innerHTML",$html);
		return $html;
	}

	/**************************************************
	
	***************************************************/
	function comboCategoriaEvento($dbid=0,$seccion=""){
		//$objResponse = new xajaxResponse();
		$desc = array("Internacional","Nacional");
		$id = array("1","2");
                
                if($seccion=="search"){
                    $funcion="";
                }
                else{
                    $funcion="xajax_obtenerIdDescripcion('selectCategoriaEvento','registerCatEvento')";
                }
                
        if($dbid!=0){
            //buscar la posición de la variable $tipo recuperada
            //para mostrarla como valor inicial del combo
			$pos = array_search($dbid,$id);
			$pos=$pos+1;
        }
        else{
			$pos=0;
        }
	
		if (is_array($desc) and is_array($id)){
			$cboPubRef=new combo();
			$html=$cboPubRef->comboList($desc,$id,"OnChange",$funcion,"Elige","0","selectCategoriaEvento",$pos,"combo-buscador-2");
		}
		//$html="<p><label class='left'>Categor&iacute;a Evento:</label>$comboPubRef<br></p>";
		//$objResponse->Assign("categoriaEvento","innerHTML",$html);
		return $html;
	}
	
	/**************************************************
	
	***************************************************/
	function comboClaseEvento($dbid=0,$seccion=""){
		//$objResponse = new xajaxResponse();
		$desc = array("Difusi&oacute;n","Informativa");
		$id = array("1","2");

                if($seccion=="search"){
                    $funcion="";
                }
                else{               
                    $funcion="xajax_obtenerIdDescripcion('selectClaseEvento','registerClaseEvento')";
                }
                
        if($dbid!=0){
            //buscar la posición de la variable $tipo recuperada
            //para mostrarla como valor inicial del combo
			$pos = array_search($dbid,$id);
			$pos=$pos+1;
        }
        else{
			$pos=0;
        }
	
		if (is_array($desc) and is_array($id)){
			$cboPubRef=new combo();
			$html=$cboPubRef->comboList($desc,$id,"OnChange",$funcion,"Elige","0","selectClaseEvento",$pos,"combo-buscador-2");
		}
		//$html="<p><label class='left'>Categor&iacute;a Evento:</label>$comboPubRef<br></p>";
		//$objResponse->Assign("categoriaEvento","innerHTML",$html);
		return $html;
	}
	
	/**************************************************
	
	***************************************************/
	function comboTipoAsuntosAcademicosShow($dbid=0,$seccion=0){
		$objResponse = new xajaxResponse();

		switch($seccion){
		    case 1:
		    $iniCombo="Elige";
		    $divCombo="registerTypeAsuAca";
		    $funcion="xajax_formSubcategoryShow(this.value)";
		    break;
		    case 2:
		    $iniCombo="Elige Tipo Publicaci&oacute;n";
		    $divCombo="searchTypeAsuAca";
		    $funcion="";
		    $funcion="xajax_seccionShow(this.value)";
		    break;
		}

		$desc = array("Compendio de Estudiantes","Charlas Internas");
		$id = array("8","9");

        if($dbid!=0){
                /*buscar la posición de la variable $tipo recuperada
                para mostrarla como valor inicial del combo*/
                $pos = array_search($dbid,$id);
                $pos=$pos+1;
        }
        else{
                $pos=0;
        }

		if (is_array($desc) and is_array($id)){
			$cboPubRef=new combo();
			$comboPubRef=$cboPubRef->comboList($desc,$id,"OnChange",$funcion,"$iniCombo","0","tipoPublicacion",$pos,"combo-buscador-1");
			$objResponse->assign($divCombo, 'innerHTML',$comboPubRef);
		}
		else{
			$objResponse->assign($divCombo, 'innerHTML', 'No data available');
		}
		return $objResponse;
	}

	/**************************************************
	
	***************************************************/
	function comboTipoInformacionInternaShow($dbid=0,$seccion=0){
		$objResponse = new xajaxResponse();
	
		switch($seccion){
		    case 1:
		    $iniCombo="Elige";
		    $divCombo="registerTypeInfInt";
		    $funcion="xajax_formSubcategoryShow(this.value)";
		    break;
		    case 2:
		    $iniCombo="Elige Tipo Publicaci&oacute;n";
		    $divCombo="searchTypeInfInt";
		    $funcion="";
		    $funcion="xajax_seccionShow(this.value)";
		    break;
		}
	
		$desc = array("Informes Trimestrales","Reportes T&eacute;cnicos","Bolet&iacute;nes");
		$id = array("5","6","7");
	
        if($dbid!=0){
                /*buscar la posición de la variable $tipo recuperada
                para mostrarla como valor inicial del combo*/
                $pos = array_search($dbid,$id);
                $pos=$pos+1;
        }
        else{
                $pos=0;
        }
	
		if (is_array($desc) and is_array($id)){
			$cboPubRef=new combo();
			$comboPubRef=$cboPubRef->comboList($desc,$id,"OnChange",$funcion,"$iniCombo","0","tipoPublicacion",$pos,"combo-buscador-1");
			$objResponse->assign($divCombo, 'innerHTML',$comboPubRef);
		}
		else{
			$objResponse->assign($divCombo, 'innerHTML', 'No data available');
		}
	
		return $objResponse;
	}


	/**************************************************

	***************************************************/
	function comboTipoTesisShow($dbid=0,$seccion=0){
		$objResponse = new xajaxResponse();
                //$objResponse->alert($dbid);
                $funcion="";
		$funcion2="";

		switch($seccion){
		    case 1:
		        $div="registerTipoTesis";
		        //$funcion="tipoTesisText()";
                        $funcion="xajax_obtenerIdDescripcion('selectTipoTesis','registerTipoTesis')";
		        //$funcion2="xajax_registerTipoTesis(this.value,tipoTesisDescription.value)";
		    break;
		    case 2:
		        $div="searchTipoTesis";
		        $funcion="tipoTesisText()";
		    break;
		}
	
		$desc = array("Pregrado","M.Sc","Ph. D.");
		$id = array("1","2","3");
	
        if($dbid!=0){
                /*buscar la posición de la variable $tipo recuperada
                para mostrarla como valor inicial del combo*/
                $pos = array_search($dbid,$id);
                $pos=$pos+1;
        }
        else{
                $pos=0;
        }
	
            
        
        
		if (is_array($desc) and is_array($id)){
			$cboPubRef=new combo();
			$comboPubRef=$cboPubRef->comboList($desc,$id,"OnChange",$funcion.";".$funcion2,"Todas las tesis","0","selectTipoTesis",$pos,"combo-buscador-1");
			$objResponse->assign($div, 'innerHTML',$comboPubRef);
		}
		else{
			$objResponse->assign($div, 'innerHTML', 'No data available');
		}
	
		return $objResponse;
	}
	
	
	/**************************************************
	Funcion que muestra un combo
	***************************************************/
	function comboTipoPonencia($dbid=0){
		//$objResponse = new xajaxResponse();
		
		
		//$funcion="tipoPonenciaText()";
		//$funcion2="xajax_registerTipoPonencia(this.value,tipoPonencia_txt.value)";
                
                $funcion="xajax_obtenerIdDescripcion('selectTipoPonencia','registerTipoPonencia')";
                
		$desc = array("Oral","Poster");
		$id = array("1","2");
	
		
        if($dbid!=0){
			//buscar la posición de la variable $tipo recuperada
            //para mostrarla como valor inicial del combo
			$pos = array_search($dbid,$id);
			$pos=$pos+1;
        }
        else{
			$pos=0;
        }
	
		if (is_array($desc) and is_array($id)){
			$cboPubRef=new combo();
			$html=$cboPubRef->comboList($desc,$id,"OnChange",$funcion,"Seleccione tipo","0","selectTipoPonencia",$pos,"combo-buscador-1");
		}
		else{
			$html="no hay datos";
		}
		
		//$html="<p><label class='left'>Tipo:</label>$comboPubRef<br><br></p>";
		//$objResponse->Assign("tipoPonencia","innerHTML",$html);
				
		return $html;
	}
	
	
	function comboTypeSubcategoryResult($idcategory,$in_notin="",$rango=""){
        $resultSql= searchSubcategorySQL($idcategory,$in_notin,$rango,$_SESSION["idarea"]);
        return $resultSql;
	}

	/**************************************************

	***************************************************/
	function comboTypeSubcategoryShow($dbid=0,$document=0,$idarea=0){
		$objResponse = new xajaxResponse();
		
		$in_notin="";
		$rango="";
		if($idarea==5){
		    $in_notin="in";
		    $rango="8";
		}
		else{
		    $in_notin="not in";
		    $rango="8";   
		}
	
		switch($document){
		    case 1:
		    $iniCombo="Publicaci&oacute;n";
		    $divCombo="registerTypePublication";
		    $funcion="xajax_formSubcategoryShow(this.value)";
		    break;
		    case 4:
		    $iniCombo="Informaci&oacute;n Interna";
		    $divCombo="registerTypeInfInt";
		    $funcion="xajax_formSubcategoryShow(this.value)";
		    break;
		    case 3:
		    $iniCombo="Asuntos Acad&eacute;micos";
		    $divCombo="registerTypeAsuAca";
		    $funcion="xajax_formSubcategoryShow(this.value)";
		    break;
		    case 2:
		    $iniCombo="";
		    $divCombo="";
		    $funcion="";
		    break;
		}
	
		$resultSql= comboTypeSubcategoryResult($document,$in_notin,$rango);
		$desc = $resultSql["subcategory_description"];
		$id = $resultSql["idsubcategory"];
	
		if($dbid!=0){
			$pos = array_search($dbid,$id);
			$pos=$pos+1;
		}
		else{
			$pos=0;
		}
	
		if (is_array($desc) and is_array($id)){
			$cboPubRef=new combo();
			$comboPubRef=$cboPubRef->comboList($desc,$id,"OnChange",$funcion,"Elija el tipo de publicación","0","tipoPublicacion",$pos,"combo-buscador-1");
			$objResponse->assign($divCombo, 'innerHTML',$comboPubRef);
		}
		else{
			$objResponse->assign($divCombo, 'innerHTML', 'No data available');
		}
                                
		return $objResponse;
	}


	/**************************************************
	
	***************************************************/
	function comboYearRegisterShow($dbyear=0,$funcion=""){
		//$objResponse = new xajaxResponse();
	    $anoActual=date('Y');
	    $k=0;
	    for ($i=$anoActual;$i>=1958;$i--){
	        $desc[$k] = $i;
	        $k++;
	    }
	
	    //$dbyear=2010;
	
	    if($dbyear!=0){
	            /*buscar la posición de la variable $tipo recuperada
	            para mostrarla como valor inicial del combo*/
	            $pos = array_search($dbyear,$desc);
	            $pos=$pos+1;
	    }
	    else{
	            $pos=0;
	    }
	
	    if (is_array($desc)){
			$cboPubRef=new combo();
			$html=$cboPubRef->comboList($desc,$desc,"onchange",$funcion,"Elige","0","selectYear",$pos,"combo-buscador-1");
	    }
	    else{
	           $html='No data available';
	    }
	
	    //$html="<div class='campo-buscador'>A&ntilde;o:</div><div class='contenedor-combo-buscador-1'>$comboPubRef</div>";
	    //$objResponse->Assign("$capa","innerHTML",$html);
	
		return $html;
	}	


	/**************************************************
	
	***************************************************/
	
    function size($path, $formated = true, $retstring = null){
        if(!is_dir($path) || !is_readable($path)){
            if(is_file($path) || file_exists($path)){
                $size = filesize($path);
            } else {
                return "Error";
            }
        } else {
            $path_stack[] = $path;
            $size = 0;
           
            do {
                $path   = array_shift($path_stack);
                $handle = opendir($path);
                while(false !== ($file = readdir($handle))) {
                    if($file != '.' && $file != '..' && is_readable($path . DIRECTORY_SEPARATOR . $file)) {
                        if(is_dir($path . DIRECTORY_SEPARATOR . $file)){ $path_stack[] = $path . DIRECTORY_SEPARATOR . $file; }
                        $size += filesize($path . DIRECTORY_SEPARATOR . $file);
                    }
                }
                closedir($handle);
            } while (count($path_stack)> 0);
        }
        if($formated){
            $sizes = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            if($retstring == null) { $retstring = '%01.2f %s'; }
            $lastsizestring = end($sizes);
            foreach($sizes as $sizestring){
                if($size <1024){ break; }
                if($sizestring != $lastsizestring){ $size /= 1024; }
            }
            if($sizestring == $sizes[0]){ $retstring = '%01d %s'; } // los Bytes normalmente no son fraccionales
            $size = sprintf($retstring, $size, $sizestring);
        }
        return $size;
    }

	
function verFile(){
        $respuesta= new xajaxResponse();

        /*
        $respuesta->script('
        link1=document.getElementById("link");
        divFile=document.getElementById("fileR");
        divFile.style.display="block";
        divFile.style.width="100px";
        document.formUpload.fileUpload.value="";

        divMensaje=document.getElementById("mensajeR");
        divMensaje.style.display="none";
        link1.style.display="none";
');

*/
        
        $respuesta->assign("formUpload","style.display","block");
        $respuesta->assign("fileR","style.display","block");
        /*$respuesta->assign("fileR","style.width","90px");*/
        $respuesta->assign("tituloUpload","style.display","block");
        $respuesta->assign("linkUpload","style.display","none");
        $respuesta->assign("linkSubir","style.display","none");
        
        
        
        
        
        return $respuesta;
}
	
	
	
	
	
?>

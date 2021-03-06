<?php

	require ('../class/ClassCombo.php');
	require ('../class/ClassForm.php');
	require ('../class/ClassPaginado.php');
        require ('../class/ClassPaginator.php');
	require ('../class/dbconnect.php');
	require ('../class/xajax_core/xajax.inc.php');
	$xajax=new xajax();	
	$xajax->configure('javascript URI', '../class/');
 	date_default_timezone_set('America/Lima');

	require("indexSearch.php");
	require("indexStatistics.php");
 
	//Ejecutamos el modelo
	require("indexModel.php");
	session_start();

	if(isset($_GET["idfrom"])){
		$_SESSION["idfrom"]=$_GET["idfrom"];


		if($_GET["idfrom"]==1){
			if(isset($_GET["idarea"])){
				print ("ERROR IGP - AREA");
				exit;
			}

			if(isset($_GET["idautor"])){
				print ("ERROR IGP - AUTOR");
				exit;
			}
		}


		if($_GET["idfrom"]==2){
			if(isset($_GET["idarea"])){

				if (isset($_SESSION["idarea"])){

					unset($_SESSION["idarea"]);
					$_SESSION["idarea"]=$_GET["idarea"];
				}
				else {
					$_SESSION["idarea"]=$_GET["idarea"];
				}
			}
			else{
				print ("ERROR AREA");
				exit;
			}
		}
		
		if($_GET["idfrom"]==3){

			if (isset($_GET["pag"])){

				unset($_SESSION["pag"]);
				$_SESSION["pag"]=$_GET["pag"];
			}
                    
			if (isset($_SESSION["idautor"])){

				unset($_SESSION["idautor"]);
				$_SESSION["idautor"]=$_GET["idautor"];
			}
			else {
				if(isset($_GET["idautor"])){
					$_SESSION["idautor"]=$_GET["idautor"];
				}
				else{
					print ("ERROR AUTOR");
					exit;
				}
			}
                        
		}
	}
	else{
		print ("NO HA SIDO LLAMADO DESDE LA WEB DEL IGP");
		exit;
	}
	



	function formConsultaIndexShow($idbutton,$seccion=""){
		$objResponse = new xajaxResponse();
	
		if(isset($_SESSION["edit"])){
		    unset($_SESSION["edit"]);
		    unset($_SESSION["publicaciones"]);
		}
		$titulo="";
		// Desde la pagina web del IGP
		if($idbutton==1){
			$formArea='<div class="campo-buscador">&Aacutereas:&nbsp;</div><div class="contenedor-combo-buscador-1" id="divArea"></div><div style="clear:both"></div>';
			$formCategory='<div class="campo-buscador">Categor&iacute;a:&nbsp;</div><div class="contenedor-combo-buscador-1" id="divCategory"><select class="combo-buscador-1"></select></div><div style="clear:both"></div>';
			$functionButton="xajax_auxSearchShow(20,1,xajax.getFormValues('formSearch'));";
			$formAutor='<div id="divAuthor" class="campo-buscador">Apellido Autor:&nbsp;</div><div class="contenedor-combo-buscador-1"><input id="author" name="author" type="text" size="30" class="caja-buscador-1"></div><div style="clear:both"></div>';
		}
	
		// Desde la pagina web del area
		if($idbutton==2){
			//$formArea='<label class="left">Areas:&nbsp;</label><div id="divArea"></div>';
			$formArea="";
			
			if(isset($_SESSION["idarea"])){
				$idarea=$_SESSION["idarea"];
				$formCategory='<div class="campo-buscador">Categor&iacute;a:&nbsp;</div><div class="contenedor-combo-buscador-1" id="divCategory">'.comboCategoryResult($idarea).'</div><div style="clear:both"></div>';
				$nombreArea=searchAreaSQL($idarea);
				
				if($nombreArea["Error"]==0){
					$titulo="&nbsp;&nbsp;&nbsp;  ( ".$nombreArea["area_description"][0]." )";
				}
				else{
					$titulo="Area desconocida";
				} 			
			}
			$functionButton="xajax_auxSearchShow(20,1,xajax.getFormValues('formSearch'),'',$idarea);";
			$formAutor='<div id="divAuthor" class="campo-buscador">Apellido Autor:&nbsp;</div><div class="contenedor-combo-buscador-1"><input id="author" name="author" type="text" size="30" class="caja-buscador-1"></div><div style="clear:both"></div>';
	
		}
		// Desde la pagina web del autor
		if($idbutton==3){
                        //$idarea=$_SESSION["idarea"];
                        if($seccion==2){
                            
                            $objResponse->Script("xajax_auxSearchShow(20,1,xajax.getFormValues('formSearch'));");
                        }
                        
			$formCategory='<div class="campo-buscador">Categor&iacute;a:&nbsp;</div><div class="contenedor-combo-buscador-1" id="divCategory">'.comboCategoryResult(0,$seccion).'</div><div style="clear:both"></div>';
			//$functionButton="xajax_searchPublicationShow(xajax.getFormValues('formSearch'),'3');";
                        $functionButton="xajax_auxSearchShow(20,1,xajax.getFormValues('formSearch'));";
			$formAutor='';
			$formArea='';

			if(isset($_SESSION["idautor"])){
				$idautor=$_SESSION["idautor"];
				$nombreAutor=searchAutorSQL($idautor);
				
				if($nombreAutor["Error"]==0){
					$titulo="&nbsp;&nbsp;&nbsp;  ( ".ucfirst($nombreAutor["author_surname"][0]).", ".ucfirst($nombreAutor["author_first_name"][0]).". )";
				}			
				else{
					$titulo="Autor desconocido";
				}
			}			
		}
		$fieldhidden='<input id="fieldHidden" name="fieldHidden" type="hidden" value='.$seccion.'>';
	        
		$html='

		<div class="contactform">
			<div id="divformSearch">
			<form id="formSearch">
	            <div style="font-size: 18px; padding: 15px 0 15px 0;">
	            <span class="txt-azul">Buscador '.$titulo.'</span>
	            </div>        				
				<div style="float:right;"><input  id="botonbuscar" onclick='.$functionButton.' type="button" value="Buscar"></div>
				'.$formArea.'
				'.$formCategory.'
				<!-- Buscar por titulo -->
				<div class="campo-buscador"><div>T&iacute;tulo :</div></div>
                <div class="contenedor-combo-buscador-1">
					<input id="titulo" name="titulo" type="text" size="30" class="caja-buscador-1">
				</div>
                <div style="clear:both"></div>	
				<!-- Buscar por autor  -->
				'.$formAutor.$fieldhidden.'
				
                <div style="clear:both"></div>
                <br>
				
				<div id="opcionesAvanzadas">
            		<p class="txt-azul">Opciones avanzadas</p>
            	</div>
            	<div class="campo-buscador">Fecha publicaci&oacute;n :</div>
				<div class="contenedor-caja-buscador-1">
                                Desde :
					<span id="divYear"></span>
					<span id="divMonth"></span>
                                
                                &nbsp; Hasta &nbsp;:
					<span id="divYearHasta"></span>
					<span id="divMonthHasta"></span>
                                        
				</div>
				<div style="clear:both"></div>
				<div id="optionsSubcategory"></div>
				<div id="moreOptions"></div>
                                

                <!--                
                <div class="campo-buscador">Fecha de inicio:</div>
		<div class="contenedor-caja-buscador-1">
		<input type="text" class="caja-buscador-2" name="date_ini" id="date_ini" READONLY size="5" />
		</div>
		<div style="clear:both"></div>
                <div class="campo-buscador">Fecha final</div>
		<div class="contenedor-caja-buscador-1">
		<input type="text" class="caja-buscador-2" name="date_fin" id="date_fin" READONLY size="5" />
		</div>-->
		<div style="clear:both"></div>


			</form>
			</div>
			<div id="resultSearch" style="display:none;"></div>
		</div>
		';
	
	    $objResponse->assign("consultas","innerHTML","$html");
	    $objResponse->assign("formulario","style.display","none");
	    $objResponse->assign("consultas","style.display","block");
	    
		$cboArea=comboAreaResult();
		$objResponse->assign('divArea', 'innerHTML', $cboArea);    
	    
		//$cboMonth=comboMonth(0,"","monthDesde");
		//$objResponse->assign('divMonth', 'innerHTML',$cboMonth);
		
		$cboYear=comboYear(0,"","yearDesde");
		$objResponse->assign('divYear', 'innerHTML',$cboYear);

		//$cboMonth=comboMonth(0,"","monthHasta");
		//$objResponse->assign('divMonthHasta', 'innerHTML',$cboMonth);
		
		$cboYear=comboYear(0,"","yearHasta");
		$objResponse->assign('divYearHasta', 'innerHTML',$cboYear);
                
                //$objResponse->script("xajax_cargaScriptDatesRange()");
		return $objResponse;
	}
	
	$xajax->registerFunction('formConsultaIndexShow');
	$xajax->registerFunction('verGrafico');
	$xajax->registerFunction('muestraFormGraficoAutor');
	$xajax->registerFunction('graficosEstadisticosAutor');
	$xajax->registerFunction('muestraFormGraficoAreas');
	$xajax->registerFunction('graficosEstadisticosAreas');
	$xajax->registerFunction('muestraFormGrafico');
	$xajax->registerFunction('graficosEstadisticos');
        $xajax->registerFunction('cargaScriptDates');
        $xajax->registerFunction('cargaScriptDatesRange');
	$xajax->processRequest();

	//Mostramos la pagina
	require("indexView.php");

?>
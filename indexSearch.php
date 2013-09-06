<?php

	require("indexSearchSQL.php");
	require("auxiliary.php");
	
	function seccionShow($idsubcategory,$idarea=0){
		$objResponse = new xajaxResponse();
			
		if($idsubcategory==1){
			$objResponse->script("xajax_comboReferenciaShow($idarea,$idsubcategory,0,2)");
			$objResponse->script("xajax_comboEstadoShow('searchEstado',0)");
			$objResponse->assign('moreOptions', 'innerHTML','');
			$objResponse->assign("referenceStatus", "style.display","block");
			$objResponse->assign("divMonth", "style.display","inline");
                        
		}
	        
		elseif($idsubcategory==2){
	
			$html="
				<div class='campo-buscador'>Tipo:</div>
				<div class='contenedor-combo-buscador-1'>
					<select id='tipoTesis' name='tipoTesis' class='combo-buscador-1'>
						<option value='0'>Todas las tesis</option>
						<option value='1'>UnderGraduate</option>
						<option value='2'>M.S</option>
						<option value='3'>Ph.D</option>
					</select>
				</div>
				<div style='clear:both'></div>
				<div class='campo-buscador'>Pa&iacute;s:</div>
				<div class='contenedor-combo-buscador-1'><input class='caja-buscador-1' type='text' id='pais' name='pais' /></div>
				<div style='clear:both'></div>
				<div class='campo-buscador'>Universidad:</div>
				<div class='contenedor-combo-buscador-1'><input class='caja-buscador-1' type='text' id='uni' name='uni' /></div>";
			
			$objResponse->assign('titReference', 'innerHTML','');
			$objResponse->assign('titStatus', 'innerHTML','');
			$objResponse->assign("searchReference", 'innerHTML','');
			$objResponse->assign("searchEstado", 'innerHTML','');			
			$objResponse->assign('moreOptions', 'innerHTML',$html);
		}
		elseif($idsubcategory==3){
			$objResponse->assign('titReference', 'innerHTML','Referencia:');
			$objResponse->assign('titStatus', 'innerHTML','Estado:');
			$objResponse->script("xajax_comboReferenciaShow($idarea,$idsubcategory,0,2)");
			$objResponse->script("xajax_comboEstadoShow('searchEstado',0)");
			$objResponse->assign('moreOptions', 'innerHTML','');
			$objResponse->assign("referenceStatus", "style.display","block");
		}
	
		elseif($idsubcategory==5){
			$html="<label class='left'>&Aacute;rea:</label><input type='text' id='area' name='area' /></br></br>";
			$html.="<p><label class='left'><u>Presentado Por:</u></label></p>";
			$html.="<label class='left'>Nombre:</label><input class='caja-buscador-1' type='text' maxlength='1' id='prePorNombre' name='prePorNombre' /></br></br>";
			$html.="<label class='left'>Apellido:</label><input class='caja-buscador-1' type='text' id='prePorApellido' name='prePorApellido' class='field' /></br></br>";
			$objResponse->assign('moreOptions', 'innerHTML',$html);
	
	                
		}
		elseif($idsubcategory==11){
	
			$html="<label class='left'>Numero de compendio:</label><input class='caja-buscador-1' type='text' id='nro_compendio' name='nro_compendio'/></br></br>";
			$objResponse->assign('moreOptions', 'innerHTML',$html);
			$objResponse->assign("divTipoFecha", "style.display","none");
			$objResponse->assign("divMonth", "style.display","none");
	
		}
		elseif($idsubcategory==12){
                        $objResponse->assign("searchDate", 'style.display','block');
			$html="<div id='titTrimestre' class='campo-buscador'>Trimestre:</div>";
			$html.="<div id='divTrimestre' class='contenedor-combo-buscador-1'>";
			$html.="<select id='trimestre' name='trimestre' class='combo-buscador-1'><option value='0'>Todos los trimestres</option><option value='1'>Primero</option><option value='2'>Segundo</option><option value='3'>Tercero</option><option value='4'>Cuarto</option></select>";
			$html.="</div><div style='clear:both'></div>";
			$objResponse->assign('moreOptions', 'innerHTML',$html);
			$objResponse->assign("divTipoFecha", "style.display","none");
			$objResponse->assign("divMonth", "style.display","none");
	                
		}
	
		elseif($idsubcategory==6){
                        $objResponse->assign("divTipoFecha", "style.display","inline");
			$objResponse->assign("divMonth", "style.display","inline");
			$objResponse->assign('moreOptions', 'innerHTML','');

	
		}
		elseif($idsubcategory==7){
			$html="<div id='titTrimestre' class='campo-buscador'>Trimestre:</div>";
			$html.="<div id='divTrimestre' class='contenedor-combo-buscador-1'>";
			$html.="<select id='trimestre' name='trimestre' class='combo-buscador-1'><option value='0'>Todos los trimestres</option><option value='1'>Primero</option><option value='2'>Segundo</option><option value='3'>Tercero</option><option value='4'>Cuarto</option></select>";
			$html.="</div><div style='clear:both'></div>";
			$objResponse->assign('moreOptions', 'innerHTML',$html);
			$objResponse->assign("divTipoFecha", "style.display","none");
			$objResponse->assign("divMonth", "style.display","none");
	                
		}
		elseif($idsubcategory==8){
			$html="<div class='campo-buscador'>Región:</div>
					<div id='searchRegionBoletines' class='contenedor-combo-buscador-1'></div>
					<div style='clear:both'></div>";
			$html.="<div class='campo-buscador'>Departamento:</div>
					<div id='searchDepartamentoBoletines' class='contenedor-combo-buscador-1'>
						<select class='combo-buscador-1'></select>
					</div>
					<div style='clear:both'></div>";
	                
			$magnitudes="";
			$magnitudes.="<option value='0'>Seleccione</option>";
			for($m=3;$m<13;$m++){
				$magnitudes.="<option value='$m'>$m</option>";
			}
			$html.="<div class='campo-buscador'>Magnitud:</div>
					<div id='searchDepartamentoBoletines' class='contenedor-combo-buscador-1'>
						<select id='selectMagnitud' NAME='selectMagnitud' class='combo-buscador-1'>$magnitudes</select>
					</div>
					<div style='clear:both'></div>";			
			$objResponse->script("xajax_comboRegionShow(0,2)");                
			$objResponse->assign('moreOptions', 'innerHTML',$html);
	
		}

		elseif($idsubcategory==40){
			// Informacion interna (4) - todos los tipos (0)
			//$objResponse->assign("divTrimestre", "innerHTML","");
			$objResponse->assign("moreOptions", "innerHTML","");
			$objResponse->assign("divMonth", "style.display","inline");
			
		}
		
		elseif($idsubcategory==10){
			// Publicaciones (4) - todos los tipos (0)
			//$objResponse->assign("divTrimestre", "innerHTML","");
			$objResponse->assign("referenceStatus", "style.display","none");
			$objResponse->assign("searchStatus", "innerHTML","");
			$objResponse->assign("searchReference", "innerHTML","");
			$objResponse->assign("moreOptions", "innerHTML","");
			$objResponse->assign("divMonth", "style.display","inline");
			
		}		
		
	
		return $objResponse;
	}
	
	
	

/*
	
	
	function formConsulta($idbutton,$seccion="",$idarea=0, $idautor=""){

		// Desde la pagina web del IGP
		if($idbutton==1){
			$functionButton="xajax_auxSearchShow(20,1,xajax.getFormValues('formSearch'),\"\",\"$idarea\");";
			$formAutor='<div id="divAuthor"><label class="left">Apellido Autor:&nbsp;</label><input id="author" name="author" type="text" size="30" class="field"></div>';
	
		}
	
		// Desde la pagina web del area
		if($idbutton==2){
			$functionButton="xajax_auxSearchShow(20,1,xajax.getFormValues('formSearch'),\"\",\"$idarea\");";
			$formAutor='<div id="divAuthor"><label class="left">Apellido Autor:&nbsp;</label><input id="author" name="author" type="text" size="30" class="field"></div>';

		}
		// Desde la pagina web del autor
		if($idbutton==3){
			$functionButton="xajax_auxSearchShow(20,1,xajax.getFormValues('formSearch'),\"\",\"$idarea\");";
			$formAutor='';
		}
	
		$fieldhidden='<input id="fieldHidden" name="fieldHidden" type="hidden" value='.$seccion.'>';
	
		if($idarea==8){
			$comboTipoPublicacion='
			<select  name="idsubcategory" id="idsubcategory" onChange="xajax_comboTipoFechasShow(this.value);xajax_seccionShow(this.value); return false;" class="combo-buscador-1">
			    <option value="0" selected="selected">- Seleccione-&nbsp;</option>
			    <option value="5" >&nbsp;Charlas Internas&nbsp;</option>
			    <option value="11">&nbsp;Compendios de estudiantes&nbsp;</option>
			</select>';    
		}
		else{
			$comboTipoPublicacion='
			<select  name="idcategory" id="idcategory" onChange="xajax_comboTipoPublicacionShow(0,this.value,'.$idarea.'); return false;" class="combo-buscador-1">
			    <option value="0" selected="selected">- Seleccione-&nbsp;</option>
			    <option value="1" >&nbsp;Publicaciones&nbsp;</option>
			    <option value="2">&nbsp;Ponencias&nbsp;</option>
			    <!--<option value="3">&nbsp;Asuntos Academicos&nbsp;</option>-->
			    <option value="4">&nbsp;Informaci&oacute;n Interna&nbsp;</option>
			</select>';
		}
		
		
		$htmlAutor="";
		if($idautor==523){
			$htmlAutor=" ( Woodman, R.)";
		}
		
		if($idautor==571){
			$htmlAutor=" ( Chau, J.)";
		}


		if($idautor==590){
			$htmlAutor=" ( Tavera, H.)";
		}		
		
		
		
		if($idarea==1){
			$htmlAutor=" ( Aeronom&iacute;a )";
		}
		
		if($idarea==2){
			$htmlAutor=" ( Astronom&iacute;a y Astrof&iacute;sica )";
		}

		if($idarea==3){
			$htmlAutor=" ( Geodesia y Peligro Geol&oacute;gico )";
		}
		
		if($idarea==4){
			$htmlAutor=" ( Geomagnetismo )";
		}
		
		if($idarea==5){
			$htmlAutor=" ( Sismolog&iacute;a )";
		}		
		
		if($idarea==6){
			$htmlAutor=" ( Variabilidad y Cambio Clim&aacute;tico )";
		}				
						
		if($idarea==7){
			$htmlAutor=" ( Vulcanolog&iacute;a )";
		}		
		
		
		$html='
            <div style="font-size: 14px; padding: 15px 0 15px 0;">
            <span class="txt-azul">CONSULTAS '.$htmlAutor.'</span>
            </div>
		<div class="contactform">
			<form id="formSearch">
			<fieldset>
				<span><label class="left">Buscar en :</label>
	                        '.$comboTipoPublicacion.'
				</span>
				<input  id="botonbuscar" class="button" onclick='.$functionButton.' type="button" value="Buscar">
				<!-- Buscar por titulo -->
	
				<div>
					<label class="left">T&iacute;tulo :&nbsp;</label>
					<input id="titulo" name="titulo" type="text" size="30" class="field">
				</div>
	
				<!-- Buscar por autor  -->
				'.$formAutor.'
	                        '.$fieldhidden.'
			</fieldset>
			<fieldset>
				<legend>Opciones avanzadas</legend>
				<div id="optionsSubcategory"></div>
				<div id="moreOptions"></div>
					<!-- Buscar por fecha -->
				<div id="searchDate" style="display:none;">
					<label class="left">Fechas: </label><span id="divTipoFecha"></span>
					<label></label><span id="divMonth">'.comboMonth().'</span>
					<label></label><span id="divYear">'.comboYear().'</span>
				</div>
			</fieldset>
			</form>
			<div id="resultSearch"></div>
		</div>';
	
	    
//	    $objResponse->Assign("consultas","innerHTML","$html");
//	    $objResponse->Assign("formulario","style.display","none");
//	    $objResponse->Assign("consultas","style.display","block");
//	    $objResponse->Assign("estadisticas", "style.display", "none");
	    

		return $html;
	}	
*/	

	function auxSearchShow($pageSize,$currentPage,$form="",$seccion="",$idarea=0){
	
		$respuesta = new xajaxResponse();
		//$respuesta->Alert("ipp=$pageSize and page=$currentPage");	
                
	        
	        
		if(isset($_SESSION["idfrom"])){
                    
			if($form==""){
                            
				$result=searchPublicationSQL("","",$_SESSION["idfrom"],"","",$idarea);
				$total=$result["Count"];
                                
				$respuesta->script("xajax_formConsultaShow(".$_SESSION["idfrom"].")");
				$respuesta->script("xajax_searchPublicationShow(xajax.getFormValues('formSearch'),'".$_SESSION["idfrom"]."','$currentPage','$pageSize','$idarea')");
				$respuesta->script("xajax_paginatorSearch($currentPage,$pageSize,$total,'',$idarea)");
				// $respuesta->alert($_SESSION["idfrom"]);

	
			}
			else{
                
				$result=searchPublicationSQL("",$form,$_SESSION["idfrom"],"","",$idarea);
				$total=$result["Count"]; 

				$respuesta->script("xajax_searchPublicationShow(xajax.getFormValues('formSearch'),'".$_SESSION["idfrom"]."','$currentPage','$pageSize','$idarea')");
				$respuesta->script("xajax_paginatorSearch($currentPage,$pageSize,$total,xajax.getFormValues('formSearch'),$idarea)");
	             // $respuesta->alert(print_r($result,TRUE));  	                         
			}
	
		}
		//$respuesta->assign('divformSearch', 'style.display',"none");
                $respuesta->assign('paginator', 'style.display',"block");
                $respuesta->assign('estadisticas', 'style.display','none');

         // $respuesta->alert(print_r($total,TRUE));

		return $respuesta;
	}
	
	function searchPublicationShow($form,$searchFrom=0, $currentPage="", $pageSize="", $idarea=0){
		$objResponse = new xajaxResponse();
		//$objResponse->alert(arrayToXml($form,"search"));
                
                //$objResponse->alert($form["tip_inf"]);
		
		if($searchFrom==1){
			
			list($html,$strModal2, $strAutor2,$md5iddata,$count)=searchPublication(0,$form,1,$currentPage, $pageSize, $idarea,$tip_inf);
			
		}
	
		if($searchFrom==2){
			//list($html,$strModal2, $strAutor2,$md5iddata,$count)=searchPublication(0,$form,2,$currentPage, $pageSize, $idarea,$tip_inf);
			$html=searchbook($form, $currentPage, $pageSize);
			
		}
	
		if($searchFrom==3){
			list($html,$strModal2, $strAutor2,$md5iddata,$count)=searchPublication(0,$form,3,$currentPage, $pageSize, $idarea,$tip_inf);
			$objResponse->Assign("divformSearch","style.display","none");
		}
	        
		//$objResponse->Alert("ipp=$pageSize and page=$currentPage");
		$objResponse->assign("resultSearch","style.display","block");
		$objResponse->assign("resultSearch","innerHTML",$html);	             
       
                
		return $objResponse;
	}
	
	function graficoFromLoad($idfrom="",$idarea="", $idautor=""){
		$respuesta = new xajaxResponse();
		
		if(isset($_SESSION["idfrom"])){
		    unset($_SESSION["idfrom"]);
		    $_SESSION["idfrom"]=$idfrom;
		}
		else{
		    $_SESSION["idfrom"]=$idfrom;    
		}
		
		if(isset($_SESSION["idarea"])){
		    unset($_SESSION["idarea"]);
		    $_SESSION["idarea"]=$idarea;
		}
		else{
		    $_SESSION["idarea"]=$idarea;
		}
		
		if(isset($_SESSION["idautor"])){
		    unset($_SESSION["idautor"]);
		    $_SESSION["idautor"]=$idautor;
		}
		else{
		    $_SESSION["idautor"]=$idautor;    
		}
		
		//$respuesta->alert(print_r($_SESSION, true));
		
		$cadena="xajax_iniPublicationShow()";
		$respuesta->script($cadena);
		
		
		return $respuesta;
	}
	
	function iniPublicationShow($idfrom="",$idarea="", $idautor=""){
		$objResponse = new xajaxResponse();
                
        if(isset($_SESSION["loginDownload"])){
            $html="Esta logeado como ".$_SESSION["loginDownload"];
            $html.=" <a href='#' onclick='xajax_cerrarSesionDescarga();'>Cerrar sesión</a>";
            $objResponse->Assign("loginform","innerHTML",$html);    
            
        }
        else{
            $html="<p>Para descargar es necesario identificarse, ingrese usuario y contraseña</p>";
            $objResponse->Assign("mensaje","innerHTML",$html);    
            
        }
	                
		if(isset($idfrom)){
	
			$currentPage=1;
			$pageSize=20;
			$result=searchPublicationSQL("","",$idfrom,"","",$idarea);
			$total=$result["Count"];
			$pagHtml=paginatorConstruct($currentPage,$pageSize,$total,'',$idarea);
			$objResponse->assign('paginator', 'innerHTML',$pagHtml);
			
			if($idfrom==1){

				$html=formConsulta(1,'',$idarea);				
				//$objResponse->script("xajax_formConsultaShow(1,'',$idarea)");
				//$objResponse->script("xajax_searchPublicationShow(0,1,$currentPage,$pageSize,$idarea)");
				$htmlResultSearch=searchPublication(0,0,1,$currentPage, $pageSize, $idarea);
				$objResponse->script("xajax_comboAreaShow()");
			}
	
			if($idfrom==2 AND isset($idarea)){
				$html=formConsulta(2,'',$idarea);
				//$objResponse->script("xajax_formConsultaShow(2,'',$idarea)");
				//$objResponse->script("xajax_searchPublicationShow(0,2,$currentPage,$pageSize,$idarea)");
				$htmlResultSearch=searchPublication(0,0,2,$currentPage, $pageSize, $idarea);
	
			}
	
			if($idfrom==3 AND isset($idautor)){
				$html=formConsulta(3,'',$idarea,$idautor);
				//$objResponse->script("xajax_formConsultaShow(3,'',$idarea)");
				//$objResponse->script("xajax_searchPublicationShow(0,3,$currentPage,$pageSize,$idarea)");
				$htmlResultSearch=searchPublication(0,0,3,$currentPage, $pageSize, $idarea);
			}
			//$objResponse->assign('total', 'innerHTML',$total);
			
			
		    $objResponse->Assign("consultas","innerHTML","$html");
		    $objResponse->Assign("formulario","style.display","none");
		    $objResponse->Assign("consultas","style.display","block");
		    $objResponse->Assign("estadisticas", "style.display", "none");			
			$objResponse->Assign("resultSearch","innerHTML",$htmlResultSearch);
		}
		
		return $objResponse;
	
	}
	
	
	function searchbook($form, $currentPage='', $pageSize=''){
		
	
		//$text=$form["author"];
	
		//$result=searchPublicationSQL($idcategory,$form,$idfrom,$currentPage, $pageSize, $idarea,$tip_inf);
		$result = searchBookSQL($form, $currentPage, $pageSize);
		$html = "";
		// $sql = $result["Query"];

		$i = 0;
		if($result["Count"]>0){
			foreach ($result["book_data"] as $xmldata){
	
				//libxml_use_internal_errors(true);
				$xmlt = simplexml_load_string($xmldata);
				if (!$xmlt) {
					
					foreach(libxml_get_errors() as $error) {
						echo "\t", $error->message;
					}
					return "Error cargando XML (searchPublication)\n";
						
				}

				// $autorSEC="";
				// if(isset($xmlt->authorSEC)){
				// 	//Preguntamos si hay mas de un autor secundario
	
				// 	if(isset($xmlt->authorSEC->author_first_name1)){
				// 		for($j=0;$j<100;$j++){
				// 			eval('if (isset($xmlt->authorSEC->author_surname'.$j.')){$xmlflag=TRUE;} else {$xmlflag=FALSE;}');
				// 			if($xmlflag){
				// 				eval('$xmlfirstname=$xmlt->authorSEC->author_first_name'.$j.';');
				// 				eval('$xmlsurname=$xmlt->authorSEC->author_surname'.$j.';');
				// 				$autorSEC.=", ".ucfirst(substr((string)$xmlfirstname,0,1)).". ";
				// 				$autorSEC.=(str_replace("*","'",ucfirst((string)$xmlsurname)));
	                            
				// 			}
				// 		}
					
				// 		//reemplazamos la ultima coma por and
				// 		$posComa=strrpos($autorSEC,",");
				// 		$autorSEC{$posComa}="#";
				// 		$autorSEC=str_replace("#", ", and ", $autorSEC);
						
				// 	}
				// 	//Solo un autor secundario
				// 	else{
				// 		$autorSEC=" and ".ucfirst(substr((string)$xmlt->authorSEC->author_first_name0,0,1)).". ";
				// 		$autorSEC.=(str_replace("*","'",ucfirst((string)$xmlt->authorSEC->author_surname0)));
				// 	}
					
				// }
				// else{
				// 	$autorSEC="";
				// }
				/* autor principal*/
				//   $idautorPRI=(int)$xmlt->authorPRI->idauthor0;
				// $autorPRI=(str_replace("*","'",ucfirst((string)$xmlt->authorPRI->author_surname0))).", ".ucfirst(substr((string)$xmlt->authorPRI->author_first_name0,0,1)).".";
				// $prePor=(str_replace("*","'",ucfirst((string)$xmlt->prePorApellido))).", ".ucfirst((string)$xmlt->prePorNombre).".";
	                        
				// eval('if (isset($xmlt->enlace)){$xmlflag=TRUE; $enlace=(string)$xmlt->enlace;} else {$xmlflag=FALSE;}');
                                $titulo=ucfirst((string)$xmlt->title);
                                // $author=ucfirst((string)$xmlt->authorPRI->author_surname0);
                                $idauthor= (int)$xmlt->authorPRI->idauthor0; 
                                                        
                                $result_author = searchAuthorID($idauthor);
                                $author = "- ".$result_author["author_surname"][0].",".$result_author["author_name"][0];
                                if ($result_author["Error"]==1) {
                                	$author ="";
                                }
                                if (isset($xmlt->Resumen)) {
                                	$resumen = (string)$xmlt->Resumen;                                	
                                	$resumen = "<p class='res'>".substr($resumen, 0,400)."...</p>";
                                }
                                if (isset($xmlt->NoteConte)) {
                                	$NoteConte = (string)$xmlt->NoteConte;
                                	$NoteConte = "<p class='res'>".substr($NoteConte, 0,400)."...</p>";
                                }
                                if (isset($xmlt->UbicFis)) {
                                	$UbicFis = (string)$xmlt->UbicFis;
                                	$UbicFis = "<p class='res'>".$UbicFis."...</p>";
                                }
                                


				// if(($xmlflag) and ($enlace!="")){
				// 	$titulo="<a href='$enlace' target='_blank'>".$titulo."</a>";
				// }
				// else{
					$titulo="<a  href='#' onclick='xajax_editBook(".$result["idbook"][$i].",1); return false;' class='resultado' >".$titulo."</a>";
					// $titulo="<a class='resultado' onclick='xajax_editShow(".$result["idbook"][$i].", 2)' >".$titulo."</a>";
				// }
				$class_list ="";
				if (($i+1)%2==0) {
					$class_list="list_block";
					}
				else{
					$class_list = "list_block_0";
				}	
					
				$html.="<div class='resultado-busqueda ".$class_list."'>";				
				$pag=($currentPage-1)*$pageSize+($i+1);
				$html.="<span class='list_number'>" .$pag.".</span> ".$titulo.$author.$resumen.$NoteConte.$UbicFis;

				$html .= "".$sql."</div>";

			$i++;
			}
		}
		else{
			$html .= "<p>NO SE ENCONTRARON RESULTADOS  ".$sql."</p>";
		}

        //return array($html, $strModal2, $strAutor2,$md5iddata2,$count);

		return $html;
		
	}	
	
	function searchPublication($idcategory,$form,$idfrom,$currentPage= '', $pageSize= '', $idarea=0,$tip_inf){
	
		//$text=$form["author"];
	
		$result=searchPublicationSQL($idcategory,$form,$idfrom,$currentPage, $pageSize, $idarea,$tip_inf);
		
		$resultTotal=searchPublicationSQL($idcategory,$form,$idfrom,'','',$idarea,$tip_inf);
		
		//$html=$result["data_content"];		
	
		$i=0;
		$html .= "";
                $strModal1="";
                $strModal2="";
                $strAutor1="";
                $strAutor2="";
                $md5iddata1="";
                $md5iddata2="";
                $count="";
                //$html.=print_r($result,TRUE);
		if($result["Count"]>0){
			foreach ($result["data_content"] as $xmldata){
	
				libxml_use_internal_errors(true);
				$xmlt = simplexml_load_string($xmldata);
				if (!$xmlt) {
					
					foreach(libxml_get_errors() as $error) {
						echo "\t", $error->message;
					}
					return "Error cargando XML (searchPublication)\n";
						
				}
	
				//$xmlt = simplexml_load_string($xmldata);
				
				$autorSEC="";
				if(isset($xmlt->authorSEC)){
					//Preguntamos si hay mas de un autor secundario
	
					if(isset($xmlt->authorSEC->author_first_name1)){
						for($j=0;$j<100;$j++){
							eval('if (isset($xmlt->authorSEC->author_surname'.$j.')){$xmlflag=TRUE;} else {$xmlflag=FALSE;}');
							if($xmlflag){
								eval('$xmlfirstname=$xmlt->authorSEC->author_first_name'.$j.';');
								eval('$xmlsurname=$xmlt->authorSEC->author_surname'.$j.';');
								$autorSEC.=", ".ucfirst(substr((string)$xmlfirstname,0,1)).". ";
								$autorSEC.=(str_replace("*","'",ucfirst((string)$xmlsurname)));
	                            
							}
						}
					
						//reemplazamos la ultima coma por and
						$posComa=strrpos($autorSEC,",");
						$autorSEC{$posComa}="#";
						$autorSEC=str_replace("#", ", and ", $autorSEC);
						
					}
					//Solo un autor secundario
					else{
						$autorSEC=" and ".ucfirst(substr((string)$xmlt->authorSEC->author_first_name0,0,1)).". ";
						$autorSEC.=(str_replace("*","'",ucfirst((string)$xmlt->authorSEC->author_surname0)));
					}
					
				}
				else{
					$autorSEC="";
				}

		/****************ID Autor Secundario****************************************************************************************/
				$idautorSECcoma="";
                                $idautorSEC="";
                                $arrayidautor[0]=array();
				if(isset($xmlt->authorSEC)){
					//Preguntamos si hay mas de un autor secundario
	
					if(isset($xmlt->authorSEC->idauthor1)){
						for($j=0;$j<100;$j++){
							eval('if (isset($xmlt->authorSEC->idauthor'.$j.')){$xmlflag=TRUE; $idauthorSEC=(int)$xmlt->authorSEC->idauthor'.$j.';} else {$xmlflag=FALSE;}');
							if($xmlflag){
								//eval('$xmlidauthor=$xmlt->authorSEC->idauthor'.$j.';');
								//$idautorSECcoma.=(int)$xmlidauthor.",";
                                                                $arrayidautor[$j]=$idauthorSEC;
							}
                                                        else{
                                                                $arrayidautor[$j]=array();
                                                        }
                                                        
						}
                                                
					
					}
					//Solo un autor secundario
					else{
						$arrayidautor[0]=(int)$xmlt->authorSEC->idauthor0;
						
					}
					
				}
				else{
					$idautorSEC="";
				}
		/***************************************************************************************************************************************/
                                
                        $idautorPRI=(int)$xmlt->authorPRI->idauthor0;
				$autorPRI=(str_replace("*","'",ucfirst((string)$xmlt->authorPRI->author_surname0))).", ".ucfirst(substr((string)$xmlt->authorPRI->author_first_name0,0,1)).".";
				$prePor=(str_replace("*","'",ucfirst((string)$xmlt->prePorApellido))).", ".ucfirst((string)$xmlt->prePorNombre).".";
	                        
				eval('if (isset($xmlt->enlace)){$xmlflag=TRUE; $enlace=(string)$xmlt->enlace;} else {$xmlflag=FALSE;}');
                                $titulo=ucfirst((string)$xmlt->titulo);
                                $titulo=(str_replace("*","'",$titulo));
				if(($xmlflag) and ($enlace!="")){
					$titulo="<a href='$enlace' target='_blank'>".$titulo."</a>";
				}
				else{
					$titulo="<a class='resultado' href='http://www.google.com.pe/webhp?hl=es-419#hl=es-419&source=hp&biw=1024&bih=645&q=$xmlt->titulo&aq=f&aqi=&aql=&oq=&fp=3193a7b02b1d4d71' target='_blank'>".$titulo."</a>";
				}
	                    
				
                                
				if(isset($xmlt->date_pub)){
                                    $yearpub="(".substr((string)$xmlt->date_pub,0, 4).")";
                                }
                                else{
                                    $yearpub="(".(string)$xmlt->year_pub.")";
                                }
                                    
                                
                                
                                if(isset($xmlt->year)){
                                    $yearQuarter=" <b>".(string)$xmlt->year."</b>";
                                }
                                else{
                                    $yearQuarter=" <b>".(string)$xmlt->yearQuarter."</b>";
                                }
                                
				$nroCompendio=(int)$xmlt->nroCompendio;
				$yearCompendio="(".substr((string)$xmlt->yearCompendio,0, 4).")";
				$nroBoletin=(int)$xmlt->nroBoletin;
                                $idquarter=(int)$xmlt->idquarter;
                                $areaPRI=(int)$xmlt->areaPRI;
                                
                                
                                switch($areaPRI){
                                    case 1:
                                        $area_description="Aeronom&iacute;a";
                                    break;
                                    case 2:
                                        $area_description="Astronom&iacute;a";
                                    break;
                                    case 3:
                                        $area_description="Geodesia";
                                    break;
                                    case 4:
                                        $area_description="Geomagnet&iacute;smo";
                                    break;
                                    case 5:
                                        $area_description="Sismolog&iacute;a";
                                    break;
                                    case 6:
                                        $area_description="Variabilidad";
                                    break;
                                    case 7:
                                        $area_description="Vulcanolog&iacute;a";
                                    break;
                                    case 8:
                                        $area_description="Asuntos Acad&eacute;micos";
                                    break;
                                    case 10:
                                        $area_description="CNDG";
                                    break;
                                    case 11:
                                        $area_description="Asesoria Legal";
                                    break;
                                    case 12:
                                        $area_description="Geof&iacute;sica y Sociedad";
                                    break;
                                    case 13:
                                        $area_description="ODI";
                                    break;
                                    case 14:
                                        $area_description="Administracion";
                                    break;
                                
                                }
				
				//$yearQuarter=" <b>".substr((string)$xmlt->year,0, 4)."</b>";
	                        
				if(isset($xmlt->reference_description) and isset($xmlt->reference_details)){
					$referencia=", ".(string)$xmlt->reference_description.", ".(string)$xmlt->reference_details;
				}
				else{
					$referencia="";
				}
                                
				//$resumen=(string)$xmlt->resumen;
                                $departamento_description=(string)$xmlt->departamento_description;
                                $evento_description=(string)$xmlt->evento_description;
                                $pais_evento=(string)$xmlt->pais_description;
                                $idclase_evento=(string)$xmlt->idclaseEvento;
                                $clase_evento=(string)$xmlt->claseEvento_description;
                                
                                
                                //Tesis
                                $tipoTesisDescription=(string)$xmlt->tipoTesisDescription;
                                $uni_description=(string)$xmlt->uni_description;
                                $pais_description=(string)$xmlt->pais_description;
                                
                                
                                /*
                                $date_pub=(string)$xmlt->date_pub;
                                /*list($year) = explode("-", $date_pub);                                                                
                                $date_pub="-".$year;                                
                                 */

                                //$fecha = "1973-04-30";
                                    
				$html.="<div class='resultado-busqueda'>";

                // Presentaremos los datos dependiendo de  la subcategoria
				$subcategoryPublicaciones=isset($form["selectTypePublication"])?$form["selectTypePublication"]:"";
				$subcategoryAcademicos=isset($form["selectTypeAcademicos"])?$form["selectTypeAcademicos"]:"";
				$subcategoryCategory=isset($form["selectTypeCategory"])?$form["selectTypeCategory"]:"";
				$idsubcategory=isset($form["idsubcategory"])?$form["idsubcategory"]:"";
				$idcategory=isset($form["idcategory"])?$form["idcategory"]:"";
				$numero=($currentPage-1)*$pageSize+$i+1;
				$html.="<b>".$numero." .- </b>";

                switch($result["idsubcategory"][$i]){
                    case 1:
                        $html.= $autorPRI." ".$autorSEC." ".$yearpub.", ".$titulo.$referencia;
						break;
                    case 2://Tesis
                        $html.= $autorPRI." ".$autorSEC." ".$yearpub.", ".$titulo." (".$tipoTesisDescription."), ".$uni_description.", ".$pais_description;
						break;
                    case 3:
                        $html.= $autorPRI." ".$autorSEC." ".$yearpub.", ".$titulo.$referencia;
						break;                    
                    case 4:
                        if(isset($idclase_evento)){
                            switch($idclase_evento){
                                case 1:
                                    $msg_clase_evento="Ponencia de ";
                                break;
                                case 2:                            
                                    $msg_clase_evento="Ponencia ";
                                break;
                                default :
                                    $msg_clase_evento="";
                                break;    
                            }
                            
                        }
                        $html.= $autorPRI." ".$autorSEC." ".$yearpub.", ".$titulo.", ".$evento_description.", ".$pais_evento.". ".$msg_clase_evento.$clase_evento;
						break;                    
                    case 5:
                        $html.= $prePor." ".$yearpub.", ".$titulo;
						break;                    
                    case 6:
                        $html.= $autorPRI." ".$autorSEC." ".$yearpub.", ".$titulo;
						break;                    
                    case 7:
                        $html.= $area_description.", Informe Trimestral ".$idquarter.", ". $yearQuarter;
						break;
                    case 8:
                                $date_pub="";
                                if(isset($xmlt->date_pub)){
                                    if($xmlt->date_pub!=""){
                                        $date_pub = (string)$xmlt->date_pub;
                                        list($año, $mes, $dia) = explode("-", $date_pub);
                                        $date_pub=$dia."-".$mes."-".$año;
                                    }
                                    else{
                                        $date_pub="";
                                    }
                                }
                                else{
                                    if(isset($xmlt->day_pub)){
                                        $day_pub = (string)$xmlt->day_pub;
                                    }
                                    if(isset($xmlt->desc_month_pub)){
                                        $desc_month_pub = (string)$xmlt->desc_month_pub;
                                    }
                                    if(isset($xmlt->year_pub)){
                                        $year_pub = (string)$xmlt->year_pub;
                                    }
                                    
                                    $date_pub=$day_pub." de ".$desc_month_pub." del ".$year_pub;
                                    
                                }
                        
                        $html.= "Bolet&iacute;n Nro. ".$nroBoletin." - ".$yearpub.", ".$departamento_description.", ".$date_pub;
						break;                    
                    case 9:
                        $html.= $autorPRI." ".$autorSEC." ".$yearpub.", ".$titulo.$referencia;
						break;                    
                    case 10:
                        $html.= $autorPRI." ".$autorSEC." ".$yearpub.", ".$titulo.$referencia;
						break;
                    case 11:
                        $html.= "Compendio Nro. ".$nroCompendio." - ".$yearCompendio;
						break;                    
                    case 12:
                        $html.= $area_description.", Informe Trimestral ".$idquarter.", ". $yearQuarter;
						break;
                    case 13:
                        $html.= $area_description.", Informe Trimestral ".$idquarter.", ". $yearQuarter;
						break;
                 
                }
                
				$html.=".</div><div align='right' style='padding-bottom: 20px;'>";

				eval('if (isset($xmlt->resumen)){$xmlflag=TRUE; $resumen=(string)$xmlt->resumen;} else {$xmlflag=FALSE;}');
				$resumen=(str_replace("*","'",$resumen));
				if(($xmlflag) and ($resumen!="")){
					$p="";
					$html.="Resumen <a class='mostaza' href=# onclick=\"xajax_abstractShow('".md5($result["iddata"][$i])."'); return false;\"> [+]</a>";
					$html.="<a class='mostaza' href=# onclick=\"xajax_abstractHide('".md5($result["iddata"][$i])."'); return false;\"> [-]</a>";
				}
				$seccion="";
                                $seccion1="";

                                if(isset($form["fieldHidden"])){
                                    if($form["fieldHidden"]=="admin"){
                                        $seccion1=$form["fieldHidden"];
                                    }
                                }

				eval('if (isset($xmlt->pdf)){$xmlflag=TRUE; $pdf=(string)$xmlt->pdf;} else {$xmlflag=FALSE;}');
				if(($xmlflag) and ($pdf!="")){
					
					// Pasamos parametros a la funcion que nos devolvera el enlace de descarga
					// $idfrom = 1 (web del IGP) 
					// $idfrom = 2 (web de las areas)
					// $idfrom = 3 (web del autor)
					// $idfrom = 4 (administrador)
					// Compara los permisos y el origen de donde se hace la búsqueda
					$html.=" &nbsp; &nbsp; &nbsp; ".downloadLink($result["iddata"][$i],$seccion1); 

					
				}
	                    
				if(isset($form["fieldHidden"])){
					if($form["fieldHidden"]=="admin"){
						$html.="  &nbsp; &nbsp; &nbsp; <a href=# onclick=\"xajax_editShow('".$result["iddata"][$i]."','".$currentPage."'); return false;\"> Editar</a>";
					}                        
				}
	
				$html.="</div>";
                                
                                /***Modal***
                                $iddata=$result["iddata"][$i];
                                /*$html.="<div id='$iddata'>".$iddata."</div><br>";
                                /***Modal***/
                                                                
				$html.="<div id='".md5($result["iddata"][$i])."' style='display:none;'><p class='details'>".$resumen."</p></div>";
                                
                                /***Modal***/
                                $iddata=$result["iddata"][$i];
                                $mensaje_modal="Este archivo requiere permisos para su descarga<br><br>";
                                $enlace="";
                                $a=0;
                                //$arrayidautor=array($idautorSEC);
                                switch ($idautorPRI) {
                                    case 523:
                                    case 571:
                                    case 590:
                                    case 773:
                                    case 656:
                                    case 712:
                                    case 745:
                                    case 827:
                                    case 271:                                   
                                    case 775:                                    
                                    case 772:                                    
                                    case 591:                                    
                                    case 888:
                                        $enlace.='<u class="ui-state-default ui-corner-all"><a href="index.php?idfrom=3&idautor='.$idautorPRI.'&pag=2&iddata='.$iddata.'" target="_blank" >Contacte al autor</a></u>';
                                        $a=1;
                                    break;
                                }
                                
                                if($a==0){
                                    $idwoodman=523;
                                    $idchau=571;
                                    $idtavera=590;                                    
                                    $idlagos=773;
                                    $idishitsuka=656;
                                    $idnorabuena=712;
                                    $idtakahashi=745;
                                    $idmacedo=827;
                                    $idmilla=271;                                   
                                    $idsilva=775;                                    
                                    $idmartinez=772;                                    
                                    $idbernal=591;                                    
                                    $idespinoza=888;
                                    
                                    
                                    // Buscamos los permisos para un $idfrom 
                                    if(in_array($idchau,$arrayidautor)){
                                        $enlace.='<a href="index.php?idfrom=3&idautor='.$idchau.'&pag=2&iddata='.$iddata.'" target="_blank" >Contacte al autor</a>';
                                    }
                                    elseif(in_array($idwoodman,$arrayidautor)){
                                        $enlace.='<a href="index.php?idfrom=3&idautor='.$idwoodman.'&pag=2&iddata='.$iddata.'" target="_blank" >Contacte al autor</a>';
                                    }
                                    elseif(in_array($idlagos,$arrayidautor)){
                                        $enlace.='<a href="index.php?idfrom=3&idautor='.$idlagos.'&pag=2&iddata='.$iddata.'" target="_blank" >Contacte al autor</a>';
                                    }
                                    elseif(in_array($idmilla,$arrayidautor)){
                                        $enlace.='<a href="index.php?idfrom=3&idautor='.$idmilla.'&pag=2&iddata='.$iddata.'" target="_blank" >Contacte al autor</a>';
                                    }
                                    elseif(in_array($idishitsuka,$arrayidautor)){
                                        $enlace.='<a href="index.php?idfrom=3&idautor='.$idishitsuka.'&pag=2&iddata='.$iddata.'" target="_blank" >Contacte al autor</a>';
                                    }
                                    elseif(in_array($idnorabuena,$arrayidautor)){
                                        $enlace.='<a href="index.php?idfrom=3&idautor='.$idnorabuena.'&pag=2&iddata='.$iddata.'" target="_blank" >Contacte al autor</a>';
                                    }
                                    elseif(in_array($idsilva,$arrayidautor)){
                                        $enlace.='<a href="index.php?idfrom=3&idautor='.$idsilva.'&pag=2&iddata='.$iddata.'" target="_blank" >Contacte al autor</a>';
                                    }
                                    elseif(in_array($idtakahashi,$arrayidautor)){
                                        $enlace.='<a href="index.php?idfrom=3&idautor='.$idtakahashi.'&pag=2&iddata='.$iddata.'" target="_blank" >Contacte al autor</a>';
                                    }
                                    elseif(in_array($idmartinez,$arrayidautor)){
                                        $enlace.='<a href="index.php?idfrom=3&idautor='.$idmartinez.'&pag=2&iddata='.$iddata.'" target="_blank" >Contacte al autor</a>';
                                    }
                                    elseif(in_array($idtavera,$arrayidautor)){
                                        $enlace.='<a href="index.php?idfrom=3&idautor='.$idtavera.'&pag=2&iddata='.$iddata.'" target="_blank" >Contacte al autor</a>';
                                    }
                                    elseif(in_array($idbernal,$arrayidautor)){
                                        $enlace.='<a href="index.php?idfrom=3&idautor='.$idbernal.'&pag=2&iddata='.$iddata.'" target="_blank" >Contacte al autor</a>';
                                    }
                                    elseif(in_array($idmacedo,$arrayidautor)){
                                        $enlace.='<a href="index.php?idfrom=3&idautor='.$idmacedo.'&pag=2&iddata='.$iddata.'" target="_blank" >Contacte al autor</a>';
                                    }
                                    elseif(in_array($idespinoza,$arrayidautor)){
                                        $enlace.='<a href="index.php?idfrom=3&idautor='.$idespinoza.'&pag=2&iddata='.$iddata.'" target="_blank" >Contacte al autor</a>';
                                    }
            
                                }                                  
                                
                                //$mensaje_modal.='<a href="http://www.google.com.pe" target="_blank" >'.$autorPRI.'</a>';
                                $mensaje_modal.=$enlace;
                                $html.="<div id='modal_".md5($result["iddata"][$i])."' class='c' title='Mensaje' style='display:none;color:red;'>".$mensaje_modal."</div>";
                                
                                $strModal1.="#modal_".md5($iddata).",";
                                $strAutor1.="#autor_".md5($iddata).",";
                                $md5iddata1.="'".md5($iddata)."',";
                                $count=$resultTotal["Count"];
				/***Modal***/
                                
				// Quitamos el ultimo separador 
				//if($i<>$result["Count"]-1){
				//	$html.="<div class='linea-separacion'></div>";
				//}
				$i++;
			}
		}
		else{
			$html="<p>NO SE ENCONTRARON RESULTADOS (".$result["Count"].")</p>";
	
		}
                
                /* descripción de la búsqueda
                if($subcategoryPublicaciones==1){
                    $desc_subcategory="art&iacute;culos indexados";
                }
                elseif($subcategoryPublicaciones==2){
                    $desc_subcategory="tesis";
                }
                elseif($subcategoryPublicaciones==3){
                    $desc_subcategory="otras publicaciones";
                }
                elseif($idcategory==2){
                    $desc_subcategory="ponencias";
                }
                elseif($subcategoryCategory==6){
                    $desc_subcategory="reportes t&eacute;cnicos";
                }
                elseif($subcategoryCategory==7){
                    $desc_subcategory="informes trimestrales";
                }
                else{
                    $desc_subcategory="";
                }
                */
                
                /* Reseteando el formulario
		$html='<div style="font-size: 18px; padding: 15px 0 15px 0;"><span class="txt-azul">Resultados ('.$resultTotal["Count"].') </span>
				<span style="float:right; font-size: 12px"><a href="#" class="txt-rojo" onclick="xajax_abstractShow(\'divformSearch\'); xajax_abstractHide(\'resultSearch\'); xajax_abstractHide(\'paginator\'); xajax_formReset()"><img style="cursor: pointer; border:0;" width="12px" src="img/flecha-atras.jpg" >&nbsp;&nbsp;&nbsp;Retornar a la búsqueda</a></span></div>
			   <div id="count"></div><br><br>'.$html;
		*/
			   
		$html='<div style="font-size: 18px; padding: 15px 0 15px 0;"><span class="txt-azul">Resultados ('.$resultTotal["Count"].') </span>
				<span style="float:right; font-size: 12px"><a href="#" class="txt-rojo" onclick="xajax_abstractShow(\'divformSearch\'); xajax_abstractHide(\'resultSearch\'); xajax_abstractHide(\'paginator\'); "><img style="cursor: pointer; border:0;" width="12px" src="img/flecha-atras.jpg" >&nbsp;&nbsp;&nbsp;Retornar a la búsqueda</a></span></div>
			   <div id="count"></div><br><br>'.$html;
			   
			   
			   
			   
			   
		//return $html;
		//return $html.$result["Query"];
                
                /*Quitamos la ultima coma a los arrays*/
                $strModal2.= substr($strModal1, 0,-1);
                $strAutor2.= substr($strAutor1, 0,-1);
                $md5iddata2.= substr($md5iddata1, 0,-1);
                //return $html.$strAutor2;
                //return array($html.$result["Query"], $strModal2, $strAutor2,$md5iddata2,$count);
                return array($html, $strModal2, $strAutor2,$md5iddata2,$count);
		//.$result["Query"]."ipp=$pageSize and page=$currentPage"
	}
	
	
	
	function formReset(){
		$objResponse = new xajaxResponse();
                $objResponse->script('document.getElementById(\'formSearch\').reset()');
		return $objResponse;
	}
	
	
	function abstractShow($div){
		$objResponse = new xajaxResponse();
		$objResponse->Assign($div,"style.display","block");                
		return $objResponse;
	}
	
	function abstractHide($div){
		$objResponse = new xajaxResponse();
		$objResponse->Assign($div,"style.display","none");
		return $objResponse;
	}
	
	function downloadLogin($form){
		$objResponse = new xajaxResponse();
		if(isset($form["usuario"]) and isset($form["clave"])){
	
			$result=downloadSQL($form["usuario"]);
			$clave=md5($form["clave"]);
	
			if($result["Error"]==0){
				if($result["Count"]>0){
	
					if($result["users_name"][0]==$form["usuario"] and $result["users_password"][0]==$clave){
						$_SESSION["loginDownload"]=$form["usuario"];
						$html="Esta logeado como ".$form["usuario"];
                        $html.=" <a href='#' onclick='xajax_cerrarSesionDescarga();'>Cerrar sesión</a>";
						$objResponse->Assign("loginform","innerHTML",$html);
                        $objResponse->Assign("mensaje","innerHTML","");
                        $idarea=isset($_SESSION["idarea"])?$_SESSION["idarea"]:0;
                        $objResponse->script("xajax_auxSearchShow(20,1,xajax.getFormValues('formSearch'),'',$idarea)");
                        //$objResponse->alert(print_r($_SESSION["loginDownload"], true));
					}
	                                else{
	                                        $objResponse->alert("Usuario y clave incorrectos");
	                                        //$objResponse->Assign("loginform","innerHTML",$clave);
	                                }
	
				}
				else{
	
					$objResponse->alert("Usuario no registrado");
				}
			}
			else{
	
				//$objResponse->alert("Error SQL, ".$result["Query"]);
			}
			
		}
		else{
			$objResponse->alert("Error Login");
		}
	        
	        //$objResponse->alert(print_r($result, true));
		return $objResponse;
	}
	
	
	
	function paginatorConstruct($page,$ipp,$total,$form="",$idarea=0){
		$pages = new Paginator;
		$pages->items_total = $total;
		$pages->mid_range = 9;
	
		$function="xajax_auxSearchShow";
	
		if($form==""){
			$pages->paginate($ipp,$page,$function,$idarea);
		}
		else{
			//$respuesta->alert($idarea);//0
			$pages->paginateSearch($ipp,$page,"xajax.getFormValues('formSearch')",$function,$idarea);
		}
		
		$html="<p><br>";
		$html.= $pages->display_pages();
		//$html.= "<span class=\"\">".$pages->display_items_per_page($function)."</span>";
		$html.= "</p>";
		return $html;
	}
	
	
	function paginatorSearch($page,$ipp,$total,$form="",$idarea=0){
		$respuesta = new xajaxResponse();
		$html=paginatorConstruct($page,$ipp,$total,$form,$idarea);
		$respuesta->assign("paginator","innerHTML",$html);
		return $respuesta;
	}	
	
	
	
	/*************************************************
	
	**************************************************/
	
	
	
	
	
	function cerrarSesionDescarga(){
	    $respuesta = new xajaxResponse();    
	        unset($_SESSION["loginDownload"]);
	        
	
	        if(isset($_SESSION["idfrom"])){
	            switch ($_SESSION["idfrom"]) {
	                case 1:
	                    $ruta="idfrom=1";
	                break;
	                case 2:
	                    $ruta="idfrom=2&idarea=".$_SESSION["idarea"];
	                break;
	                case 3:
	                    $ruta="idfrom=3&idautor=".$_SESSION["idautor"];
	                break;
	                default :
	                    $ruta="idfrom=1";
	                break;                    
	            }
	        }
	        
	        $pagina="index.php?".$ruta;
		$respuesta->redirect($pagina, 0);	
	        
	    return $respuesta;
	}
	
	
	/******* Busqueda**********/
	
	$xajax->registerFunction('pasaValor');
	$xajax->registerFunction('comboCategoryShow');
	$xajax->registerFunction('graficoFromLoad');
	$xajax->registerFunction('cerrarSesionDescarga');
	$xajax->registerFunction('comboAreaShow');
	
	$xajax->registerFunction('comboReferenciaAutorShow');
	
	$xajax->registerFunction('paginatorSearch');
	$xajax->registerFunction('auxSearchShow');
	$xajax->registerFunction('downloadLogin');
	$xajax->registerFunction('formConsultaShow');
	$xajax->registerFunction('iniPublicationShow');
	$xajax->registerFunction('downloadPDF');
	$xajax->registerFunction('abstractHide');
	$xajax->registerFunction('abstractShow');
        $xajax->registerFunction('formReset');
	$xajax->registerFunction('searchPublicationShow');
	$xajax->registerFunction('searchPublication');
	$xajax->registerFunction('comboEstadoShow');
	$xajax->registerFunction('comboTipoPublicacionShow');
	$xajax->registerFunction('comboTipoFechasShow');
	$xajax->registerFunction('seccionShow');
	$xajax->registerFunction('comboReferenciaShow');
	$xajax->registerFunction('comboMonthShow');
	$xajax->registerFunction('comboYearShow');
	$xajax->registerFunction('comboRegionShow');
	$xajax->registerFunction('comboDepartamentoShow');

?>

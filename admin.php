<?php

	require ('../class/ClassCombo.php');
	require ('../class/ClassForm.php');
	require ('../class/ClassPaginado.php');
        require ('../class/ClassPaginator.php');
	require ('../class/dbconnect.php');
	require ('../class/xajax_core/xajax.inc.php');
	require ('../class/RegisterInput.php');
	$xajax=new xajax();
        //$xajax->configure("debug", true);
	$xajax->configure('javascript URI', 'js/');
 	date_default_timezone_set('America/Lima');

	require("adminIni.php");
	require("adminSearch.php");
	require("adminRegister.php");
	require("adminStatistics.php");
	require("indexSearch.php");

	//Ejecutamos el modelo
	require("adminModel.php");
        
	//include ("graficos/FusionCharts.php");
	//include("graficos/DBConn1.php");

	if(isset($_GET["idarea"])){
		$idarea=$_GET["idarea"];
	}
	else{
		$idarea=0;
	}

	session_name("bib");
	session_start();



	/************************************************************
	Función que Verfica el Login
	************************************************************/
	function inicio(){
		$respuesta = new xajaxResponse();
                    /*
	            $iduser=$_SESSION["idusers"];
                    $respuesta->alert($iduser);
                    */
                $sessionidarea="";
		if(isset($_SESSION["admin"])){
		    if($_SESSION["admin"]!=""){
		    	if($_SESSION["idarea"]==8){
                            $idarea=$_SESSION["idarea"];
                            $respuesta->script("xajax_menuAAShow($idarea)");
		        }
                        /*
                        elseif($_SESSION["idarea"]==12){
                                $respuesta->script("xajax_menuGSShow($idarea)");
                        }
                        */
                        else{
                            $sessionidarea=$_SESSION["idarea"];
		            $cadena="xajax_menuShow($sessionidarea);";
                            $respuesta->script($cadena);               
                        }
                        
                        /*muestra el enlace del formulario modal*/        
                        $respuesta->script("xajax_crea_form('cambiar');");
                        $enlace='<a id="new-clave" href="#" class="blanco" >Cambiar Clave<img src="img/iconos/candado_llave_24.png"></img></a>';
                        $respuesta->assign("menu_d", "innerHTML","$enlace");
                                
		    	$respuesta->assign("loginform", "style.display","none");
		    	$respuesta->assign("subcontent1", "style.display","block");
		    }
			else{
		    	$cadena="xajax_formLoginShow();";
		    	$respuesta->script($cadena);
                        
                        $respuesta->script("xajax_crea_form('recuperar');");
                        $enlace='<a id="recuparar-clave" href="#" class="blanco" >Recuperar Clave<img src="img/iconos/candado_llave_24.png"></img></a>';
                        $respuesta->assign("menu_d", "innerHTML","$enlace");
                        
		    	$respuesta->assign("subcontent1", "style.display","none");
		    	$respuesta->assign("loginform", "style.display","block");                
                        
                        
                        $html='<table><tr><td style="text-align: center;">';
                        $html.='<img src="img/login.jpg" />';
                        $html.='</td></tr></table>';
                        
                        $respuesta->assign("imghome", "innerHTML", $html);
                        
			}   
		}
		else{
			$cadena="xajax_formLoginShow();";
                        
                        $respuesta->script("xajax_crea_form('recuperar');");
                        $enlace='<a id="recuparar-clave" href="#" class="blanco" >Recuperar Clave<img src="img/iconos/candado_llave_24.png"></img></a>';
                        $respuesta->assign("menu_d", "innerHTML","$enlace");
                        
            $respuesta->script($cadena);
            $respuesta->assign("subcontent1", "style.display","none");
            $respuesta->assign("loginform", "style.display","block");   
                           
            

            
		}
		//tab title tooltip
            $respuesta->script("$('[rel=propover]').popover({
            							animation : 0.05 ,
            							placement : 'top',
            							trigger: 'hover',
            							title:'Contáctenos',
            							html:'true',
            							content :\"Cualquier consulta escribanos a <span class='emailigp'>web@igp.gob.pe</span>\"
            							});
            					"); 

		return $respuesta;
	}	
	
	
	function formLoginShow(){
	    $respuesta = new xajaxResponse();
              
            $form= '
                <form class="form-inline" onsubmit="xajax_verificaUsuarioShow(xajax.getFormValues(formLogin)); return false;" id="formLogin" method="post">                                    	
                	<div class="input-prepend">
  					<span class="add-on label-id" ></span>
  					<input class="input-small" id="usuario" name="usuario" type="text" placeholder="Usuario">
					</div>
					<div class="input-prepend">
					<span class="add-on label-pw"></span>
  					<input class="input-small" id="clave" name="clave" type="password" placeholder="Contraseña">
					</div>
					<input type="submit" name="Login" class="btn" value="Ingresar">
					<div id="error"></div>

                   
                </form>                
                ';
                
	    
	    $respuesta->Assign("divformlogin","innerHTML",$form);
	    return $respuesta;
	}

	
	/************************************************************
	Función que Cierra la Sesión
	************************************************************/
	function cerrarSesion(){
		$respuesta = new xajaxResponse();
		$_SESSION["admin"]="";
		$respuesta->redirect("admin.php", 0);	
		$respuesta->Assign("subcontent1","style.display","none");
	    return $respuesta;
	}

	function checkDataForm($form){
	        
	    $check["Error"]=0;
	    if($form["author_name"]==""){
	        $check["Msg"]="Ingrese Nombre";
	        $check["Error"]=1;
	    }
	
	    elseif($form["author_surname"]==""){
	        $check["Msg"]="Ingrese Apellido";
	        $check["Error"]=1;
	    }
	    return $check;
	}

	function verificaUsuarioShow($form_entrada){
        $respuesta = new xajaxResponse();

        //$usuario=$form_entrada["usuario"];
        //$clave=$form_entrada["clave"];

        $result = verificaUsuarioSQL($form_entrada);

        $NroRegistros=$result["Count"];
        switch($NroRegistros){
            case 0:
                $divError="error";
                $respuesta->Assign("error","style.display","block");				
                $respuesta->assign("error", "innerHTML","<span class='span3 offset7 alert alert-error'><span class='add-on i-error'></span>Usuario y/o clave incorrectos</span>");
            break;
			case 1:
                                $idusers=$result["idusers"];
				$users_name=$result["users_name"];
				$area_description=$result["area_description"];
				$users_type=$result["users_type"];
				session_unset();
				session_destroy();
				session_start();
                                $_SESSION["idusers"]=$idusers;
				$_SESSION["users_type"]=$users_type;
				$_SESSION["idfrom"]=2;
				$_SESSION["admin"]=$users_name;
				$_SESSION["authorPRI"] = array();
				$_SESSION["authorSEC"] = array();
                        
				if($_SESSION["idusers"]==8){
					$respuesta->script("xajax_menuAAShow($idarea)");
				}/*
                                elseif($_SESSION["idarea"]==12){
					$respuesta->script("xajax_menuGSShow($idarea)");
				}
                                */
				else{
					$respuesta->script("xajax_menuShow()");
				}
                                
                                
                                //$respuesta->alert(print_r($_SESSION, true));
                                
                                //$respuesta->script("xajax_crea_form();");
                                $respuesta->script("xajax_inicio();");
                                $enlace='<a id="new-clave" href="#" class="blanco" >Cambiar Clave<img src="img/iconos/candado_llave_24.png"></img></a>';
                                $respuesta->assign("menu_d", "innerHTML","$enlace");
                                
				//$respuesta->script("xajax_muestraFormGrafico()");
				$respuesta->Assign("subcontent1","style.display","block");
				//$respuesta->Assign("loginform","style.display","none");
                                $respuesta->Assign("divformlogin","innerHTML","&nbsp");
                                $respuesta->Assign("permiso","style.display","none");
                                $respuesta->Assign("ingreso","style.display","block");
                                
            break;
        }
        
        return $respuesta;
    }


    function recuperarClaveResult($user,$correo){
        
        $result=recuperarClaveSQL($user,$correo);
        
        return $result;
    }
	
    function recuperarClave($user,$correo){
        $respuesta = new xajaxResponse();
        
        $result=recuperarClaveResult($user,$correo);
        $count=$result["Count"];
        
        if($count>0){

                $iduser=$result["idusers"];
                $user=$result["users_name"];
                $correo=$result["users_email"];
                      
                $random=rand();
                $clave_temp=$random;
                                        
                $respuesta->script('xajax_sendemail("'.$iduser.'","'.$user.'","'.$correo.'","'.$clave_temp.'")');
        }
        else{
                $respuesta->alert($result['Msg']);
        }
        //$respuesta->alert($result["Query_select"]);
        //$respuesta->alert($result["Query_update"]);
        //$respuesta->alert($result["Count"]);
        
        return $respuesta;
    }

    function claveTempResult($iduser,$users,$correo,$clave_temp){
        
        $result=cambiarTempClaveSQL($iduser,$users,$correo,$clave_temp);
        
        return $result;
        
    }
    
    function sendemail($iduser="",$user="",$correo="",$clave_temp=""){
        $respuesta = new xajaxResponse();
    
        /*Cambiar la clave por una temporal*/
        $resultTemp=claveTempResult($iduser,$users,$correo,$clave_temp);
        //$respuesta->alert($resultTemp["Query_update"]);
        
                        
                        $connection = @ssh2_connect('mailer.igp.gob.pe', 22);
                        ssh2_auth_password($connection, 'telematica', 'telematica');
                        
                        /*lo envia al span
                        $connection = @ssh2_connect('geo.igp.gob.pe', 22);
                        ssh2_auth_password($connection, 'sismo_responde', 'tavera');
                        */

                        $random=rand();
                        
                        
		if (!$connection){
			$sendEmail["error"]= 1;
			$sendEmail["msg"]= "No se pudo conectar al servidor de correos";
		}
		else{
                        
			$message=  "                                                    
			<h1 style='color:#0D648C;'>INSTITUTO GEOF&Iacute;SICO DEL PER&Uacute;</h1>
		 	<h2>&Aacute;REA DE TELEM&Aacute;TICA</h2>
			<h3>Módulo de Informaci&oacute;n Cient&iacute;fica T&eacute;cnica</h3>
			
			<b>USUARIO</b>
                        <br>
			--------------------------------------------
			<br><br>
			<b>Usuario</b>   : <span style='color:#0D648C;'>".$user."</span><br>
			<b>Correo</b>   : ".$correo."<br>
			<b>Clave</b> : ".$clave_temp."<br>
			
			";
                        
                        $gestor = fopen("tmp/mensaje$random.html", "w");
			fwrite($gestor, utf8_decode($message));
			fclose($gestor);			
                        ssh2_scp_send($connection, "tmp/mensaje$random.html", "mensaje$random.html", 0666);

                        $bash='
                        #!/bin/bash
                        subject="Renovación de contraseña Módulo ITS"
                        #cat mensaje.html | mail -s "$(echo -e "$subject\nContent-Type: text/html")" eddy.lecca3@gmail.com
                        #Linea de codigo usada actualmente
                        #cat mensaje'.$random.'.html | mail -s "$(echo -e "$subject\nContent-Type: text/html")" eddy.lecca3@gmail.com
                            
                        cat mensaje'.$random.'.html | mail -s "$(echo -e "$subject\nContent-Type: text/html")" '.$correo.'
                            
                        ';
                        
                        $gestor = fopen("tmp/mail$random.sh", "w");
			fwrite($gestor, utf8_decode($bash));
			fclose($gestor);			
                        ssh2_scp_send($connection, "tmp/mail$random.sh", "mail$random.sh", 0755);
                        
                        //Ejecutamos el archivo sh creado
                        ssh2_exec($connection, "./mail$random.sh");
                        
                        //Borrar el archivo sh Remotamente y Localmente
                        //ssh2_exec($connection, "rm mail$random.sh");
                        //exec("rm tmp/mail$random.sh");
                        
                        //Borrar el archivo html Remotamente y Localmente
                        //ssh2_exec($connection, "rm mensaje$random.html");
                        //exec("rm tmp/mensaje$random.html");
                        
                        
                        $sendEmail["error"]= 0;
			$sendEmail["msg"]= "Se envió el correo";
                        //$sendEmail["msg"]= "Consulta enviada correctamente";
                        
                }
                
                $respuesta->alert($sendEmail["msg"]);
                
      return $respuesta;
        
    }
    
    function cambiarClaveResult($clave_old,$clave_new,$correo,$idusers){
        
        $result=cambiarClaveSQL($clave_old,$clave_new,$correo,$idusers);
        
        return $result;
    }
	
    function cambiarClave($clave_old,$clave_new,$correo,$idusers){
        $respuesta = new xajaxResponse();
        
        //$respuesta->alert($idusers);
        /*
        
        $respuesta->alert($clave_old);
        $respuesta->alert($clave_new);
        */
        
        $result=cambiarClaveResult($clave_old,$clave_new,$correo,$idusers);
        
        $respuesta->alert($result["Msg"]);
        //$respuesta->alert($result["Query_update"]);
        //$respuesta->alert($result["Count"]);
        
        return $respuesta;
    }
	
	function displaydiv($div,$idtitle) {
	    $objResponse = new xajaxResponse();
	    $array=array("titulo_resumen","titulo_tipo_prepor","author","evento","lugarPais","referencia","tipoTesis_pais_universidad","area_tema","fecha_estado_permisos","archivo","region_departamento","titulo","nro_magnitud","fecha_permisos","year_quarter","areas","compendio","titulo_presentado","areasAdministrativas","institucion_externa");
		$titulos=array("titulo1","titulo2","titulo3","titulo4","titulo5","titulo6","titulo7");
		foreach ($array as $elemento){
			if($elemento==$div){
				$objResponse->assign($elemento,"style.display","block");
				foreach ($titulos as $nombre_titulos){
					if($nombre_titulos==$idtitle){
						$objResponse->script("
							$('body .tab').removeClass('tabactive');
							$('body #".$idtitle."').addClass('tabactive');

							");
						
					}
					else{
						// $objResponse->assign($nombre_titulos,"style.background","#FFFFFF");
						// $objResponse->assign($nombre_titulos,"style.border","none");
	                                        
					}
	                                
				}
	                        
			}
			else{
				$objResponse->assign($elemento,"style.display","none");
			}
	                
		}
	
		$subcategory=$_SESSION["subcategory"];
		switch($subcategory){
	    case "charlas_internas":
			if($div=="areas"){
				$objResponse->assign("areasAdministrativas","style.display","block");
				$objResponse->assign("institucion_externa","style.display","block");
			}
		break;
	
		}
	
	
	
		//    $objResponse->alert(print_r($array, true));
	
	    return $objResponse;
	}

	
	/******************************************
	Función que muestra un Menú en el Template
	*******************************************/
	function menuShow(){
		$respuesta= new xajaxResponse();
                

                $menu="";
                if($_SESSION["admin"]=="admin"){
                    
                    /*Menú de la nueva plantilla 2012*/
                    switch($_SESSION["users_type"]){
                        case 0: //el segundo parametro es el currentpage al ser cero utiliza el valor del formulario
                            $menu.='<li><a href="#" onclick="xajax_formCategoryShow(2); return false;"><img width="12px;" style="vertical-align:middle;" src="img/iconos/salir_16.png" /> Nuevo </a></li>';
                            $menu.="<li><a href='#' onclick='xajax_formConsultaShow(\"$idfrom\",\"admin\",\"$idarea\"); xajax_auxSearchShow(20,1,xajax.getFormValues(\"formSearch\"),\"\",\"0\")'><img width='12px;' style='vertical-align:middle;' src='img/iconos/search_16.png' /> Consultas</a></li>";
                        
                            
                    }

                    if($_SESSION["users_type"]==0){
                        //$menu.='<li><a href="#" onClick="xajax_formUsuarioShow(); return false;" ><img style="vertical-align:middle;" src="img/iconos/candado_llave_16.png" />Nuevo Usuario</a></li>';
                    }  
                    $menu.='<li><a href="#" onclick="xajax_cerrarSesion(); return false"><img width="12px;" style="vertical-align:middle;" src="img/iconos/salir_16.png" /> Cerrar Sesión</a></li>';
                             
                    $respuesta->assign("divformlogin", "style.display", "none");
                    $html='<table><tr><td style="text-align: center;">';
                    $html.='<img src="img/biblioteca.png" />';
                    $html.='</td></tr></table>';
                    
                    $respuesta->assign("imghome", "innerHTML", $html);
                }  
                              
		$respuesta->assign("menu", "innerHTML", $menu);
                
		
		$respuesta->script('
                    $(function(){

                        $("ul.dropdown li").hover(function(){

                            $(this).addClass("hover");
                            $("ul:first",this).css("visibility", "visible");

                        }, function(){

                            $(this).removeClass("hover");
                            $("ul:first",this).css("visibility", "hidden");

                        });


                        $("ul.dropdown li ul li:has(ul)").find("a:first").append(" &raquo; ");

                    });
                    
                ');
		return $respuesta;
	}  
        
        
	function subcategoryResult($category=0,$idarea=0){
		$resultSql= searchSubCategorySQL($category,"","",$idarea);
		return $resultSql;
	}
	
	/******************************************
	Función que muestra un Menú en el Template
	*******************************************/
	function menuAAShow($idarea=0){
		$respuesta= new xajaxResponse();
	
		$result=subcategoryResult(3,$idarea);
		$count=$result["Count"];
	       
		$menu="<div><h3  class='txt-rojo'>Nuevo Ingreso:</h3></div>";

		for($i=0;$i<$count;$i++){
			$desc = ucfirst($result["subcategory_description"][$i]);
			$id = $result["idsubcategory"][$i];
			//$idfrom=$_SESSION["idfrom"];
                        $idfrom=isset($_SESSION["idfrom"])?$_SESSION["idfrom"]:0;
			$idarea=isset($_SESSION["idarea"])?$_SESSION["idarea"]:0;
	        $menu.="<div class='submenu'>»<a href='#' class='negro' onClick='xajax_formCategoryShow(3,$id); return false'>$desc</a></div>";
		}
	       
                $menu.="<div><h3 class='txt-rojo'>Consultas :</h3>
                        <div class='submenu'>»<a class='negro' href='#'  onClick='xajax_formConsultaShow(\"$idfrom\",\"admin\",\"$idarea\"); return false'>B&uacute;squeda</a></div>
                        <div class='submenu'>»<a id='botonshow' class='negro' href='#'  >Estad&iacute;sticas   </a></div>
                        <div class='left-box'><h3 class='txt-rojo'>Salir :</h3></div>
                        <div class='submenu'>»<a href='#' class='negro' onClick='xajax_cerrarSesion(); return false'>Cerrar sesi&oacute;n</a></div>";
		$respuesta->assign("menuLateral", "innerHTML", $menu);
	       
		$respuesta->assign("menuLateral", "innerHTML", $menu);
		return $respuesta;
	}

	/******************************************
	Función que muestra un Menú en el Template
	*******************************************/
	
        
	function formCategoryShow($idcategory,$idSubcategory=0){
	    $respuesta = new xajaxResponse();
		if(isset($_SESSION["editar"])){
			if($_SESSION["editar"]==1){
				unset($_SESSION["edit"]);
				unset($_SESSION["editar"]);
			}
		}
	        
                $respuesta->Assign("consultas","style.display","none");
		$respuesta->Assign("paginator","style.display","none");        
                
                
		switch($idcategory){
		    case 1:
		        $respuesta->script("xajax_formPublicacionShow($idSubcategory)");
		    break;
		    case 2:
		        $_SESSION["tipoDocumento"]="ponencia";
		        $_SESSION["subcategory"]="ponencia";
		
		        $respuesta->script("xajax_formPonenciasShow()");
		    break;
		   
		    case 4:
		        $respuesta->script("xajax_formInformacionInternaShow(0,7)");
		    break;
		   
                
		}
                
                //$respuesta->alert(print_r($_SESSION, true));
		
	
		return $respuesta;
	}
	
	
	
	function formPonenciasShow($iddata=0,$idSubcategory=0){
		$objResponse = new xajaxResponse();
		

		//Borramos las variables de sesion
		if(isset($_SESSION["tmp"])){
		    unset($_SESSION["tmp"]);
		    unset($_SESSION["publicaciones"]);
		}
		
		if(isset($_SESSION["editar"])){
		    if($_SESSION["editar"]==1){
		        $action="UPD";
		        $tituloBoton="ACTUALIZAR";
		        $tituloGeneral="Editar Material Bibliográfico";
				
				$recuperar = $_SESSION["edit"];
				//verificar los checked
				$ISBN_ch = (isset($recuperar["ISBN"])?"checked":"");
				$ISSN_ch = (isset($recuperar["ISSN"])?"checked":"");
				$Edition_ch = (isset($recuperar["Edition"])?"checked":"");
				$Resumen_ch = (isset($recuperar["Resumen"])?"checked":"");
				$Description_ch = (isset($recuperar["Description"])?"checked":"");
				$FxIng_ch = (isset($recuperar["FxIng"])?"checked":"");
				$UbicFis_ch = (isset($recuperar["UbicFis"])?"checked":"");
				$NumReg_ch = (isset($recuperar["NumReg"])?"checked":"");

				$languaje_ch = (isset($recuperar["languaje"])?"checked":"");
				$NumLC_ch = (isset($recuperar["NumLC"])?"checked":"");

				$NumDewey_ch = (isset($recuperar["NumDewey"])?"checked":"");
				$Class_IGP_ch = (isset($recuperar["Class_IGP"])?"checked":"");
				$EncMat_ch = (isset($recuperar["EncMat"])?"checked":"");
				$OtherTitles_ch = (isset($recuperar["OtherTitles"])?"checked":"");
				$Periodicidad_ch = (isset($recuperar["Periodicidad"])?"checked":"");
				$Serie_ch = (isset($recuperar["Serie"])?"checked":"");
				$NoteGeneral_ch = (isset($recuperar["NoteGeneral"])?"checked":"");
				$NoteTesis_ch = (isset($recuperar["NoteTesis"])?"checked":"");
				$NoteBiblio_ch = (isset($recuperar["NoteBiblio"])?"checked":"");
				$NoteConte_ch = (isset($recuperar["NoteConte"])?"checked":"");
				$DesPersonal_ch = (isset($recuperar["DesPersonal"])?"checked":"");
				$MatEntidad_ch = (isset($recuperar["MatEntidad"])?"checked":"");
				$Descriptor_ch = (isset($recuperar["Descriptor"])?"checked":"");
				$Descriptor_geo_ch = (isset($recuperar["Descriptor_geo"])?"checked":"");
				$CongSec_ch = (isset($recuperar["CongSec"])?"checked":"");
				$TitSec_ch = (isset($recuperar["TitSec"])?"checked":"");
				$Fuente_ch = (isset($recuperar["Fuente"])?"checked":"");
				$NumIng_ch = (isset($recuperar["NumIng"])?"checked":"");
				$UbicElect_ch = (isset($recuperar["UbicElect"])?"checked":"");
				$ModAdqui_ch = (isset($recuperar["ModAdqui"])?"checked":"");
				$Catalogador_ch = (isset($recuperar["Catalogador"])?"checked":"");
				
		    }
		}
		else{
			$action="INS";
                        $tituloBoton="GUARDAR";
                        $tituloGeneral="Nuevo Material Bibliográfico";
		}
                
                $objResponse->script("xajax_registerDateIng()");
                // $objResponse->alert(print_r($_SESSION["edit"],TRUE));
		unset($_SESSION["tmp"]);
	    $tipoDocumento="ponencias";
	
	    $_SESSION["tipoDocumento"]="ponencias";
	    $_SESSION["subcategory"]="ponencia";
            $_SESSION["idtypedocument"]=2;
            $_SESSION["idsubcategory"]=0;
	
	    $html='<h2 class="txt-azul">'.$tituloGeneral.'</h2>

		    <!-- List of register inputs -->
			    	<div class="list-campos span2">
			    		<form id="ListCampos" name="ListCampos">
						  <fieldset>
						    <legend>Lita de Campos </legend>
						    <p><small>Seleccione un campo para añadir al formulario.</small> </p>
						    <label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="id_020" '.$ISBN_ch.'> ISBN
					    	</label>
					    	
						   	<label class="checkbox checkbox1">
					      		<input class="ActionInput" type="checkbox" value="001" '.$ISSN_ch.'> ISSN
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="id_0250" '.$Edition_ch.'> Edicion
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="id_0920" '.$FxIng_ch.'> Fecha de Ingreso
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="id_0924" '.$UbicFis_ch.'> Ubicación Física
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="id_0925" '.$NumReg_ch.'> Número de Registro
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="id_0520" '.$Resumen_ch.'> Resumen
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="id_0300" '.$Description_ch.'> Descripcion
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="002" '.$languaje_ch.'> Idiomas
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="003" '.$NumLC_ch.'> Número de Clasificacion LC
					    	</label>
					    	<label class="checkbox checkbox1">
					      		<input class="ActionInput" type="checkbox" value="004" '.$NumDewey_ch.'> Número de Clasificacion Dewey
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="005" '.$Class_IGP_ch.'> Clasificacion IGP
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="006" '.$EncMat_ch.'> Encabezamiento de Materia
					    	</label>
					    	<label class="checkbox checkbox1">
					      		<input class="ActionInput" type="checkbox" value="007" '.$OtherTitles_ch.'> Otros Títulos
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="008" '.$Periodicidad_ch.'> Periodicidad
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="009" '.$Serie_ch.'> Serie
					    	</label>
					    	<label class="checkbox checkbox1">
					      		<input class="ActionInput" type="checkbox" value="010" '.$NoteGeneral_ch.'> Notas Generales
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="011" '.$NoteTesis_ch.'> Notas Tesis
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="012" '.$NoteBiblio_ch.'> Notas de bibliografía
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="013" '.$NoteConte_ch.'> Notas de contenido
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="014" '.$DesPersonal_ch.'> Descripción Personal
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="015" '.$MatEntidad_ch.'> Materia como entidad
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="016" '.$Descriptor_ch.'> Descriptor
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="017" '.$Descriptor_geo_ch.'> Descriptor Geográfico
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="018" '.$CongSec_ch.'> Congresos Secundarios
					    	</label>

					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="019" '.$TitSec_ch.'> Titulos Secundarios
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="020" '.$Fuente_ch.'> Fuente
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="021" '.$NumIng_ch.'> Número de Ingreso
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="022" '.$UbicElect_ch.'> Ubicación Electrónica
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="023" '.$ModAdqui_ch.'> Modalidad Adquisión
					    	</label>
					    	<label class="checkbox">
					      		<input class="ActionInput" type="checkbox" value="024" '.$Catalogador_ch.'> Catalogador 
					    	</label>	    	
						  </fieldset>
						</form>
			    	</div>
			<!-- fin register inputs -->

			   	<span id="botonRegresar"></span>
			<!-- form conte-->
			    <div class="conte-form span9">
					<div style="padding-top:20px;">
				        <span class="tab" id="titulo1"></span>
				        <span class="tab" id="titulo2"></span> 
				            
				        <!--span class="tab" id="titulo5"></span-->
				        <span class="tab" id="titulo6"></span>
				        <span class="tab" id="titulo7"></span>
					</div>
					<form id="frmBiblio" name="frmBiblio">	
			        <div id="idcontactform" class="listado-busqueda form-horizontal">
			        	
			                
				            <div  id="titulo_tipo_prepor"></div>
				        
					        <div id="author" style="display:none;">
							    <div id="search_authorPRI"></div>
							    <div class="linea-separacion"></div>
							    <div id="newFormAuthor"></div>
					        </div>	
				            
				            <div id="referencia" style="display:none"></div>
				                
				            <div id="area_tema" style="display:none">
				                <div class="txt-azul" id="conte_temas"></div>	                
								<div  class="linea-separacion"></div>
								<a class="showdiv txt-azul" onclick="$(\'.showdiv\').toggle()"> <i class="icon-chevron-right"></i>  Nuevo Tema</a>                
								<a class="showdiv hide txt-azul divactive" onclick="$(\'.showdiv\').toggle()"> <i class="icon-chevron-down"></i> Nuevo Tema</a>
				                <!--div class="txt-azul" id="titNuevoTema"></div-->
				                <div class="hide showdiv" id="nuevo_tema_publicacion"></div>
				            </div>
				
							<div id="fecha_permisos" style="display:none">
								<div id="fechasTesis"></div>
								<div  class="linea-separacion"></div>					
									
							</div>
							<div id="archivo" style="display:none"></div>
						</form>
					</div>
					
		            <div class="action-btn">
		            	<!--input class="btn"  type="button" onclick="xajax_newPonencia('.$iddata.',\''.$action.'\');" value='.$tituloBoton.'-->
		            	<input class="btn"  type="button" onclick="xajax_newRegisterBiblio('.$iddata.',\''.$action.'\',xajax.getFormValues(\'frmBiblio\'));" value='.$tituloBoton.'  />
		            </div>            	
		        </div> 

		    <!-- fin form conte -->
			';

    	//###############################################################
		//PRIMERO COLOCAMOS EL FORMULARIO QUE CONTIENE LAS DEMAS CAPAS
		// $objResponse->alert(print_r($_SESSION["editar"],TRUE));
	    $objResponse->assign("formulario","style.display","block");	    
	    $objResponse->assign("formulario","innerHTML","$html");	    
	    
		// Muestra los tabs por default
	    $objResponse->script("xajax_displaydiv('titulo_tipo_prepor','titulo1')");        
	    
	    // $objResponse->alert(print_r($_SESSION["edit"],TRUE));
	    $titulo="Detalle";
		if(isset($_SESSION["edit"])){
		    $recuperar=$_SESSION["edit"];
		}
		elseif(isset($_SESSION["tmp"])){
		    $recuperar=$_SESSION["tmp"];
		 }

	
        if(isset($recuperar["titulo"])){
            $tit=$recuperar["titulo"];
        }
        else{
            $tit="";
        }

        if(isset($recuperar["ISBN"])){
            $ISBN=$recuperar["ISBN"];
        }
        else{
            $ISBN="";
        }

        if(isset($recuperar["CallNumber"])){
            $CallNumber=$recuperar["CallNumber"];
        }
        else{
            $CallNumber="";
        }

        if(isset($recuperar["description_physical"])){
            $description_physical=$recuperar["description_physical"];
        }
        else{
            $description_physical="";
        }

        if(isset($recuperar["edition"])){
            $edition=$recuperar["edition"];
        }
        else{
            $edition="";
        }

        if(isset($recuperar["subject"])){
            $subject=$recuperar["subject"];
        }
        else{
            $subject="";
        }

        if(isset($recuperar["summary"])){
            $summary=$recuperar["summary"];
        }
        else{
            $summary="";
        }
        

        if(isset($recuperar["tipoPonencia_description"])){
            $tipoPonencia_description=$recuperar["tipoPonencia_description"];
        }
        else{
            $tipoPonencia_description="";
        }        
        
		$tipoPonencia="";
		$tipoPonencia=comboTipoPonencia($tipoPonencia_id);	
		
		$html="
	       	<div class='clear'></div>  

	       	
	       	<!--input type='hidden' value='tipoPonencia_description' id='tipoPonencia_txt' name='tipoPonencia_txt' class='field'-->
			<div class='clear'></div>
			
			<!--campos requeridos -->
			<div class='control-group'>
				<label class='control-label' for='title'>Ingrese Titulo</label>
				<div class='controls'>
				<input type='text' placeholder='Ingrese titulo aqui' onchange='xajax_registerTitulo(this.value); return false;' value='$tit' id='title' name='title' class='caja-buscador-1' />
				<span id='title_error' class='msg_error color_red'></span>
				</div>
				<!--select name='sel'> <option value='01'>0000</option><option value='02'>002</option> </select-->
			</div>

			<!-- comentado temporalmente>
			<div class='control-group'>
				<label class='control-label' for='list_fbook'>formato</label>
				<div class='controls'>
				<div class='fleft' id='tipoFormato'></div>
				       	<span><a href='#' class='btnOpen small' onclick='xajax_NewFormat(); return false;'>&nbsp Nuevo Formato</a></span>
				       	<div id='divNewFormat'></div>
				</div>
			</div>

			<div class='control-group'>
				<label class='control-label' for='ISBN'>Codigo ISBN:&nbsp;</label>
				<div class='controls'>
				<input type='text' placeholder='ej. 0385342586' onchange='xajax_registerISBN(this.value); return false;' value='$ISBN' id='ISBN' name='ISBN' class='caja-buscador-1' />
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label' for='CallNumber'>Codigo de ubicación</label>
				<div class='controls'>
				<input type='text'  placeholder='Ingrese código de ubicación física aqui' onchange='xajax_registerCallNumber(this.value); return false;' value='$CallNumber' id='CallNumber' name='CallNumber' class='caja-buscador-1' />
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label' for='description_physical'>Descripción Física</label>
				<div class='controls'>
				<input type='text' placeholder='ej. 719 p. ; 21 cm' onchange='xajax_registerDescription_Physical(this.value); return false;' value='$description_physical' id='description_physical' name='publication' class='caja-buscador-1' />
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label' for='edition'>Edición</label>
				<div class='controls'>
				<input type='text' placeholder='ej. 1ra ed' value='$edition' onchange='xajax_registerEdition(this.value); return false;' id='edition' name='edition' class='caja-buscador-1' />
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label' for='summary'>Resumen</label>
				<div class='controls'>
				<textarea placeholder='Escriba aqui el resumen' onchange='xajax_registerSumary(this.value); return false;' id='summary' name='summary' rows='3' >$summary</textarea>
				</div>
			</div>
			<fin comentado temporalmente-->
			<div id='input_secundary'></div>
			<!-- fin campos requeridos -->
			       		
       	";
       	$objResponse->script("xajax_Combo_Format();");

	    $objResponse->Assign("titulo_tipo_prepor","innerHTML",$html);
		$objResponse->Assign('titulo1',"innerHTML","<a href=#1 onclick=\"xajax_displaydiv('titulo_tipo_prepor','titulo1'); return false;\"  rel='tooltip' data-toggle='tooltip' title='Información General!'>$titulo</a>");
	    
	    
	    
    	//###############################################################
		//PARA EL AUTOR
	    //$objResponse->script("xajax_iniAuthorShow('titulo2')");

    	$objResponse->assign("titulo2","innerHTML","<a class='tab-title' href='#' onclick=\"xajax_displaydiv('author','titulo2'); return false;\" rel='tooltip' data-toggle='tooltip' title='Gestione Autores aqui!' >Autor</a>");
    	$objResponse->script("xajax_searchAuthorSesionPriShow()");
    	$objResponse->script("xajax_searchAuthorSesionSecShow()"); 

    	
    	$objResponse->assign("search_authorPRI","innerHTML",iniAuthorPriShow());    		
        $objResponse->assign("newFormAuthor","innerHTML",formAuthorShow());
	    
	    
    	
	
    	//###############################################################    		
	    //$objResponse->script("xajax_iniAreaTheme('titulo5')");
	    // Temas relacionados
		$link="<a onclick=\"xajax_displaydiv('area_tema','titulo5'); return false;\" class='tab-title' href='#' rel='tooltip' title='Temas Relacionados'>Temas Relacionados</a>";
		$objResponse->assign('titulo5',"innerHTML",$link);
	
	    
	
	        //Ingresar nuevo tema
		$objResponse->script("xajax_iniThemes_Book();");

		$objResponse->script("xajax_newThemeShow();");	    
	    
    	
		//###############################################################    		
        $objResponse->script("xajax_iniDatePermission('titulo6')");
	    
		

		//###############################################################
		// ARCHIVO			
	    //$objResponse->script("xajax_iniArchivoShow('titulo7')");
	    //$htmlArchivo=iniArchivoShow();            
            //$objResponse->script("xajax_cargaScriptMostrarAutores()");

        list($htmlArchivo,$link)=iniArchivoShow();
        $objResponse->Assign('titulo7',"innerHTML","<a class='tab-title' href=#1 onclick=\"xajax_displaydiv('archivo','titulo7'); return false;\" rel='tooltip' title='Imagen de Portada'>Imagen</a>");
        // $objResponse->alert(print_r($htmlArchivo, true));
    	$objResponse->Assign("archivo","innerHTML",$htmlArchivo);
    	
                    if($link!=""){
                        $objResponse->Assign("formUpload","style.display","none");
                        // $objResponse->alert($link);
                    }
        
		$objResponse->Assign("formulario","style.display","block");
		$objResponse->Assign("resultSearch","style.display","none");

		$objResponse->Assign("estadisticas", "style.display", "none");
                $objResponse->script("xajax_cargaScriptDates()");
                
    //             if(isset($_SESSION["editar"])){
				//     if($_SESSION["editar"]==1){
				// 		$linkRegresar='<span style="float:right;"><a class="negro" href=# id="boton_actualizar"onclick="xajax_abstractHide(\'formulario\'); xajax_abstractShow(\'consultas\'); xajax_abstractShow(\'resultSearch\'); xajax_abstractShow(\'paginator\');"><img style="cursor: pointer; border:0;" width="20px" src="img/flecha-izq.jpg">&nbsp;&nbsp; Retornar a resultados </a></span>';
				// 		$objResponse->assign("botonRegresar","innerHTML",$linkRegresar);
				//     }
				// }       
                
                
                //upload file - image of portada
                $objResponse->script("xajax_carga_archivo()");

                //nuevo formato bibliográfico
                $objResponse->script("
                					$('#list_fbook').change(function(){
                						var sel_html = $('#list_fbook option:selected').html();
                						if (sel_html == 'Nuevo Formato') {
                							$('#newformat').removeClass('divnone');
                							$('#newformat').addClass('divblock');                							              							
                						}
                						else{
                							$('#newformat').removeClass('divblock');
                							$('#newformat').addClass('divnone');  
                						}

                					});
                					");                
        
        
                $objResponse->assign("imghome", "style.display", "none");
                $objResponse->assign("consultas", "style.display", "none");
                
                //Nuevo formato tipo modal y formulario dinamico
                $objResponse->script("
									$('#divNewFormat').dialog({
									autoOpen: false,
									modal: true,
									title: 'Nuevo Formato',
									show: 'fade',
									hide: 'fade',
						            height: 'auto',
						            width: 350 });

						            $('.btnOpen').click(function() {
										$('#divNewFormat').dialog('open');					
										return false;
									});
                					//alert('verificando los checked para incrementarlo al form');
                					$('.ActionInput').each(function(){
                						var id = $(this).val();
				                		if($(this).is(':checked')) {
								            xajax_ListCampos(id);								            
								        } else {  								            
								            xajax_delCampos(id);  
								        } 
                					});

									$('.ActionInput').change(function(){
				                		var id = $(this).val();
				                		if($(this).is(':checked')) {
								            xajax_ListCampos(id);								            
								        } else {  								            
								            xajax_delCampos(id);  
								        }  
				                	});	
                ");                
                  

		return $objResponse;

	} 
	function ListCampos($id){
		$objResponse = new xajaxResponse();				

		$result = Query_input($id);			

		$html = $result["html"];
		
 		$html = eregi_replace("[\n|\r|\n\r]", ' ', $html);
 		$html = addslashes($html);		

		$objResponse->script('
							var1 = "'.$html.'";
							var var2=var1.replace("\n"," ");
							$(""+var2+"").appendTo("#input_secundary");							
							');
		$objResponse->script(" 
					$('#".$id." > div').each(function(index){					
						$(this).attr('id','".$id."_'+(index+1));
						$(this).find('a').attr('id','a_".$id."_'+(index+1));
						$(this).find('input').change(function(){
							//alert(index);
						});										
					});
		");

		if (isset($_SESSION["edit"])) {
			$recuperar = $_SESSION["edit"];
		}
		// if(isset($recuperar["languaje"])){            
  //           $objResponse->script("
  //           			$('#languaje').attr('value','".$recuperar["languaje"]."');
  //           			");
  //       }
  //       else{
  //           $languaje="";
  //       }	
		return $objResponse;

	} 
	function delCampos($id="",$id2=""){
		$objResponse = new xajaxResponse();

		if (isset($id) and $id!="") {
			$result = Query_input($id);			
			$idinput = $result["idinput"];
		
			if ($_SESSION["required"]["$idinput"]) {
				unset($_SESSION["required"]["$idinput"]);
			}
		}
		if (isset($id2) and $id2!="") {
			$id = $id2;
			
		}

		$objResponse->remove("$id");
		$objResponse->script(" 
					$('#".$id." > div').each(function(index){					
						$(this).attr('id','".$id."_'+(index+1));
						$(this).find('a').attr('id','a_".$id."_'+(index+1));
						$(this).find('input').change(function(){
							//alert(index);
						});										
					});
		");			

		return $objResponse;
	}

	function Query_input($id) {

		$recuperar = (isset($_SESSION["edit"])?$_SESSION["edit"]:"");
		$respuesta["html"] = "<div class='control-group' id='$id'>";
		//agregar y eliminar input
		 
		// $respuest["add"] = "<span><a href='#' onclick='xajax_AddInput(\"".$id."\",\"".$respuesta["labelinput"]."\",\"".$respuesta["idinput"]."\"); return false;'>(+)Aumentar</a></span>";
		// $respuesta["del"] = "<span><a href='#' onclick='$(\"#".$id."_".$k."\").remove(); return false;'>(-)Eliminar</a></span>";
		$repetibles = array("002","006","007","009","010","014","015","016","017","019","020","021");
		switch ($id) {
				case 'id_020':										
					$respuesta["idinput"] = "ISBN";
					$respuesta["labelinput"] = "ISBN";
					break;
				case 'id_0250':										
					$respuesta["idinput"] = "Edition";
					$respuesta["labelinput"] = "Edicion";
					break;
				case 'id_0520':										
					$respuesta["idinput"] = "Resumen";
					$respuesta["labelinput"] = "Resumen";
					break;
				case 'id_0300':										
					$respuesta["idinput"] = "Description";
					$respuesta["labelinput"] = "Descripcion";
					break;
				case 'id_0920':										
					$respuesta["idinput"] = "FxIng";
					$respuesta["labelinput"] = "Fecha de Ingreso";
					break;
				case 'id_0924':										
					$respuesta["idinput"] = "UbicFis";
					$respuesta["labelinput"] = "Ubicación Fisica";
					break;
				case 'id_0925':										
					$respuesta["idinput"] = "NumReg";
					$respuesta["labelinput"] = "Nḿero de Registro";
					break;

				case '001':										
					$respuesta["idinput"] = "ISSN";
					$respuesta["labelinput"] = "ISSN";
					break;

				case '002':												        
					$respuesta["idinput"] = "languaje";
					$respuesta["labelinput"] = "Idioma";
					break;

				case '003':
					$respuesta["idinput"] = "NumLC";
					$respuesta["labelinput"] = "Número de Clasificacion LC";					
					break;

				case '004':
					$respuesta["idinput"] = "NumDewey";
					$respuesta["labelinput"] = "Número de Clasificacion Dewey";					
					break;

				case '005':					
					$respuesta["idinput"] = "Class_IGP";
					$respuesta["labelinput"] = "Número de Clasificacion IGP";					
					break;

				case '006':					
					$respuesta["idinput"] = "EncMat";
					$respuesta["labelinput"] = "Encabezameinto de Materia";					
					break;

				case '007':
					$respuesta["idinput"] = "OtherTitles";
					$respuesta["labelinput"] = "Otros Títulos";					
					break;

				case '008':					
					$respuesta["idinput"] = "Periodicidad";
					$respuesta["labelinput"] = "Periodicidad";					
					break;

				case '009':					
					$respuesta["idinput"] = "Serie";
					$respuesta["labelinput"] = "Serie";					
					break;

				case '010':
					$respuesta["idinput"] = "NoteGeneral";
					$respuesta["labelinput"] = "Notas Generales";					
					break;

				case '011':
					$respuesta["idinput"] = "NoteTesis";
					$respuesta["labelinput"] = "Notas de Tesis";					
					break;

				case '012':
					$respuesta["idinput"] = "NoteBiblio";
					$respuesta["labelinput"] = "Notas de bibliografía";					
					break;

				case '013':
					$respuesta["idinput"] = "NoteConte";
					$respuesta["labelinput"] = "Notas de contenido";					
					break;

				case '014':
					$respuesta["idinput"] = "DesPersonal";
					$respuesta["labelinput"] = "Descripción Personal";					
					break;

				case '015':
					$respuesta["idinput"] = "MatEntidad";
					$respuesta["labelinput"] = "Materia como entidad";					
					break;

				case '016':
					$respuesta["idinput"] = "Descriptor";
					$respuesta["labelinput"] = "Descriptor";					
					break;

				case '017':
					$respuesta["idinput"] = "Descriptor_geo";
					$respuesta["labelinput"] = "Descriptor Geográfico";					
					break;

				case '018':
					$respuesta["idinput"] = "CongSec";
					$respuesta["labelinput"] = "Congresos Secundarios";
					break;

				case '019':
					$respuesta["idinput"] = "TitSec";
					$respuesta["labelinput"] = "Titulos Secundarios";					
					break;

				case '020':
					$respuesta["idinput"] = "Fuente";
					$respuesta["labelinput"] = "Fuente";
					break;

				case '021':
					$respuesta["idinput"] = "NumIng";
					$respuesta["labelinput"] = "Número de Ingreso";				
					break;

				case '022':
					$respuesta["idinput"] = "UbicElect";
					$respuesta["labelinput"] = "Ubicación electrónica";					
					break;

				case '023':
					$respuesta["idinput"] = "ModAdqui";
					$respuesta["labelinput"] = "Modalidad adquisión";				
					break;

				case '024':
					$respuesta["idinput"] = "Catalogador";
					$respuesta["labelinput"] = "Catalogador";				
					break;

				default:
					$respuesta["html"] = "";
					break;				
			}

			$idinput = $respuesta["idinput"];
			//para campos repetidos
			if (is_array($recuperar[$idinput])) {
				
				if (isset($recuperar[$idinput])) {
						$respuesta["html"] .= "<label class='control-label' for='$idinput'>".$respuesta["labelinput"]."</label>";
						for ($k=0; $k < count($recuperar[$idinput]); $k++) {
							 $val_input=(isset($recuperar[$idinput][$k])?$recuperar[$idinput][$k]:"");
							
							$respuesta["html"] .= "
								    <div class='controls' id='".$id."_".($k+1)."'>
								      <input type='text' name='".$idinput."[]' placeholder='Ejm. esp.' onchange='xajax_register_input(this.value,\"".$respuesta["labelinput"]."\",\"".$respuesta["idinput"]."\"); return false;' value='$val_input'>
									
								    ";
							// $respuesta["html"] .=($k==0?$respuesta["add"]:$respuesta["del"]);	    
							  if ($k==0) {						 	
								$respuesta["html"] .= "<span><a href='#' onclick='xajax_AddInput(\"".$id."\",\"".$respuesta["labelinput"]."\",\"".$respuesta["idinput"]."\"); return false;'>
															<span class='ui-icon ui-icon-circle-plus inline'></span></a>
														</span> ";
							  }
							  else{						 	
								$respuesta["html"] .= "<span><a href='#' onclick='xajax_delCampos(\" \",\"".$id."_".($k+1)."\");  return false;'>
															<span class='ui-icon ui-icon-circle-minus inline'></span></a>
														</span>";
							  }
							 $respuesta["html"] .="</div>";							
							}
					}
					else{
						$respuesta["html"] .= "
							    <label class='control-label' for='$idinput'>".$respuesta["labelinput"]."</label> 
							    <div class='controls' id='".$id."_".($k+1)."'>
							      <input type='text' name='".$idinput."[]' placeholder='".$respuesta["labelinput"]."' onchange='xajax_register_input(this.value,\"".$respuesta["labelinput"]."\",\"".$respuesta["idinput"]."\"); return false;' value=''>
							      <span><a href='#' onclick='xajax_AddInput(\"".$id."\",\"".$respuesta["labelinput"]."\",\"".$respuesta["idinput"]."\"); return false;'>
							      	<span class='ui-icon ui-icon-circle-plus inline'></span></a></span>
							    </div>
							";
					}
			}
			
			else{
				if (isset($_SESSION["tmp"])  && in_array($id, $repetibles)) {					
						$respuesta["html"] .= "
							    <label class='control-label' for='$idinput'>".$respuesta["labelinput"]."</label> 
							    <div class='controls' id='".$id."_1'>
							      <input type='text' name='".$idinput."[]' placeholder='".$respuesta["labelinput"]."' onchange='xajax_register_input(this.value,\"Idioma\",\"languaje\"); return false;' value=''>
							      <span><a href='#' onclick='xajax_AddInput(\"".$id."\",\"".$respuesta["labelinput"]."\",\"".$respuesta["idinput"]."\"); return false;'>
							      	<span class='ui-icon ui-icon-circle-plus inline'></span></a>
							      </span>
							      <span id='".$respuesta["idinput"]."_0_error' class='msg_error color_red'></span>
							    </div>
						";					
				}
			//para campos no repetidos
				else{
					$val_input=(isset($recuperar[$idinput])?$recuperar[$idinput]:"");
					$respuesta["html"] .="
								<label class='control-label' for='$idinput'>".$respuesta["labelinput"]."</label>
								<div class='controls'>
								<input type='text' placeholder='".$respuesta["labelinput"]."' onchange='xajax_register_input(this.value,\"".$respuesta["labelinput"]."\",\"".$respuesta["idinput"]."\"); return false;' value='$val_input' id='$idinput' name='$idinput'  />
								<span id='".$respuesta["idinput"]."_error' class='msg_error color_red'></span>
								</div>
							";
				}

				
			}		

		$respuesta["html"]	.= '</div>';
		return $respuesta;

	}
	function AddInput($id="",$labelinput="",$idinput=""){
		$objResponse = new xajaxResponse();
		$html = "<div class='controls' >
								<input type='text'  value=''  name='".$idinput."[]'  />
								<span><a href='#' class='del_input' onclick='xajax_delInput($(this).parents(\"div\").attr(\"id\"),\"".$labelinput."\",\"".$idinput."\")'>
									<span class='ui-icon ui-icon-circle-minus inline'></span></a>
								</span>
								<span  class='msg_error color_red'></span>
								</div>";
		$html = eregi_replace("[\n|\r|\n\r]", ' ', $html);
 		$html = addslashes($html);	

		$objResponse->script("
				$('".$html."').appendTo('#".$id."');
				reconteo('".$id."');
				function reconteo(iddd){
					$('#'+iddd+' > div').each(function(index){					
						$(this).attr('id',iddd+'_'+(index+1));
						$(this).find('a').attr('id','a_".$id."_'+(index+1));
						$(this).find('span.msg_error').attr('id','".$idinput."_'+(index)+'_error');
						// $(this).find('input').change(function(){
						// 	alert(index);
						// });	
					});
				}
				

			");

		// $objResponse->assign("div","innerHTML",$html);
		return $objResponse;
	}
	function delInput($idDiv,$labelinput="",$idinput=""){
		$objResponse = new xajaxResponse();		
		$objResponse->script("
					var idDiv = $('#".$idDiv."').parents('div').attr('id');					
					$('#".$idDiv."').remove();
					
					$('#'+idDiv+' > div').each(function(index){	

						$(this).attr('id',idDiv+'_'+(index+1));	
						$(this).find('span.msg_error').attr('id','".$idinput."_'+(index)+'_error');					
						
					});
					//return false;
					
					
			");
		return $objResponse;

	}

	function NewFormat(){
		$objResponse = new xajaxResponse();
		$html = "<form id='Newformat'>
				<div id='newformat_content'>
					<label for='fdescription'>Ingrese Nuevo Formato</label>
					<input type='text' name='fdescription' id='fdescription'>
					<div id='msj_Fdes'></div>
					<div class='btnActions'>
						<input class='btn' type=\"button\" value=\"Guardar\" onclick=\"xajax_SaveFormat(xajax.getFormValues('Newformat'))\">                 
              			<input class='btn btnCancel' type=\"button\" value=\"Cancelar\" >
              		</div> 
              	</div> 
				</form>";
		$objResponse->assign("divNewFormat","innerHTML",$html);
		$objResponse->script("$('.btnCancel').click(function(){
					$('#divNewFormat').dialog('close')					
				});	");
		return $objResponse;
	}
	

	function SaveFormat($form){
		$objResponse = new xajaxResponse();
		if ($form["fdescription"]=="") {
			$objResponse->assign("msj_Fdes","innerHTML","<span class='alert small'>Debe ingresar un formato</span>");
			$objResponse->script("$('#fdescription').focus();");
		}
		else{
			$result = insertFormat($form);
			if ($result["Error"]==0) {
				$html = "<span class='ui-icon ui-icon-circle-check' style='float: left; margin: 0 7px 20px 0;'></span>Nuevo formato guardado con exito";
				$objResponse->script("xajax_Combo_Format();");
			}
			else{
				$html = "Intentalo mas tarde";
			}
			$objResponse->assign("newformat_content","innerHTML",$html);

		}	
		
		return $objResponse;
	}	
	function Combo_Format(){
		$objResponse = new xajaxResponse();
		$listformat = new combo();		
		$result_format = select_format();
		
		$fbook_values = array();
		for ($i=0; $i < $result_format["Count"]; $i++) { 
			array_push($fbook_values, ($i+1));
		}
		
		$fbook_options = $result_format["fdescription"];						
		$formatBook = $listformat->comboList($fbook_options,$fbook_values,"OnChange","xajax_obtenerIdDescripcion('list_fbook','registerfbook')","","999","list_fbook"," ","list_fbook");
		
		$objResponse->assign("tipoFormato","innerHTML",$formatBook);


		if (isset($_SESSION["edit"])) {
			$idfbook = $_SESSION["edit"]["idfbook"];
			$objResponse->script("									
									var id_book = ".$_SESSION["edit"]["idfbook"].";									
									$('#list_fbook option[value='+id_book+']').attr('selected',true);  
									");
		}
		return $objResponse;
	}

	function formConsultaShow($idbutton,$seccion="",$idarea=0){
		$objResponse = new xajaxResponse();
	
		if(isset($_SESSION["edit"])){                    
		    unset($_SESSION["edit"]);
                    unset($_SESSION["editar"]);
		    unset($_SESSION["publicaciones"]);
		}
                
                //$objResponse->alert($idarea);
		// Desde la pagina web del IGP
		if($idbutton==1){
			$functionButton="xajax_auxSearchShow(20,1,xajax.getFormValues('formSearch'),\"\",\"$idarea\");";
			$formAutor='<div id="divAuthor">';
			$formAutor.='<div class="campo-buscador">Apellido Autor:&nbsp;</div>';
			$formAutor.='<div class="contenedor-caja-buscador-1"><input id="author" name="author" type="text" size="30" class="caja-buscador-1"></div>';
			$formAutor.='</div>';
	
		}
	
		// Desde la pagina web del area
		if($idbutton==2){
			$functionButton="xajax_auxSearchShow(20,1,xajax.getFormValues('formSearch'),\"\",\"$idarea\");";
			// $formAutor='<div id="divAuthor">';
			// $formAutor.='<div class="campo-buscador">Apellido Autor:&nbsp;</div>';
			// $formAutor.='<div class="contenedor-caja-buscador-1"><input id="author" name="author" type="text" size="30" class="caja-buscador-1"></div>';
			// $formAutor.='</div>';
			
			//$formAutor='<div id="divAuthor"><label class="left">Apellido Autor:&nbsp;</label><input id="author" name="author" type="text" size="30" class="field"></div>';

		}
		// Desde la pagina web del autor
		if($idbutton==3){
			$functionButton="xajax_auxSearchShow(20,1,xajax.getFormValues('formSearch'),\"\",\"$idarea\");";
			$formAutor='';
		}
	
		$fieldhidden='<input id="fieldHidden" name="fieldHidden" type="hidden" value='.$seccion.'>';

		if($idarea==9){
                    $formArea='<div class="campo-buscador">&Aacute;reas:&nbsp;</div><div class="contenedor-combo-buscador-1" id="divArea"></div><div style="clear:both"></div>';
		}                
		if($idarea==8){
			$comboTipoPublicacion='
			<select  name="idsubcategory" id="idsubcategory" onChange="xajax_comboTipoFechasShow(this.value);xajax_seccionShow(this.value); return false;" class="combo-buscador-1">
			    <option value="0" selected="selected">- Seleccione-&nbsp;</option>
			    <option value="5" >&nbsp;Charlas Internas&nbsp;</option>
			    <option value="11">&nbsp;Compendios de estudiantes&nbsp;</option>
                            <option value="12">&nbsp;Informes trimestrales&nbsp;</option>
			</select>';    
		}		          
		else{
			$comboTipoPublicacion='
			<select  name="idcategory" id="idcategory" class="combo-buscador-1">
			    <option value="1" selected="selected">Todos los campos</option>
			    <option value="2">Titulo</option>
			    <option value="3">Autor</option>
			    <option value="4">Descripcion</option>			    
			</select>';
		}
		
		$html='
		<div>
			<div id="divformSearch">
			<h2 class="txt-azul">Buscador </h2>
			<form id="formSearch">'.$formArea.'	
				    <label class="checkbox inline">
					  <input type="radio" id="query_type_1" name="query_type" value="content" checked> Que contenga
					</label>

					<label class="checkbox inline">
					  <input type="radio" id="query_type_2" name="query_type" value="empieza"> Empieza por
					</label>
					<label class="checkbox inline">
					  <input type="radio" id="query_type_3" name="query_type" value="exacta" > Exacta
					</label>
				    
									
				<div class="clear"></div>
				<div>
                                    
                            <div id="div_tituloSearch" class="contenedor-caja-buscador-1">
                                <input id="tituloSearch" name="tituloSearch" type="text" size="30" class="caja-buscador-1">
                            </div>

                            <div class="contenedor-combo-buscador-1" id="divCategory">
							'.$comboTipoPublicacion.'						
							</div>
				</div>'.$formAutor.' '.$fieldhidden.'            
                <button id="btn-search">Buscar</button>
                <span class="text-right none"><a href="#">Busqueda Avanzada</a></span>
				<div class="clear"></div>
				<div id="msj_query_type"> Buscará la palabra o frase que esté contenido en todo registro</div>				
				
				<div id="optionsSubcategory"></div>
				<div id="moreOptions"></div>

				<div id="searchDate" style="display:none;">
					<div style="clear:both;"></div>
					<div class="campo-buscador">Fechas: </div>
					<div class="contenedor-caja-buscador-2">
						<span id="divTipoFecha"></span>
						<span id="divMonth"></span>
						<span id="divYear"></span>
					</div>
					<div class="clear"></div>	
				</div>

			</form>
			</div>
			<div id="resultSearch" style="display: none;"></div>
		</div>';
		
	    //$objResponse->script("xajax_comboAreaShow()");
	    //$objResponse->script("xajax_comboMonthShow()");
	    //$objResponse->script("xajax_comboYearShow()");
	    
	    
	    $objResponse->Assign("consultas","innerHTML","$html");
	    $objResponse->Assign("formulario","style.display","none");
	    $objResponse->Assign("consultas","style.display","block");
            $objResponse->assign('paginator', 'style.display',"none");
            $objResponse->assign("imghome", "style.display", "none");
            
                $comboArea=comboAreaResult();
		// $objResponse->assign('divArea', 'innerHTML', $comboArea);
		
		$comboMonth=comboMonth(0,'','searchMonth');
		// $objResponse->assign('divMonth', 'innerHTML',$comboMonth);

		$comboYear=comboYear(0,'','searchYear');
		// $objResponse->assign('divYear', 'innerHTML',$comboYear);
                
	    $objResponse->Assign("estadisticas", "style.display", "none");
	    
            		if($idarea==11 or $idarea==12 or $idarea==13 or $idarea==14){
                            $objResponse->assign("div_titulo","innerHTML","");
                            $objResponse->assign("div_tituloSearch","innerHTML","");
                            $objResponse->assign("divAuthor","innerHTML","");
                            
                            
                        }
	    //$objResponse->assign('botonGuardarEditar', 'innerHTML',$comboYear);
	    $objResponse->script('
	    	

	   		$("input:radio[name=query_type]").click(function(){
	   			
	   			if ($(this).attr("checked", "checked")) {
	   				
	   				var cc = $("input:radio[name=query_type]:checked").val();
	   				if (cc=="content") {
	   					msjdes = "Buscará la palabra o frase que esté contenido en todo registro";
	   				}
	   				else if (cc=="empieza") {
	   					msjdes = "Buscará la palabra o frase que empieza por";
	   				}
	   				else if (cc=="exacta") {
	   					msjdes = "Buscará la palabra o ofrase exacta";
	   				}
	   				else{
	   					msjdes == "debe elegir una opcion";
	   				}

	   				$("#msj_query_type").html(msjdes);
	   			}
	   		})    
	    	
                
                $( "#btn-search" ).button({
                    icons: {
                        primary: "ui-icon-search"
                    }            
                })
                .click(function() {                                    
                                    xajax_auxSearchShow(20,1,xajax.getFormValues(formSearch)); return false;        })  
            

		');
		return $objResponse;
	}

	
function crea_form($accion){
    $respuesta = new xajaxResponse();
    
    $iduser=$_SESSION["idusers"];
    
    switch($accion){
        case "cambiar":
        
        $html='                        
        <div id="clave-form" title="Cambiar Clave">
        	<p class="validateTips">Todos los campos son requeridos</p>
			<form id="myform">
			<fieldset>
				<label for="name">Clave actual</label>
				<input type="password" name="password_old" id="password_old" class="text ui-widget-content ui-corner-all" />
		                
				<label for="name">Ingrese su nueva clave</label>
				<input type="password" name="password_new" id="password_new" class="text ui-widget-content ui-corner-all" />

				<label for="name">Reingrese su nueva clave </label>
				<input type="password" name="repasswordnew" id="repasswordnew" class="text ui-widget-content ui-corner-all" />

		                <p class="validateTips_correo">La siguiente dirección de correo que ingrese se utilizará en caso usted olvide la contraseña</p>
				<label for="name">Ingrese su E-mail </label>
				<input type="text" name="correo" id="correo" class="text ui-widget-content ui-corner-all" />

			</fieldset>
			</form>
        </div>

        ';

        $respuesta->assign("form","innerHTML",$html);
        
        $respuesta->script('
	$(function() {


		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		

		var password_old = $( "#password_old" ),
                    password_new = $( "#password_new" ),
                    repasswordnew = $( "#repasswordnew" ),
                    correo = $( "#correo" ),
                    
                    allFields = $( [] ).add( password_old ).add( repasswordnew ).add( password_new ).add( correo ),
                    tips = $( ".validateTips" );

		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}

		function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );
				updateTips( "Longitud de " + n + " debe estar entre " +
					min + " y " + max + "." );
				return false;
			} else {
				return true;
			}
		}

		function checkRegexp( o, regexp, n ) {
			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} else {
				return true;
			}
		}

		function equal_pass( o, n ) {
			if ( o.val() != n.val() ) {
				n.addClass( "ui-state-error" );
				updateTips( "El nuevo password no coincide con el ingresado anteriormente." );
				return false;
			} else {
				return true;
			}
		}



   /********Dialogo Clave****************/
   /*
   Las dimensiones puedes obviarse solo sí el contenido en pequeño
    height: 700,
    width: 700,
    */
		$( "#clave-form" ).dialog({
			autoOpen: false,
			modal: true,
                        resizable: false,
                        /*position: "top",*/
			buttons: {
				"Aceptar": function() {
					var bValid = true;
					allFields.removeClass( "ui-state-error" );
                                        
					bValid = bValid && checkLength( password_old, "password", 5, 16 );                                        
                                        bValid = bValid && checkLength( password_new, "password", 5, 16 );
                                        bValid = bValid && checkLength( repasswordnew, "password", 5, 16 );
                                        bValid = bValid && equal_pass( password_new, repasswordnew );
                                        bValid = bValid && checkLength( correo, "email", 6, 80 );
                                        
                                        bValid = bValid && checkRegexp( password_old, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
					bValid = bValid && checkRegexp( repasswordnew, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
                                        bValid = bValid && checkRegexp( password_new, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
                                                                                
                                                                                
					// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
                                        /*bValid = bValid && checkRegexp( correo, /^((([a-z]|\d|[!#\$%&\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );*/
					/*bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );*/
                                        
                                            bValid = bValid && checkRegexp( correo, /^[A-Z|a-z|_|0-9|\.]+@([0-9a-zA-Z])+\.([0-9a-zA-Z])+$/i, "ejm. usuario@dominio.com" );
                                        /*Para que acepte un correo parecido a eddy.leccca@yahoo.com.pe*/
                                        /*bValid = bValid && checkRegexp( correo, /^[A-Z|a-z|_|0-9|\.]+@([0-9a-zA-Z])+\.([0-9a-zA-Z])+\.([0-9a-zA-Z])+$/i, "ejm. usuario@dominio.com" );*/
                                        

                                        
					if ( bValid ) {
                                                
                                                /*show(name.val());*/
                                                /*xajax_insertElement(\'instrument_type\',name.val());*/
                                                xajax_cambiarClave(password_old.val(),password_new.val(),correo.val(),'.$iduser.');
                                                /*
						$( "#users tbody" ).append( "<tr>" +
							"<td>" + name.val() + "</td>" + 
							"<td>" + email.val() + "</td>" + 
							"<td>" + password.val() + "</td>" +
						"</tr>" ); 
                                                */
						$( this ).dialog( "close" );
					}
				},
				Cancelar: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});
    /***************************************/

    /**********Asignar a los divs el efecto*************/
		$( "#new-clave" )                       
			.click(function() {
				$( "#clave-form" ).dialog( "open" );
			});
                        

	});

    function show(val){
            alert(val);
        }
        ');
    break;

    case "recuperar":
        
        $html='                        
        <div id="recuparar-form" title="Recuperar Clave">
        <p class="validateTips">Todos los campos son requeridos</p>
	<form id="myform">
	<fieldset>
		<label for="name">Ingrese su Usuario</label>
		<input type="text" name="user" id="user" class="text ui-widget-content ui-corner-all" />
                
		<label for="name">Ingrese su Correo</label>
		<input type="text" name="correo" id="correo" class="text ui-widget-content ui-corner-all" />


	</fieldset>
	</form>
        </div>




        ';

        $respuesta->assign("form","innerHTML",$html);
        
        $respuesta->script('
	$(function() {


		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		

		var user = $( "#user" ),
                    correo = $( "#correo" ),
                    
                    allFields = $( [] ).add( user ).add( correo ),
                    tips = $( ".validateTips" );

		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}

		function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );
				updateTips( "Longitud de " + n + " debe estar entre " +
					min + " y " + max + "." );
				return false;
			} else {
				return true;
			}
		}

		function checkRegexp( o, regexp, n ) {
			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} else {
				return true;
			}
		}

		function equal_pass( o, n ) {
			if ( o.val() != n.val() ) {
				n.addClass( "ui-state-error" );
				updateTips( "El nuevo password no coincide con el ingresado anteriormente." );
				return false;
			} else {
				return true;
			}
		}



   /********Dialogo Clave****************/
   /*
    Las dimensiones puedes obviarse solo sí el contenido en pequeño
    height: 700,
    width: 700,
    */
		$( "#recuparar-form" ).dialog({
			autoOpen: false,
			modal: true,
                        resizable: false,
                        /*position: "top",*/
			buttons: {
				"Aceptar": function() {
					var bValid = true;
					allFields.removeClass( "ui-state-error" );
                                        
					bValid = bValid && checkLength( user, "username", 3, 16 );                                        
                                        bValid = bValid && checkLength( correo, "email", 6, 80 );
                                        
                                        bValid = bValid && checkRegexp( user, /^[a-z]([0-9a-z_])+$/i, "Usuario puede concistir  a-z, 0-9, comenzar con una letra." );
					// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/                                       
                                        bValid = bValid && checkRegexp( correo, /^[A-Z|a-z|_|0-9|\.]+@([0-9a-zA-Z])+\.([0-9a-zA-Z])+$/i, "ejm. usuario@dominio.com" );
                                        

                                        
					if ( bValid ) {
                                                
                                                /*show(name.val());*/
                                                /*xajax_insertElement(\'instrument_type\',name.val());*/
                                                /*xajax_cambiarClave(password_old.val(),password_new.val(),correo.val(),'.$iduser.');*/
                                                xajax_recuperarClave(user.val(),correo.val());
                                                /*
						$( "#users tbody" ).append( "<tr>" +
							"<td>" + name.val() + "</td>" + 
							"<td>" + email.val() + "</td>" + 
							"<td>" + password.val() + "</td>" +
						"</tr>" ); 
                                                */
						$( this ).dialog( "close" );
					}
				},
				Cancelar: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});
    /***************************************/

    /**********Asignar a los divs el efecto*************/
		$( "#recuparar-clave" )                       
			.click(function() {
				$( "#recuparar-form" ).dialog( "open" );
			});
                        

	});

    function show(val){
            alert(val);
        }
        ');
    break;

    }
        
	
    return $respuesta;        
}
	
	

function carga_archivo($img_portada=""){
    $respuesta = new xajaxResponse();
    if(isset($_SESSION["edit"])){    	
    	$recuperar=$_SESSION["edit"];
    	if (count($recuperar["files"])==0) {
    		$_SESSION["edit"]["files"]= array();
    	}
	}
	elseif(isset($_SESSION["tmp"])){
		$_SESSION["tmp"]["files"]= array();
	    $recuperar=$_SESSION["tmp"];
	}

    
    $html='
            <table class="options">
            <thead>
                    <tr>
                            <!--<th>Subir cargo</th>-->
                            <!--<th>Listado de Archivos Cargados</th>-->
                    </tr>
            </thead>
            <tbody>
                    <tr>
                            <td>';
                            if (isset($_SESSION["tmp"])) {
                            	$html .= '<div id="up_files" style="width:500px"></div>
                                    <!--<div id="report" style="overflow:auto;width:300px;height:200px;"></div>-->';
                            }
                            elseif(isset($_SESSION["edit"])){
           //                  	if ($gestor = opendir('librerias/ax-jquery-multiuploader/examples/uploaded')) {							           
							    //     $html.="<ul>";
							    //     while (false !== ($arch = readdir($gestor))) {
							    //            if ($arch != "." && $arch != "..") {							                       
							    //                    $html.="<li><a href=\"librerias/ax-jquery-multiuploader/examples/uploaded/".$arch."\" class=\"linkli\">".$arch."</a></li>\n";
							    //            }
							    //     }
							    //     closedir($gestor);
							            
							    //     $html.="</ul>";							        
							    // }
							    // $respuesta->alert(print_r($_SESSION["edit"],TRUE));
							    
							    if (isset($recuperar["files"])) {
							    	$html .= '<div id="edit_files" style="width:500px">
                            			<ul>';
	                            	for ($i=0; $i < count($recuperar["files"]); $i++) { 
	                            	    $html.="<li id='file_".$i."'><a href=\"librerias/ax-jquery-multiuploader/examples/uploaded/".$recuperar["files"][$i]."\" class=\"linkli\">".$recuperar["files"][$i]."</a> 
	                            	    			<span> <a href='#' id='del-file' class='del-file' onclick='xajax_DeleteImg(\"".$recuperar["files"][$i]."\",\"".$i."\")'>Eliminar</a></span></li>\n";


	                            	}
	                            	$html .= '<div id="msj-del-file" title="Eliminar Imagen"> </div>';
	                            	$html .= '</ul></div>';							    	
							    }
							    else{
							    	$html .= '<div id="up_files" style="width:500px"></div>';
							    }
                            	
                            }
                                    

$html .='					</td>
                            
                    </tr>
            </tbody>
            </table>

    ';

    
    $respuesta->assign("carga_archivo", "innerHTML", $html);
    $respuesta->script("
							    	$(function(){
							    		 $('#msj-del-file').dialog({
											autoOpen: false,											
											width: 350,
											modal: true											
											});
							    		$('.del-file').click(function(){
							    			$('#msj-del-file').dialog('open');
							    		});
							    	});
							    	");
    
    $respuesta->script('
			$("#up_files").ajaxupload({
				url:"librerias/ax-jquery-multiuploader/examples/upload.php",
                                allowExt:["png","gif","jpg","zip"],
				remotePath:"uploaded/",
                                finish:function(files)
                                    {
                                        alert("Todas las archivos han sido cargados");                                        
                                        //var conteo=files.length 
                                        //alert(files);
                                        //xajax_lista_archivos();
                                        
                                    },
                                success:function(fileName)
                                    {
                                        
                                        texto = fileName.split(".");
                                        name=texto[0];
                                        //alert(name);

                                        //$("#report").append("<p>"+fileName+" uploaded.</p>");
                                        //$("#report").append("<input class=\'filesupload\' type=\'text\' name=\'"+name+"\' id=\'"+name+"\' value=\'"+fileName+"\'></input>");
                                        xajax_save_files(fileName);
                                    }
			});
        
    ');
    
    return $respuesta;
}    


function save_files($namefile){
    $respuesta = new xajaxResponse();
    if(isset($_SESSION["edit"])){
    	
    	$recuperar=$_SESSION["edit"];
	}
	elseif(isset($_SESSION["tmp"])){
		
	    $recuperar=$_SESSION["tmp"];
	}

    $texto = explode('.',$namefile);
    $name=$texto[0];
    
    $str_name=(str_replace(" ","-",$name));   
	                  
       //$_SESSION["publicaciones"]["files"] = array( );
    	if(isset($_SESSION["edit"])){
    		array_push($_SESSION["edit"]["files"],$namefile);

		}
		elseif(isset($_SESSION["tmp"])){
			array_push($_SESSION["tmp"]["files"],$namefile);
		}

        
       //$_SESSION["publicaciones"]["files"]["img-".$str_name]= $namefile;
       //$_SESSION["publicaciones"]["files"]["img-".$str_name]= $namefile;
        
    // $respuesta->alert(print_r($namefile, true));
    
    return $respuesta;
}



function delete_file($namefile){
    $respuesta = new xajaxResponse();
    
    //$respuesta->alert($namefile);
        
    // $pos = array_search($namefile,$_SESSION["files"]);
    
    // unset($_SESSION["files"][$pos]);
      
    $dir="librerias/ax-jquery-multiuploader/examples/uploaded/";
   
    	if (is_file($dir.$namefile)) {
	      if ( unlink($dir.$namefile) ){
	        $respuesta->assign($namefile, "value", "");
	        
	      }
     }
    $texto = explode('.',$namefile);
    $name=$texto[0];
     
    /*
     //Eliminar el input creado para el archivo cargado
     $respuesta->script("
        $('#$name').remove();
     ");
    */
    		
    return $respuesta;
}

function DeleteImg($namefile="",$id=""){
    $objResponse = new xajaxResponse();
    $html = "<p class='msj'>Está seguro que desea eliminar el programa.</p>
		   <div class='btnActions'>
		   	<input type='button' value='Eliminar' onclick='xajax_ConfirmDeleteImg(\"".$namefile."\", \"".$id."\")' class='btn btnCancel'>
		   	<input type='button' value='Cancelar' class='btn btnCancel'>
		   </div>";
    
    $objResponse->assign("msj-del-file","innerHTML",$html);
		$objResponse->script("
					$('.btnCancel').click(function(){
						$('#msj-del-file').dialog('close')
					});
		");
    		
    return $objResponse;
}

function ConfirmDeleteImg($namefile,$id){
	$objResponse = new xajaxResponse();
	$dir="librerias/ax-jquery-multiuploader/examples/uploaded/";

    if (is_file($dir.$namefile)) {
	      if ( unlink($dir.$namefile) ){
	        $objResponse->assign($namefile, "value", "");
	        unset($_SESSION["edit"]["files"][$id]);
	        //var_dump($_SESSION["edit"]["files"]);

	        $objResponse->script("
	        		$('#file_".$id."').remove();
	        	");

	        if (count($_SESSION["edit"]["files"]) ==0) {
	        	unset($_SESSION["edit"]["files"]);
	         	$objResponse->script("xajax_carga_archivo()");
				}
	        
	        $objResponse->alert(print_r($_SESSION["edit"], true));
	      }
     }
    	
    
    else{
    	$objResponse->script("xajax_carga_archivo()");
    }
    return $objResponse;

}


	/*******************************************************************
	Registrar las Funciones
	*******************************************************************/
	
	$xajax->registerFunction('newRegisterBiblio');
	$xajax->registerFunction('subArea');
	$xajax->registerFunction('registerSubAreas');
	$xajax->registerFunction('menuAAShow');
	$xajax->registerFunction('formCategoryShow');
	$xajax->registerFunction('detalleGraficosEstadisticos');
	$xajax->registerFunction('graficosEstadisticos');
	$xajax->registerFunction('muestraFormGrafico');
	
	/*******Seccion Asuntos Academicos**********/
        $xajax->registerFunction('registerYearPub');
        $xajax->registerFunction('registerMonthPub');        
        $xajax->registerFunction('registerDayPub');
        $xajax->registerFunction('registerDateIng');

	$xajax->registerFunction('registerAreaAdministrativa');
	$xajax->registerFunction('iniAreasAdministrativasShow');
	$xajax->registerFunction('registerTitPrePor');
	$xajax->registerFunction('registerInst_Ext');
	$xajax->registerFunction('iniInstitucionExterna');
	$xajax->registerFunction('iniAreasAdministrativasShow');
	$xajax->registerFunction('iniTitulo_Presentado');
	$xajax->registerFunction('registerCompendioYear');
	$xajax->registerFunction('iniNroCompendioYear');        
        
	$xajax->registerFunction('comboTipoAsuntosAcademicosShow');
	
        
	/*******Seccion Asuntos Academicos**********/
	
	
	
	/*******Seccion Informacion Interna**********/
	
	$xajax->registerFunction('iniAreas');
	$xajax->registerFunction('registerYearQuarter');
	$xajax->registerFunction('comboYearRegisterShow');
	$xajax->registerFunction('comboQuarter');
	$xajax->registerFunction('iniYearQuarter');
	$xajax->registerFunction('registerBoletinMagnitud');
	$xajax->registerFunction('iniNroMagnitud');
	$xajax->registerFunction('comboMagnitudShow');
	$xajax->registerFunction('registerRegDepFechas');
	$xajax->registerFunction('registerTitulo');
	$xajax->registerFunction('iniTitulo');
	
	$xajax->registerFunction('comboDepartamentoShow');
	$xajax->registerFunction('iniRegionDepartamentoFechas');
	$xajax->registerFunction('comboRegionShow');
	$xajax->registerFunction('comboTipoInformacionInternaShow');
	$xajax->registerFunction('formInformacionInternaShow');
	/*******Seccion Informacion Interna**********/
	
	
	/*******Seccion Ponencias********************/
	$xajax->registerFunction('registerCatEvento');
	$xajax->registerFunction('registerNomEvento');
	$xajax->registerFunction('registerLugar');
	$xajax->registerFunction('registerPais');
	$xajax->registerFunction('registerPrePorNombre');
	$xajax->registerFunction('registerPrePorApellido');
	$xajax->registerFunction('registerTipoPonencia');
	$xajax->registerFunction('comboCategoriaEvento');
	$xajax->registerFunction('comboTipoPonencia');
	$xajax->registerFunction('iniEvento');
	$xajax->registerFunction('iniLugarPais');
	$xajax->registerFunction('iniTitulo_Tipo_Presentado');
	$xajax->registerFunction('formPonenciasShow');
	/*******Seccion Ponencias********************/
	
	/*******Sección Publicaciones****************/
     
	
	
	$xajax->registerFunction('arrayAuthor');
	
	$xajax->registerFunction('newPonencia');
	
	$xajax->registerFunction('displaydiv');
	$xajax->registerFunction('comboTypeSubcategoryShow');
	
	
	
	//Registramos funciones para formularios y selects
	
	$xajax->registerFunction('formConsultaShow');
	$xajax->registerFunction('newReferenceRegister');
	$xajax->registerFunction('comboTipoTesisShow');
	$xajax->registerFunction('seccionShow');
	$xajax->registerFunction('comboTipoFechasShow');
	$xajax->registerFunction('iniTitulo_Tipo_Presentado');
	$xajax->registerFunction('registerLugarPais');
	$xajax->registerFunction('registerEventoTipo');
        $xajax->registerFunction('registerClaseEvento');
	
	// Registramos funciones para las fechas, el estado y los permisos 
	// ------------------------------------------------------------------
	$xajax->registerFunction('iniDateStatusPermission');
	$xajax->registerFunction('iniStatus');
	$xajax->registerFunction('iniDates');
	$xajax->registerFunction('iniPermission');
	$xajax->registerFunction('iniDatePermission');
	$xajax->registerFunction('registerPermission');
	$xajax->registerFunction('registerPermissionKey');
	$xajax->registerFunction('registerStatus');
	$xajax->registerFunction('registerDateIng');
	$xajax->registerFunction('registerDatePub');
        $xajax->registerFunction('registerYearCompendio');
	
	// Registramos funciones para areas asociadas y temas
	// ------------------------------------------------------------------
	
	$xajax->registerFunction('iniAreaTheme');
	$xajax->registerFunction('iniOtrosTemasShow');
	$xajax->registerFunction('iniAreas');
	$xajax->registerFunction('newThemeRegister');
	$xajax->registerFunction('newThemeInsert');
	$xajax->registerFunction('newThemeShow');
	$xajax->registerFunction('otrosTemasShow');
	$xajax->registerFunction('registerTheme');
	$xajax->registerFunction('registerArea');
	$xajax->registerFunction('iniOtrasAreasShow');
	$xajax->registerFunction('iniAreaShow');
	
	
	
	
	$xajax->registerFunction('iniArchivoShow');
	$xajax->registerFunction('guardarSesiones');
	
	/*Registrar las sesiones*/
	$xajax->registerFunction('registerTitRes');
	$xajax->registerFunction('registerTitTipo');
	$xajax->registerFunction('registerReference');
	
	$xajax->registerFunction('iniAuthorShow');
	$xajax->registerFunction('auxAuthorPriShow');
	$xajax->registerFunction('auxAuthorSecShow');
	
	$xajax->registerFunction('searchAuthorPriResult');
	$xajax->registerFunction('searchAuthorPriShow');
	
	$xajax->registerFunction('iniTitulo_Resumen');
	$xajax->registerFunction('iniTitulo_ResumenShow');
	$xajax->registerFunction('iniEstadoShow');
	$xajax->registerFunction('iniReferenciaShow');
	$xajax->registerFunction('iniAuthorPriShow');
	$xajax->registerFunction('iniAuthorSecShow');
	$xajax->registerFunction('iniAreaShow');
	
	$xajax->registerFunction('paginatorShow');
	
	$xajax->registerFunction('registraReferenciaShow');
	$xajax->registerFunction('registraReferenciaResult');
	
	$xajax->registerFunction('formAuthorShow');
	
	$xajax->registerFunction('registraAuthorResult');
	$xajax->registerFunction('registraAuthorShow');
	
	$xajax->registerFunction('inicio');
	$xajax->registerFunction('cerrarSesion');
	
	$xajax->registerFunction('searchReferenciaShow');
	$xajax->registerFunction('searchReferenciaResult');
	
	/*************Registrar Funciones de Autores****************/
	$xajax->registerFunction('searchAuthorSesionPriShow');
	$xajax->registerFunction('searchAuthorSesionPriResult');
	
	$xajax->registerFunction('searchAuthorSesionSecShow');
	$xajax->registerFunction('searchAuthorSesionSecResult');
	
	$xajax->registerFunction('delSearchAuthorSesionPriShow');
	$xajax->registerFunction('delSearchAuthorSesionPriResult');
	
	$xajax->registerFunction('delSearchAuthorSesionSecShow');
	$xajax->registerFunction('delSearchAuthorSesionSecResult');
	
	$xajax->registerFunction('searchAuthorPriShow');
	$xajax->registerFunction('searchAuthorPriResult');
	
	$xajax->registerFunction('searchAuthorSecShow');
	$xajax->registerFunction('searchAuthorSecResult');
	/*************Registrar Funciones de Autores****************/
	
	
	$xajax->registerFunction('busquedaReferenciaShow');
	$xajax->registerFunction('nuevaReferenciaShow');
	
	
	$xajax->registerFunction('editShow');
	$xajax->registerFunction('formSubcategoryShow');
	$xajax->registerFunction('formPublicacionShow');
	$xajax->registerFunction('formEstadisticaShow');
	
	$xajax->registerFunction('comboReferenciaShow');
	$xajax->registerFunction('comboEstadoPublicacionShow');
	$xajax->registerFunction('comboTipoPublicacionShow');
	
	$xajax->registerFunction('menuShow');
        $xajax->registerFunction('menuGSShow');
        
	$xajax->registerFunction('formLoginShow');
	$xajax->registerFunction('verificaUsuarioShow');
	
	$xajax->registerFunction('cargaScriptDates');
        $xajax->registerFunction('cargaScriptReferencia');
        $xajax->registerFunction('obtenerIdDescripcion');
        $xajax->registerFunction('cargaScriptMostrarAutores');
        $xajax->registerFunction('cargaScriptOcultarAutores');
        $xajax->registerFunction('mostrarBusquedaAutores');
        $xajax->registerFunction('ocultarBusquedaAutores');
        $xajax->registerFunction('verFile');
        $xajax->registerFunction('cambiarClave');        
        $xajax->registerFunction('crea_form');        
        $xajax->registerFunction('recuperarClave');        
        $xajax->registerFunction('sendemail');

    $xajax->registerFunction('registerfbook');
    $xajax->registerFunction('registerISBN');
    $xajax->registerFunction('registerCallNumber');
    $xajax->registerFunction('registerPublication');
    $xajax->registerFunction('registerEdition');
    $xajax->registerFunction('registerSubject');
    $xajax->registerFunction('registerSumary');
    $xajax->registerFunction('registerISSN');

    $xajax->registerFunction('click_checked');
    $xajax->registerFunction('carga_archivo');
    $xajax->registerFunction('save_files');
    $xajax->registerFunction('delete_file');
    $xajax->registerFunction('registerDescription_Physical');
    $xajax->registerFunction('editBook'); 
    $xajax->registerFunction('NewFormat'); 
    $xajax->registerFunction('SaveFormat'); 
    $xajax->registerFunction('Combo_Format');
    $xajax->registerFunction('DeleteImg') ;
    $xajax->registerFunction('ConfirmDeleteImg');
    $xajax->registerFunction('iniThemes_Book');
    $xajax->registerFunction('ListCampos');
    $xajax->registerFunction('delCampos');
    $xajax->registerFunction('registerlanguaje');
    $xajax->registerFunction('register_input');
    $xajax->registerFunction('AddInput');
    $xajax->registerFunction('delInput');
    $xajax->registerFunction('PubLanguaje');

	$xajax->processRequest();	
	
	
	//Mostramos la pagina
	require("adminView.php");

?>
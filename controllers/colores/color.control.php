<?php
/*
* Control colores mostrar los colores
*
*/


  require_once 'models/colores/colores.model.php';
  require_once 'libs/validadores.php';
  function run(){
    $viewData =array();
    $viewData["mode"] = "";
    $viewData["modeDesc"] = "";
    $viewData["tocken"] = "";
    $viewData["errores"] = array();
    $viewData["haserrores"] = false;
    $viewData["readonly"] = false;
    $viewData["isupdate"] = false;
    $viewData["isinsert"] = false;
    $viewData["isPgmEdit"] = false;
  
    //Arreglo para el combo de Estado del color
    $viewData["estadoColorC"]= getEstadoColor();
    //--------------------------------------
    //Esto es para decirle que va a hacer la pagina porque puede agregar, editar o mostrar, no se eliminan solo se desactivan
    if($_SERVER["REQUEST_METHOD"] == "GET"){

        if(isset($_GET["mode"])){

          $viewData["mode"] = $_GET["mode"];
          $viewData["id"] =$_GET["id"];

          switch ($viewData["mode"]) {
            case 'INS':
              $viewData["modeDesc"] = "Nuevo Color";
              $viewData["isinsert"] = true;
              break;
            case 'UPD':
              $viewData["isupdate"] = 'readonly="readonly"';
              $viewData["modeDesc"] = "Editar ";
              break;
            case 'DEL':
              $viewData["modeDesc"] = "Eliminar ";
              break;
            case 'DSP':
              $viewData["modeDesc"] = "Detalle de ";
              $viewData["readonly"] = 'readonly="readonly"';
              break;
          default:
            redirectWithMessage("Accion Solicitada no disponible.", "index.php?page=colores");
            die();
        }
        // tocken para evitar ataques xhr
        $viewData["tocken"] = md5(time()."colortr");
        $_SESSION["color_tocken"] = $viewData["tocken"];
      }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
       if(isset($_POST["tocken"]) && $_POST["tocken"] === $_SESSION["color_tocken"]){
         if(isset($_POST["mode"])){

           $viewData["mode"] = $_POST["mode"];
           $viewData["tocken"] = $_POST["tocken"];
           $viewData["id"] =$_POST["id"];

           if($viewData["mode"]=="UPD" && (isset($_POST["btnDelPgm"]) || isset($_POST["btnAddPgm"]))){
               $viewData["isPgmEdit"] = true;
           }else{
             $viewData["codigoColor"] = $_POST["txtCodigoColor"];
             $viewData["descripcionColor"] = $_POST["txtDescripcionColor"];
             $viewData["usosColor"] = $_POST["txtUsoColor"];
             $viewData["estadoColor"] =  $_POST["cmbEstado"];


             if(isEmpty($viewData["descripcionColor"])){
                 $viewData["errores"][] = "Descripción en formato Incorrecto";
             }
             if(isEmpty($viewData["usosColor"])){
                 $viewData["errores"][] = "Usos del color en formato Incorrecto";
             }
           }

           $viewData["haserrores"] = count($viewData["errores"]) && true;

           switch ($viewData["mode"]) {
             case 'INS':

			if( isset($viewData["codigoColor"]) && $viewData["codigoColor"]!='' &&
				isset($viewData["descripcionColor"]) && $viewData["descripcionColor"] != '' ){

                     $lastId = insertColor($viewData["codigoColor"],$viewData["descripcionColor"], $viewData["usosColor"],
                                   $viewData["estadoColor"]
                                 );

                 if($lastId){
                   redirectWithMessage("Color Creado Satisfactoriamente.", "index.php?page=colores");
                   die();
                 }else{
                   $viewData["errores"][] = "Error al crear el color";
                   $viewData["haserrores"] = true;
                 }

			}else{

				  if(!isset($viewData["codigoColor"]) || $viewData["codigoColor"] == ''){
					  $viewData["haserrores"] = true;
					  $viewData["errores"][] = "Error codigo color no valido.";
				  }

				  if(!isset($viewData["descripcionColor"]) || $viewData["descripcionColor"]==''){
					  $viewData["haserrores"] = true;
					  $viewData["errores"][] = "Error descripcion del color no valido.";
				  }
			  }

               $viewData["modeDesc"] = "Nuevo Color";
               break;

             case 'UPD':
               $viewData["isupdate"] = 'readonly="readonly"';
               if(!$viewData["haserrores"] && !empty($viewData["codigoColor"])){
                 if(!$viewData["isPgmEdit"]){
                   $affected = updateColores($viewData["id"],$viewData["codigoColor"], $viewData["descripcionColor"],
                                 $viewData["usosColor"],
                                 $viewData["estadoColor"]
                               );
                   // Si no hay error se redirige a la lista de usuarios
                   if($affected){
                     redirectWithMessage("Color Actualizado Satisfactoriamente.", "index.php?page=colores");
                     die();
                   }else{
                   // Se muestra un error sobre la edicion del usuario
                     $viewData["errores"][] = "Error al editar el color";
                     $viewData["haserrores"] = true;
                   }
                }else{
                  
                }
               }
               $viewData["modeDesc"] = "Editar ";
               break;
             case 'DEL':
               $viewData["modeDesc"] = "Eliminar ";
               //No se implementará
               break;
             case 'DSP':
               $viewData["modeDesc"] = "Detalle de ";
               $viewData["readonly"] = 'readonly="readonly"';
               break;
             default:
               redirectWithMessage("Acción Solicitada no disponible.", "index.php?page=colores");
               die();
           }

         }
       }else{
         //Cambia la seguridad del formulario
         $viewData["tocken"] = md5(time()."roltr");
         $_SESSION["rol_tocken"] = $viewData["tocken"];
         $viewData["errores"][] = "Error para validar información.";
       }
   }


   //Obtiene los datos del usuario y gestiona los valores de los arreglos
    if(!empty($viewData["id"])){
      $colores = obtenerColores($viewData["id"]);
      mergeFullArrayTo($colores,$viewData);
      $viewData["modeDesc"] .= $viewData["descripcionColor"];
      $viewData["estadoColorC"] = addSelectedCmbArray($viewData["estadoColorC"],"codigo",$viewData["estadoColor"]);

    }
    // Cambia la seguridad del formulario para evitar ataques XHR.
    if($viewData["haserrores"]>0){
      $viewData["tocken"] = md5(time()."roltr");
      $_SESSION["rol_tocken"] = $viewData["tocken"];
    }
    
    renderizar("colores/color", $viewData);
  }

run();
 ?>

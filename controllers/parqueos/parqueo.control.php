<?php
/*
* Control parqueo editar o guardar 
*
*/


  require_once 'models/parqueos/parqueos.model.php';
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
  
    //Arreglo para el combo de Estados del Parqueo
    $viewData["EstadoParqueoC"]= getEstadosParqueo();
    //Arreglo para el combo de Tipos del Parqueo
    $viewData["TipoParqueoC"]= getTipoParqueo();
    //--------------------------------------
    //Esto es para decirle que va a hacer la pagina porque puede agregar, editar o mostrar, no se eliminan solo se desactivan
    if($_SERVER["REQUEST_METHOD"] == "GET"){

        if(isset($_GET["mode"])){

          $viewData["mode"] = $_GET["mode"];
          $viewData["id"] =$_GET["id"];
          switch ($viewData["mode"]) {
            case 'INS':
              $viewData["modeDesc"] = "Nuevo Parqueo";
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
            redirectWithMessage("Accion Solicitada no disponible.", "index.php?page=parqueos");
            die();
        }
      
        // tocken para evitar ataques xhr
        $viewData["tocken"] = md5(time()."parqueotr");
        $_SESSION["rol_tocken"] = $viewData["tocken"];
      }
    }
             
     if($_SERVER["REQUEST_METHOD"] == "POST"){
       if(isset($_POST["tocken"]) && $_POST["tocken"] === $_SESSION["rol_tocken"]){
         if(isset($_POST["mode"])){

           $viewData["mode"] = $_POST["mode"];
           $viewData["tocken"] = $_POST["tocken"];
           $viewData["id"] =$_POST["id"];

           if($viewData["mode"]=="UPD" && (isset($_POST["btnDelPgm"]) || isset($_POST["btnAddPgm"]))){
               $viewData["isPgmEdit"] = true;
           }else{
             $viewData["EstadoParqueo"] = $_POST["cmbEstado"];
             $viewData["LoteParqueo"] = $_POST["txtLoteParqueo"];
             $viewData["TipoParqueo"] = $_POST["cmbTipoParqueo"];


             if(isEmpty($viewData["LoteParqueo"])){
                 $viewData["errores"][] = "Lote en formato Incorrecto";
             }
           }

           $viewData["haserrores"] = count($viewData["errores"]) && true;

           switch ($viewData["mode"]) {
             case 'INS':

			if( isset($viewData["LoteParqueo"]) && $viewData["LoteParqueo"]!=''){
                    
                     $lastId = insertParqueo($viewData["EstadoParqueo"], $viewData["LoteParqueo"], $viewData["TipoParqueo"]);

                 if($lastId){
                   redirectWithMessage("Parqueo Creado Satisfactoriamente.", "index.php?page=parqueos");
                   die();
                 }else{
                   $viewData["errores"][] = "Error al crear el parqueo";
                   $viewData["haserrores"] = true;
                 }

			}else{

				  if(!isset($viewData["LoteParqueo"]) || $viewData["LoteParqueo"] == ''){
					  $viewData["haserrores"] = true;
					  $viewData["errores"][] = "Error lote de parqueo no valido.";
				  }
			  }

               $viewData["modeDesc"] = "Nuevo Parqueo";
               break;

             case 'UPD':
               $viewData["isupdate"] = 'readonly="readonly"';
               if(!$viewData["haserrores"] && !empty($viewData["LoteParqueo"])){
                 if(!$viewData["isPgmEdit"]){
                   $affected = updateParqueo($viewData["id"], $viewData["EstadoParqueo"],$viewData["LoteParqueo"],$viewData["TipoParqueo"]);
                   // Si no hay error se redirige a la lista de parqueos
                   if($affected){
                     redirectWithMessage("Parqueo Actualizado Satisfactoriamente.", "index.php?page=parqueos");
                     die();
                   }else{
                   // Se muestra un error sobre la edicion del parqueo
                     $viewData["errores"][] = "Error al editar el parqueo";
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
               redirectWithMessage("Acción Solicitada no disponible.", "index.php?page=parqueos");
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
      $parqueos = obtenerParqueos($viewData["id"]);
      mergeFullArrayTo($parqueos,$viewData);
      $viewData["modeDesc"] .= $viewData["parqueolot"];
      $viewData["EstadoParqueoC"] = addSelectedCmbArray($viewData["EstadoParqueoC"],"codigo",$viewData["parqueoest"]);
      $viewData["TipoParqueoC"] = addSelectedCmbArray($viewData["TipoParqueoC"],"codigo",$viewData["parqueotip"]);
    }
    // Cambia la seguridad del formulario para evitar ataques XHR.
    if($viewData["haserrores"]>0){
      $viewData["tocken"] = md5(time()."roltr");
      $_SESSION["rol_tocken"] = $viewData["tocken"];
    }
    
    renderizar("parqueos/parqueo", $viewData);
  }

run();
 ?>

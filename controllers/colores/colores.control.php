<?php
/*
* Control colores mostrar los colores
*
*/

require_once 'models/colores/colores.model.php';
function run(){
    $data = array();
    $data["fltDsc"]="";
    $filter = '';
    if(isset($_SESSION["roles_context"])){
      $filter = $_SESSION["roles_context"]["filter"];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $filter = $_POST["fltDsc"];
      $_SESSION["roles_context"] = array("filter" =>$filter);
    }
    $data["fltDsc"] = $filter;

    $data["colores"] = obtenerColoresPorFiltro($filter);

    renderizar("colores/colores", $data);
}
run();
 ?>
<?php
/*
* Control parqueos mostrar los parqueos
*
*/

require_once 'models/parqueos/parqueos.model.php';
function run(){
    $data = array();
    $data["fltDsc"]="";
    $filter = '';
    if(isset($_SESSION["parqueos_context"])){
      $filter = $_SESSION["parqueos_context"]["filter"];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $filter = $_POST["fltDsc"];
      $_SESSION["parqueos_context"] = array("filter" =>$filter);
    }
    $data["fltDsc"] = $filter;

    $data["parqueos"] = obtenerParqueosPorFiltro($filter);

    renderizar("parqueos/parqueos", $data);
}
run();
 ?>
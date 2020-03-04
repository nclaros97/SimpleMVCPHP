<?php
/**
 * PHP Version 5
 * Modelo de Datos para la Entidad de Colores.
 *
 * @category Data_Model
 * @package  Models\Colores
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version 1.0.0
 *
 * @link http://url.com
 */
require_once 'libs/dao.php';

/**
 * Método para Obtener los Colores Registrados
 * obtenerColores.
 *
 * @param string $idColor Codigo del Color
 *
 * @return array
 */
function obtenerColores($idColor)
{
    $color = array();
    $sqlstr = sprintf("SELECT id, codigoColor, descripcionColor, usosColor, estadoColor FROM lista_colores WHERE id = %d;", $idColor);
    $color = obtenerUnRegistro($sqlstr);
    return $color;
}
/**
 * Método para Obtener los Colores Registrados
 * obtenerColores.
 *
 * @param mixed $descripcionColor Descripción del Color
 *
 * @return array
 */
function obtenerColoresDsc($coloresDsc)
{
    $color = array();
    $sqlstr = sprintf("SELECT 'id','codigoColor','descripcionColor','usosColor','estadoColor' FROM lista_colores WHERE codigoColor = %d;", $coloresDsc);
    $color = obtenerUnRegistro($sqlstr);
    return $color;
}
/**
 * Obtener Colores por Filtro
 *
 * @param string $coloresdsc Código Parcial o Completo
 *
 * @return array
 */
function obtenerColoresPorFiltro($coloresdsc)
{
    $color = array();
    $sqlstr = sprintf("SELECT id,codigoColor,descripcionColor,usosColor,estadoColor FROM lista_colores where descripcionColor like '%s';","%".$coloresdsc."%");
    $colores = obtenerRegistros($sqlstr);
    return $colores;
}
/**
 * Obtiene los Estados de los Roles
 *
 * @return array
 */

function getEstadoColor()
{
    return array(
                array('codigo' => 'PND', 'valor' => 'Sin Activar'),
                array('codigo' => 'ACT', 'valor' => 'Activo'),
                array('codigo' => 'INA', 'valor' => 'Inactivo'),
            );
}
/**
 * Obtener Colores por el Código
 *
 * @param string $codigoColor Codigo del Rol
 *
 * @return array
 */
function obtenerColoresPorCodigo($colorescod)
{
    $colores = array();
    $sqlstr = sprintf("SELECT 'id','codigoColor','descripcionColor','usosColor','estadoColor' FROM lista_colores WHERE codigoColor = %d;", $colorescod);
    $colores = obtenerUnRegistro($sqlstr);
    return $colores;
}
/**
 * Insertar Nuevo Color
 *
 * @param string $codigoColor Codigo de Colores
 * @param string $descripcionColor Descripción de Colores
 * @param string $usosColor Usos del Color
* @param string $estadoColor Estado del Color
 *
 * @return boolean
 */
function insertColor($codigoColor, $descripcionColor, $usosColor, $estadoColor)
{
    $strsql = "INSERT INTO `lista_colores` (`codigoColor`, `descripcionColor`, `usosColor`, `estadoColor`) VALUES ('%s','%s', '%s', '%s');";
    $strsql = sprintf($strsql, valstr($codigoColor), $descripcionColor, $usosColor, $estadoColor);
    if (ejecutarNonQuery($strsql)) {
        return true;
    }
    return 0;
}
/**
 * Actualiza el Color Especificado
 *
 * @param string $idColor Id de Colores
 * @param string $codigoColor Codigo de Colores
 * @param string $descripcionColor Descripción de Colores
 * @param string $usosColor Usos del Color
 * @param string $estadoColor Estado del Color
 *
 * @return integer Cantidad de Registros Modificados
 */
function updateColores($idColor, $codigoColor, $descripcionColor, $usosColor, $estadoColor)
{
    $strsql = "UPDATE `lista_colores` SET `codigoColor`='%s', `descripcionColor`='%s', `usosColor`='%s', `estadoColor`='%s' WHERE `id`='%s';";
    $strsql = sprintf($strsql, $codigoColor, $descripcionColor, $usosColor, $estadoColor, valstr($idColor));
    $affected = ejecutarNonQuery($strsql);
    return $affected > 0;
}
?>

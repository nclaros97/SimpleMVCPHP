<?php
/**
 * PHP Version 5
 * Modelo de Datos para la Entidad de Parqueos.
 *
 * @category Data_Model
 * @package  Models\Parqueos
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version 1.0.0
 *
 * @link http://url.com
 */
require_once 'libs/dao.php';

/**
 * Método para Obtener los Parqueos Registrados
 * obtenerParqueos.
 *
 * @param string $idParqueo id del Parqueo
 *
 * @return array
 */
function obtenerParqueos($idParqueo)
{
    $parqueo = array();
    $sqlstr = sprintf("SELECT parqueoid, parqueoest, parqueolot, parqueotip FROM parqueos WHERE parqueoid = %d;", $idParqueo);
    $parqueo = obtenerUnRegistro($sqlstr);
    return $parqueo;
}
/**
 * Método para Obtener los Parqueos Registrados por la descripcion
 * obtenerParqueosDsc.
 *
 * @param mixed $descripcionColor Descripción del Color
 *
 * @return array
 */
function obtenerParqueosDsc($ParqueosDsc)
{
    $parqueo = array();
    $sqlstr = sprintf("SELECT parqueoid, parqueoest, parqueolot, parqueotip FROM parqueos WHERE parqueolot = %d;", $ParqueosDsc);
    $parqueo = obtenerUnRegistro($sqlstr);
    return $parqueo;
}
/**
 * Obtener Parqueos por Filtro
 *
 * @param string $Parqueodsc Descripcion Parcial o Completo
 *
 * @return array
 */
function obtenerParqueosPorFiltro($Parqueodsc)
{
    $parqueo = array();
    $sqlstr = sprintf("SELECT parqueoid, parqueoest, parqueolot, parqueotip FROM parqueos where parqueolot like '%s';","%".$Parqueodsc."%");
    $parqueo = obtenerRegistros($sqlstr);
    return $parqueo;
}
/**
 * Obtiene los tipos de parqueo
 *
 * @return array
 */

function getTipoParqueo()
{
    return array(
                array('codigo' => 'MTO', 'valor' => 'Moto'),
                array('codigo' => 'CAR', 'valor' => 'Carro'),
                array('codigo' => 'TRK', 'valor' => 'Camion'),
            );
}

/**
 * Obtiene los estados de parqueo
 *
 * @return array
 */

function getEstadosParqueo()
{
    return array(
                array('codigo' => 'AVL', 'valor' => 'Disponible'),
                array('codigo' => 'OCP', 'valor' => 'Ocupado'),
                array('codigo' => 'RSV', 'valor' => 'Reservado'),
            );
}
/**
 * Obtener Parqueos por el Código
 *
 * @param string $codigoParqueo Codigo del Parqueo
 *
 * @return array
 */
function obtenerParqueosPorCodigo($codigoParqueo)
{
    $parqueo = array();
    $sqlstr = sprintf("SELECT parqueoid, parqueoest, parqueolot, parqueotip FROM parqueos WHERE parqueoid = %d;", $codigoParqueo);
    $parqueo = obtenerUnRegistro($sqlstr);
    return $parqueo;
}
/**
 * Insertar Nuevo Parqueo
 *
 * @param string $IdParqueo Codigo del Parqueo
 * @param string $EstadoParqueo Estado del Parqueo
 * @param string $LoteParqueo Lote del Parqueo
* @param string $TipoParqueo Tipo Parqueo
 *
 * @return boolean
 */
function insertParqueo($EstadoParqueo, $LoteParqueo, $TipoParqueo)
{
    $strsql = "INSERT INTO parqueos(parqueoest, parqueolot, parqueotip) VALUES ('%s', '%s', '%s');";
    $strsql = sprintf($strsql, $EstadoParqueo, $LoteParqueo, $TipoParqueo);
    if (ejecutarNonQuery($strsql)) {
        return true;
    }
    return 0;
}
/**
 * Actualiza el Parqueo Especificado
 *
 * @param string $IdParqueo Codigo del Parqueo
 * @param string $EstadoParqueo Estado del Parqueo
 * @param string $LoteParqueo Lote del Parqueo
* @param string $TipoParqueo Tipo Parqueo
 *
 * @return integer Cantidad de Registros Modificados
 */
function updateParqueo($IdParqueo, $EstadoParqueo, $LoteParqueo, $TipoParqueo)
{
    $strsql = "UPDATE `parqueos` SET `parqueoest`='%s', `parqueolot`='%s', `parqueotip`='%s' WHERE `parqueoid`='%s';";
    $strsql = sprintf($strsql, $EstadoParqueo, $LoteParqueo, $TipoParqueo, valstr($IdParqueo));
    $affected = ejecutarNonQuery($strsql);
    return $affected > 0;
}
?>

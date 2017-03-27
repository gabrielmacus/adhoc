<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 25/03/2017
 * Time: 15:11
 */
interface IArchivo
{
    /** Create **/
    public function insertArchivo(Archivo $a);
    /** **/

    /** Read **/
    public function selectArchivos();
    public function selectArchivoById($id);
    /** **/

    /** Update**/
    public function updateArchivos(Archivo $a);
    /** */

    /** Delete **/
    public function deleteArchivoById($id);
    /** **/

}
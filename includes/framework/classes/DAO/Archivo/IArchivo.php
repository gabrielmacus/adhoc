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
    public function insertArchivo(IArchivo $a);
    /** **/

    /** Read **/
    public function selectArchivos();
    public function selectArchivoById($id);
    /** **/

    /** Update**/
    public function updateArchivo(IArchivo $a);
    /** */

    /** Delete **/
    public function deleteArchivoById($id);
    /** **/
    
    /**Validate **/
    public function validate(IArchivo $a);
   /*** */

}
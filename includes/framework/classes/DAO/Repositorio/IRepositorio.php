<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 28/03/2017
 * Time: 2:59
 */
interface IRepositorio
{
    /** Create **/
    public function insertRepositorio(Repositorio $r);
    /** **/

    /** Read **/
    public function selectRepositorios();
    public function selectRepositorioById($id);
    /** **/

    /** Update**/
    public function updateRepositorio(Repositorio $r);
    /** */

    /** Delete **/
    public function deleteRepositorioById($id);
    /** **/


    /**Validate **/
    public function validate(Repositorio $r);
    /*** */

}
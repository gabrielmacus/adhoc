<?php

/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 25/03/2017
 * Time: 15:11
 */
interface IUser
{
    /** Create **/
    public function insertUsuario(User $u);
    /** **/

    /** Read **/
    public function selectUsuarios();
    public function selectUsuarioById($id);
    /** **/

    /** Update**/
    public function updateUsuario(User $u);
    /** */

    /** Delete **/
    public function deleteUsuarioById($id);
    /** **/

}
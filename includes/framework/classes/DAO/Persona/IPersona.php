<?php

/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 23/03/2017
 * Time: 01:16 PM
 */
interface IPersona
{
    /** Create **/
    public function insertPersona(Persona $p);
    /** **/

    /** Read **/
    public function selectPersonas();
    public function selectPersonaById($id);
    /** **/

    /** Update**/
    public function updatePersona(Persona $p);
    /** */

    /** Delete **/
    public function deletePersonaById($id);
    /** **/


}
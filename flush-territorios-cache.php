<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 17/03/2017
 * Time: 12:19 PM
 */
function rrmdir($dir) {
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (is_dir($dir."/".$object))
                    rrmdir($dir."/".$object);
                else
                    unlink($dir."/".$object);
            }
        }
        rmdir($dir);
    }
}
$dir="cache/territorios";
rrmdir($dir);

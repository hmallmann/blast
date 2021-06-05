<?php
/**
 * Created by PhpStorm.
 * User: Henrique
 * Date: 01/04/2020
 * Time: 22:54
 */

namespace App\Utilities;


class DateUtils
{
    public static function formatToFront( \DateTime $time )
    {
        return $time->format( 'd/m/Y');
    }
}

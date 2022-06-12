<?php
declare(strict_types =1);
/**
 * Created by : PhpStorm.
 * Description : Provides helper functions
 * User : keith
 * Date : 04/06/2022
 */


/**
 * @const array VALID_INSTRUCTION
 */
define('VALID_INSTRUCTION',
    [
        'add', 'subtract', 'divide',
        'multiply','apply'
    ]
);


/**
 * Check debug mode enabled
 * @param int $debug
 * @return bool
 */
function debugMode(bool $debug) :bool
{
    return $debug == true;
}



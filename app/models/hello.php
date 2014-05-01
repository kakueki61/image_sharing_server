<?php
/**
 * Model class to test displaying "Hello World!".
 *
 * @author TakuyaKodama<t.kodama61@gmail.com>
 * @version 1.00 14/04/12 20:27
 */

//namespace models;


class Hello extends AppModel
{
    public static function getMessage()
    {
        return 'Hello World!';
    }

} 

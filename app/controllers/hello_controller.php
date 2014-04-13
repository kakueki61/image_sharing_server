<?php
/**
 * Controller class to test displaying "Hello World!".
 *
 * @author TakuyaKodama<email>
 * @version 1.00 14/04/12 20:25
 */

//namespace controllers;


//use models\Hello;

class HelloController extends AppController
{
    public function index()
    {
        $message = Hello::getMessage();
        $this->set(get_defined_vars());
    }
}

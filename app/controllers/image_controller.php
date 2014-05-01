<?php
/**
 * Controller Class to manipulate images.
 *
 * @author TakuyaKodama<email>
 * @version 1.00 14/05/01 20:11
 */

class ImageController extends AppController {

    /**
     * @param pass
     * @param images
     */
    public function submit() {
    }

    /**
     * @param pass
     */
    public function get() {
    }

    /**
     * The function to test to use get params and restore them to DB.
     * @param pass
     * @param texts
     */
    public function test_submit() {

    }

    /**
     * The function to test to get params and select data from DB by the params.
     * @param pass
     */
    public function test_get() {
        $message = Image::getMessage();
        $this->set(get_defined_vars());
    }
} 

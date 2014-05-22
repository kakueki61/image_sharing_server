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
        $password = Param::get('password');
        $image = new Image($password);
        $image_path_list = $image->getImagePath();

        $this->set(get_defined_vars());
    }

    /**
     * The function to test to use get params and restore them to DB.
     * @param pass
     * @param texts
     */
    public function test_submit() {
        $message = Param::get('message');
        $password = Param::get('password');

        Image::setMessage($message, $password);

        $this->set(get_defined_vars());
    }

    /**
     * The function to test to get params and select data from DB by the params.
     */
    public function test_get() {
        $password = Param::get('password');

        if(!$password) {
            $message = Image::getMessage();
        } else {
            $messages = Image::getMessagesByPassword($password);
        }

        $this->set(get_defined_vars());
    }

    public function upload()
    {
        $password = Param::get('password');

        $upload = Upload::get($password);
        $upload->process();

        $this->set(get_defined_vars());
    }

    /**
     * uploads additional images
     */
    public function add()
    {

    }
}

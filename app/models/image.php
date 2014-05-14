<?php
/**
 * Image Class for manipulating images.
 *
 * @author TakuyaKodama<t.kodama61@gmail.com>
 * @version 1.00 14/05/01 20:49
 */

class Image {

    const POST_FILE_KEY = uploadFiles;

    public function __construct($password) {
        $this->password = $password;
        $test = 'check if local val is set or not.';
    }

    public static function setMessage($message, $password) {
        var_dump($message, $password);

        $db = DB::conn('normal');

        $params = array(
            'message' => $message,
            'password' => $password,
            'created' => Time::now()
        );
        $db->insert('japanese_text', $params);
    }

    public static function getMessage() {
        return 'Does this function work? Yes!!';
    }

    public static function getMessagesByPassword($password) {
        var_dump($password);
        $db = DB::conn('normal');

        $rows = $db->rows("SELECT message FROM japanese_text WHERE password = ? ORDER BY created DESC", array($password));

        if(!$rows) {
            return array();
        }

        $message_list = array();
        foreach($rows as $row) {
            $message_list = $row['message'];
        }

        return $message_list;
    }

    public function saveImages() {
        //TODO image size validation

        if (isset($_FILES[self::POST_FILE_KEY])) {
            echo('successfully got $_FILES');
            for ($i = 0; $i < count($_FILES[self::POST_FILE_KEY]['name']); $i++) {
                // TODO uploaded file validations: checkFile()

                $name = $_FILES[self::POST_FILE_KEY]['name'][$i];
                $tmp_name = $_FILES[self::POST_FILE_KEY]['tmp_name'][$i];
                $ext = 'jpg';

                // the path uploaded files are move to are defined according to the rule below.
                // "{app name('img' by default)}_" + timestamp + sequential number + "_"
                // + "MD5 generated by micro seconds, original file name and accessed IP + extension
                $move_to = IMG_DIR . 'img_' . time() . $i . '_'
                    . md5(microtime() . $name . $_SERVER['REMOTE_ADDR'])
                    . '.' . $ext;

                move_uploaded_file($tmp_name, $move_to);
            }
        } else {
        }
    }

    public function getImagePath() {

    }

}

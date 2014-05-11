<?php
/**
 * Image Class for manipulating images.
 *
 * @author TakuyaKodama<t.kodama61@gmail.com>
 * @version 1.00 14/05/01 20:49
 */

class Image {

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
    }

    public function getImagePath() {

    }


} 

<?php
/**
 * Image Class for manipulating images.
 *
 * @author TakuyaKodama<t.kodama61@gmail.com>
 * @version 1.00 14/05/01 20:49
 */

class Image {

    public static function getMessage() {
        return 'Does this function work? Yes!!';
    }

    public static function getMessagesByPassword($password) {
        $db = DB::conn('normal');

        $rows = $db->rows("SELECT message FROM message WHERE password = ? ORDER BY created DESC", array($password));

        if(!$rows) {
            return array();
        }

        $message_list = array();
        foreach($rows as $row) {
            $message_list = $row['message'];
        }

        return $message_list;
    }
} 

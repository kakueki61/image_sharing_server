<?php
/**
 * Represents values regarding time.
 *
 * @author TakuyaKodama<t.kodama61@gmail.com>
 * @version 1.00 14/05/08 1:32
 */

class Time {

    /**
     * Returns current date string formatted 'Y-m-d H:i:s'.
     * @return bool|string
     */
    public static function now() {
        return date('Y-m-d H:i:s', time());
    }
} 
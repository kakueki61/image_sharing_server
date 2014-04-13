<?php
/**
 * Helper class for something regarding html.
 *
 * @author TakuyaKodama<email>
 * @version 1.00 14/04/12 20:33
 */
function eh($string)
{
    if (!isset($string)) return;
    echo htmlspecialchars($string, ENT_QUOTES);
}

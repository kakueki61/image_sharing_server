<?php
/**
 * Upload
 *
 * @author TakuyaKodama<t.kodama61@gmail.com>
 * @version 1.00 14/05/22 23:02
 */

class Upload extends AppModel
{
    private $upload_id;

    /**
     * constructor
     * @param array $password
     */
    public function __construct($password)
    {
        $this->password = $password;
    }

    public static function get($password)
    {
        $db = DB::conn('normal');
        $row = $db->row('SELECT * FROM upload WHERE password = ?', array($password));
        if (!$row) {
            return new Upload($password);
        }
        return new parent($row);
    }

    public static function getById($id)
    {
        $db = DB::conn('normal');
        $row = $db->row('SELECT * FROM upload WHERE id = ?', array($id));
        if (!$row) {
            throw new RecordNotFoundException();
        }
        return new parent($row);
    }

    public function process()
    {
        $this->create();

        $image = new Image($this->upload_id);
        $image->saveImages();
    }

    private function create()
    {
        $params = array(
            'user_id' => 000000000,
            'password' => $this->password,
            'can_add' => true,
            'created' => Time::now(),
            'expiring' => Time::toYMDHMS(strtotime('+2 week')),
            'updated' => null
        );
        $db = DB::conn('normal');
        $db->insert('upload', $params);

        // get id from the inserted record
        $this->upload_id = $db->value('SELECT LAST_INSERT_ID() FROM upload');
    }

    public static function add()
    {

    }
}

<?php
/**
 *
 *
 */

class DB extends SimpleDBI
{
    /**
     * @param $dsn
     * @param $username
     * @param $password
     * @param $driver_options
     */
    public function __construct($dsn, $username, $password, $driver_options) {
        parent::__construct($dsn, $username, $password, $driver_options);
    }

    public function begin() {
        if(count($this->trans_stack) == 0) {
            $this->pdo->beginTransaction();
        }
        array_push($this->trans_stack, 'A');
    }

    public function commit() {
        if(count($this->trans_stack) <= 1) {
            $this->pdo->commit();
            $this->afterCommit();
        }
        array_pop($this->trans_stack);
    }

    public function rollback() {
        if(count($this->trans_stack) <= 1) {
            $this->pdo->rollBack();
        }
        array_pop($this->trans_stack);
    }

    private function afterCommit() {
    }

    /**
     * データベースの接続設定を取得する
     *
     * このメソッドは、SimpleDBI クラスのサブクラスでオーバーライドして使われます。
     *
     * @param  string $destination 接続先
     * @return array  DSN などの接続設定の配列
     */
    public static function getConnectSettings($destination = null) {
        switch($destination) {
            case 'normal':
                $dsn = DB_NORMAL_DSN;
                $username = DB_NORMAL_USERNAME;
                $password = DB_NORMAL_PASSWORD;
                $driver_options = array(
                    PDO::ATTR_TIMEOUT => DB_NORMAL_ATTR_TIMEOUT,
                    PDO::ATTR_PERSISTENT => true
                );
                break;
            default:
                throw new InvalidArgumentException('unknown database: ' . $destination);
        }

        return array($dsn, $username, $password, $driver_options);
    }

    /**
     * Called after the process of a query
     *
     * @param string $sql
     * @param arrya $params
     * @param bool $access_time
     */
    protected function onQueryEnd($sql, array $params = array(), $access_time = false) {
        if(ENV_PRODUCTION) {
            return;
        }

        // logs
        static $num_query = 1;

        // host name
        preg_match('/host=([0-9A-Za-z_-]+)/', $this->dsn, $matches);
        $host = isset($matches[1]) ? $matches[1] : '-';

        // file_name + line number
        $filename = '';
        $line = '';
        $traces = debug_backtrace();
        for($i = 2; $i < 10; $i++) {
            if(strpos($traces[$i]['file'], 'SimpleDBI') === false) {
                $filename = $traces[$i]['file'];
                $p = strpos($filename, '/app/');
                if($p) {
                    $filename = substr($filename, $p + 5);
                }
                $line = $traces[$i]['line'];
                break;
            }
        }

        if($access_time) {
            $host;
            $sql;
            $params;
            $filename;
            $line;
        }
    }
} 

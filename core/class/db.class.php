<?php

namespace Cms\core;
class db
{
    public static $runnum = 0;
    public static $pre;
    public static $lastsql;
    public static $table;
    public static $suffix;
    private static $conn = array();
    private static $running;
    private static $pdo;//后缀

    public function __construct()
    {
        // echo var_dump(self::$running);
    }

    public static function set_table($table)
    {
        self::$table = self::table($table);
    }

    public static function table($parse)
    {
        return self::$pre . $parse;
    }

    public static function query($parse)
    {
        self::$running = $parse;
        self::$lastsql = $parse;
        try {
            $res = self::$pdo->query($parse);
            if ($res)
                $res = $res->fetchall();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die('pdo query error');
        }
        //    self::$running=NULL;
        return $res;
    }

    public static function fetchfirst($parse)
    {
        self::$running = $parse;
        try {
            $res = self::$pdo->query($parse);
            if ($res)
                $res = $res->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die('pdo query error');
        }
        self::$suffix = NULL;
        return $res;
    }

    public static function select($arr = null, $debug = false)
    {
        $sql = 'SELECT * FROM ' . self::$table . self::where($arr);
        if ($debug)
            return $sql;
        return self::fetchall($sql);
    }

    private static function where($arr)
    {
        if (!is_array($arr)) return;
        $arr = self::secfiter($arr);//基本安全过滤
        $status = 1;
        foreach ($arr as $k => $v) {
            if ($status) {
                if ($k && !is_numeric($k)) {
                    $sql = " where $k='$v'";
                } else {
                    $sql = " where $v";
                }
                $status = 0;
            } else {
                if ($k && !is_numeric($k)) {
                    $sql .= " and $k='$v'";
                } else {
                    $sql .= " and $v";
                }
            }
        }
        return $sql;
    }

    /**
     * @return array
     */
    public static function secfiter($arr)
    {
        return array_diyfiter($arr, 'addslashes');
    }

    public static function fetchall($parse)
    {
        global $G;
        $parse .= self::$suffix ? self::$suffix : '';
        self::$running = $parse;
        try {
            $res = self::$pdo->query($parse, \PDO::FETCH_ASSOC);
            if ($res)
                $res = $res->fetchall();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die('pdo query error');
        }
        self::$suffix = NULL;
        array_append($G['debug']['sqllog'], $parse);
        return $res;
    }

    public static function update($index, $data, $debug = false)
    {
        $sql = 'UPDATE ' . self::$table . ' SET';
        $data = self::secfiter($data);
        $status = 1;
        foreach ($data as $k => $v) {
            if ($status) {
                $sql .= " $k='$v'";
                $status = 0;
            } else {
                $sql .= ",$k='$v'";
            }
        }
        $sql .= self::where($index);
        if ($debug) return $sql;
        return self::exec($sql);
    }

    public static function exec($parse)
    {

        //记录log
        global $G;
        array_append($G['debug']['sqllog'], $parse);

        self::$running = $parse;

        $res = self::$pdo->exec($parse);
        self::$running = NULL;
        return $res;
    }

    public static function delete($arr, $debug = false)
    {
        $sql = 'DELETE FROM ' . self::$table . self::where($arr);
        if ($debug)
            return $sql;
        return self::exec($sql);
    }

    public static function save($arr, $debug = false)
    {
        if (!self::find($arr)) {
            return self::add($arr, $debug);
        } else {
            return true;
        }
    }

    public static function find($arr, $debug = false)
    {
        $sql = 'SELECT * FROM ' . self::$table . self::where($arr);
        if ($debug) return $sql;
        return self::fetchall($sql)[0];
    }

    public static function add($data, $debug = false)
    {
        $sql = 'INSERT INTO ' . self::$table;
        $data = self::secfiter($data);
        $status = 1;
        $sql .= " (";
        foreach ($data as $k => $v) {
            $sql .= "$k,";
        }
        $sql = rtrim($sql, ",");
        $sql .= ') VALUES (';
        foreach ($data as $k => $v) {
            $sql .= "'$v',";
        }
        $sql = rtrim($sql, ",");
        $sql .= ')';
        if ($debug) return $sql;
        return self::exec($sql);
    }

    /**
     * @return mixed
     */
    public static function getLastid()
    {
        return self::fetchall("select last_insert_id() id")[0]['id'];
    }

    public static function format($sql, $arg)
    {
        $count = substr_count($sql, '%');
        if (!$count) {
            return $sql;
        } elseif ($count > count($arg)) {
            throw new DbException('SQL string format error! This SQL need "' . $count . '" vars to replace into.', 0, $sql);
        }
        $len = strlen($sql);
        $i = $find = 0;
        $ret = '';
        while ($i <= $len && $find < $count) {
            if ($sql{$i} == '%') {
                $next = $sql{$i + 1};
                if ($next == 't') {
                    $ret .= self::table($arg[$find]);
                } elseif ($next == 's') {
                    $ret .= '\'' . $arg[$find] . '\'';
                } elseif ($next == 'f') {
                    $ret .= sprintf('%F', $arg[$find]);
                } elseif ($next == 'd') {
                    $ret .= intval($arg[$find]);
                } elseif ($next == 'i') {
                    $ret .= $arg[$find];
                }
                $i++;
                $find++;
            } else {
                $ret .= $sql{$i};
            }
            $i++;
        }
        if ($i < $len) {
            $ret .= substr($sql, $i);
        }
        return $ret;
    }

    public function init($db)
    {
        self::$pre = $db['pre'];
        self::$conn = $db;
        if (self::$conn['type'] == 'mysql') {
            $dsn = "mysql:dbname=$db[database];host=$db[host];port=$db[port]";
        } elseif (self::$conn['type'] == 'mssql') {
            $dsn = "sqlsrv:Server=$db[host];database=$db[database]";
        }
        try {
            self::$pdo = new \PDO($dsn, $db['user'], $db['passwd']);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        self::$pdo->exec('SET NAMES ' . $db['charset']);
    }

    public function orderby($filed, $order)
    {
        self::$suffix .= " order by " . $filed . " " . $order;
        return $this;
    }

    public function page($num, $pagenum)
    {
        $num = $num > 0 && is_numeric($num) ? $num : 1;
        $start = ($num - 1) * $pagenum;
        self::$suffix .= ' limit ' . $start . ',' . $pagenum;
        return $this;
    }

}
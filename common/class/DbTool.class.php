<?php

namespace Cms\common;
class DbTool
{
    public static $runnum = 0;
    public static $pre;
    public static $lastsql;
    public static $table;
    public static $insertlimit;
    private static $conn = array();
    private static $running;
    private static $pdo;

    public static function init($db)
    {
        self::$insertlimit = 1000;
        self::$pre = $db['pre'];
        self::$conn = $db;
        if (self::$conn['type'] == 'mysql') {
            $dsn = "mysql:dbname=$db[database];host=$db[host];port=$db[port]";
        }
        try {
            self::$pdo = new PDO($dsn, $db['user'], $db['passwd']);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        self::$pdo->exec('SET NAMES ' . $db['charset']);
    }

    public static function backUp($file)
    {
        if (file_exists($file)) {
            unlink($file);
        }
        $tables = self::getTables();
        foreach ($tables as $table) {
            $structure = self::getTableStructure($table) . ";\r\n";
            file_put_contents($file, $structure, FILE_APPEND);
            $count = self::countTable($table);
            for ($i = 0; $i < $count; $i += self::$insertlimit) {
                $inserts = self::getData($table, $i);
                foreach ((array)$inserts as $insert) {
                    $text = self::convertToInsert($insert, $table) . ";\r\n";
                    file_put_contents($file, $text, FILE_APPEND);
                }
            }
        }
        return file_exists($file);
    }

    public static function getTables()
    {
        $tables = self::query('show tables');
        $key = array_keys($tables[0])[0];
        foreach ($tables as $value) {
            $data[] = $value[$key];
        }
        return $data;
    }

    public static function query($parse)
    {
        self::$running = $parse;
        self::$lastsql = $parse;
        try {
            $res = self::$pdo->query($parse);
            if ($res)
                $res = $res->fetchall(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die('pdo query error');
        }
        //    self::$running=NULL;
        return $res;
    }

    public static function getTableStructure($parse)
    {
        $Strcuture = self::query('show create table ' . $parse);
        return str_replace('CREATE TABLE', 'CREATE TABLE IF NOT EXISTS', $Strcuture[0]['Create Table']);
    }

    public static function countTable($parse)
    {
        return self::query('SELECT count(*) FROM ' . $parse)[0]['count(*)'];
    }

    public static function getData($parse, $i)
    {
        return self::query('SELECT * FROM ' . $parse . " limit $i," . self::$insertlimit);
    }

    public static function convertToInsert($arr, $table)
    {

        $sql = 'INSERT INTO ' . $table;
        $status = 1;
        $sql .= " (";
        foreach ((array)$arr as $k => $v) {
            $sql .= "$k,";
        }
        $sql = rtrim($sql, ",");
        $sql .= ') VALUES (';
        foreach ((array)$arr as $k => $v) {
            $v = addslashes($v);
            $sql .= "'$v',";
        }
        $sql = rtrim($sql, ",");
        $sql .= ')';
        return $sql;
    }

}

?>
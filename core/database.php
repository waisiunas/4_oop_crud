<?php
define('SUCCESS', 'Magic has been spelled!');
define('FAILURE', 'Magic has become shopper!');

class Database
{
    private const DB_HOST = 'localhost';
    private const DB_USER = 'root';
    private const DB_PASS = '';
    private const DB_NAME = '4_oop_crud';

    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli(self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_NAME);

        if (!$this->conn) {
            die("Failed to connect!");
        }
    }

    public function show_all($table)
    {
        $sql = "SELECT * FROM `$table`";
        $result = $this->conn->query($sql);
        $records = $result->fetch_all(MYSQLI_ASSOC);

        return $records;
    }

    public function show_single($table, $id)
    {
        $sql = "SELECT * FROM `$table` WHERE `id` = $id";
        $result = $this->conn->query($sql);
        $record = $result->fetch_assoc();

        return $record;
    }

    public function email_validation($table, $email, $id = false)
    {
        if ($id) {
            $sql = "SELECT * FROM `$table` WHERE `email` = '$email' AND `id` != $id";
        } else {
            $sql = "SELECT * FROM `$table` WHERE `email` = '$email'";
        }

        $result = $this->conn->query($sql);

        if ($result->num_rows == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function create($table, $data)
    {
        $keys = array_keys($data);
        $values = array_values($data);
        $columns = implode('`,`', $keys);
        $insert_values = implode("','", $values);

        $sql = "INSERT INTO `$table`(`$columns`) VALUES ('$insert_values')";
        $result = $this->conn->query($sql);

        return $result;
    }

    public function update($table, $data, $id)
    {
        $keys = array_keys($data);
        $values = array_values($data);
        $pairs = [];

        for ($i = 0; $i < count($keys); $i++) {
            array_push($pairs, "`" . $keys[$i] . "` = '" . $values[$i] . "'");
        }

        $pairs = implode(',', $pairs);

        $sql = "UPDATE `$table` SET $pairs WHERE `id` = $id";
        $result = $this->conn->query($sql);

        return $result;
    }

    public function delete($table, $id)
    {
        $sql = "DELETE FROM `$table` WHERE `id` = $id";
        $result = $this->conn->query($sql);

        return $result;
    }
}

$database = new Database();

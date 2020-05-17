<?php

class Database
{
    private static $INSTANCE = null;
    private $conn;
    private $HOST    = 'localhost';
    private $USER    = 'root';
    private $PASS    = 'root';
    private $DB_NAME = 'db_kutbi';
    
    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->HOST;dbname=$this->DB_NAME", $this->USER, $this->PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$INSTANCE)) {
            self::$INSTANCE = new Database;
        }
        return self::$INSTANCE;
    }

    public function insert($table, $fields = array())
    {
        $link = $this->conn;
        
        $column = implode(", ", array_keys($fields));
        
        $arrayValues = array();
        $i = 0;
        foreach ($fields as $key => $value) {
            $arrayValues[$i] = "?";
            $i++;
        }
        $values = implode(", ", $arrayValues);
        
        $query = "INSERT INTO $table ($column) VALUES ($values)";

        $statement = $link->prepare($query);
        $j = 1;
        foreach ($fields as $keys => $val) {
            if (is_int($val)) {
                $statement->bindValue($j, $val, PDO::PARAM_INT);
            } else {
                $statement->bindValue($j, "$val", PDO::PARAM_STR);
            }
            $j++;
        }
        //    die($statement);
        
        if ($statement->execute()) {
            // $id = $link->lastInsertId();
            // die($id);
            return true;
        }

        return false;
    }

    public function insertTransaction($table, $fields = array())
    {
        $link = $this->conn;
        
        $column = implode(", ", array_keys($fields));
        
        $arrayValues = array();
        $i = 0;
        foreach ($fields as $key => $value) {
            $arrayValues[$i] = "?";
            $i++;
        }
        $values = implode(", ", $arrayValues);
        
        $query = "INSERT INTO $table ($column) VALUES ($values)";

        $statement = $link->prepare($query);
        $j = 1;
        foreach ($fields as $keys => $val) {
            if (is_int($val)) {
                $statement->bindValue($j, $val, PDO::PARAM_INT);
            } else {
                $statement->bindValue($j, "$val", PDO::PARAM_STR);
            }
            $j++;
        }
        //    die($statement);
        
        if ($statement->execute()) {
            $id = $link->lastInsertId();
            return $id;
        }

        return false;
    }

    public function update($table, $fields = array(), $id)
    {
        $link = $this->conn;

        $keys = implode(" = ?, ", array_keys($fields));
        $column = $keys . " = ?";
        $query  = "UPDATE $table SET $column WHERE id = $id";
        
        $statement = $link->prepare($query);
        $i = 1;
        foreach ($fields as $key => $value) {
            if (is_int($value)) {
                $statement->bindValue($i, $value, PDO::PARAM_INT);
            } else {
                $statement->bindValue($i, "$value", PDO::PARAM_STR);
            }
            $i++;
        }

        $statement->execute();

        return true;
    }

    public function updateProof($table, $fields = array(), $id)
    {
        $link = $this->conn;

        $keys = implode(" = ?, ", array_keys($fields));
        $column = $keys . " = ?";
        $query  = "UPDATE $table SET $column WHERE order_id = $id";
        
        $statement = $link->prepare($query);
        $i = 1;
        foreach ($fields as $key => $value) {
            if (is_int($value)) {
                $statement->bindValue($i, $value, PDO::PARAM_INT);
            } else {
                $statement->bindValue($i, "$value", PDO::PARAM_STR);
            }
            $i++;
        }

        $statement->execute();

        return true;
    }

    public function delete($table, $id)
    {
        $link   = $this->conn;

        $query  = "DELETE FROM $table WHERE id = ?";
        $statement = $link->prepare($query);
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();

        return true;
    }

    public function getInfoLogin($table, $column, $value)
    {
        $link = $this->conn;

        $query      = "SELECT * FROM $table WHERE $column = ?";
        $statement  = $link->prepare($query);
        $statement->bindValue(1, $value, PDO::PARAM_STR);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            return $row;
        }
    }

    public function getDataKategori($table, $column, $value)
    {
        $link = $this->conn;

        $query      = "SELECT * FROM $table WHERE $column = ?";
        $statement  = $link->prepare($query);
        $statement->bindValue(1, $value, PDO::PARAM_STR);
        $statement->execute();

        $data = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getAll($table)
    {
        $link = $this->conn;

        $query      = "SELECT * FROM $table";
        $statement  = $link->prepare($query);
        $statement->execute();

        $data = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function search($table, $column, $q)
    {
        $link = $this->conn;

        $query      = "SELECT * FROM $table WHERE $column LIKE '%$q%'";
        $statement  = $link->prepare($query);
        $statement->execute();

        $data = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getAllWhere($table, $column, $value)
    {
        $link = $this->conn;

        $query      = "SELECT * FROM $table WHERE $column = ?";
        $statement  = $link->prepare($query);
        $statement->bindValue(1, $value, PDO::PARAM_STR);
        $statement->execute();

        $data = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getDataJoin($table1, $table2, $id)
    {
        $link   = $this->conn;

        $query      = "SELECT * FROM $table1 LEFT JOIN $table2 ON $table1.$id = $table2.id";
        // print_r($query);
        // die;
        $statement  = $link->prepare($query);
        $statement->execute();

        // print_r($statement);
        // die;

        $data = array();
        while ($row = $statement->fetch(PDO::FETCH_BOTH)) {
            $data[] = $row;
        }

        return $data;
    }

    public function getJoinBelanja()
    {
        $link   = $this->conn;

        $query = "SELECT belanja.*, produk.nama from belanja join produk on belanja.id_produk = produk.id";
        // print_r($query);
        // die;
        $statement  = $link->prepare($query);
        $statement->execute();

        // print_r($statement);
        // die;

        $data = array();
        while ($row = $statement->fetch(PDO::FETCH_BOTH)) {
            $data[] = $row;
        }

        return $data;
    }

    public function getDataJoinById($table1, $table2, $id, $field1, $field2)
    {
        $link   = $this->conn;

        $query  = "SELECT * FROM $table1 JOIN $table2 ON $table1.$field1 = $table2.id WHERE $table1.$field2 = $id";
        $statement = $link->prepare($query);
        $statement->execute();

        $data = array();
        while ($row = $statement->fetch(PDO::FETCH_BOTH)) {
            $data[] = $row;
        }

        return $data;
    }

    public function getLimitSort($table, $limit, $sort)
    {
        $link = $this->conn;

        $query = "SELECT * FROM $table ORDER BY id $sort LIMIT $limit";
        $statement = $link->prepare($query);
        $statement->execute();

        $data = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }

    public function getWhereBetween($table, $column, $value1, $value2)
    {
        $link = $this->conn;

        $query      = "SELECT * FROM $table WHERE DATE($column) BETWEEN '$value1' AND '$value2'";
        $statement  = $link->prepare($query);
        $statement->execute();

        $data = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getWhereOr($table, $column, $value, $column2, $value2)
    {
        $link = $this->conn;

        $query      = "SELECT * FROM $table WHERE $column = '$value' OR $column2 = '$value2'";
        $statement  = $link->prepare($query);
        $statement->execute();

        $data = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getStatistic()
    {
        $link = $this->conn;

        $query      = "SELECT * FROM pembelian WHERE YEAR(tanggal) = YEAR(CURDATE()) AND MONTH(tanggal) = MONTH(CURDATE())";
        $statement  = $link->prepare($query);
        $statement->execute();

        $data = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }
}

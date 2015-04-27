<?php

require_once 'config.php';

class dbHelper {
    private $db;

    //Constructor initialize the connection to the db
    function __construct(){
        $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8';
        try{
            $this->db = new PDO($dsn, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }catch(PDOException $e){
            exit;
        }
    }

    //Need for counting rows in the table
    public function countRows($table, $w, $a){
        $stmt = $this->db->prepare("SELECT id FROM ".$table.' WHERE 1=1 '.$w);
        $stmt->execute($a);
        return $stmt->rowCount();
    }

    //Query for select data from db
    public function select($from, $what, $where, $start = null, $end = null, $orderby = null, $order = null){
        $a = array();
        $w = "";
        foreach ($where as $key => $value) {
            $w .= " AND " .$key. " LIKE :".$key;
            $a[":".$key] = $value;
        }

        //!!!! VERY IMPORTANT !!!!! THIS LINE MUST BE HERE
        $data['count'] = $this->countRows($from, $w, $a);
        //!!!! VERY IMPORTANT !!!!! THIS LINE MUST BE HERE

        if($orderby != null and $order != null){
            $w .= ' ORDER BY '.$orderby.' '.$order;
        }else{
            $w .= ' ORDER BY id ASC';
        }

        if ($start != null and $end != null) {
            $count = $end - $start;
            $w .= ' LIMIT ' . $start . ', ' . $count;
        }else if($start != null){
            $w .= ' LIMIT ' . $start;
        }else {
            $w .= ' LIMIT 0, 30';
        }

        $stmt = $this->db->prepare("SELECT ".$what." FROM ".$from." WHERE 1=1 ". $w);
        $stmt->execute($a);

        $data['rows'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    //Query for search data from db
    public function search($from, $what, $where, $start = null, $end = null, $limit = null, $orderby = null, $order = null){
        $a = array();
        $w = "";
        foreach ($where as $key => $value) {
            $w .= " AND " .$key. " LIKE :".$key;
            $a[":".$key] = '%'.$value.'%';
        }

        //!!!! VERY IMPORTANT !!!!! THIS LINE MUST BE HERE
        $data['count'] = $this->countRows($from, $w, $a);
        //!!!! VERY IMPORTANT !!!!! THIS LINE MUST BE HERE

        if($orderby != null and $order != null){
            $w .= ' ORDER BY '.$orderby.' '.$order;
        }else{
            $w .= ' ORDER BY id ASC';
        }

        if ($start != null and $end != null) {
            $count = $end - $start;
            $w .= ' LIMIT ' . $start . ', ' . $count;
        }else if($start != null){
            $w .= ' LIMIT ' . $start;
        }else {
            $w .= ' LIMIT 0, 30';
        }

        $stmt = $this->db->prepare("SELECT ".$what." FROM ".$from." WHERE 1=1 ". $w);
        $stmt->execute($a);

        $data['rows'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    //Query for insert data to the db
    public function insert($table, $columnsArray, $requiredColumnsArray) {
        $this->verifyRequiredParams($columnsArray, $requiredColumnsArray);

        $a = array();
        $c = "";
        $v = "";

        foreach ($columnsArray as $key => $value) {
            $c .= $key. ", ";
            $v .= ":".$key. ", ";
            $a[":".$key] = $value;
        }

        $c = rtrim($c, ', ');
        $v = rtrim($v, ', ');
        $stmt =  $this->db->prepare("INSERT INTO $table($c) VALUES($v)");
        $stmt->execute($a);

        $response['id'] = $this->db->lastInsertId();

        return $response;
    }

    //Query for update data in the db
    public function update($table, $columnsArray, $where, $requiredColumnsArray){
        $this->verifyRequiredParams($columnsArray, $requiredColumnsArray);

        $a = array();
        $w = "";
        $c = "";
        foreach ($where as $key => $value) {
            $w .= " and " .$key. " = :".$key;
            $a[":".$key] = $value;
        }
        foreach ($columnsArray as $key => $value) {
            $c .= $key. " = :".$key.", ";
            $a[":".$key] = $value;
        }
            $c = rtrim($c,", ");

        $stmt =  $this->db->prepare("UPDATE $table SET $c WHERE 1=1 ".$w);
        $stmt->execute($a);
    }

    //Query for delete data from the db
    public function delete($table, $where){
        $a = array();
        $w = "";
        foreach ($where as $key => $value) {
            $w .= " and " .$key. " = :".$key;
            $a[":".$key] = $value;
        }
        $stmt =  $this->db->prepare("DELETE FROM $table WHERE 1=1 ".$w);
        $stmt->execute($a);
    }

    //Method for checking the security and sql injections
    public function verifyRequiredParams($inArray, $requiredColumns) {
        $error = false;
        $errorColumns = "";
        foreach ($requiredColumns as $field) {
            if (!isset($inArray->$field) || strlen(trim($inArray->$field)) <= 0) {
                $error = true;
                $errorColumns .= $field . ', ';
            }
        }

        if ($error) {
            $response = array();
            $response["status"] = "error";
            $response["message"] = 'Required field(s) ' . rtrim($errorColumns, ', ') . ' is missing or empty';
            echoResponse(200, $response);
            exit;
        }
    }
}
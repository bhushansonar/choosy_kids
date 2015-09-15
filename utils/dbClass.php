<?php

include("utils/config.php");

class MySQLCN {

    function MySQLCN() {

        $user = DB_USERNAME;
        $pass = DB_PASSWORD;
        $server = DB_SERVER;
        $dbase = DB_DATABASE;

        $conn = mysql_connect($server, $user, $pass);
        mysql_query("SET CHARACTER SET utf8", $conn);
        if (!$conn) {
            $this->error("Connection attempt failed");
        }
        if (!mysql_select_db($dbase, $conn)) {
            $this->error("Dbase Select failed");
        }
        $this->CONN = $conn;
        return true;
    }

    function close() {
        $conn = $this->CONN;
        $close = mysql_close($conn);
        if (!$close) {
            $this->error("Connection close failed");
        }
        return true;
    }

    function error($text) {
        $no = mysql_errno();
        $msg = mysql_error();
        exit;
    }

    function select($sql = "") {
        if (empty($sql)) {
            return false;
        }
        if (!eregi("^select", $sql)) {
            echo "Wrong Query<hr>$sql<p>";
            echo "<H2>Wrong function silly!</H2>\n";
            return false;
        }
        if (empty($this->CONN)) {
            return false;
        }
        $conn = $this->CONN;
        $results = @mysql_query($sql, $conn);
        if ((!$results) or (empty($results))) {
            return false;
        }
        $count = 0;
        $data = array();
        while ($row = mysql_fetch_array($results)) {
            $data[$count] = $row;
            $count++;
        }
        mysql_free_result($results);
        return $data;
    }

    function newselect($sql = "") {
        if (empty($sql)) {
            return false;
        }
        if (!eregi("^select", $sql)) {
            echo "wrongquery<br>$sql<p>";
            echo "<H2>Wrong function silly!</H2>\n";
            return false;
        }
        if (empty($this->CONN)) {
            return false;
        }
        $conn = $this->CONN;
        $results = @mysql_query($sql, $conn);
        if ((!$results) or (empty($results))) {
            return false;
        }
        $count = 0;
        $data = array();
        while ($row = mysql_fetch_array($results)) {
            $data[$count] = $row;
            $count++;
        }
        mysql_free_result($results);
        return $data;
    }

    function affected($sql = "") {
        if (empty($sql)) {
            return false;
        }
        if (!eregi("^select", $sql)) {
            echo "wrongquery<br>$sql<p>";
            echo "<H2>Wrong function silly!</H2>\n";
            return false;
        }
        if (empty($this->CONN)) {
            return false;
        }
        $conn = $this->CONN;
        $results = @mysql_query($sql, $conn);
        if ((!$results) or (empty($results))) {
            return false;
        }
        $tot = 0;
        $tot = mysql_affected_rows();
        return $tot;
    }

    function insert($sql = "") {
        if (empty($sql)) {
            return false;
        }
        if (!eregi("^insert", $sql)) {
            return false;
        }
        if (empty($this->CONN)) {
            return false;
        }
        $conn = $this->CONN;
        $results = mysql_query($sql, $conn);
        if (!$results) {
            echo "Insert Operation Failed..<hr>" . mysql_error();
            $this->error("Insert Operation Failed..");
            $this->error("<H2>No results!</H2>\n");
            return false;
        }
        $id = mysql_insert_id($this->CONN);
        return $id;
    }

    //Dont remove this - Added by sreejan//
    function adder($sql = "") {
        if (empty($sql)) {
            return false;
        }
        if (!eregi("^insert", $sql)) {
            return false;
        }
        if (empty($this->CONN)) {
            return false;
        }
        $conn = $this->CONN;
        $results = @mysql_query($sql, $conn);

        if (!$results)
            $id = "";
        else
            $id = mysql_insert_id();

        return $id;
    }

    function edit($sql = "") {
        if (empty($sql)) {
            return false;
        }
        if (!eregi("^update", $sql)) {
            return false;
        }
        if (empty($this->CONN)) {
            return false;
        }
        $conn = $this->CONN;
        $results = mysql_query($sql, $conn);
        if (!$results) {
            $this->error("<H2>No results!</H2>\n");
            return false;
        }
        $rows = 0;
        $rows = mysql_affected_rows();
        return $rows;
    }

    function sql_query($sql = "") {
        if (empty($sql)) {
            return false;
        }
        if (empty($this->CONN)) {
            return false;
        }
        $conn = $this->CONN;
        $results = mysql_query($sql, $conn) or die("Query Failed..<hr>" . mysql_error());
        if (!$results) {
            $message = "Query went bad!";
            $this->error($message);
            return false;
        }
        // (Martin Huba) also SHOW... commands return some results
        if (!(eregi("^select", $sql) || eregi("^show", $sql))) {
            return true;
        } else {
            $count = 0;
            $data = array();
            while ($row = mysql_fetch_array($results)) {
                $data[$count] = $row;
                $count++;
            }
            mysql_free_result($results);
            return $data;
        }
    }

    function getDataArray($table, $key, $value, $orderby, $where = "") {
        $sql = "select {$key},{$value} from {$table} where 1 {$where} order by {$orderby}";
        $result = mysql_query($sql);
        $data = array();
        while ($row = mysql_fetch_array($result)) {
            $data[$row[$key]] = $row[$value];
        }
        return $data;
    }

    function isExist($code) {
        $sql = "select mn_user_id from mn_user where my_user_activationcode='{$code}'";
        $result = mysql_query($sql);
        if (mysql_num_rows($result))
            return TRUE;
        return FALSE;
    }

    function isContentExist($uri) {
        $sql = "select content_uri from site_content where content_uri='{$uri}'";
        $result = mysql_query($sql);
        if (mysql_num_rows($result)) {
            return mysql_num_rows($result);
        }
        return FALSE;
    }

    function isUserExist($userEmail) {
        $sql = "select mn_user_id,mn_user_display_name from mn_user where mn_user_email='{$userEmail}'";
        $result = mysql_query($sql);
        if (mysql_num_rows($result))
            return mysql_fetch_row($result);
        return FALSE;
    }
    function getRow($tableName = "", $fieldName = "", $value = "", $where = "") {

        $sql = sprintf("SELECT * FROM `%s` WHERE %s = '%s' %s limit 1", $tableName, $fieldName, mysql_real_escape_string($value), $where);
        if (empty($sql)) {
            return false;
        }
        if (empty($this->CONN)) {
            return false;
        }
        $conn = $this->CONN;
        $results = mysql_query($sql, $conn) or die("Query Failed..<hr>" . mysql_error());
        if (!$results) {
            $message = "Query went bad!";
            $this->error($message);
            return false;
        }
        // (Ravi Sharma) also SHOW... commands return some results
        if (!(eregi("^select", $sql) || eregi("^show", $sql))) {
            return true;
        } else {
            $data = array();
            while ($row = mysql_fetch_array($results)) {
                $data = $row;
            }
            mysql_free_result($results);
            return $data;
        }
    }

//ends the class over here
}

?>
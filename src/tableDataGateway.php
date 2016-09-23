<?php

class TableDataGateway {
    
    private $servername = '';
    private $username = '';
    private $password = '';
    private $dbname = '';
    private $errmode = '';
    
    private function connection() {
        try {
            $conn = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->username, $this->password);
    // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) { 
    echo "Connection failed: " . $e->getMessage();
        }
        return $conn;
    }
    
    public function getRow($email) {
        $conn = $this->connection();    
        $stmt = $conn->prepare('SELECT * FROM students WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function setConfig ($servername, $username, $password, $dbname, $errmode) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->errmode = $errmode;
    }
    
    public function getFields () {
        $conn = $this->connection();
        $fields = array();
        $stmt = $conn->query('SELECT * FROM fields');
        foreach ($stmt as $row) {
            $field = array();
            $field[name] = $row[name]; 
            $field[descr] = $row[descr];
            $field[type] = $row[type];
            if ($row[type] != 'text') {
                $field[values] = array($row[value1],$row[value2]);
            }
            $field[checkErr] = $row[checkErr];
            $field[value] = isset($_POST[$field[name]]) ? htmlspecialchars(strval($_POST[$field[name]])) : '';
            $fields[] = $field;
        }
        $conn = null;
        return $fields;
    }
    
    public function getHeaders() {
        $conn = $this->connection();
        $fields = array();
        $stmt = $conn->query('SELECT name,descr FROM fields');
        $conn = null;
        return $stmt->fetchAll();
    }
    
    public function getHashEmails() {
        $conn = $this->connection();
        $fields = array();
        $stmt = $conn->query('SELECT email,cookpass FROM students');
        $conn = null;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function setStudent($fields) {
        $conn = $this->connection();
        $stmt = $conn->prepare("INSERT INTO `student_list`.`students` (`name`, `surname`, `sex`, `groupnum`, `email`, `egepoints`, `birthyear`, `local`, `cookpass`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");
        $i = 0;
        foreach ($fields as $field) {
            $i++;
            $stmt->bindParam($i, $field[value]);
        }
        $stmt->execute();
        $conn = null;
    }
    
    public function countEmail($var, $except) {
        $conn = $this->connection();
        $rows = $conn->prepare("SELECT COUNT(*) FROM (SELECT * FROM students WHERE email  NOT IN (SELECT email FROM students WHERE email = :except)) d WHERE email = :email");
        $rows -> bindParam(':email', $var);
        $rows -> bindParam(':except', $except);
        $rows -> execute();
        $conn = null;
        return $rows-> fetchColumn(); 
    }
    
    public function getStudents ($recordsOnPage, $page, $search, $order, $orderdir) {
        $conn = $this->connection();
        $query = "SELECT `name`,`surname`,`sex`,`groupnum`,`email`,`egepoints`,`birthyear`,`local` FROM `students` WHERE CONCAT_WS('|',`name`,`surname`,`groupnum`,`email`, `egepoints`, `birthyear`) LIKE :search ORDER BY {$order} {$orderdir} LIMIT :records OFFSET :offset";
        $stmt = $conn->prepare($query);
        $offset = $recordsOnPage*($page-1);
        $searchstring = "%{$search}%";
        $ordera = "`{$order}`";
        $stmt -> bindParam(':records', $recordsOnPage, PDO::PARAM_INT);
        $stmt -> bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt -> bindParam(':search', $searchstring);
        $stmt -> execute();
        $conn = null;
        $studs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $studs;
    }
    
    public function getCountRecords($search) {
        $conn = $this->connection();
        $stmt = $conn->prepare("SELECT `name`,`surname`,`sex`,`groupnum`,`email`,`egepoints`,`birthyear`,`local` FROM `students` WHERE CONCAT_WS('|',`name`,`surname`,`groupnum`,`email`, `egepoints`, `birthyear`) LIKE :search");
        $searchstring = "%{$search}%";
        $stmt -> bindParam(':search', $searchstring);
        $stmt -> execute();
        $conn = null;
        return $stmt->rowCount();
    }
    
    public function updateStudent($fields) {
        $conn = $this->connection();
        $row = $this->getRow($_SESSION[email]);
        $fields[checkErr][value] = $row[0][cookpass];
        $stmt = $conn->prepare('REPLACE INTO `student_list`.`students` (`name`, `surname`, `sex`, `groupnum`, `email`, `egepoints`, `birthyear`, `local`, `cookpass`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $i=0;
        foreach ($fields as $field) {
            $i++;
            $stmt->bindParam($i, $field[value]);
        }
        $stmt->execute();
        $conn = null;
    }
    
    
}
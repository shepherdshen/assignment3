<?php
class dbConnector{
    
    //Please input YOUR database info
    protected static $mysql_servername = 'localhost';
    protected static $mysql_username = 'root';
    protected static $mysql_password = '';
    protected static $mysql_database = 'assignment3';
    
    //connect to db
    public function connectDB(){
        $conn=new mysqli(self::$mysql_servername,self::$mysql_username,self::$mysql_password,self::$mysql_database);
        
        //connection state
        if (mysqli_connect_errno($conn)){
            die("connection to db failed" . mysqli_connect_error());
        }
//         else{                               //used to test db connection
//             echo "connection to db <br>";
//         }
        //set utf8
        mysqli_query($conn, "set names utf8");
        return $conn;
    }
    public function closeDB($conn){
        mysqli_close($conn);
    }
    public function query($conn,$string) {
        return mysqli_query($conn, $string);
    }
    public function confirmLogin($conn,$userName,$password) {
        $sql = "select user_name,password from user where user_name = '$userName' and password = '$password'";
        
        return mysqli_query($conn, $sql);
    }
    public function queryUserId($conn,$userName){
        $sql = "select user_id from user where user_name = '$userName'";
        return mysqli_query($conn, $sql);
    }
    public function confirmUserName($conn,$userName){
        $sql = "select user_name from user where user_name = '$userName'";
        return mysqli_query($conn, $sql);
    }
    public function queryUserName($conn,$userId){
        $sql = "select user_name from user where user_id = '$userId'";
        return mysqli_query($conn, $sql);
    }
    public function querySecretContent($conn,$secretContent){
        $sql = "select secret_content from secret where secret_content = '$secretContent'";
        return mysqli_query($conn, $sql);
    }
    
    public function insertUserInfo($conn,$userName,$password,$gender,$interests,$myPictureName,$remark){
        $sql = "insert into user values(null, '$userName', '$password', '$gender', '$interests', '$myPictureName', '$remark')";
        return mysqli_query($conn, $sql);
    }
    public function insertSecret($conn,$userName,$secretContent){
        $userId = queryUserId($conn,$userName);
        $sql = "insert into secret values(null, '$userId','$secretContent',null)";
        return mysqli_query($conn, $sql);
    }
}
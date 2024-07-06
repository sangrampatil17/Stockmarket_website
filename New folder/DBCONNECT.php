<?php

class DBCONNECT
{

    const SERVER_NAME = 'localhost';
    const DB = 'gymwebsite';
    const USER_NAME = 'root';
    const PASSWORD = '';


    function __construct()
    {

        try {
            $conn = new PDO("mysql:host=" . self::SERVER_NAME . ";dbname=" . self::DB, self::USER_NAME, self::PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        $GLOBALS['conn'] = $conn;

        //$conn = null;
    }
    public function insert_signup($fnm,  $email, $password, $phone, $package, $startdate, $enddate, $time)
    {
      
    
        try {
            $query = "INSERT INTO login (vName,vEmail ,vPassword, vPhone, vPackage, vStartdate, vEnddate, vTime) VALUES (:fnm,  :email, :pass, :phone, :package, :sdate, :edate, :timee)";

            $sql = $GLOBALS['conn']->prepare($query);

            $sql->execute([
                ':fnm' => $fnm,
                ':email' => $email,
                ':pass' => $password,
                ':phone'  => $phone,
                ':package' => $package,
                ':sdate'  => $startdate,
                ':edate'  => $enddate,
                'timee' => $time
               
            ]);
            return 1;
        } catch (PDOException $e) {
            echo 'failed' . $e->getMessage();
            return 0;
        }
    }

    //for login
    public function fetch_login($emaill, $pass)
    {
        $result = [];
        $email = $emaill;
        $password = $pass;
         
        try {
            $query = 'SELECT * FROM login WHERE vEmail = :email AND vPassword = :password LIMIT 1';
            $sql = $GLOBALS['conn']->prepare($query);
            $sql->execute([':email' => $email, ':password' => $password]);
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            #$sql->debugDumpParams();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public function fetch_userpage($email)
    {
        
        $result = [];
        
        try {
            $query = 'SELECT * FROM login WHERE vEmail = :email';
            $sql = $GLOBALS['conn']->prepare($query);
            $sql->execute([':email' => $email]);
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            #$sql->debugDumpParams();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public function insert_admin_data($name, $email ,$mobile, $message)
    {
        try {
            $query = "INSERT INTO admin_data(vName, vEmail, vMobile, vMessage) VALUES (:namee,  :emaill, :mobilee, :messagee)";

            $sql = $GLOBALS['conn']->prepare($query);

            $sql->execute([
                ':namee' => $name,
                ':emaill' => $email,
                ':mobilee' => $mobile,
                ':messagee'  => $message
            ]);
            return 1;
        } catch (PDOException $e) {
            echo 'failed' . $e->getMessage();
            return 0;
        }
        
    }

    public function fetch_costomer_data()
    {
        
        $count = [];
        
        try {
            $query = 'SELECT * FROM login';
            $sql = $GLOBALS['conn']->prepare($query);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            $count = $result;
            #$sql->debugDumpParams();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $count;
    }

    public function fetch_feedback_data()
    {
        
        $count = [];
        
        try {
            $query = 'SELECT * FROM admin_data';
            $sql = $GLOBALS['conn']->prepare($query);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            $count = $result;
            #$sql->debugDumpParams();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $count;
    }
    
//     //for all info of student
//     public function fetch_student_profile($emaill)
//     {
//         $result = [];
//         $email = $emaill;
       
//         try {
//             $query = 'SELECT * FROM student WHERE vEmail = :email  LIMIT 1';
//             $sql = $GLOBALS['conn']->prepare($query);
//             $sql->execute([':email' => $email]);
//             $result = $sql->fetchAll(PDO::FETCH_ASSOC);
//             #$sql->debugDumpParams();

//         } catch (Exception $e) {
//             echo $e->getMessage();
//         }
//         return $result;
//     }

    //for sign up the student
    


//     public function fetch_colleges()
//     {
//         $result = [];
       
//         try {
//             $query = 'SELECT * FROM colleges';
//             $sql = $GLOBALS['conn']->prepare($query);
//             $sql->execute();
//             $result = $sql->fetchAll(PDO::FETCH_ASSOC);
//             #$sql->debugDumpParams();

//         } catch (Exception $e) {
//             echo $e->getMessage();
//         }
//         return $result;
//     }

//     //for fetching teacher for query
//     public function fetch_teacher()
//     {
        
//         $result = [];
        
//         try {
//             $query = 'SELECT * FROM teacher';
//             $sql = $GLOBALS['conn']->prepare($query);
//             $sql->execute();
//             $result = $sql->fetchAll(PDO::FETCH_ASSOC);
//             #$sql->debugDumpParams();

//         } catch (Exception $e) {
//             echo $e->getMessage();
//         }
//         return $result;
//     }

//     //for inserting student query
//     public function insert_query($t_id,$s_id,$namee,$email,$queryy)
//     {
       
//         try {
//             $query = "INSERT INTO squery (iTeacherId,iStudentId,vName,vEmail,vQuery) VALUES (:t_id,:s_id,:namee,:email,:queryy)";

//             $sql = $GLOBALS['conn']->prepare($query);

//             $sql->execute([
//                 ':t_id' => $t_id,
//                 ':s_id' => $s_id,
//                 ':namee' => $namee,
//                 ':email' => $email,
//                 ':queryy' => $queryy
//             ]);
//             return 1;
//         } catch (PDOException $e) {
//             echo 'failed' . $e->getMessage();
//             return 0;
//         }
//     }

//     //fetch query and reply
//     public function fetch_query($s_id)
//     {
        
//         $result = [];
//         try {
//             $query = 'SELECT q.iId, t.vFirstName, t.vLastName, q.vQuery, q.vReply FROM squery q, teacher t WHERE t.iId=q.iTeacherId AND q.iStudentId=:s_id;';
//             $sql = $GLOBALS['conn']->prepare($query);
//             $sql->execute([':s_id'=>$s_id]);
//             $result = $sql->fetchAll(PDO::FETCH_ASSOC);
//             #$sql->debugDumpParams();

//         } catch (Exception $e) {
//             echo $e->getMessage();
//         }
//         return $result;
//     }

//     //insert apointment
//     public function insert_apointment($t_id,$s_id,$reason)
//     {
       
//         try {
//             $query = "INSERT INTO apointment (iTeacherId,iStudentId,vReason) VALUES (:t_id,:s_id,:reason)";

//             $sql = $GLOBALS['conn']->prepare($query);

//             $sql->execute([
//                 ':t_id' => $t_id,
//                 ':s_id' => $s_id,
//                 ':reason' => $reason
//             ]);
//             return 1;
//         } catch (PDOException $e) {
//             echo 'failed' . $e->getMessage();
//             return 0;
//         }
//     }

//     //fetch Apointment
//     public function fetch_apt($s_id)
//     {
        
//         $result = [];
//         try {
//             $query = 'SELECT apt.iId, t.vFirstName,apt.iStatus ,t.vLastName, apt.vReason, apt.vInformation FROM apointment apt, teacher t WHERE t.iId=apt.iTeacherId AND apt.iStudentId=:s_id';
//             $sql = $GLOBALS['conn']->prepare($query);
//             $sql->execute([':s_id'=>$s_id]);
//             $result = $sql->fetchAll(PDO::FETCH_ASSOC);
//             #$sql->debugDumpParams();

//         } catch (Exception $e) {
//             echo $e->getMessage();
//         }
//         return $result;
//     }
 }

<?php
ini_set('display_errors', 1);
include('common_setting.php');
session_start();
$email = $_POST['email'];
$password = $_POST['password'];

include('DBCONNECT.php');
$obj = new DBCONNECT;
$res = $obj->fetch_login($email, $password);


if (count($res) == 1) {
    $_SESSION['emailU'] = $email;
?>
    <script>
        alert('login successfull....');
        window.location.href = '<?php echo $url; ?>userpage.php';
    </script>
<?php
} else {
    
?>
    <script>
        alert('Invalid Details....!!!');
        window.location.href = '<?php echo $url; ?>login.php';
    </script>
<?php
}

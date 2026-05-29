<?php
$a = '';
$b = '';
$o = '';
$result = '';
echo "<pre>";
 

print_r($_SERVER);
exit();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = $_POST['a'];
    $b = $_POST['b'];
    $o = $_POST['o'];

    if ($o == '+') {
        $result = $a + $b;
    } 
    else if ($o == '-') {
        $result = $a - $b;

        if ($result < 0) {
            $result = "negative result";
        }
    } 
    else if ($o == '*') {
        $result = $a * $b;
    } 
    else if ($o == '/') {

        if ($b != 0) {
            $result = $a / $b;
        } else {
            $result = "cannot divide by zero";
        }

    } 
    else {
        $result = "invalid operator";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>title</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        main {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }
        input[type="number"], input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 5px ;
            box-sizing: border-box;
        }
       
    </style>
</head>
<body>
    <main>
    <form method="post">
        <b>Number 1:</b>
        <input type="number" name="a" >
        <br><br>
        <b>Number 2:</b>
        <input type="number" name="b">
        <br></br>
        <b>Enter operator:</b>
        <input type="text" name="o">
        <br></br>
        <button type="submit">Calculate</button>
    </form>

    
            <h2>Result:<?php echo $result; ?> </h2>
         
    </main>
</body>
</html>
<?php
session_start();
include 'db.php';
// अगर पहले से logged in है तो dashboard पर redirect करें
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: dashboard.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (empty($username)) {
        $error = "Username required!";
    } else {
        $query = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['password'];
            $stored_email = $row['email'];

            if ($password === $stored_password && $email === $stored_email) {
                $_SESSION['username'] = $username;
                $_SESSION['logged_in'] = true;
                $_SESSION['login_time'] = time();
                $_SESSION['email'] = $email;

                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Incorrect password or email!";
            }
        } else {
            $error = "User not found!";   // 
        }
    }
}
?>
<?php
session_start();
include 'koneksi.php'; 

$email = $_POST['email'];
$password = $_POST['password'];

try {
    $stmt = $conn->prepare("SELECT * FROM table_login WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password === $user['password']) {  // Direct comparison
        $_SESSION['email'] = $email;
        $_SESSION['status'] = "sudah_login";
        $_SESSION['id_login'] = $user['id'];
        header("location:view.php");
        exit();
    } else {
        echo "<script>alert('email dan password tidak sesuai');
        window.location.href='index.php';
        </script>";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

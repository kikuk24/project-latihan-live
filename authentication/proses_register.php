session_start();
include '../config/koneksi.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = 'user';

$query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
if (mysqli_query($conn, $query)) {
    header("Location: ../pages/auth/login.php");
} else {
    echo "Pendaftaran gagal: " . mysqli_error($conn);
}
?>

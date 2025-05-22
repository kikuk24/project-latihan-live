<?php
session_start(); //  Mulai session

include '../config/koneksi.php';


//  Cek jika data dikirim dengan POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 🧹 Bersihkan input
    $email    = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    //  Validasi input
    if (empty($email) || empty($password)) {
        echo "Email dan password wajib diisi.";
        exit;
    }

    //  Ambil data user berdasarkan email
    $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        //  Cek password
        if (password_verify($password, $user['password'])) {
            //  Simpan ke session
            $_SESSION["user_id"]    = $user["id"];
            $_SESSION["user_name"]  = $user["name"];
            $_SESSION["user_email"] = $user["email"];

            // 🔁 Redirect ke dashboard
            header("Location: ../pages/admin/index.php");
            exit;
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Email tidak ditemukan.";
    }
}

mysqli_close($conn);
?>

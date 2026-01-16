<?php
// keamanan: pastikan session aktif
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// koneksi database
include "koneksi.php";

// pastikan user sudah login
if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit;
}

// ambil username dari session
$username = $_SESSION['username'];

// ambil data user yang login
$query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
$data = mysqli_fetch_assoc($query);

// proses simpan
if (isset($_POST['simpan'])) {

    // ======================
    // UPDATE PASSWORD
    // ======================
    if (!empty($_POST['password'])) {
        $password = md5($_POST['password']); // sesuaikan dengan sistem login
        mysqli_query($conn, "UPDATE user SET password='$password' WHERE username='$username'");
    }

    // ======================
    // UPDATE FOTO PROFIL
    // ======================
    if (!empty($_FILES['foto']['name'])) {
        $namaFoto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];

        move_uploaded_file($tmp, "img/" . $namaFoto);

        mysqli_query($conn, "UPDATE user SET foto='$namaFoto' WHERE username='$username'");
    }

    echo "<script>alert('Profil berhasil diperbarui');location='admin.php?page=profile';</script>";
}
?>

<div class="col-md-6">
    <form method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" value="<?= $data['username']; ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Ganti Password</label>
            <input type="password" name="password" class="form-control" placeholder="Isi jika ingin mengganti password">
        </div>

        <div class="mb-3">
            <label class="form-label">Ganti Foto Profil</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Profil Saat Ini</label><br>
            <?php if (!empty($data['foto'])) { ?>
                <img src="img/<?= $data['foto']; ?>" width="120" class="img-thumbnail">
            <?php } else { ?>
                <p class="text-muted">Belum ada foto</p>
            <?php } ?>
        </div>

        <button type="submit" name="simpan" class="btn btn-primary">
            Simpan
        </button>

    </form>
</div>

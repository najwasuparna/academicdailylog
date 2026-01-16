<?php
function upload_foto($file)
{
    $hasil = [
        'status' => false,
        'message' => '',
        'filename' => ''
    ];

    // ===== PROPERTI FILE =====
    $fileName = $file['name'];
    $tmpName  = $file['tmp_name'];
    $fileSize = $file['size'];

    // ===== EKSTENSI =====
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // ===== EKSTENSI YANG DIIZINKAN =====
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

    // ===== VALIDASI =====
    if ($fileSize > 500000) {
        $hasil['message'] = 'Ukuran file maksimal 500KB';
        return $hasil;
    }

    if (!in_array($ext, $allowed)) {
        $hasil['message'] = 'Format file harus JPG, JPEG, PNG, atau GIF';
        return $hasil;
    }

    // ===== PASTIKAN FOLDER IMG ADA =====
    if (!is_dir('img')) {
        mkdir('img', 0777, true);
    }

    // ===== NAMA FILE BARU =====
    $newName = date('YmdHis') . '.' . $ext;
    $destination = 'img/' . $newName;

    // ===== UPLOAD =====
    if (move_uploaded_file($tmpName, $destination)) {
        $hasil['status']   = true;
        $hasil['filename'] = $newName;
        $hasil['message']  = 'Upload berhasil';
    } else {
        $hasil['message'] = 'Gagal upload file';
    }

    if (isset($_POST['simpan'])) {

    // UPDATE PASSWORD (jika diisi)
    if (!empty($_POST['password'])) {
        $password = md5($_POST['password']); // sesuaikan dg sistem loginmu
        mysqli_query($koneksi, "UPDATE user SET password='$password' WHERE username='$username'");
    }

    // UPDATE FOTO (jika upload)
    if (!empty($_FILES['foto']['name'])) {
        $namaFoto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];

        move_uploaded_file($tmp, "img/".$namaFoto);

        mysqli_query($koneksi, "UPDATE user SET foto='$namaFoto' WHERE username='$username'");
    }

    echo "<script>alert('Profil berhasil diperbarui');location='admin.php?page=profile';</script>";
}

    return $hasil;
}
?>

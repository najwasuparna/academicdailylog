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

    return $hasil;
}
?>

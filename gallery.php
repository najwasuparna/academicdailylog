<?php
// pastikan session & koneksi sudah ada
// session_start();
// include 'koneksi.php';

include "upload_foto.php";
?>

<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg"></i> Tambah Gallery
            </button>
        </div>

        <div class="col-md-6">
            <div class="input-group">
                <input type="text" id="search" class="form-control"
                       placeholder="Ketikkan minimal 3 karakter untuk pencarian">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th class="w-50">Deskripsi</th>
                        <th class="w-25">Image</th>
                        <th class="w-25">Aksi</th>
                    </tr>
                </thead>
                <tbody id="result"></tbody>
            </table>
        </div>

        <!-- ================= MODAL TAMBAH ================= -->
        <div class="modal fade" id="modalTambah" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Gallery</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <input type="text" class="form-control" name="deskripsi" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ================= END MODAL ================= -->
    </div>
</div>

<script>
function loadData(keyword = '') {
    $.ajax({
        url: "gallery_search.php",
        type: "POST",
        data: { keyword: keyword },
        success: function(data) {
            $("#result").html(data);
        }
    });
}

// load awal
loadData();

// pencarian
$("#search").on("keyup", function () {
    loadData($(this).val());
});
</script>

<?php
// ================= SIMPAN / UPDATE =================
if (isset($_POST['simpan'])) {

    $deskripsi = $_POST['deskripsi'];
    $tanggal   = date("Y-m-d H:i:s");
    $username  = $_SESSION['username'];
    $image     = '';

    // ===== UPLOAD IMAGE =====
    if (!empty($_FILES['image']['name'])) {
        $upload = upload_foto($_FILES['image']);

        if ($upload['status']) {
            $image = $upload['filename']; // WAJIB filename
        } else {
            echo "<script>
                alert('".$upload['message']."');
                location='admin.php?page=gallery';
            </script>";
            exit;
        }
    }

    // ===== UPDATE =====
    if (!empty($_POST['id'])) {

        $id = $_POST['id'];

        if ($image == '') {
            $image = $_POST['image_lama'];
        } else {
            if (!empty($_POST['image_lama']) && file_exists("img/" . $_POST['image_lama'])) {
                unlink("img/" . $_POST['image_lama']);
            }
        }

        $stmt = $conn->prepare(
            "UPDATE gallery 
             SET deskripsi=?, image=?, tanggal=?, username=? 
             WHERE id=?"
        );
        $stmt->bind_param("ssssi", $deskripsi, $image, $tanggal, $username, $id);
        $simpan = $stmt->execute();

    } 
    // ===== INSERT =====
    else {
        $stmt = $conn->prepare(
            "INSERT INTO gallery (deskripsi, image, tanggal, username)
             VALUES (?,?,?,?)"
        );
        $stmt->bind_param("ssss", $deskripsi, $image, $tanggal, $username);
        $simpan = $stmt->execute();
    }

    echo "<script>
        alert('Simpan data ".($simpan ? "sukses" : "gagal")."');
        location='admin.php?page=gallery';
    </script>";
}

// ================= HAPUS =================
if (isset($_POST['hapus'])) {

    $id    = $_POST['id'];
    $image = $_POST['image'];

    if (!empty($image) && file_exists("img/" . $image)) {
        unlink("img/" . $image);
    }

    $stmt = $conn->prepare("DELETE FROM gallery WHERE id=?");
    $stmt->bind_param("i", $id);
    $hapus = $stmt->execute();

    echo "<script>
        alert('Hapus data ".($hapus ? "sukses" : "gagal")."');
        location='admin.php?page=gallery';
    </script>";
}
?>

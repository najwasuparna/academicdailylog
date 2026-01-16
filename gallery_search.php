<?php
include "koneksi.php";

$keyword = $_POST['keyword'] ?? '';

$sql = "SELECT * FROM gallery
        WHERE deskripsi LIKE ?
           OR tanggal LIKE ?
           OR username LIKE ?
        ORDER BY tanggal DESC";

$stmt = $conn->prepare($sql);
$search = "%$keyword%";
$stmt->bind_param("sss", $search, $search, $search);
$stmt->execute();

$hasil = $stmt->get_result();
$no = 1;

while ($row = $hasil->fetch_assoc()) {
?>

<tr>
    <td><?= $no++ ?></td>

    <!-- DESKRIPSI -->
    <td>
        <strong><?= htmlspecialchars($row['deskripsi']) ?></strong>
        <br>pada : <?= $row['tanggal'] ?>
        <br>oleh : <?= $row['username'] ?>
    </td>

    <!-- GAMBAR -->
    <td>
        <?php if ($row['image'] && file_exists("img/".$row['image'])) { ?>
            <img src="img/<?= $row['image'] ?>" class="img-fluid" style="max-height:120px">
        <?php } else { ?>
            <span class="text-muted">Tidak ada gambar</span>
        <?php } ?>
    </td>

    <!-- AKSI -->
    <td class="text-nowrap">
        <a href="#" class="badge rounded-pill text-bg-success"
           data-bs-toggle="modal"
           data-bs-target="#modalEdit<?= $row['id'] ?>">
           <i class="bi bi-pencil"></i>
        </a>

        <a href="#" class="badge rounded-pill text-bg-danger"
           data-bs-toggle="modal"
           data-bs-target="#modalHapus<?= $row['id'] ?>">
           <i class="bi bi-x-circle"></i>
        </a>

        <!-- MODAL EDIT -->
        <div class="modal fade" id="modalEdit<?= $row['id'] ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Gallery</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="gambar_lama" value="<?= $row['image'] ?>">

                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <input type="text" class="form-control"
                                       name="deskripsi"
                                       value="<?= htmlspecialchars($row['deskripsi']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ganti Gambar</label>
                                <input type="file" class="form-control" name="gambar">
                            </div>

                            <?php if ($row['image'] && file_exists("img/".$row['image'])) { ?>
                                <img src="img/<?= $row['image'] ?>" class="img-fluid">
                            <?php } ?>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- MODAL HAPUS -->
        <div class="modal fade" id="modalHapus<?= $row['id'] ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus Gallery</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            Yakin hapus:
                            <strong><?= htmlspecialchars($row['deskripsi']) ?></strong> ?
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="gambar" value="<?= $row['image'] ?>">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </td>
</tr>
<?php } ?>

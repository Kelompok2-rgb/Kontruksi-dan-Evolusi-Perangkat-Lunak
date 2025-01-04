<div class="container-fluid py-3">
  <h2>Berita TRPL 2A</h2>

  <div class="row py-2">
    <?php
    include 'koneksi.php';

    $d = isset($_GET['d']) ? $_GET['d'] : 'home';

    switch ($d) {
      case 'home':
        $ambil_berita = mysqli_query($db, "SELECT * FROM berita ORDER BY id DESC LIMIT 6");
        while ($data_berita = mysqli_fetch_array($ambil_berita)) {
          ?>
          <div class="col-4 mb-3">
            <div class="card">
              <img src="admin/images/<?= htmlspecialchars($data_berita['file_upload']) ?>" class="card-img-top" height="200"
                alt="<?= htmlspecialchars($data_berita['judul_berita']) ?>">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($data_berita['judul_berita']) ?></h5>
                <p class="card-text"><?= htmlspecialchars(substr($data_berita['isi_berita'], 0, 250)) ?>...</p>
                <a href="index.php?d=detail&id=<?= $data_berita['id'] ?>" class="btn btn-primary">Readmore..</a>
              </div>
            </div>
          </div>
          <?php
        }
        break;

      case 'detail':
        if (isset($_GET['id'])) {
          $id = intval($_GET['id']);
          $ambil_berita = mysqli_query($db, "SELECT * FROM berita WHERE id='$id'");
          if ($data_berita = mysqli_fetch_array($ambil_berita)) {
            ?>
            <div class="col-8 mb-3">
              <div class="card">
                <img src="admin/images/<?= htmlspecialchars($data_berita['file_upload']) ?>" class="card-img-top" height="400"
                  alt="<?= htmlspecialchars($data_berita['judul_berita']) ?>">
                <div class="card-body">
                  <h5 class="card-title"><?= htmlspecialchars($data_berita['judul_berita']) ?></h5>
                  <p class="card-text"><?= nl2br(htmlspecialchars($data_berita['isi_berita'])) ?></p>
                  <a href="index.php" class="btn btn-secondary">Back to Home</a>
                </div>
              </div>
            </div>
            <?php
          }
        }
        break;
    }
    ?>
  </div>
</div>
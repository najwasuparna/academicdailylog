<?php
//menyertakan code dari file koneksi
include "koneksi.php";

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Academic Daily Log</title>
    <link rel="icon" href="logo2.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet" 
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" 
    crossorigin="anonymous"
    />

<style>
  .custom-accordion-btn:not(.collapsed) {
    background-color: #dc3545 !important;
    color: white !important;
  }

  .custom-accordion-btn:hover {
    background-color: #c82333 !important;
    color: white !important;
  }

  .theme-switcher-btn {
    width: 40px;
    height: 40px;
    border-radius: 6px;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    font-size: 1.2rem;
  }

  .theme-dark-btn {
    background-color: #121212;   
    color: #ffffff;
  }

  .theme-light-btn {
    background-color: #e63946;   
    color: #ffffff;
  }

  body.light-theme {
    background-color: #ffffff;
    color: #212529;
  }

  body.light-theme .navbar,
  body.light-theme footer {
    background-color: #f8f9fa;
    color: #212529;
  }

  body.light-theme .nav-link {
    color: #212529 !important;
  }

body.dark-theme {
  background-color: #121212;
  color: #f8f9fa;
}

body.dark-theme .navbar,
body.dark-theme .navbar.bg-body-tertiary,
body.dark-theme footer {
  background-color: #000000 !important;
  color: #f8f9fa !important;
}

body.dark-theme .navbar .navbar-brand,
body.dark-theme .navbar .nav-link {
  color: #f8f9fa !important;
}

body.dark-theme .card,
body.dark-theme .accordion-button,
body.dark-theme .accordion-body,
body.dark-theme #hero,
body.dark-theme #gallery,
body.dark-theme #schedule,
body.dark-theme #about {
  background-color: #1f1f1f !important;
  color: #f8f9fa !important;
}

</style>
  </head>

 <body class="light-theme">
    <!--nav begin-->
<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
  <div class="container">

    <a class="navbar-brand fw-bold" href="#">Academic Daily Log</a>

    <button class="navbar-toggler ms-auto me-2" type="button"
      data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="d-flex d-lg-none">
      <button id="darkBtnMobile" class="theme-switcher-btn theme-dark-btn me-1">
        <i class="bi bi-moon-fill"></i>
      </button>
      <button id="lightBtnMobile" class="theme-switcher-btn theme-light-btn">
        <i class="bi bi-brightness-high-fill"></i>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#article">Article</a></li>
        <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
        <li class="nav-item"><a class="nav-link" href="#schedule">Schedule</a></li>
        <li class="nav-item"><a class="nav-link" href="#about">About Me</a></li>
        <li class="nav-item">
    <a class="nav-link fw-semibold" href="login.php">Login</a>
  </li>
      </ul>

      <div class="d-none d-lg-flex ms-3">
        <button id="darkBtnDesktop" class="theme-switcher-btn theme-dark-btn me-1">
          <i class="bi bi-moon-fill"></i>
        </button>
        <button id="lightBtnDesktop" class="theme-switcher-btn theme-light-btn">
          <i class="bi bi-brightness-high-fill"></i>
        </button>
      </div>
    </div>

  </div>
</nav>
    <!--nav end-->
    <!--hero begin-->
    <section id="hero" class="text-center p-5 bg-info-subtle text-sm-start">
        <div class="container">
            <div class="row align-items-center ">
          
            <div class="col-md-6 text-md-start text-center">
                    <h1 class="fw-bold display-4">"Record your academic journey day by day"</h1>
                    <h4 class="lead display-6">Pantau perkembangan belajarmu dari hari ke hari</h4>
                    <span id="tanggal"></span>
                    <span id="jam"></span>
                </div>
                     <div class="col-md-6 text-center">
        <img src="img/banner2.jpg" class="img-fluid" width="300" alt="Banner">
      </div>
        </div>
            </div>
    </section>
    <!--hero end-->
    <!--article begin-->
<section id="article" class="text-center p-5">
  <div class="container">

    <h1 class="fw-bold display-4 pb-4">Article</h1>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 justify-content-center">
        <?php
        $sql = "SELECT * FROM article ORDER BY tanggal DESC";
        $hasil = $conn->query($sql); 

        while ($row = $hasil->fetch_assoc()) {
        ?>

        <!--col begin-->
      <div class="col">
        <div class="card h-100 shadow-sm">
          <img src="img/<?=$row["gambar"]?>" class="card-img-top" alt="Daily Study Routine">
          <div class="card-body">
            <h5 class="card-title fw-bold"><?=$row["judul"]?></h5>
            <p class="card-text">
              <?=$row["isi"]?>
            </p>
          </div>
          <div class="card-footer">
            <small class="text-body-secondary"><?=$row["tanggal"]?></small>
          </div>
        </div>
      </div>
        <!-- col end -->
        <?php
        } 
        ?>
      
    </div>

  </div>
</section>
    <!--article end-->
<!--gallery begin-->
<section id="gallery" class="text-center p-5 bg-info-subtle">
  <div class="container">
    <h1 class="fw-bold display-4 pb-3">Gallery</h1>

    <?php
    $sql = "SELECT * FROM gallery ORDER BY tanggal DESC";
    $hasil = $conn->query($sql);
    ?>

    <?php if ($hasil->num_rows > 0) : ?>
    <div id="carouselGallery" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">

        <?php
        $active = "active";
        while ($row = $hasil->fetch_assoc()) :
            if ($row['image'] == '') continue;
        ?>
<div class="carousel-item <?= $active ?> text-center">
    
    <!-- FOTO -->
    <img src="img/<?= htmlspecialchars($row['image']) ?>"
         class="d-block mx-auto"
         style="max-width: 600px; height: auto;"
         alt="<?= htmlspecialchars($row['deskripsi']) ?>">

    <!-- DESKRIPSI DI BAWAH FOTO -->
    <div class="mt-3 px-3">
        <p class="fw-semibold mb-0">
            <?= htmlspecialchars($row['deskripsi']) ?>
        </p>
    </div>

</div>


          </div>
        <?php
            $active = "";
        endwhile;
        ?>

      </div>

      <button class="carousel-control-prev" type="button"
              data-bs-target="#carouselGallery" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>

      <button class="carousel-control-next" type="button"
              data-bs-target="#carouselGallery" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
    <?php else : ?>
      <p class="text-muted">Belum ada gambar di gallery.</p>
    <?php endif; ?>

  </div>
</section>
<!--gallery end-->
    <!-- SCHEDULE BEGIN -->
<section id="schedule" class="text-center p-5">
  <div class="container">
    <h1 class="fw-bold display-4 pb-4">Schedule</h1>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4 justify-content-center">

      <div class="col">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body">
            <div class="mb-3">
              <i class="bi bi-journal-bookmark fs-1 text-danger"></i>
            </div>
            <h5 class="card-title fw-bold">Membaca</h5>
            <p class="card-text">
              Menambah wawasan setiap pagi sebelum beraktivitas.
            </p>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body">
            <div class="mb-3">
              <i class="bi bi-laptop fs-1 text-danger"></i>
            </div>
            <h5 class="card-title fw-bold">Menulis</h5>
            <p class="card-text">
              Mencatat setiap pengalaman harian di jurnal pribadi.
            </p>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body">
            <div class="mb-3">
              <i class="bi bi-people fs-1 text-danger"></i>
            </div>
            <h5 class="card-title fw-bold">Diskusi</h5>
            <p class="card-text">
              Bertukar ide dengan teman dalam kelompok belajar.
            </p>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body">
            <div class="mb-3">
              <i class="bi bi-bicycle fs-1 text-danger"></i>
            </div>
            <h5 class="card-title fw-bold">Olahraga</h5>
            <p class="card-text">
              Menjaga kesehatan dengan bersepeda sore hari.
            </p>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body">
            <div class="mb-3">
              <i class="bi bi-film fs-1 text-danger"></i>
            </div>
            <h5 class="card-title fw-bold">Movie</h5>
            <p class="card-text">
              Menonton film yang bagus di bioskop.
            </p>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body">
            <div class="mb-3">
              <i class="bi bi-bag fs-1 text-danger"></i>
            </div>
            <h5 class="card-title fw-bold">Belanja</h5>
            <p class="card-text">
              Membeli kebutuhan bulanan di supermarket.
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
<!-- SCHEDULE END -->
 <!-- ABOUT ME BEGIN -->
<section id="about" class="text-center p-5 bg-info-subtle">
  <div class="container">

    <h1 class="fw-bold display-4 pb-4">About Me</h1>

    <div class="accordion mx-auto shadow" id="aboutAccordion" style="max-width: 900px;">

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button custom-accordion-btn" type="button" 
                  data-bs-toggle="collapse" data-bs-target="#collapseOne" 
                  aria-expanded="true" aria-controls="collapseOne">
            Universitas Dian Nuswantoro Semarang (2024–Now)
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" 
             aria-labelledby="headingOne" data-bs-parent="#aboutAccordion">
          <div class="accordion-body">
            Saya adalah mahasiswa Universitas Dian Nuswantoro (UDINUS), 
            Prodi Teknik Informatika. Saya mulai kuliah pada tahun 2024 dan 
            terus mengembangkan skill saya di bidang teknologi dan pemrograman.
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed custom-accordion-btn" type="button" 
                  data-bs-toggle="collapse" data-bs-target="#collapseTwo" 
                  aria-expanded="false" aria-controls="collapseTwo">
            SMA Negeri 1 Semarang (2021–2024)
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" 
             aria-labelledby="headingTwo" data-bs-parent="#aboutAccordion">
          <div class="accordion-body">
            Saya adalah lulusan SMA Negeri 1 Semarang. Selama SMA, 
            saya aktif dalam kegiatan organisasi dan akademik.
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed custom-accordion-btn" type="button" 
                  data-bs-toggle="collapse" data-bs-target="#collapseThree" 
                  aria-expanded="false" aria-controls="collapseThree">
            SMP Negeri 2 Semarang (2018–2021)
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" 
             aria-labelledby="headingThree" data-bs-parent="#aboutAccordion">
          <div class="accordion-body">
            Saya bersekolah di SMP Negeri 2 Semarang dan selalu bersemangat 
            dalam mengikuti pembelajaran dan kegiatan ekstrakurikuler.
          </div>
        </div>
      </div>

    </div>

  </div>
</section>
<!-- ABOUT ME END -->
    <!--footer begin-->
    <footer class="text-center p-5">
        <div class="container">
            <div>
                <a href="https://www.instagram.com/udinusofficial"><i class="bi bi-instagram h2 p-2 text-dark"></i></a>
                <a href="https://twitter.com/udinusofficial"><i class="bi bi-twitter h2 p-2 text-dark"></i></a>
                <a href="https://wa.me/+62812685577"><i class="bi bi-whatsapp h2 p-2 text-dark"></i></a>
            </div>
            <div>
                Najwa Handaria Suparna &copy; 2025
            </div>
        </div>
    </footer>
    <!--footer end-->
    <button
      id="backToTop"
      class="btn btn-danger rounded-circle position-fixed bottom-0 end-0 m-3 d-none"
    >
      <i class="bi bi-arrow-up" title="Back to Top"></i>
    </button>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
function tampilWaktu() {
    var waktu = new Date();
    var tanggal = waktu.getDate();
    var bulan = waktu.getMonth();
    var tahun = waktu.getFullYear();
    var jam = waktu.getHours();
    var menit = waktu.getMinutes();
    var detik = waktu.getSeconds();

    function pad(n) {
        return n < 10 ? "0" + n : n;
    }

    var arrBulan = ["1","2","3","4","5","6","7","8","9","10","11","12"];

    var tanggal_full = tanggal + "/" + arrBulan[bulan] + "/" + tahun;
    var jam_full = pad(jam) + ":" + pad(menit) + ":" + pad(detik);

    document.getElementById("tanggal").innerHTML = tanggal_full;
    document.getElementById("jam").innerHTML = jam_full;

    console.log(tanggal_full + " " + jam_full);
}

setInterval(tampilWaktu, 1000);
</script>
<script type="text/javascript"> 
  const backToTop = document.getElementById("backToTop");


  			window.addEventListener("scroll", function () {
        if (window.scrollY > 300) {
          backToTop.classList.remove("d-none");
          backToTop.classList.add("d-block");
        } else {
          backToTop.classList.remove("d-block");
          backToTop.classList.add("d-none");
        }
      }); 

  backToTop.addEventListener("click", function () {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });
</script>
<script>
function setDark() {
  document.body.classList.add("dark-theme");
  document.body.classList.remove("light-theme");
}

function setLight() {
  document.body.classList.add("light-theme");
  document.body.classList.remove("dark-theme");
}

["darkBtnMobile", "darkBtnDesktop"].forEach(function(id) {
  var btn = document.getElementById(id);
  if (btn) btn.addEventListener("click", setDark);
});

["lightBtnMobile", "lightBtnDesktop"].forEach(function(id) {
  var btn = document.getElementById(id);
  if (btn) btn.addEventListener("click", setLight);
});
</script>

</body>
</html>
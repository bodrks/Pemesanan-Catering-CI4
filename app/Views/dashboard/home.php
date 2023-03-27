<?= $this->extend('layout/home_template'); ?>

<?= $this->section('content'); ?>
<section class="slider-section pt-4 pb-4">
    <div class="container">
        <div class="slider-inner">
            <div class="row">
                <div class="col-md-3">
                    <nav class="nav-category">
                        <h2>Categories</h2>
                        <ul class="menu-category">
                            <li><a href="#">Modern</a></li>
                            <li><a href="#">Traditional</a></li>
                            <li><a href="#">Decoration</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-9">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src=" <?= base_url(); ?>/images/a.jpeg" class="d-block w-100" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img src=" <?= base_url(); ?>/images/b.jpeg" class="d-block w-100" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img src=" <?= base_url(); ?>/images/d.jpeg" class="d-block w-100" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" role="button" href="#carouselExampleIndicators" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" role="button" href="#carouselExampleIndicators" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="media">
                    <img class="img-responsive" src="<?= base_url(); ?>/images/about.jpg" alt="ABOUT US">
                </div>
                <div class="media-body">
                    <h5>Fast Service</h5>
                    <p class="text-muted">
                        Give you the best catering service.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="media">
                    <div class="media-body">
                        <h4>About Us</h4>
                        <p class="text-muted">
                            Yeyen Catering merupakan sebuah perusahaan jasa catering yang sudah lama bergelut dalam bidang jasa catering.
                            Prinsip dalam usaha kami adalah melayani konsumen kami dengan sebaik mungkin, layanan yang dimulai dari bahan masakan yang kami buat adalah bahan yang berkualitas dan dimasak dengan bersih di dapur yang sangat rapi dan bersih. Ditangani oleh koki kami yang handal dalam memasak, sehingga cita rasa masakan menjadi enak dan lezat. Selain koki kami mempunyai karyawan pembantu koki yang terampil dan cekatan, yang bekerja dengan kompak dan cepat, sehingga hasil catering selalu tepat waktu.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<section class="pt-5 pb-5">
    <div class="container-fluid">
        <div class="hero text-white hero-bg-image hero-bg-parallax" data-background="<?= base_url(); ?>/images/hero.jpg" style="background-image: url(&quot;<?= base_url(); ?>/images/hero.jpg&quot;);">
            <div class="hero-inner text-center">
                <h2>Favourite Menu</h2>
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6 ">
                            <div id="carouselFavMenu" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselFavMenu" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselFavMenu" data-slide-to="1"></li>
                                    <li data-target="#carouselFavMenu" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src=" <?= base_url(); ?>/images/favmenu1.jpg" class="d-block w-100" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img src=" <?= base_url(); ?>/images/favmenu2.jpg" class="d-block w-100" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img src=" <?= base_url(); ?>/images/favmenu3.jpg" class="d-block w-100" alt="Third slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" role="button" href="#carouselFavMenu" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" role="button" href="#carouselFavMenu" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>
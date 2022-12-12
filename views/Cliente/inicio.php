<?php
session_start();

if (!array_key_exists('user_id', $_SESSION)) {
    header("Location: ../login.php");
    die;
}


//valida el rol del usuario
if (!array_key_exists('rol', $_SESSION) || !in_array($_SESSION['rol'], ['2'])) {
    header("Location: ../login.php");
    die;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/inicio_cliente.css">
    <title>Inicio</title>
</head>

<body>



    <?php
    include_once('../../class/cliente.php');
    include_once('../../class/juego.php');
    include_once('../../class/categoria.php');
    include_once('../../class/plataforma.php');

    $obj_juegos = new Juego();
    $obj_cliente = new Cliente();
    $obj_cat = new Categoria();
    $obj_plat = new Plataforma();


    $plataforma = $obj_plat->listar_plataformas_destacadas();
    $categorias = $obj_cat->listar_categorias();
    $cliente = $obj_cliente->usuario_actual($_SESSION['user_id']);
    $juegos = $obj_juegos->listar_juegos();

    ?>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar brand -->
                <a class="navbar-brand mt-lg-0" href="#">
                    <i class="fas fa-crow fa-2x"></i>
                    <span class="h1 fw-bold "> Flowers Store</span>
                </a>
                <!-- Left links -->
                <ul class="navbar-nav mb-1 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="compras.php">Compras</a>
                    </li>

                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <div class="d-flex align-items-center">
                <!-- Icon -->

                <form class="d-flex input-group w-auto mx-5" action="buscador.php" method="GET">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" name="data" />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="fas fa-search"></i>
                    </span>
                </form>

                <a class="text-reset me-3" href="carrito.php">
                    <i class="fas fa-shopping-cart"></i>
                </a>
                <!-- Avatar -->


                <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $cliente['NOMBRE'] . " " . $cliente['APELLIDO']  ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../../process/logout.php">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
            <!-- Right elements -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->


    <main class="container-fluid mb-4">

        <section class="container">

            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php
                    $j = 0;
                    foreach ($categorias as $cat) { ?>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?= $j ?>" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <?php
                        $j++;
                    } ?>
                </div>
                <div class="carousel-inner">

                    <?php
                    $i = 0;
                    foreach ($categorias as $cat) { ?>
                        <?php if ($i == 0) { ?>
                            <div class="carousel-item active" style="height: 700px;" data-bs-interval="8000">
                                <img src="../../Images/categorias/<?= $cat['DIR_IMG_CAT'] ?>" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h2><?= $cat['DESCRIPCION_CATEGORIA'] ?></h2>

                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="carousel-item" style="height: 700px;" data-bs-interval="8000">
                                <img src="../../Images/categorias/<?= $cat['DIR_IMG_CAT'] ?>" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h2><?= $cat['DESCRIPCION_CATEGORIA'] ?></h2>
                                </div>
                            </div>
                        <?php } ?>

                    <?php
                        $i++;
                    } ?>


                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </section>

        <section class="container py-5 ">

            <h2> Los Juegos más Destacados: </h2>

            <section class="container py-5 bg-light rounded">
                <div class="row row-cols-1 row-cols-md-3 g-4">

                    <?php foreach ($juegos as $jug) { ?>
                        <div class="col">
                            <div class="card h-100">
                                <?php if (empty($jug['DIR_IMG']) || strlen($jug['DIR_IMG']) < 10) { ?>
                                    <img src="../../Images/defecto.jpeg" class="card-img-top" alt="Hollywood Sign on The Hill" />
                                <?php } else { ?>
                                    <img src="../../<?= $jug['DIR_IMG'] ?>" class="card-img-top" alt="Hollywood Sign on The Hill" />
                                <?php } ?>
                                <div class="card-body h-20">
                                    <h5 class="card-title"><?= $jug['NOMBRE'] ?></h5>
                                    <hr>
                                    <strong class="h3">$<?= $jug['PRECIO'] ?></strong>
                                    <br>
                                    <a href="un_juego.php?id_juego=<?= $jug['ID'] ?>" class="btn btn-primary w-100 mt-3">Ver mas</a>
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                </div>
            </section>

        </section>


        <!-- Parallax -->
        <section class="container-fluid parallax ">
        </section>

        <section class="container py-5">
            <h2>PLataformas más Destacadas: </h2>

            <section class="container row row-cols-1 row-cols-md-3 g-4 py-4">
                <?php foreach ($plataforma as $plat) { ?>
                    <div class="col">
                        <div class="card h-100 p-5">
                            <img class="rounded-circle shadow-4-strong mb-4" alt="avatar2" src="../../Images/plataformas/<?= $plat['DIR_IMG_PLAT'] ?>" width="300" height="300" style="object-fit: cover;" />

                            <div class="card-body h-20">
                                <h5 class="card-title text-center"><?= $plat['DESCRIPCION_PLATAFORMA'] ?></h5>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </section>
        </section>

    </main>

    <?php include '../partials/footer.html' ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
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

    $cliente = $obj_cliente->usuario_actual($_SESSION['user_id']);
    $juego = $obj_juegos->un_juego($_REQUEST['id_juego']);
    $categorias = $obj_juegos->buscar_juego_categoria($_REQUEST['id_juego']);

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
                        <a class="nav-link" href="inicio.php">Inicio</a>
                    </li>
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

                <form class="d-flex input-group w-auto mx-5" action="buscador.php">
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


    <main class="container my-5  ">
        <section class="bg-dark d-flex rounded text-light justify-content-between h-70">
            <div class="imagen w-50">
                <?php if (empty($juego['DIR_IMG']) || strlen($juego['DIR_IMG']) < 10) { ?>
                    <img src="../../Images/defecto.jpeg" class="card-img-top" alt="Hollywood Sign on The Hill" />
                <?php } else { ?>
                    <img src="../../<?= $juego['DIR_IMG'] ?>" class="card-img-top" alt="Hollywood Sign on The Hill" />
                <?php } ?>
            </div>

            <div class="contenido p-3 w-50">
                <h3 class="text-center"><?= $juego['NOMBRE'] ?></h3>

                <br>
                <br>
                <br>

                <p><strong>Descripción del Juego:</strong></p>
                <p><?= $juego['DESCRIPCION_JUEGO'] ?></p>

                <br>
                <p><strong>Categorias:</strong></p>
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <?php foreach ($categorias as $cat) { ?>
                        <input type="radio" class="btn-check" name="btnradio" id="<?= $cat['ID'] ?>" autocomplete="off" checked>
                        <label class="btn btn-light" for="<?= $cat['ID'] ?>"><?= $cat['DESCRIPCION_CATEGORIA'] ?></label>
                    <?php } ?>
                </div>

                <br>
                <br>

                <div class="d-flex justify-content-around">
                    <div class="">
                        <p><strong>Cantidad Disponible:</strong></p>
                        <p> <strong> <?= $juego['CANTIDAD'] ?> </strong> </p>
                    </div>

                    <div class="">
                        <p><strong>Precio del Juego:</strong></p>
                        <p class="text-end"> <strong> <?= $juego['PRECIO'] ?> </strong> </p>
                    </div>
                </div>

                <br>

                <p><strong>Plataforma Disponible:</strong> </p>
                <div class="d-flex justify-content-center align-items-center">
                    <img class="rounded-circle shadow-4-strong mb-4" alt="avatar2" src="../../Images/plataformas/<?= $juego['DIR_IMG_PLAT'] ?>" width="100" height="100" style="object-fit: cover;" />
                    <h5 class=" text-center align-middle mx-5"><?= $juego['DESCRIPCION_PLATAFORMA'] ?></h5>

                </div>
            </div>
        </section>
        <form action="../../process/agregar_carrito.php" method="POST" class="d-flex justify-content-center my-5">
            <input type="hidden" name="id_cliente" value="<?= $_SESSION['user_id'] ?>">
            <input type="hidden" name="id_juego" value="<?= $_REQUEST['id_juego'] ?>">
            <button type="sutmit" class="btn btn-success w-100 mx-3">Agregar al Carrito</button>
        </form>
    </main>

    <?php include '../partials/footer.html' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
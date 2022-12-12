<?php
session_start();

if (!array_key_exists('user_id', $_SESSION)) {
    header("Location: ../login.php");
    die;
}


//valida el rol del usuario
if (!array_key_exists('rol', $_SESSION) || !in_array($_SESSION['rol'], ['1'])) {
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

    <title>Inicio</title>
</head>

<body>

    <?php
    include_once('../../class/vendedor.php');
    include_once('../../class/juego.php');

    $obj_vendedor = new Vendedor();
    $obj_juegos = new Juego();
    $vendedor = $obj_vendedor->usuario_actual($_SESSION['user_id']);
    $juegos = $obj_juegos->listar_juegos_vendedor($_SESSION['user_id']);

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
                        <a class="nav-link" href="compras.php">Dashboard</a>
                    </li>

                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <div class="d-flex align-items-center">
                <!-- Icon -->
                <!-- Avatar -->


                <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $vendedor['NOMBRE'] . " " . $vendedor['APELLIDO']  ?>
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


    <main class="container mb-4">

        <section class="container-fluid my-5 d-flex justify-content-between">
            <h2> Juegos Agregados...</h2>
            <a href="agregar.php" class="btn btn-outline-success btn-lg">Agregar</a>
        </section>


        <section class="container-fluid">

            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($juegos as $juego) { ?>
                    <div class="col">
                        <div class="card">
                            <?php if (empty($juego['DIR_IMG']) || strlen($juego['DIR_IMG']) < 10) { ?>
                                <img src="../../Images/defecto.jpeg" class="card-img-top" alt="Hollywood Sign on The Hill" />
                            <?php } else { ?>
                                <img src="../../<?= $juego['DIR_IMG'] ?>" class="card-img-top" alt="Hollywood Sign on The Hill" />
                            <?php } ?>

                            <div class="card-body">
                                <h5 class="card-title"><?= $juego['NOMBRE'] ?></h5>
                                <p class="card-text">
                                    <?= $juego['DESCRIPCION_JUEGO'] ?>
                                </p>

                                <div class="my-4 d-flex justify-content-between h5">
                                    <p>
                                        <b>Cantidad:</b> <?= $juego['CANTIDAD'] ?>
                                    </p>

                                    <p>
                                        <b>Precio:</b> B/.<?= $juego['PRECIO'] ?>
                                    </p>
                                </div>

                                <div class="card-end mt-2 d-flex justify-content-between">
                                    <a href="../../process/eliminar_juego.process.php?id=<?= $juego['ID'] ?>"> <i class="fa-solid fa-trash fs-3 text"></i> </a>
                                    <a href="editar.php?id_juego=<?= $juego['ID'] ?>"> <i class="fa-solid fa-pen-to-square fs-3 text"></i> </a>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </section>

    </main>

    <?php include '../partials/footer.html' ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
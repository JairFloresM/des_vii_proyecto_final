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


    $categorias = $obj_cat->listar_categorias();
    $cliente = $obj_cliente->usuario_actual($_SESSION['user_id']);
    $juegos = $obj_juegos->listar_carrito($_SESSION['user_id']);

    $cantidad = 0;
    $total = 0;

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


    <main class="container my-5">

        <h2>Carrito de Compra</h2>

        <section class="d-flex justify-content-between">
            <section class="w-75 bg-light mb-5 d-flex flex-column justify-content-center align-items-center">
                <?php foreach ($juegos as $jug) { ?>
                    <div class="card mb-3" style="max-width: 650px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <?php if (empty($jug['DIR_IMG']) || strlen($jug['DIR_IMG']) < 10) { ?>
                                    <img src="../../Images/defecto.jpeg" class="card-img-top" alt="Hollywood Sign on The Hill" />
                                <?php } else { ?>
                                    <img src="../../<?= $jug['DIR_IMG'] ?>" class="card-img-top" alt="Hollywood Sign on The Hill" />
                                <?php } ?>
                            </div>
                            <div class="col-md-8 d-flex justify-content-center align-items-center">
                                <div class="card-body">
                                    <h5 class="card-title"> <?= $jug['NOMBRE'] ?></h5>
                                    <p class="card-text"><strong>Precio: $<?= $jug['PRECIO'] ?></strong></p>
                                    <p class="card-text"><small class="text-muted">Fecha en que se agrego al carrito: <strong> <?= date('M j Y g:i A', strtotime($jug['created_at']))  ?> </strong> </small></p>
                                </div>
                                <div class="card-footer border">
                                    <a href="../../process/eliminar_carrito.process.php?id=<?= $jug['ID'] ?>"> <i class="fa-solid fa-trash fs-3 text"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $total += $jug['PRECIO'];
                    $cantidad++;
                } ?>
            </section>
            <aside class="w-20 bg-light">

                <div class="card text-center border border-primary shadow-0  mb-3" style="background-color:#ffffff;">
                    <div class="card-header">Metodos de Pago</div>
                    <div class="card-body">
                        <div class="card-text">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <p class="text-start"><img src="../../Images/visa.png" alt=""></p>
                                    <p class="text-end"><strong>Tarjeta 1</strong></p>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Agregar
                        </button>
                    </div>
                </div>
                <div class="card text-center border border-primary shadow-0 " style="background-color:#ffffff;">
                    <div class="card-header">Confirmación del Pedido</div>
                    <div class="card-body">
                        <div class="card-text">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <p class="text-start"><strong>Cantidad:</strong></p>
                                    <p class="text-end"><strong><?= $cantidad ?></strong></p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <p class="text-start"><strong>Subtotal:</strong></p>
                                    <p class="text-end"><strong>$<?= $total ?></strong></p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <p class="text-start"><strong>ITBMS:</strong></p>
                                    <p class="text-end"><strong>$<?= $total * 0.07 ?></strong></p>
                                </li>
                                <li class="list-group-item ">
                                    <p class="text-center"><strong>Total a Pagar:</strong></p>
                                    <p class="text-center"><strong>$<?= $total + ($total * 0.07) ?></strong></p>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Comprar
                        </button>
                    </div>
                </div>
            </aside>

        </section>



    </main>





    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="../../process/actualizar_carrito.process.php" method="POST">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmación de Pedido</h1>
                        <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-between align-items-center">
                        <img src="../../Images/ok_final.png" alt="" width="300" height="300">
                        Gracias por su compra
                    </div>
                    <?php foreach ($juegos as $jug) { ?>
                        <input type="hidden" name="ids[]" value="<?= $jug['ID'] ?>">
                    <?php } ?>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">OK</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <?php include '../partials/footer.html' ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
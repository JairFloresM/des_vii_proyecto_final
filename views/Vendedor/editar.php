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
    <script src="https://kit.fontawesome.com/f277d04d7a.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>Editar Juego</title>
</head>

<body>

    <?php
    include_once('../../class/vendedor.php');
    include_once('../../class/categoria.php');
    include_once('../../class/plataforma.php');
    include_once('../../class/juego.php');

    $obj_vendedor = new Vendedor();
    $obj_cat = new Categoria();
    $obj_plat = new Plataforma();
    $obj_juego = new Juego();


    $vendedor = $obj_vendedor->usuario_actual($_SESSION['user_id']);
    $categorias = $obj_cat->listar_categorias();
    $plataformas = $obj_plat->listar_plataformas();


    $juego = $obj_juego->buscar_juego($_REQUEST['id_juego']);
    $cat_juego = $obj_juego->buscar_juego_categoria($_REQUEST['id_juego']);

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
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>

                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <div class="d-flex align-items-center">
                <!-- Icon -->


                <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $vendedor['NOMBRE'] . " " . $vendedor['APELLIDO']  ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
            <!-- Right elements -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->


    <main class="container my-4">
        <h2>Editando Juego</h2>

        <form class="container mt-5" action="../../process/editar_juego.process.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class=" mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nombre del Juego</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="nombre" value="<?= $juego['NOMBRE'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Descripción del Juego</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descripcion"><?= $juego['DESCRIPCION_JUEGO'] ?></textarea>
                </div>
            </div>

            <div class="row py-2">
                <div class="col-6">
                    <h5>Seleccionar Plaforma del Juego</h5>
                    <select class="form-select" aria-label="Default select example" name="plataforma">
                        <?php foreach ($plataformas as $plat) { ?>
                            <?php if ($plat['DESCRIPCION_PLATAFORMA'] == $juego['DESCRIPCION_PLATAFORMA']) { ?>
                                <option value="<?= $plat['ID'] ?>" selected> <?= $plat['DESCRIPCION_PLATAFORMA'] ?> </option>
                            <?php } else { ?>
                                <option value="<?= $plat['ID'] ?>"> <?= $plat['DESCRIPCION_PLATAFORMA'] ?> </option>
                            <?php  } ?>
                        <?php  } ?>

                    </select>
                </div>
                <div class="col-6">
                    <h5>Categorías del Juego</h5>

                    <?php foreach ($categorias as $cat) { ?>
                        <div class="form-check">
                            <?php if (array_search($cat['ID'], array_column($cat_juego, 'ID'))) { ?>
                                <input class="form-check-input" type="checkbox" value="<?= $cat['ID'] ?>" id="flexCheckChecked" name="categoria[]" checked="true">
                            <?php } else { ?>
                                <input class="form-check-input" type="checkbox" value="<?= $cat['ID'] ?>" id="flexCheckChecked" name="categoria[]">
                            <?php } ?>

                            <label class="form-check-label" for="flexCheckDefault">
                                <?= $cat['DESCRIPCION_CATEGORIA'] ?>
                            </label>
                        </div>

                    <?php  } ?>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-6">
                    <div class=" mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="exampleFormControlInput1" name="cantidad" min="1" value="<?= $juego['CANTIDAD'] ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class=" mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="exampleFormControlInput1" name="precio" min="1" step=0.1 value="<?= $juego['PRECIO'] ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Imagen del Juego</label>
                    <input class="form-control" type="file" id="formFile" name="archivo" value="<?= $juego['DIR_IMG'] ?>">
                </div>
            </div>


            <input type="hidden" name="id" value="<?= $_SESSION['user_id'] ?>">
            <input type="hidden" name="id_juego" value="<?= $juego['ID'] ?>">
            <div class="row">
                <button class="btn btn-info" type="submit">Actualizar</button>
            </div>


        </form>


    </main>

    <?php include '../partials/footer.html' ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
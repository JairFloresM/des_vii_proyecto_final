<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://kit.fontawesome.com/f277d04d7a.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Inicion de Sesión</title>

</head>

<body>
    <section class="vh-100">
        <div class="container-fluid ">
            <div class="row justify-content-center my-5">
                <div class="col-sm-3 text-black">

                    <div class="px-5 ms-xl-4">
                        <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4"></i>
                        <span class="h1 fw-bold mb-0"> Flowers Store</span>
                    </div>

                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                        <form action="../process/login.process.php" method="POST" style="width: 23rem;">

                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Inicio de Sesión</h3>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2Example18">Correo </label>

                                <input type="email" id="form2Example18" class="form-control form-control-lg" name="correo" />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2Example28">Contraseña</label>

                                <input type="password" id="form2Example28" class="form-control form-control-lg" name="contrasenia" />
                            </div>

                            <div class="pt-1 mb-4">
                                <button class="btn btn-info btn-lg btn-block" type="submit">Login</button>
                            </div>

                            <p>¿Aún no tiene una cuenta? <a href="registrar.php" class="link-info">Registrese aquí</a></p>

                        </form>

                    </div>

                </div>
                <div class="col-sm-3 px-0 d-none d-sm-block">
                    <img src="../Images/Pads.jpeg" alt="Login image" style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </div>
    </section>

    <?php include 'partials/footer.html' ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
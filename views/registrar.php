<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f277d04d7a.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/registrar.css">
    <title>Registrar</title>
</head>

<body>

    <section class="h-100 bg-dark">
        <div class="container py-5 h-100">
            <form action="../process/registrar.process.php" method="POST" class="row d-flex justify-content-center align-items-center">
                <div class="col">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-6 d-flex w-50">
                                <img src="../Images/registrar.jpeg" alt="Sample photo" class="img-fluid" style=" border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                            </div>
                            <div class="col-xl-6">
                                <div class="card-body p-md-5 text-black">
                                    <h3 class="mb-5 text-uppercase">Formulario de Registro</h3>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1m">Nombre</label>
                                                <input type="text" id="form3Example1m" class="form-control form-control-lg" name="nombre" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1n">Apellido</label>
                                                <input type="text" id="form3Example1n" class="form-control form-control-lg" name="apellido" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example8">Correo</label>
                                        <input type="emial" id="form3Example8" class="form-control form-control-lg" name="correo" />
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1m1">Contraseña</label>
                                                <input type="password" id="form3Example1m1" class="form-control form-control-lg" name="contrasenia" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1n1">Repetir Contraseña</label>
                                                <input type="password" id="form3Example1n1" class="form-control form-control-lg" name="rep_contrasenia" />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example9">Pais</label>
                                        <input type="text" id="form3Example9" class="form-control form-control-lg" name="pais" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example90">Dirección</label>
                                        <input type="text" id="form3Example90" class="form-control form-control-lg" name="direccion" />
                                    </div>

                                    <div class="d-flex justify-content-end pt-3">
                                        <button class="btn btn-info btn-lg btn-block" type="submit">Registrar</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <?php include 'partials/footer.html' ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
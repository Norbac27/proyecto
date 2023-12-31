<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Nomina</title>

    <link rel="stylesheet" href="estilos/index.css">

    

</head>
<body>

    <!--Header - Menu-->

    <header>
        <div class="container__header">
            <div class="logo">
                <a href="#">
                    <img src="" alt="">
                </a>
            </div>

            <div class="menu">
                <nav>
                    <ul>
                        <li><a href="#">Inicio</a></li>
                        <li><a href="#">Sobre</a></li>
                        <li><a href="#">Servicios</a></li>
                        <li><a href="#">Obras</a></li>
                        <li><a href="#">Contactos</a></li>
                    </ul>
                </nav>

               
                <div class="socialMedia">
                    <a href="#">
                        <img src="imagenes/social media/facebook.png" alt="">
                    </a>
                    <a href="#">
                        <img src="imagenes/social media/instagram.png" alt="">
                    </a>
                    <a href="#">
                        <img src="imagenes/social media/twitter.png" alt="">
                    </a>
                    <a href="#">
                        <img src="imagenes/social media/youtube.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main>

        <div class="container__cover div__offset">
            <div class="cover">
                <section class="text__cover">
                    <h1>Iniciar Sesión</h1>
                
                    <div class="container">
                    <?php
                        require 'conexion.php';
                        require 'loginclass.php';
                        $loginController = new LoginController();
                        ?>
                        <form action="index.php" method="post">
                            <label for="usuario">Nombre de usuario</label><br>
                            <input type="text" id="usuario" name="usuario" placeholder="Ingrese su usuario"required><br><br>

                            <label for="contraseña">Contraseña</label><br>
                            <input type="password" id="contraseña" name="contraseña" placeholder="Ingrese su contraseña"required pattern="(?=.*\d)(?=.*[a-zA-Z]).{8,}" title="La contraseña debe tener al menos 8 caracteres y contener al menos un número y una letra">
                            <span id="togglePassword"></span>
                            
                            <br><br>
                            <label for="label" class="" style="margin-top: 5px;">¿Aun no tienes cuenta? <a href="registrarse.php">Regístrate</a></label>
                    
                            <input class="btn__text-cover btn__text"type="submit" value="Empezar"></a>
                        </form>
                        <?php if(isset($mensaje)) { echo "<p>$mensaje</p>"; } ?>
                    </div>
                    
                    
        
                </section>
                <section class="image__cover">
                    <img src="imagenes/Cover/hero-img.png" alt="">
                </section>
            </div>
        </div>

        <!--Generador de confianza-->

        <div class="container__trust container__card-primary">
            <div class="trust card__primary">
                <div class="text__trust text__card-primary">
                    <p>GENERA CONFIANZA PRIMERO</p>
                    <h1>Controla tu empresa con un solo toque</h1>
                </div>
                <div class="container__trust container__box-cardPrimary">
                    <div class="card__trust box__card-primary">
                        <img src="imagenes/Trust area/anchor.png" alt="">
                        <h2>Control de nomina completo</h2>
                        <p>Pore et dolore magna aliqua. Ut enim ad minim veniam, quis nos trud exercitation</p>
                    </div>
                    <div class="card__trust box__card-primary">
                        <img src="imagenes/Trust area/archive.png" alt="">
                        <h2>Informes y análisis críticos</h2>
                        <p>Pore et dolore magna aliqua. Ut enim ad minim veniam, quis nos trud exercitation</p>
                    </div>
                    <div class="card__trust box__card-primary">
                        <img src="imagenes/Trust area/user.png" alt="">
                        <h2>Satisfacción del usuario garantizada</h2>
                        <p>Pore et dolore magna aliqua. Ut enim ad minim veniam, quis nos trud exercitation</p>
                    </div>
                </div>
            </div>
        </div>

        <!--Sobre nosotros - Nuestro equipo-->

        <div class="container__about div__offset">
            <div class="about">
                <div class="text__about">
                    <h1>Equipo innovador</h1>
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepto teur sint occae cat cupidatat non proident, sunt in culpa qui oficia deser unt mollit anim id est laborum.</p>
                    <a href="#" class="btn__text-about btn__text">Saber Más</a>
                </div>
                
                <div class="image__about">
                    <img src="imagenes/About/about-1.png" alt="">
                    <img src="imagenes/About/about-2.png" alt="">
                </div>
            </div>
            
        </div>

        <!--SERVICIOS-->

        <div class="container__service container__card-primary div__offset">
            <div class="service card__primary">
                <div class="text__service text__card-primary">
                    <p>QUE HACEMOS</p>
                  
                </div>

                <div class="container__card-service container__box-cardPrimary">
                    <div class="card__service box__card-primary">
                        <img src="imagenes/Services/grid.png" alt="">
                        <h2>Nomina</h2>
                        <p>Pore et dolore magna aliqua. Ut enim ad minim veniam, quis nos trud exercitation</p>
                        <a href="#">
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="card__service box__card-primary">
                        <img src="imagenes/Services/cart.png" alt="">
                        <h2>Novedades</h2>
                        <p>Pore et dolore magna aliqua. Ut enim ad minim veniam, quis nos trud exercitation</p>
                        <a href="#">
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="card__service box__card-primary">
                        <img src="imagenes/Services/camera.png" alt="">
                        <h2>Seguridad social</h2>
                        <p>Pore et dolore magna aliqua. Ut enim ad minim veniam, quis nos trud exercitation</p>
                        <a href="#">
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="card__service box__card-primary">
                        <img src="imagenes/Services/headphone.png" alt="">
                        <h2>Empresa</h2>
                        <p>Pore et dolore magna aliqua. Ut enim ad minim veniam, quis nos trud exercitation</p>
                        <a href="#">
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="card__service box__card-primary">
                        <img src="imagenes/Services/location.png" alt="">
                        <h2>Comprobantes</h2>
                        <p>Pore et dolore magna aliqua. Ut enim ad minim veniam, quis nos trud exercitation</p>
                        <a href="#">
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="card__service box__card-primary">
                        <img src="imagenes/Services/file.png" alt="">
                        <h2>Gestion</h2>
                        <p>Pore et dolore magna aliqua. Ut enim ad minim veniam, quis nos trud exercitation</p>
                        <a href="#">
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </main>
    
</body>
</html>
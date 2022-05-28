<?php

session_start();
require_once('database.php');
 
if(isset($_POST['submit']))
{
	if(isset($_POST['email'],$_POST['password']) && !empty($_POST['email']) && !empty($_POST['password']))
	{
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
 
		if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$sql = "select * from users where email = :email ";
			$handle = $pdo->prepare($sql);
			$params = ['email'=>$email];
			$handle->execute($params);
			if($handle->rowCount() > 0)
			{
				$getRow = $handle->fetch(PDO::FETCH_ASSOC);
				if(password_verify($password, $getRow['password']))
				{
					unset($getRow['password']);
					$_SESSION = $getRow;
					header('location:panel.php');
					exit();
				}
				else
				{
					$errors[] = "Error en  Email o Password";
				}
			}
			else
			{
				$errors[] = "Error Email o Password";
			}
			
		}
		else
		{
			$errors[] = "Email no valido";	
		}
 
	}
	else
	{
		$errors[] = "Email y Password son requeridos";	
	}
 
}
?>



<!DOCTYPE html>

<html lang="en">

<head>

	<title>Login V4</title>

	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

<!--===============================================================================================-->	

	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>

<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">

<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">

<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">

<!--===============================================================================================-->	

	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">

<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">

<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">

<!--===============================================================================================-->	

	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">

<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="css/util.css">

	<link rel="stylesheet" type="text/css" href="css/main.css">

<!--===============================================================================================-->



<!-- Favicon -->

    <link href="img/favicon.ico" rel="icon">



    <!-- Google Web Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet"> 



    <!-- Icon Font Stylesheet -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">



    <!-- Libraries Stylesheet -->

    <link href="lib/animate/animate.min.css" rel="stylesheet">

    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">



    <!-- Customized Bootstrap Stylesheet -->

    <link href="css/bootstrap.min.css" rel="stylesheet">



    <!-- Template Stylesheet -->

    <link href="css/style.css" rel="stylesheet">

</head>

<body>





    <!-- Navbar Start -->

    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">

        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">

            <h2 class="m-0 text-primary">Empresa Wannabes</h2>

        </a>

        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">

            <div class="navbar-nav ms-auto p-4 p-lg-0">

                <a href="index.html" class="nav-item nav-link active">Home</a>

                <a href="about.html" class="nav-item nav-link">Sobre nosotros</a>

                <a href="service.html" class="nav-item nav-link">Servicios</a>

                <a href="project.html" class="nav-item nav-link">Proyectos</a>

                <div class="nav-item dropdown">

                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Páginas</a>

                    <div class="dropdown-menu fade-up m-0">

                        <a href="feature.html" class="dropdown-item">Características</a>

                        <a href="team.html" class="dropdown-item">Nuestro equipo</a>

                        <a href="testimonial.html" class="dropdown-item">Testimonio</a>

                    </div>

                </div>

                <a href="contact.html" class="nav-item nav-link">Contacto</a>

            </div>

            <a href="login.php" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Iniciar Sesión<i class="fa fa-arrow-right ms-3"></i></a>

        </div>

    </nav>

    <!-- Navbar End -->

	

	<div class="limiter">

		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">

			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
           
            <?php
                if (isset($errors) && count($errors) > 0) {
                    foreach ($errors as $error_msg) {
                        echo '<div class="alert alert-danger">' . $error_msg . '</div>';
                    }
                }
            ?>
            
				<form action="login.php" method="POST" class="login100-form validate-form">

					<span class="login100-form-title p-b-49">

					<div class="alertcreate">

                    </div>

						Inicia Sesión

					</span>



					<div class="wrap-input100 validate-input m-b-23" data-validate = "Email is reaquired">

						<span class="label-input100">Email</span>

						<input class="input100" type="email" name="email" placeholder="Escribe tu email">

						<span class="focus-input100" data-symbol="&#xf206;"></span>

					</div>



					<div class="wrap-input100 validate-input" data-validate="Password is required">

						<span class="label-input100">Contraseña</span>

						<input class="input100" type="password" name="password" placeholder="Escribe tu Contraseña">

						<span class="focus-input100" data-symbol="&#xf190;"></span>

					</div>

					

					<div class="text-right p-t-8 p-b-31">

						<a href="#">

							¿Olvidaste tu contraseña?

						</a>

					</div>

					

					<div class="container-login100-form-btn">

						<div class="wrap-login100-form-btn">

							<div class="login100-form-bgbtn"></div>

							<button class="login100-form-btn" name="submit" type="submit">

								Entrar

							</button>

						</div>

					</div>

					<div class="flex-col-c p-t-20">

						<span class="txt1 p-b-17">

							¿No tienes una cuenta?

						</span>



						<a href="/registrar.php" class="txt2">

							Regístrate

						</a>

					</div>

				</form>

			</div>

		</div>

	</div>

	



	<div id="dropDownSelect1"></div>

	

<!--===============================================================================================-->

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>

<!--===============================================================================================-->

	<script src="vendor/animsition/js/animsition.min.js"></script>

<!--===============================================================================================-->

	<script src="vendor/bootstrap/js/popper.js"></script>

	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!--===============================================================================================-->

	<script src="vendor/select2/select2.min.js"></script>

<!--===============================================================================================-->

	<script src="vendor/daterangepicker/moment.min.js"></script>

	<script src="vendor/daterangepicker/daterangepicker.js"></script>

<!--===============================================================================================-->

	<script src="vendor/countdowntime/countdowntime.js"></script>

<!--===============================================================================================-->

	<script src="js/main_login.js"></script>

	



</body>

</html>
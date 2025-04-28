<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Control</title>
</head>

<body>



    <nav>
        <ul class="menu">
            <li><a href="dashboard.php">Inicio</a></li>
            <li><a href="usuarios.php">Usuarios</a></li>
            <li><a href="productos.php">Productos</a></li>
            <li><a href="pedidos.php">Pedidos</a></li>
            <a href="../auth/logout.php" class="salir">Cerrar sesión</a>
        </ul>
    </nav>


    <section class="main-content">
        <h1>Bienvenido, <?php echo $_SESSION["usuario"]; ?></h1>


        <div class="content">
            <ul>
                <li>Ventas<img class="img-adjust" src="../assets/img/ventas.jpg" alt="">
                </li>
                <li>

                    <img class="img-adjust" src="../assets/img/inventario.png" alt="">
                </li>
                <li>
                    <img class="img-adjust" src="../assets/img/factu.png" alt="">

                </li>

            </ul>

        </div>
    </section>




</body>



<style>
    body {
        margin: 0;
        height: 100vh;
        background: radial-gradient(circle, #335577 0%, #112233 70%, #000814 100%);
        background-repeat: no-repeat;
        background-size: cover;
        color: white;
        /* Opcional: texto claro para buen contraste */
        font-family: Arial, sans-serif;

    }


    nav {
        background: radial-gradient(circle, #335577 0%, #112233 70%, #000814 100%);
        color: white;
        padding: 10px;
    }

    .menu {
        list-style-type: none;
        padding: 0;
    }

    .menu li {
        display: inline;
        margin-right: 20px;
    }

    .menu a {
        color: white;
        text-decoration: none;
    }

    .salir {
        display: flex;
        justify-content: flex-end;
        color: white;
        text-decoration: none;
    }


    .main-content {
        padding: 20px;
        background: rgba(0, 0, 0, 0.5);
        border-radius: 10px;
        margin: 20px;
    }



    .content {
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-wrap: wrap;
    }

    .img-adjust {
        display: inline-block;
        width: 100px;
        height: auto;
        border-radius: 10px;
        margin: 10px;
        transition: transform 0.3s;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="assets/js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <nav   class="navbar navbar-expand-lg navbar-light">
            <a  class="navbar-brand" href="index.php">
                <i  id="logo" class="fab fa-pinterest"></i>
                </a>
                <form method="post" action="index.php" class="form-inline my-2 my-lg-0">
                    <input type="hidden" value="search" name="task"/>
                    <input style="width:900px;" class="form-control m-md-3" type="search" placeholder="Busqueda" aria-label="Search" name="q">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                </form>
            <button  class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto " >
                    <li class="nav-item active ">
                        <a class="nav-link btn-lg " href="index.php">Inicio <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn-lg" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pin
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModal">Insertar</a>
                            <a class="dropdown-item" href="index.php">Ver Todos</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn-lg" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tablero
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                         <a class="dropdown-item"  data-toggle="modal" data-target="#tableromodal"  href="#">Agregar Tablero</a>
                            <a class="dropdown-item" href="listaTableros.php">Ver Todos</a>
                        </div>
                    </li>

                </ul>

            </div>
        </nav>

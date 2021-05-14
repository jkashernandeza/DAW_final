<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0"
    crossorigin="anonymous">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/main.css" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="../js/main.js"></script>
    <title>DILOCONVINO</title>
</head>
<?php
    $user = 'root';
    $password = 'root';
    $db = 'diloconvino';
    $host = 'localhost';
    $port = 3306;
    
    $link = mysqli_init();
    $success = mysqli_real_connect(
        $link, 
        $host, 
        $user, 
        $password, 
        $db,
        $port
    );

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    //echo $_SESSION['id_user'];
    if(isset($_SESSION['id_user'])){
        $result_name = mysqli_query($link,"SELECT * FROM usuarios where id_user=".$_SESSION['id_user'].";");
        while($row = mysqli_fetch_array($result_name)) {
            $user_name="Hola, ".$row['name'];
            $name_user=$row['name']." ".$row['last_name'];
        }
    }else{
        $user_name="Iniciar Sesión";
    }
    //echo $_SESSION['id_user'];

        mysqli_close($link);
?>
<body>
    <div class='container-fluid'> <!-- body -->

      <!-- Cabecera -->
      <header>
        <div class='container-fluid text-white' style='background-color:rgba(197, 31, 94, 0.329); height: 200px; margin-bottom: 0px;'>
          <svg data-name='Layer 1'
            xmlns='http://www.w3.org/2000/svg'
            viewBox='0 0 1200 120'
            preserveAspectRatio='none'
            class='svg'
            style='height: 75%; width: 100%; fill: rgba(121, 31, 31, 0.712); opacity: 0.59; transform: rotateY(180deg);'>
            <path
              d='M1200 120L0 1 0 0 1200 0 1200 120z'>
            </path>
          </svg>
        </div> 
        <button class='btn btn-link' onclick=''>
          <img class='img-fluid' src='../img/DILOCONVINO PAG/LOGO TRANSPARENTE.png' alt='DILOCONVINO' 
          style='max-width: 35%; height:auto; margin-top: -245px;margin-left: 68%;'>
        </button>
        <!-- Menú -->
        <div class='d-flex flex-row-reverse' 
        style='background-color:rgb(17, 2, 10); height: 50px; margin-top: -5%;'>
          <span id='sesion' class='p-0 align-self-center' 
          style='color: white; margin-right: 15px;'>
            <?php echo $user_name;?>
          </span>
        </div>
        <!-- Categorias -->
        <div class='dropdown show' style="display: none;">
          <button class='btn btn-link dropdown-toggle align-self-center' 
          role='button' id='categoria' data-toggle='dropdown'
          style='color: rgb(255, 255, 255); margin-top: -75px;'>
            Categorías
          </button>
          <div class='dropdown-menu' aria-labelledby='categoria'>
            <?php
              //echo $cat_list;
            ?>
          </div>
        </div>
      </header>
      
      <!-- Modal -->
      <?php
        $user = 'root';
        $password = 'root';
        $db = 'diloconvino';
        $host = 'localhost';
        $port = 3306;
        
        $link = mysqli_init();
        $success = mysqli_real_connect(
          $link, 
          $host, 
          $user, 
          $password, 
          $db,
          $port
        );
        if(isset($_SESSION['user_id'])){
          $user_name=$_SESSION['user_id'];
        }
        function loginSession(){
          echo "
          <div class='alert alert-success alert-dismissible'>
          <button type='button' class='close' data-dismiss='alert'>&times;</button>
          <strong>Success!</strong> Indicates a successful or positive action.
          </div>";
        }
        echo"
        <div class='modal fade' id='loginModal'>
          <div class='modal-dialog modal-dialog-centered'>
              <div class='modal-content '>
                  <!-- Modal Header -->
                  <div class='modal-header'>
                      <h3 class='modal-title'>Iniciar Sesión</h3>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  </div>
                  <!-- Modal Content -->
                  <div class='modal-body'>
                      <form method='post' action='inicio.php'>
                        <input type='text' class='form-control' id='loginEmail' name='loginEmail' placeholder='Correo'><br>
                        <input type='password' class='form-control' id='loginPassword' name='loginPassword' placeholder='Contraseña'><br>
                        <div class='d-flex justify-content-end'>
                          <button type='submit' class='btn btn-danger material-icons';>
                            login
                          </button>
                        </div>
                      </form>
                      ";
                  echo"
                  </div>
                  <!-- Modal Footer -->
                  <div class='modal-footer'>
                    <label for='signUp' style='margin-right:5px' class='btn-link'>
                      Registrase
                    </label>
                    <button type='button' class='btn btn-danger material-icons' data-dismiss='modal'
                      id='signUp'>
                      how_to_reg
                    </button>
                  </div>
              </div>
          </div>
        </div>
        ";
        mysqli_close($link);
      ?>

      <!--  -->
      <section>
        <div class="jumbotron">
            Pagina en construccion
        </div>

        <div class='row justify-content-around'>
            <div class='col-12 row align-items-center'>
                <a href='inicio.php' type='submit' class='btn btn-lg btn-info mx-auto d-block' 
                style=' width:100%; height:auto; margin-top:15px;'>
                    Regresar a Inicio
                </a>
            </div>
        </div>
      </section>

    </div> <!-- body -->
</body>
</html>
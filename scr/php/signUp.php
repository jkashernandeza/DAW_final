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
        }
    }else{
        $user_name="Iniciar Sesión";
    }
    //echo $_SESSION['id_user'];

    if (isset( $_POST["signForm"] ) ) { 
        $name = mysqli_real_escape_string($link, $_POST['user']);
        $lastname = mysqli_real_escape_string($link, $_POST['apellidos']);
        $btday = mysqli_real_escape_string($link, $_POST['cumpleaños']);
        $mail = mysqli_real_escape_string($link, $_POST['email']);
        $passw = mysqli_real_escape_string($link, $_POST['password']);

        $receptor = mysqli_real_escape_string($link, $_POST['receptor']);
        $telefono = mysqli_real_escape_string($link, $_POST['telefono']);
        $calle = mysqli_real_escape_string($link, $_POST['calle']);
        $ext = mysqli_real_escape_string($link, $_POST['exterior']);
        $int = mysqli_real_escape_string($link, $_POST['interior']);
        $colonia = mysqli_real_escape_string($link, $_POST['colonia']);
        $cp = mysqli_real_escape_string($link, $_POST['cp']);
        $ciudad = mysqli_real_escape_string($link, $_POST['ciudad']);
        $estado = mysqli_real_escape_string($link, $_POST['estado']);
        $pais = mysqli_real_escape_string($link, $_POST['pais']);

        $q_user="insert into usuarios (name,last_name,bthday,email,password,admin) values ('$name','$lastname','$btday','$mail','$passw',0);";
        //echo $q_user;
        
        if (!mysqli_query($link,$q_user)) {
            die('Error: ' . mysqli_error($link));
        }
        /*Insertar pedido*/

        $q_idUser = mysqli_query($link,"SELECT * FROM usuarios 
        order by id_user desc limit 1;");
        //$id_msn=1;
        while($row = mysqli_fetch_array($q_idUser)) {
            $id_user=$row['id_user'];
        }
        //$id_user=3;

        $q_add="insert into addresses (id_user,receptor,telefono,calle,exterior,interior,cp,colonia,estado,pais,ciudad,preferida) 
        values ($id_user,'$receptor','$telefono','$calle','$ext','$int','$cp','$colonia','$estado','$pais','$ciudad',1)";
        echo $q_add;
        if (!mysqli_query($link,$q_add)) {
            die('Error: ' . mysqli_error($link));
        }

        $_SESSION['id_user']=$id_user;
        header("Location:./inicio.php");
    }

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
        <div class='row justify-content-around'>
            <div class='col-12 align-self-center'>
                <div class='card mx-auto d-block'>
                    <div class='card-header'>
                        <h3>
                            Resgistro
                        </h3>
                    </div>
                    <div class='card-body'>
                        <form action='./signUp.php' method='post'>
                            <h4>Datos Personales</h4>
                            <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                <input required type='text' class='form-control' name='user'id='user' placeholder='Nombre(s)' value=''>
                                <label for='user'>Nombre(s)</label>
                            </div>
                            <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                <input required type='text' class='form-control' name='apellidos'id='apellidos' placeholder='Apellidos' value=''>
                                <label for='user'>Apellidos</label>
                            </div>
                            <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                <input required type='date' class='form-control' name='cumpleaños'id='cumpleaños' placeholder='Cumpleaños' value=''>
                                <label for='cumpleaños'>Cumpleaños</label>
                            </div>
                            <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                <input required type='email' class='form-control' name='email'id='email' placeholder='E-mail' value=''>
                                <label for='email'>E-mail</label>
                            </div>
                            <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                <input required type='password' class='form-control' name='password'id='password' placeholder='Contraseña' value=''>
                                <label for='password'>Contraseña</label>
                            </div>
                            <h4>Datos de Entrega</h4>
                            <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                <input required type='text' class='form-control' name='receptor'id='receptor' placeholder='Receptor' value=''>
                                <label for='receptor'>Receptor</label>
                            </div>
                            <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                <input required type='text' class='form-control' name='telefono'id='telefono' placeholder='Telefono' value=''>
                                <label for='telefono'>Telefono</label>
                            </div>
                            <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                <input required type='text' class='form-control' name='calle'id='calle' placeholder='Calle' value=''>
                                <label for='calle'>Calle</label>
                            </div>
                            <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                <input required type='text' class='form-control' name='exterior' id='exterior' placeholder='No. Ext' value=''>
                                <label for='exterior'>No. Ext</label>
                            </div>
                            <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                <input type='text' class='form-control' name='interior' id='interior' placeholder='No. Int' value=''>
                                <label for='interior'>No. Int</label>
                            </div>
                            <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                <input required type='text' class='form-control' name='colonia' id='colonia' placeholder='Colonia' value=''>
                                <label for='colonia'>Colonia</label>
                            </div>
                            <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                <input required type='text' class='form-control' name='cp' id='cp' placeholder='CP' value=''>
                                <label for='cp'>CP</label>
                            </div>
                            <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                <input required type='text' class='form-control' name='ciudad' id='ciudad' placeholder='Ciudad' value=''>
                                <label for='ciudad'>Ciudad</label>
                            </div>
                            <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                <input required type='text' class='form-control' name='estado' id='estado' placeholder='Estado' value=''>
                                <label for='estado'>Estado</label>
                            </div>
                            <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                <input required type='text' class='form-control' name='pais' id='pais' placeholder='País' value=''>
                                <label for='pais'>País</label>
                            </div>
                            <input type="submit" name='signForm' class='btn btn-lg btn-danger mx-auto d-block' style=' width:100%; height:auto;' value='Registrarse'>
                        </form>
                    </div>
                </div>
            </div>
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
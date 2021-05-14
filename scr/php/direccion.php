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
        $result_name = mysqli_query($link,"SELECT name FROM usuarios where id_user=".$_SESSION['id_user'].";");
        while($row = mysqli_fetch_array($result_name)) {
        $user_name="Hola, ".$row['name'];
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

      <!-- Productos -->
      <section>
        <?php
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

            // escape variables for security
            $id_label = mysqli_real_escape_string($link, $_POST['id_label']);
            $_SESSION['id_label']=$id_label;
            //echo $id_label;
            $label_list = mysqli_query($link,"SELECT * FROM labels where id_label=$id_label;");
            $_SESSION['n1']=$_SESSION['n2']=$_SESSION['s']=$_SESSION['d']=$_SESSION['ts']=$_SESSION['tl']="";
            while($row = mysqli_fetch_assoc($label_list)) {
                if($row['name1']==1){$_SESSION['n1'] = mysqli_real_escape_string($link, $_POST['name1']);}
                if($row['name2']==1){$_SESSION['n2'] = mysqli_real_escape_string($link, $_POST['name2']);}
                if($row['cancion']==1){$_SESSION['s'] = mysqli_real_escape_string($link, $_POST['song']);}
                if($row['fecha']==1){$_SESSION['d'] = mysqli_real_escape_string($link, $_POST['date']);}
                if($row['texto_corto']==1){$_SESSION['ts'] = mysqli_real_escape_string($link, $_POST['text_sh']);}
                if($row['texto_largo']==1){$_SESSION['tl'] = mysqli_real_escape_string($link, $_POST['text_lg']);}
            }

            $id_vino = mysqli_real_escape_string($link, $_POST['vinos']);
            $_SESSION['id_vino']=$id_vino;
            //echo $id_vino;

            $add_list = mysqli_query($link,"SELECT * FROM addresses where id_user="
            .$_SESSION['id_user'].";");
            $receptor=$telefono=$calle=$ext=$int=$colonia=$cp=$estado=$ciudad=$pais="";
            while($row = mysqli_fetch_assoc($add_list)) {
                if($row['preferida']==1){
                    //echo $row['receptor'];
                    $_SESSION['id_add']=$row['id_address'];
                    $receptor=$row['receptor'];
                    $telefono=$row['telefono'];
                    $calle=$row['calle'];
                    $int=$row['interior'];
                    $ext=$row['exterior'];
                    $colonia=$row['colonia'];
                    $cp=$row['cp'];
                    $estado=$row['estado'];
                    $ciudad=$row['ciudad'];
                    $pais=$row['pais'];
                }
            }

        echo "
            <div class='row justify-content-around'>
                <div class='col-12 row align-items-center'>
                    <div class='card' style='width:100%; height:auto;'>
                        <div class='card-header h3'>
                            Dirección de entrega
                            <button class='material-icons btn btn-link text-end'
                            style='color: rgba(85, 3, 35, 0.781);'
                            onclick='editAddress();'>
                                <span id='edit_address'>mode_edit</span>
                            </button>
                        </div>
                        <form action='pedido.php' method='POST'>
                        <div class='card-body'>
                            <div class='row justify-content-around'>
                                <div class='col-12 col-md-6'>
                                    <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                        <input readOnly required type='text' class='form-control' name='receptor' id='receptor' placeholder='Receptor' value='".$receptor."'>
                                        <label for='receptor'>Receptor</label>
                                    </div>
                                </div>
                                <div class='col-12 col-md-6'>
                                    <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                        <input readOnly required type='text' class='form-control' name='telefono' id='telefono' placeholder='Telefono' value='".$telefono."'>
                                        <label for='receptor'>Telefono</label>
                                    </div>
                                </div>
                            </div>
                            <div class='row justify-content-around'>
                                <div class='col-12 col-md-6'>
                                    <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                        <input readOnly required type='text' class='form-control' name='calle'id='calle' placeholder='Calle' value='".$calle."'>
                                        <label for='calle'>Calle</label>
                                    </div>
                                </div>
                                <div class='col-6 col-md-3'>
                                    <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                        <input readOnly required type='text' class='form-control' name='exterior' id='exterior' placeholder='No. Ext' value='".$ext."'>
                                        <label for='exterior'>No. Ext</label>
                                    </div>
                                </div>
                                <div class='col-6 col-md-3'>
                                    <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                        <input readOnly type='text' class='form-control' name='interior' id='interior' placeholder='No. Int' value='".$int."'>
                                        <label for='interior'>No. Int</label>
                                    </div>
                                </div>
                            </div>
                            <div class='row justify-content-around'>
                                <div class='col-8'>
                                    <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                        <input readOnly required type='text' class='form-control' name='colonia' id='colonia' placeholder='Colonia' value='".$colonia."'>
                                        <label for='colonia'>Colonia</label>
                                    </div>
                                </div>
                                <div class='col-4'>
                                    <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                        <input readOnly required type='text' class='form-control' name='cp' id='cp' placeholder='CP' value='".$cp."'>
                                        <label for='cp'>CP</label>
                                    </div>
                                </div>
                            </div>
                            <div class='row justify-content-around'>
                                <div class='col-6 col-md-4'>
                                    <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                        <input readOnly required type='text' class='form-control' name='ciudad' id='ciudad' placeholder='Ciudad' value='".$ciudad."'>
                                        <label for='ciudad'>Ciudad</label>
                                    </div>
                                </div>
                                <div class='col-6 col-md-4'>
                                    <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                        <input readOnly required type='text' class='form-control' name='estado' id='estado' placeholder='Estado' value='".$estado."'>
                                        <label for='estado'>Estado</label>
                                    </div>
                                </div>
                                <div class='col-12 col-md-4'>
                                    <div class='form-floating' style='padding:1px; margin-bottom:5px;'>
                                        <input readOnly required type='text' class='form-control' name='pais' id='pais' placeholder='País' value='".$pais."'>
                                        <label for='pais'>País</label>
                                    </div>
                                </div>
                            </div>
                            <div class='row justify-content-around'>
                                <div class='col-12 align-items-center'>
                                    <button type='submit' class='btn btn-lg btn-danger mx-auto d-block' 
                                    style=' width:100%; height:auto; margin-top:15px;'>
                                        Completar Compra
                                    </button>
                                </div>
                            </div>
                            <div class=\"row justify-content-around\">
                                <div class=\"col-12 row align-items-center\">
                                    <a href='inicio.php' type='submit' class='btn btn-lg btn-info mx-auto d-block' 
                                    style=' width:100%; height:auto; margin-top:15px;'>
                                        Regresar
                                    </a>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            ";
            mysqli_close($link);
        ?>
      </section>

    </div> <!-- body -->
</body>
</html>
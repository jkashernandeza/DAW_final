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
  
  $result = mysqli_query($link,"SELECT name FROM categorias;");
  $user_name="Iniciar Sesión";
  $cat_list="";
  while($row = mysqli_fetch_array($result)) {
    $cat_list.= "<button class=\"btn btn-link dropdown-item\">".$row['name']."</button>";
  }
  //$_SESSION['id_user']="0";
  //echo $_SESSION['id_user'];
  if(isset($_SESSION['id_user'])){
    $result_name = mysqli_query($link,"SELECT name FROM usuarios where id_user=".$_SESSION['id_user'].";");
    while($row = mysqli_fetch_array($result_name)) {
      $user_name="Hola, ".$row['name'];
    }
  }

  if (isset( $_POST["logoutSub"] ) ) {
    session_destroy();
    header("Refresh:0");
  }
  
  //echo $_SESSION['id_user'];
  // echo $user_name;

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
          <div class='dropdown dropleft'>
            <button class='p-2 align-self-center btn btn-link material-icons' 
            role='button' id='logout' data-toggle='dropdown'
            style='color: rgb(255, 255, 255); margin-top: 5px; margin-right: 5px;
            <?php 
              if(isset($_SESSION['id_user']))echo "display:blok";
              else echo "display:none";
            ?>
            '>
              face
            </button>
            <div class='dropdown-menu' aria-labelledby='logout'>
              <form action='inicio.php' method='post'>
                <button class='btn btn-link dropdown-item' id='logoutSub' name='logoutSub' type='submit'>
                  Cerrar Sesión
                </button>
              </form>
            </div>
          </div>
          <a class='p-2 align-self-center btn btn-link material-icons'
          style='color: white;
          <?php 
            if(isset($_SESSION['id_user']))echo "display:blok";
            else echo "display:none";
          ?>
          '
          href='./historial.php'>
            shopping_bag
          </a>
          <a id='login_btn' class='p-2 align-self-center btn btn-link material-icons'
          <?php
          echo"
          style='color: white;";
          if(!isset($_SESSION['id_user']))echo "display:blok";
          else echo "display:none";
          echo"'
          ";
          ?>
          data-toggle='modal' data-target='#loginModal'>
            account_circle
          </a>
          <span id='sesion' class='p-0 align-self-center' 
          style='color: white;'>
            <?php echo $user_name;?>
          </span>
        </div>
        <!-- Categorias -->
        <div class='dropdown show'>
          <button class='btn btn-link dropdown-toggle align-self-center' 
          role='button' id='categoria' data-toggle='dropdown'
          style='color: rgb(255, 255, 255); margin-top: -75px;'>
            Categorías
          </button>
          <div class='dropdown-menu' aria-labelledby='categoria'>
            <?php
              echo $cat_list;
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
        if (isset( $_POST["submitButton"] ) ) { 
          $mail = mysqli_real_escape_string($link, $_POST['loginEmail']);
          $passw = mysqli_real_escape_string($link, $_POST['loginPassword']);
          //echo $mail." ".$passw;
          if($q_login = mysqli_query($link,"SELECT * FROM usuarios 
          where email='$mail';")){
            while($row = mysqli_fetch_array($q_login)) {
              if($row['password']==$passw){
                $_SESSION['id_user']=$row['id_user'];
                header("Refresh:0");
              }
            }
          }else{
            echo"
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              <strong>Success!</strong> Indicates a successful or positive action.
            </div>
            ";
          }
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
                        <input type='email' class='form-control' id='loginEmail' name='loginEmail' placeholder='Correo'><br>
                        <input type='password' class='form-control' id='loginPassword' name='loginPassword' placeholder='Contraseña'><br>
                        <div class='d-flex justify-content-end'>
                          <button type='submit' class='btn btn-danger material-icons'
                          name='submitButton' id='submitButton'>
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
                    <a href='./signUp.php' class='btn btn-danger material-icons' id='signUp'>
                      how_to_reg
                    </a>
                  </div>
              </div>
          </div>
        </div>
        ";
        mysqli_close($link);
      ?>

      <!-- Productos -->
      <section>
        <div class="row">
          <!-- Elementos -->
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

            $label_list = mysqli_query($link,"SELECT * FROM labels;");

            while($row = mysqli_fetch_array($label_list)) {
              $id_label=$row[0];
              if($row['enable']==1){
                
                //echo "console.log('".$row[0]."')";
                echo
                "<div class=\"col-12 col-md-6 col-lg-4 card\">
                  <button class=\"btn btn-link\" type=\"button\"
                  data-toggle=\"collapse\" data-target=\"#".$row['titulo']."\" aria-expanded=\"false\" aria-controls=\"".$row['titulo']."\">
                    <img class=\"card-img-top img-fluid align-self-center\" 
                    src=\"../img/".$row['image_path'].".jpeg\" 
                    alt=\"".$row['titulo']."\" style=\"max-width: 50%; height: auto;\">
                  </button>
                  <div class=\"card-body\">
                    <h4 class=\"card-title align-self-center\">".$row['titulo']."</h4>
                    <div class=\"collapse\" id=\"".$row['titulo']."\">
                      <div class=\"card-text\">
                        <form action=\"mensaje.php\" method=\"post\">
                          <div class=\"form-group\">";
                          echo
                            "<input required type=\"text\" class=\"form-control\" style=\"display:none;\" id=\"id_label\" name=\"id_label\" value=\"".$row[0]."\">";
                          if($row['name1']==1){
                            echo
                            "<input required type=\"text\" class=\"form-control\" id=\"name1\" name=\"name1\" placeholder=\"Nombre 1\"><br>";
                          }
                          if($row['name2']==1){
                            echo
                            "<input required type=\"text\" class=\"form-control\" id=\"name2\" name=\"name2\" placeholder=\"Nombre 2\"><br>";
                          }
                          if($row['cancion']==1){
                            echo
                            "<input required type=\"url\" class=\"form-control\" id=\"song\" name=\"song\" placeholder=\"Link de la Canción\"><br>";
                          }
                          if($row['fecha']==1){
                            echo
                            "<input required type=\"date\" class=\"form-control\" id=\"date\" name=\"date\" value=\"".date("d/m/Y")."\" placeholder=\"Fecha\"><br>";
                          }
                          if($row['texto_corto']==1){
                            echo
                            "<input required type=\"text\" class=\"form-control\" id=\"text_sh\" name=\"text_sh\" placeholder=\"Mensaje\" maxlength=\"50\"><br>";
                          }
                          if($row['texto_largo']==1){
                            echo
                            "<textarea required class=\"form-control\" id=\"text_lg\" name=\"text_lg\" placeholder=\"Mensaje\"></textarea><br>";
                          }
                          echo
                            "<button type=\"submit\" class=\"btn btn-link material-icons\" 
                            style=\"color:white; background-color: rgba(85, 3, 35, 0.781); margin-left: 90%; margin-top: 2%;\">
                              add_shopping_cart
                            </button>
                          </div>
                        </form>  
                      </div>
                    </div>
                  </div>
                </div>";
              }
            }
            mysqli_close($link);           
          ?>
        </div>
      </section>

    </div> <!-- body -->
</body>
</html>
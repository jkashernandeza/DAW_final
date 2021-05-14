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
		
		$cat_list="";
		while($row = mysqli_fetch_array($result)) {
			$cat_list.= "<button class=\"btn btn-link dropdown-item\">".$row['name']."</button>";
		}
    if(isset($_SESSION['id_user'])){
      $result_name = mysqli_query($link,"SELECT name FROM usuarios where id_user=".$_SESSION['id_user'].";");
      while($row = mysqli_fetch_array($result_name)) {
        $user_name="Hola, ".$row['name'];
      }
    }else{
      $user_name="Iniciar Sesión";
    }
	
		mysqli_close($link);
?>
<body>
    <div class="container-fluid">

     <!-- Cabecera -->
     <header>
        <div class="container-fluid text-white" style="background-color:rgba(197, 31, 94, 0.329); height: 200px; margin-bottom: 0px;">
          <svg data-name="Layer 1"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 1200 120"
            preserveAspectRatio="none"
            class="svg"
            style="height: 75%; width: 100%; fill: rgba(121, 31, 31, 0.712); opacity: 0.59; transform: rotateY(180deg);">
            <path
              d="M1200 120L0 1 0 0 1200 0 1200 120z">
            </path>
          </svg>
        </div> 
        <a href="./inicio.php" class="btn btn-link" >
        </a>
        <img class="img-fluid" src="../img/DILOCONVINO PAG/LOGO TRANSPARENTE.png" alt="DILOCONVINO" 
        style="max-width: 35%; height:auto; margin-top: -245px;margin-left: 68%;">
        
        <!-- Menú -->
        <div class="d-flex flex-row-reverse" 
        style="background-color:rgb(17, 2, 10); height: 50px; margin-top: -5%;">
          <a class="p-2 align-self-center btn btn-link material-icons"
          style="color: white;"
          href="#">
            shopping_bag
          </a>
          <a id='login_btn' class='p-2 align-self-center btn btn-link material-icons'
          <?php
          echo"
          style='color: white;";
          if(isset($_SESSION['id_user']))echo "display:none";
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
        <div class="dropdown show">
          <a href="#" class="btn btn-link dropdown-toggle align-self-center" 
          role="button" id="categoria" data-toggle="dropdown"
          style="color: rgb(255, 255, 255); margin-top: -75px; display:none;">
            Categorías
          </a>
          <div class="dropdown-menu" aria-labelledby="categoria">
            <?php
              echo $cat_list;
            ?>
          </div>
        </div>
      </header>
      
      <!-- Modal -->
      <div class="modal fade" id="loginModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Iniciar Sesión</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Content -->
                <div class="modal-body">
                    <input type="text" class="form-control" id="loginEmail" placeholder="Correo"><br>
                    <input type="password" class="form-control" id="loginPassword" placeholder="Contraseña"><br>
                    <div class="d-flex justify-content-end">
                      <button type="button" class="btn btn-danger material-icons" data-dismiss="modal">
                        login
                      </button>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                  <label for="signUp" style="margin-right:5px" class="btn-link">
                    Registrase
                  </label>
                  <button type="button" class="btn btn-danger material-icons" data-dismiss="modal"
                    id="signUp">
                    how_to_reg
                  </button>
                </div>
            </div>
         </div>
      </div>
      
      <!-- Preorden -->
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
          //echo $id_label;
          $label_list = mysqli_query($link,"SELECT * FROM labels where id_label=$id_label;");
          while($row = mysqli_fetch_assoc($label_list)) {
            if($row['name1']==1){$name1 = mysqli_real_escape_string($link, $_POST['name1']);}
            if($row['name2']==1){$name2 = mysqli_real_escape_string($link, $_POST['name2']);}
            if($row['cancion']==1){$song = mysqli_real_escape_string($link, $_POST['song']);}
            if($row['fecha']==1){$date = mysqli_real_escape_string($link, $_POST['date']);}
            if($row['texto_corto']==1){$text_sh = mysqli_real_escape_string($link, $_POST['text_sh']);}
            if($row['texto_largo']==1){$text_lg = mysqli_real_escape_string($link, $_POST['text_lg']);}
            //echo $text_lg;
            echo
            "
            <div class=\"row justify-content-around\">
              <div class=\"col-12 col-md-6 row align-items-center\">
                <img src=\"../img/".$row['image_path'].".jpeg\" alt=\"VINO\"
                class=\"img-fluid rounded mx-auto d-block\" style=\"max-width: 30%; height: auto;\">
              </div>
              <div class=\"col-12 col-md-6 align-self-center\">
                <div class=\"card mx-auto d-block\" style=\"max-width: 80%;\">
                    <div class=\"card-header\">
                        <h3>Información
                            <button class=\"material-icons btn btn-link text-end\" style=\"color: rgba(85, 3, 35, 0.781);\"
                            onclick=\"editPreorder();\">
                                <span id=\"edit_preorder\">mode_edit</span>
                            </button>
                        </h3>
                    </div>
                    <form action='direccion.php' method='POST'>
                      <div class=\"card-body\">
                        <input type='text' class='form-control' id='id_label' name='id_label' style='display:none' value='".$id_label."'><br>";
                        if($row['name1']==1){
                          echo
                          "<h5 class=\"card-title\">Nombre 1</h5>
                          <input required type=\"text\" class=\"form-control\" name='name1' id=\"name1\" readOnly value=\"".$name1."\"><br>";
                        }
                        if($row['name2']==1){
                          echo
                          "<h5 class=\"card-title\">Nombre 2</h5>
                          <input required type=\"text\" class=\"form-control\" name='name2' id=\"name2\" readOnly value=\"".$name2."\"><br>";
                        }
                        if($row['cancion']==1){
                          echo
                          "<h5 class=\"card-title\">Canción</h5>
                          <input required type=\"url\" class=\"form-control\" name='song' id=\"song\" readOnly value=\"".$song."\"><br>";
                        }
                        if($row['fecha']==1){
                          echo
                          "<h5 class=\"card-title\">Fecha</h5>
                          <input required type=\"text\" class=\"form-control\" name='date' id=\"date\" readOnly value=\"".$date."\"><br>";
                        }
                        if($row['texto_corto']==1){
                          echo
                          "<h5 class=\"card-title\">Mensaje</h5>
                          <input required type=\"text\" class=\"form-control\" name='text_sh' id=\"text_sh\" readOnly value=\"".$text_sh."\" maxlength=\"50\"><br>";
                        }
                        if($row['texto_largo']==1){
                          echo
                          "<h5 class=\"card-title\">Mensaje</h5>
                          <textarea required class=\"form-control\" id=\"text_lg\" name=\"text_lg\" readOnly>".$text_lg."</textarea><br>";
                        }
                        echo
                        "
                      </div>
                    </div>
                  </div>
                </div>
                <br>";
                // Tabla de vinos
                $vinos = mysqli_query($link,"SELECT * FROM vinos;");
                echo"
                <div class=\"row justify-content-around\">
                  <div class=\"col-1 row align-items-start\"></div>
                  <div class=\"col-10 row align-items-start\">
                    <p class='h3'>Escoge tu vino</p>
                    <table class='table table-striped'>
                      <thead>
                        <th scope='col'>Marca</th>
                        <th scope='col'>Precio</th>
                      </thead>
                      <tbody>";
                      while($aux2 = mysqli_fetch_assoc($vinos)) {
                        if($aux2['enable']==true){
                          echo"                  
                            <tr>
                              <td>
                                <div class='form-check'>
                                  <input class='form-check-input' type='radio' name='vinos' required
                                  id='vino_".$aux2['id_vino']."' value='".$aux2['id_vino']."'>
                                  <label class='form-check-label' for='vino_".$aux2['id_vino']."'>
                                    ".$aux2['nombre']."
                                  </label>
                                </div>
                              </td>
                              <td>
                                $".$aux2['precio']."
                              </td>
                            </tr>";  
                        }
                      }
                echo"
                        </tbody>
                      </table>
                    </div>
                  <div class=\"col-1 row align-items-start\"></div>
                </div>
                <div class=\"row justify-content-around\">
                  <div class=\"col-12 row align-items-center\">
                    <button type='submit' class='btn btn-lg btn-danger mx-auto d-block' 
                    style=' width:90%; height:auto; margin-top:15px;'>
                      Continuar Compra
                    </button>
                  </div>
                </div>
            </form>
            <div class=\"row justify-content-around\">
              <div class=\"col-12 row align-items-center\">
                  <a href='inicio.php' type='submit' class='btn btn-lg btn-info mx-auto d-block' 
                  style=' width:90%; height:auto; margin-top:15px;'>
                      Regresar
                  </a>
              </div>
          </div>
            ";
          }
          mysqli_close($link);
        ?>
      </section>

    </div>
</body>
</html>
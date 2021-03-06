<?php
session_start();
if(!isset($_SESSION['userData'])){header("Location: ./login.php");}
$userData=$_SESSION['userData'];
  include "./php/conexion.php";
  $resultado=$conexion->query("select * from productos order by id DESC")or die($conexion->error);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MI TIENDA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dashboard/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
 <?php include "./layouts/header.php";?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "./layouts/sidebar.php";?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Productos</h1>
          </div>
        
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Agregar producto</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
       
        <div class="card-body">
            <?php 
              if(isset($_GET['error'])){ 
            ?>  
              <div class="alert alert-danger">
                  <b>Error:</b> <?php echo $_GET['error'];?>
              </div>
            <?php
              }
            if(isset($_GET['success'])){ 
            ?>  
              <div class="alert alert-success">
                  <b>Listo!</b> <?php echo $_GET['success'];?>
              </div>
            <?php
              }
            ?>
          
          <form action="./php/insertarProducto.php" class="row" method="POST" enctype="multipart/form-data">
            <div class="col-4">
              <label for="">Nombre</label>
              <input type="text" class="form-control" placeholder="Inserta nombre" name="nombre" id="txtNombre" required>
            </div>
            <div class="col-4">
              <label for="">Precio</label>
              <input type="number" class="form-control" placeholder="Inserta precio" name="precio" required>
            </div>
            <div class="col-4">
              <label for="">Inventario</label>
              <input type="numer" class="form-control" placeholder="Inserta el inventario" 
              min="1" name="inventario" required>
            </div>
            <div class="col-12">
              <label for="">Imagen</label>
              <input type="file" class="form-control" placeholder="Inserta imagen" name="imagen" required>
            </div>
            <div class="col-4 p-2">
            <br>
              <button class="btn btn-primary"> <i class="fa fa-plus"></i> Insertar</buttton>
              </div>
          </form>
        </div>
         
        <!-- /.card-body -->
      
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
    <h2 class="subtitle">Productos</h2>
    <table class="table">
    <thead>
    <th>Id</th>
    <th>Nomre</th>
    <th>Precio</th>
    <th>Inventario</th>
    <th></th>
    </thead>
    <tbody>
        <?php
          while($fila=mysqli_fetch_array($resultado)){

        ?>
    <tr>
    <td><?php echo $fila['id'];?></td>
    <td>
            <img src="./imagenes/productos/<?php echo $fila['imagen'];?>" width="50px" height="50px" alt="">
            <?php echo $fila['nombre'];?>
    </td>
    <td><?php echo $fila['precio'];?></td>
    <td><?php echo $fila['inventario'];?></td>
    
    
    </tr>
    <?php
    } 
    ?>
    </tbody>
    </table>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include "./layouts/footer.php";?>
  <!-- /.MODAL ELIMINAR -->
  <div class="modal fade" id="modal-eliminar">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Eliminar Usuario</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="./php/eliminarUsuario.php" method="POST">
              <div class="modal-body">
                <p>Deseas eliminar el usuario?</p>
              
                  <input type="hidden" id="idEliminar" name="id">
              
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancelar</button>
                <button type="sibmit" class="btn btn-outline-light">Aceptar</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
     <!-- /.MODAL EDITAR -->
  <div class="modal fade" id="modal-editar">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar Usuario</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="./php/editarUsuario.php" method="POST">
              <div class="modal-body">
                
                <div class="col-12">
                  <label for="">Nombre</label>
                  <input type="text" class="form-control" placeholder="Inserta tu nombre" name="nombre" id="nombreEdit" required>
                </div>
                <div class="col-12">
                  <label for="">Apellido</label>
                  <input type="text" class="form-control" placeholder="Inserta tu apellido" name="ap" required id="apEdit">
                </div>
                <div class="col-12">
                  <label for="">Email</label>
                  <input type="email" class="form-control" placeholder="Inserta tu email" name="em" required id="emailEdit">
                </div>
                <div class="col-12">
                  <label for="">Password</label>
                  <input type="password" class="form-control" placeholder="Inserta tu password" name="p1" >
                </div>
                <div class="col-12">
                  <label for="">Confirmar password</label>
                  <input type="password" class="form-control" placeholder="Confirma tu password" name="p2" >
                </div>
            

                  <input type="text" id="idEditar" name="id">
              
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancelar</button>
                <button type="sibmit" class="btn btn-outline-primary">Guardar cambios</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="./dashboard/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dashboard/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./dashboard/dist/js/demo.js"></script>
<script>
  var idEliminar=0;
  $(document).ready(function(){
    $(".btnEliminar").click (function(){
      idEliminar=$(this).data('id');
       $("#idEliminar").val(idEliminar);
    });
    $(".btnEditar").click(function(){
      var idEdit=$(this).data('id');
      var nombre=$(this).data('nombre');
      var ap=$(this).data('ap');
      var email=$(this).data('email');
      $("#idEditar").val(idEdit);
      $("#nombreEdit").val(nombre);
      $("#apEdit").val(ap);
      $("#emailEdit").val(email);
      

    });
  });
</script>
</body>
</html>
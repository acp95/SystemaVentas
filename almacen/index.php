<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/almacen/listado_de_productos.php');

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de productos</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Productos registrados</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="display: block;">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th> <center>Nro</center></th>
                                <th><center>Codigo</center></th>
                                <th><center>Categoria</center></th>
                                <th><center>Imagen</center></th>
                                <th><center>Nombre</center></th>
                                <th><center>Descripcion</center></th>
                                <th><center>Stock</center></th>
                                <th><center>Stock minimo</center></th>
                                <th><center>Stock maximo</center></th>
                                <th><center>Precio de compra</center></th>
                                <th><center>Precio de venta</center></th>
                                <th><center>Usuario</center></th>
                                <th><center>Acciones</center></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $contador=0;
                            foreach($productos_datos as $productos_dato){ ?>
                                <tr>
                                    <td><?php echo $contador=$contador + 1;?></td>
                                    <td> <?php echo $productos_dato['codigo']; ?></td>
                                    <td> <?php echo $productos_dato['categoria']; ?></td>
                                    <td>
                                        <img src="<?php echo $productos_dato['imagen']; ?>" width="100">
                                    </td>
                                    <td> <?php echo $productos_dato['nombre']; ?></td>
                                    <td> <?php echo $productos_dato['descripcion']; ?></td>
                                    <td> <?php echo $productos_dato['stock']; ?></td>
                                    <td> <?php echo $productos_dato['stock_minimo']; ?></td>
                                    <td> <?php echo $productos_dato['stock_maximo']; ?></td>
                                    <td> <?php echo $productos_dato['precio_compra']; ?></td>
                                    <td> <?php echo $productos_dato['precio_venta']; ?></td>
                                    <td> <?php echo $productos_dato['email']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                           </tfoot>
                        </table>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<?php include('../layout/mensajes.php');?>
<?php include('../layout/parte2.php');?>
<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "decimal": "",
                "info": "Mostrando  _START_  a  _END_  de  _TOTAL_  Roles",
                "infoEmpty": "Mostrando 0 to 0 of 0 Roles",
                "infoFiltered": "(Filtrado de  _MAX_  total Roles)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Roles",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true, "lengthChange": true, "autoWidth": false,
            /* Ajuste de botones */
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [{
                    text: 'Copiar',
                    extend: 'copy'
                }, {
                    extend: 'pdf',
                }, {
                    extend: 'csv',
                }, {
                    extend: 'excel',
                }, {
                    text: 'Imprimir',
                    extend: 'print'
                }
                ]
            },
                {
                    extend: 'colvis',
                    text: 'Visor de columnas',
                    collectionLayout: 'fixed three-column'
                }
            ],
            /*Fin de ajuste de botones*/
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>
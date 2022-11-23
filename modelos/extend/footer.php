<strong>
    <p style="text-align: center;">Servicios de Salud de Coahuila, Hospital General de Saltillo. Desarrollo: oegg</p>
</strong>
<h6 style="text-align: center;">
    <p>Todos los derechos reservados &copy; 2019</p>
</h6>

<!--DataTable-->
<script src="../../public/js/jquery-3.4.1.min.js"></script>
<script src="../../public/js/jquery.dataTables.min.js"></script>
<script src="../../public/js/dataTables.bootstrap4.min.js"></script>
<script src="../../public/js/dataTables.buttons.min.js"></script>
<script src="../../public/js/buttons.flash.min.js"></script>
<script src="../../public/js/jszip.min.js"></script>
<script src="../../public/js/pdfmake.min.js"></script>
<script src="../../public/js/vfs_fonts.js"></script>
<script src="../../public/js/buttons.html5.min.js"></script>
<script src="../../public/js/buttons.print.min.js"></script>

<script src="../../public/js/bootstrap.bundle.min.js"></script>
<script src="../../public/js/bootbox.min.js"></script>
<script src="../../public/js/Chart.min.js"></script>

<!--script para mayusculas-->
<script>
    function may(obj, id) {
        obj = obj.toUpperCase();
        document.getElementById(id).value = obj;
    }
</script>

<!--script para DataTables-->
<script>
    $(document).ready(function() {
        $('#tabla').DataTable({
            "language": idioma_espanol,

            dom: 'Bfrtip',
            buttons: [
                //'copyHtml5',
                'excelHtml5',
                //'csvHtml5',
                //'pdfHtml5'
            ]
        });

    });

    var idioma_espanol = {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla =(",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
            "copy": "Copiar",
            "colvis": "Visibilidad"
        }
    }
</script>

<style>


    .blue
    {

        position:relative; 
    }


    .modal, .modal-backdrop {
        position: absolute !important;
    }
    .modal-backdrop{
        opacity: 0 !important;
    }

</style>

<html>
    <script src="/path/to/bootstrap/js/bootstrap.min.js"></script>

    <div class="blue "id="formulario"style="padding: 15%; padding-top: 5%;height: 100%">

        <div class="" style="margin-top: 15%; ">
            <label for="exampleFormControlInput1">Nombre del Grupo</label>
            <input type="text" class="form-control" id="cajaNomobreGrupo" >
        </div>

        <br><br>
        <button id="botonModal" class="btn"onclick="abreModal()">Agregar usuario</button>
        <br><br>
        <div id="usuariosNuevos"></div>
        <br><br>
        <button class="btn " onclick="creaGrupo()">Crear Grupo</button>

        <br><br>
        <span id="alertas" class="label " style="height: 200px; color: black;"></span>




        <!-- Modal -->
        <div id="myModal" class="modal " role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header"><!-- busqueda en modal -->
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <input id="cajabusqueda" class="form-control"  placeholder="Search" aria-label="Search" onkeyup="cargaUsuarios()" style="margin-left: 5%">
                    </div>
                    <div class="modal-body" id="usuarios" style="height: 200px; color: white;">  <!-- Usuarios -->    
                    </div>

                </div>

            </div>
        </div>

        <html>




            <script>
                var listaAnnadidos = [];

                function abreModal() {

                    $("#myModal").modal("show");

                    //appending modal background inside the blue div
                    $('.modal-backdrop').appendTo('.blue');

                    //remove the padding right and modal-open class from the body tag which bootstrap adds when a modal is shown
                    $('body').removeClass("modal-open");
                    $('body').css("padding-right", "");
                    cargaUsuarios();
                }


                function  cargaUsuarios() {
                    var _param = $('#cajabusqueda').val();
                    console.log(_param);
                    $('#usuarios').load('buscaUsuarios.php', {
                        param: _param


                    });
                }
                function añadeUsuario(id, nombre) {

                    console.log(id, nombre, listaAnnadidos);
                    var anadido = false;
                    for (i = 0; i < listaAnnadidos.length; i++) {
                        if (listaAnnadidos[i] == id) {
                            anadido = true;

                        }
                    }
                    if (anadido) {
                        console.log('ese usuario ya esta añadido');
                    } else {
                        $('#us'+id).hide();
                        $('#usuariosNuevos').append('<div  style="background-color: white; float: left; margin-left:43%;" ><b>' + nombre + '<b></div> <br> ');
                        listaAnnadidos[listaAnnadidos.length] = id;

                    }
                }

                function creaGrupo() {
                   
                    var _nombreGrupo = $('#cajaNomobreGrupo').val();
                    
                    
                    if (_nombreGrupo == "") {
                        $('#alertas').addClass('label-danger').text('Inserte un nombre de grupo');


                    } else {
                         console.log('crea grupo');
                            $('#tareas').load('insertaGrupo.php',{
                               lista: listaAnnadidos,
                               nombreGrupo:_nombreGrupo
                            });

                    }
                }



            </script>   




@extends('plantillas.nav')
@section('content')

<style>
    .dropbtn {
    background-color: #04AA6D;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
    }

    .dropbtn:hover, .dropbtn:focus {
        background-color: #3e8e41;
    }

    #myInput {
    box-sizing: border-box;
    background-image: url('searchicon.png');
    background-position: 14px 12px;
    background-repeat: no-repeat;
    font-size: 16px;
    padding: 14px 20px 12px 45px;
    border: none;
    border-bottom: 1px solid #ddd;
    }

    #myInput {outline: 3px solid #ddd;}

    .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f6f6f6;
    min-width: 230px;
    overflow: auto;
    border: 1px solid #ddd;
    z-index: 1;
    }

    .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    }

    .dropdown a:hover {background-color: #ddd;}

    .show {display: block;}

    .scrollable-menu {
        height: auto;
        max-height: 200px;
        overflow-x: hidden;
    }
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
        color: white;
        background-color:#003C71;
        border-color: #003C71;
    }

    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link{
        color: white;
        background-color: #E87B2A;
        border-color: #dee2e6 #dee2e6 #fff;
    }

    .form-floating > .form-control:not(:-moz-placeholder-shown) ~ label {
    opacity: 1;
    color: rgba(0, 0, 0, 0.5);
    background-color: #fff;
    height: auto;
    padding: 0px;
    padding: 0px 0px 0px 10px;
    width: 100%;
    transform: scale(0.982) translateY(0.045rem) translateX(0.1rem);
    border-radius: 5px 0 0 0;
}
.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label,
.form-floating > .form-select ~ label {
    opacity: 1;
    color: rgba(0, 0, 0, 0.5);
    background-color: #fff;
    height: auto;
    padding: 0px 0px 0px 10px;
    width: 100%;
    transform: scale(0.982) translateY(0.045rem) translateX(0.1rem);
    border-radius: 5px 0 0 0;
}
.form-floating > .form-control:-webkit-autofill ~ label {
    opacity: 1;
    color: rgba(0, 0, 0, 0.5);
    background-color: #fff;
    height: auto;
    padding: 0px;
    padding: 0px 0px 0px 10px;
    width: 100%;
    transform: scale(0.982) translateY(0.045rem) translateX(0.1rem);
    border-radius: 5px 0 0 0;
}

</style>
   
    <br>
    <div class="container">

    <!--------------------------------------------------Modal para crear lector o asesor----------------------------------------->

    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1" data-backdrop="false">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #003C71; border-bottom: solid #E87B2A 8px;">
                    <h5 class="modal-title" id="exampleModalToggleLabel" style="color: white;">Registrar asesor o lector externo</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="color: white; width: 1em;"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-floating mb-2 mt-2">
                                        <input type="email" class="form-control" id="inputName" aria-describedby="emailHelp" placeholder="Ingrese el nombre">
                                        <label for="inputName">Nombres</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-floating mb-2 mt-2">
                                        <input type="email" class="form-control" id="inputLastName" aria-describedby="emailHelp" placeholder="Ingrese el nombre">
                                        <label for="inputLastName">Apellidos</label>
                                    </div>  
                                </div>
                            </div>
                            <div class="form-group form-floating mb-3 mt-3">
                              <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Ingrese el nombre">
                              <label for="inputEmail">Correo electronico</label>
                            </div>
                            <div class="row g-2">
                              <div class="col-md">
                                <div class="form-group form-floating mb-3">
                                  <select class="form-control form-select" id="exampleFormControlRole">
                                    <option>Asesor</option>
                                    <option>Lector</option>
                                  </select>
                                  <label for="exampleFormControlRole">Rol</label>
                                </div>
                              </div>
                              <div class="col-md">
                                <div class="form-group form-floating mb-3">
                                  <select class="form-control form-select" id="exampleFormControlDepartment">
                                    <option>Informatica y electronica</option>
                                    <option>Arquitectura</option>
                                    <option>Civil</option>
                                    <option>Humanidades</option>
                                    <option>Economia</option>
                                  </select>
                                  <label for="exampleFormControlDepartment">Departamento</label>
                                </div>
                              </div>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 160px; resize:none;"></textarea>
                                <label for="floatingTextarea">Descripción</label>
                            </div>
                          </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="mb-3" type="submit" class="btn btn-primary" >Crear Lector</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pantalla de grupos de tesis CRUD -->

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Lectores Externos</button>
          <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Asesores Externos</button>
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark" style="background-color: #003C71; color: white; border-bottom: solid #E87B2A 8px; ">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Correo Electronico</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Joshua Steven</td>
                        <td>Sharp Reyes</td>
                        <td>josh@gmail.com</td>
                        <td><button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle" onclick="asignarEstudiante()" style="color: white">Editar</button></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Eduardo Alberto</td>
                        <td>Lopez Torres</td>
                        <td>edu@gmail.com</td>
                        <td><button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle" onclick="asignarEstudiante()" style="color: white">Editar</button></td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td >Ruben Alexander</td>
                        <td>Siguenza Argueta</td>
                        <td>ralex@gmail.com</td>
                        <td><button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle" onclick="asignarEstudiante()" style="color: white">Editar</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark" style="background-color: #003C71; color: white; border-bottom: solid #E87B2A 8px; ">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Correo Electronico</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Joshua Steven</td>
                        <td>Sharp Reyes</td>
                        <td>josh@gmail.com</td>
                        <td><button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle" onclick="asignarEstudiante()" style="color: white">Editar</button></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Eduardo Alberto</td>
                        <td>Lopez Torres</td>
                        <td>edu@gmail.com</td>
                        <td><button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle" onclick="asignarEstudiante()" style="color: white">Editar</button></td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td >Ruben Alexander</td>
                        <td>Siguenza Argueta</td>
                        <td>ralex@gmail.com</td>
                        <td><button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalToggle" onclick="asignarEstudiante()" style="color: white">Editar</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    <div class="row d-flex flex-row-reverse mt-3">
        <a class="float-button" data-bs-toggle="modal" href="#exampleModalToggle" role="button" data-backdrop="false" style="width: 15%; right: 0px;" ><!--<i class="bi bi-people-fill float-icon" style="border-radius: 100%"></i>--><i class="bi bi-person-plus-fill float-icon"></i></a>
    </div>
    <br>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script type="text/javascript">
    function filterTable() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("buscadorTabla");
        filter = input.value.toUpperCase();
        div = document.getElementById("estudiantes");
        a = div.getElementsByTagName("tr");
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].getElementsByTagName("td")[1].textContent || a[i].getElementsByTagName("td")[1].innerText;
            txtValue2 = a[i].getElementsByTagName("td")[2].textContent || a[i].getElementsByTagName("td")[2].innerText;
            txtValue3 = a[i].getElementsByTagName("th")[0].textContent || a[i].getElementsByTagName("th")[0].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 
            || txtValue3.toUpperCase().indexOf(filter) > -1 || (txtValue + " " +txtValue2).toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }

    var limite = 4;
    var numCont = 4;
    $('.checkEstudiantes').change(function() {
        if($("input:checked").length > limite) {
            this.checked = false;
        } else{
            if (this.checked == true) {
                $("#numEstudiante").text(--numCont);
            } else{
                $("#numEstudiante").text(++numCont);
            }
        }
    });

    function desasignar(cont, cont2) {
        document.getElementById("part-"+cont).remove();
        document.querySelectorAll('#estudiantes tr')[cont2].style.display = 'table-row';
        $("#numEstudiante").text(++numCont);
        ++limite;
    }

    var a = 0;
    function asignarEstudiante() {
        var filas = document.querySelectorAll('#estudiantes tr');
        //var filaAsignar = document.getElementById('asignados');
        var check = document.querySelectorAll('.checkEstudiantes');
        for (let index = 0; index < check.length; index++) {
            if(check[index].checked){
                ++a;
                let est = document.querySelectorAll('#estudiantes tr')[index].querySelectorAll('td');
                let carnet = document.querySelectorAll('#estudiantes tr')[index].querySelectorAll('th');
                fragmento = `
                        <td><button class="btn btn-close" onclick="desasignar(${a}, ${index})"></button></td>
                        <th scope="row">${carnet[0].textContent}</th>
                        <td>${est[1].textContent}</td>
                        <td>${est[2].textContent}</td>
                    `;
                var div = document.createElement('tr');
                div.innerHTML = fragmento;
                --limite;
                div.setAttribute('id', 'part-'+a);
                document.getElementById('asignados').appendChild(div);
                filas[index].style.display = 'none';
                check[index].checked = false;
            }
        }
    }
    var bandera;
    
    function eliminarLector(eleccion) {
        if(eleccion == 1){
            $("#nombresD").val($("#nombres").val());
            $("#idD").val($("#id").val());  
            $("#seleccionar1").text("Seleccionar");
        } else if (eleccion == 2) {
            $("#nombresL").val($("#nombres").val());
            $("#idL").val($("#id").val());  
            $("#seleccionar2").text("Seleccionar");
        }
    }

    function eleccion(boton) {
        if(boton == 1){
            document.getElementById("myDropdown1").classList.toggle("show");
        } else if(boton == 2){
            document.getElementById("myDropdown2").classList.toggle("show");
        } else if(boton == 3){
            document.getElementById("myDropdown3").classList.toggle("show");
        }
    }

    /* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */
    function myFunction(boton) {
        if(boton == 1){
            document.getElementById("myDropdown1").classList.toggle("show");
        } else if(boton == 2){
            document.getElementById("myDropdown2").classList.toggle("show");
        } else if(boton == 3){
            document.getElementById("myDropdown3").classList.toggle("show");
        }
    }

    function myFunction2(nombre, id, eleccionB) {
        eleccion(eleccionB);
        $("#nombres").val(nombre);        
        $("#id").val(id);        
    }

    function limpiarModal() {
        $("#nombres").val("");
        $("#id").val("");
        $("#cmb1 option[value=0]").attr("selected",true);
        $("#cmb2 option[value=0]").attr("selected",true);
        $('#Tdocentes').empty();
        
        if (bandera == 1 && $("#nombresD").val() == "") {
            $("#seleccionar1").text("Seleccionar");
        } else if (bandera == 2 && $("#nombresL").val() == "") {
            $("#seleccionar2").text("Seleccionar");
        }
    }

    var nombreBoton1 = "";
    var nombreBoton2 = "";

    function cancelar() {
        limpiarModal();
        if (bandera == 1 && $("#nombresD").val() != "") {
            $("#seleccionar1").text(nombreBoton1);
        } else if (bandera == 2 && $("#nombresL").val() != "") {
            $("#seleccionar2").text(nombreBoton2);
        }
    }

    function asignarDirector(nombre, id) {
        if (bandera == 1) {
            $("#nombresD").val($("#nombres").val());
            $("#idD").val($("#id").val());   
            nombreBoton1 = $("#seleccionar1").text()
        } else{
            $("#nombresL").val($("#nombres").val());
            $("#idL").val($("#id").val()); 
            nombreBoton2 = $("#seleccionar2").text()
        }
        
        limpiarModal();
    }

    function cambiarTexto(boton, nombre) {
        if(boton == 1){
            $("#seleccionar1").text(nombre);
        } else if(boton == 2){
            $("#seleccionar2").text(nombre);
        } 
    }

    function cambiarBoton(cambio, boton){
        eleccion(boton);
        if (cambio == 1) {
            cambiarTexto(boton, "UCA");
            $("#tituloModal").text("Director del trabajo de graduación"); 
            bandera = 1;
        } else if (cambio == 2) {
            cambiarTexto(boton, "Externo");
            $("#tituloModal2").text("Director del trabajo de graduación"); 
            bandera = 1;
        } else if (cambio == 3) {
            cambiarTexto(boton, "UCA");
            $("#tituloModal").text("Segundo Lector"); 
            bandera = 2;
        } else if (cambio == 4) {
            cambiarTexto(boton, "Externo");
            $("#tituloModal2").text("Segundo Lector"); 
            bandera = 2;
        }
    }

    function filterFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        div = document.getElementById("myDropdown3");
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
            } else {
            a[i].style.display = "none";
            }
        }
    }

    $(document).ready(
        function() {
            $("#cmb1").change(function(){
                prueba();
            });

            $("#cmb2").change(function(){
                $("#nombres").val("");
                $("#id").val("");
                prueba2();
            });
        }
    )

    function limpiar() {
        $('#cmb2').empty();
        var select = document.getElementById("cmb2");
		$("<option/>").val(0).text("Seleccione una opción").appendTo("#cmb2");
    }

    function agregarCmb(docentes) {
        if (docentes != "") {
            var cont = 1;
            docentes.forEach(element => {
                $("<option/>").val(cont++).text(element[0]).appendTo("#cmb2");
            });
        }
    }

    function agregarCmb2(docentes) {
        $('#Tdocentes').empty();
        docentes.forEach(element => {
            var div2 = `<a href="#about" onclick="myFunction2('${element[0]}', '${element[1]}', 3)">${element[0]}</a>`;
            var div = document.createElement('div');
                    div.innerHTML = div2;
                document.getElementById('Tdocentes').appendChild(div); 
        });
            //document.getElementById('seccion').appendChild(div);
    }

    function prueba() {
        var id = document.getElementById("cmb1").value;
        $.ajax({
            type : "POST",
            "serverSide" : true,
            url : "./filtroPost",
            data: {"_token": "{{ csrf_token() }}", "id": id},
            success : function(r) {
                limpiar();
                agregarCmb(r);
            },
            error : function(data) {
                console.log(data);
            }
        })
    }

    var hola;

    function prueba2() {
        var id = document.getElementById("cmb2").value;
        $.ajax({
            type : "POST",
            "serverSide" : true,
            url : "./filtroPost2",
            data: {"_token": "{{ csrf_token() }}", "id": id},
            success : function(r) {
                agregarCmb2(r);
                hola = r;
            },
            error : function(data) {
                console.log(data);
            }
        })
    }

    function eliminarBusqueda() {
        agregarCmb2(hola);
        $('#eliminarB').hide();
        $("#buscar").val("");
    }

    function prueba3() {
        $('#eliminarB').show();
        $.ajax({
            type : "POST",
            "serverSide" : true,
            url : "./buscador",
            data: {"_token": "{{ csrf_token() }}", "datos": JSON.stringify(hola), "busqueda":  $("#buscar").val()},
            success : function(r) {
                agregarCmb2(r);
            },
            error : function(data) {
                console.log(data);
            }
        })
    }  
    
</script>
@endsection 
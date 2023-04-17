// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };
  function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("descripcion").value = JsonString;
  
  }
  
  //
  //FUNCION PRINCIPAL D
  //
  
  $(document).ready(function() {
    let edit = false;
    console.log('JQuery is working ');
    fetchTask();
    $('#task-result').hide();
  
  //
  //BUSCAR PRODUCTO
  //
  
  $('#search').keyup(function (e) {
    if ($('#search').val()) {
        let search = $('#search').val();
  
        $.ajax({
            url: 'task-search.php',
            type: 'GET',
            data: { search },
            success: function (response) {
                let task = JSON.parse(response);
                let template = '';
                let template_bus = '';
  
                task.forEach(task => {
                template += `<li>
                ${task.nombre}
                </li>`
                });
                $('#container').html(template);
                $('#task-result').show();
                task.forEach(task => {
                template_bus += `
               <tr taskID="${task.id}">
               <td>${task.id}</td>
               <td><a href="#" class="task-item">${task.nombre}</a></td>
               <td>${task.marca}</td>
               <td>${task.modelo}</td>
               <td>$${task.precio}</td>
               <td>${task.detalles}</td>
               <td>${task.unidades}</td>
               <td><button class="task-delete btn btn-danger">Borrar</button>    </td>
               </tr>
               `
            });
            $('#tasks').html(template_bus);
          }
      });
    }
  });
  
  
    //
    //FUNCION PARA AGREGAR PRODUCTO
    //
  
    $('#task-form').submit(function (e) {
      let datos = JSON.parse($('#descripcion').val());
      const postData = {
          nombre: $('#nombre').val(),
          precio: datos["precio"],
          unidades: datos["unidades"],
          modelo: datos["modelo"],
          marca: datos["marca"],
          detalles: datos["detalles"],
          imagen: datos["imagen"],
          id: $('#taskId').val()
      };
  
      console.log(postData);
  
      let url = edit === false ? 'task-add.php' : 'task-edit.php';
  
      taskJsonString = JSON.stringify(postData, null, 2);
      console.log(taskJsonString);
  
      $.post(url, taskJsonString, function (response) {
          console.log(response);
          let res = JSON.parse(response);
          let mensaje = res.message;
          alert(mensaje);
  
          // Actualizar la lista de tareas después de agregar o editar una tarea
          fetchTask();
      });
      e.preventDefault();
  });
  
  
  //
  //FUNCION list
  //
  
  function fetchTask(){
    $.ajax({
      url : 'tasks-list.php',
      type : 'GET',
      success : function(response){
        let tasks = JSON.parse(response);
        let template = '';
        tasks.forEach(task => {
        template += `
        <tr taskID = "${task.id}">
         <td>${task.id}</td>
         <td><a href = "#" class = "task-item">${task.nombre}</a></td>
         <td>${task.marca}</td>
         <td>${task.modelo}</td>
         <td>${task.precio}</td>
         <td>${task.detalles}</td>
         <td>${task.unidades}</td>
         <td><button class="task-delete btn btn-danger">Borrar</button></td>
        </tr>
        `
        });
        $('#tasks').html(template);
      }
    });
  }
  //
  //Borrar
  //
  $(document).on('click', '.task-delete', function(){
    if(confirm('Estas seguro de eliminar este item')){
      let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr('taskID');
    $.post('task-delete.php', {id}, function(response) {
      fetchTask();
    });
    }
  });
  
  //
  //EDITAR UN CAMPO
  //
  
  $(document).on('click', '.task-item', function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr('taskID');
    //console.log(id);
    $.post('task-single.php', { id }, function (response) {
        const task = JSON.parse(response);
        console.log(response);
        $('#nombre').val(task.nombre);
        $('#taskId').val(task.id);
  
        var atributosobj = {
            "precio": task.precio,
            "unidades": task.unidades,
            "modelo": task.modelo,
            "marca": task.marca,
            "detalles": task.detalles,
            "imagen": task.imagen
        };
  
        var objstring = JSON.stringify(atributosobj, null, 2);
        $('#descripcion').val(objstring);
        edit = true;
        fetchTask();
    })
  });
  });
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


$(document).ready(function() {
  console.log('JQuery is working ');

$('#task-resutl').hide();
fetchTask();

  $('#search').keyup(function(e){
    if($('#search').val()){
      let search = $('#search').val();
      $.ajax({
        url:'task-search.php',
        type: 'POST',
        data : {search},
        success: function(response){
  
          let tasks = JSON.parse(response);
          let template = '';
          tasks.forEach(task => {
            template += `<li>
            ${task.nombre}
            <li>`
          });
          $('#container').html(template);
          $('#task-result').show();
        }
      });
    }
  });

  //
  //FUNCION PARA AGREGAR PRODUCTO
  //
  $(document).ready(function() {
    // Acción del formulario al hacer clic en "Enviar"
    $('#task-form').submit(function(e) {
      e.preventDefault();
  fetchTask();
      // Obtener los valores del formulario
      var nombre = $('#nombre').val();
      var descripcion = $('#descripcion').val();
  
      // Validar que se ingresó un nombre
      if (!nombre) {
        alert('Ingrese un nombre');
        return;
      }
  
      // Convertir la descripción de string a JSON
      var detalles;
      try {
        detalles = JSON.parse(descripcion);
      } catch(e) {
        alert('La descripción no es un JSON válido');
        return;
      }
  
      // Crear un objeto con la información a enviar
      var dataToSend = {
        nombre: nombre,
        marca: detalles.marca,
        modelo: detalles.modelo,
        precio: detalles.precio,
        detalles: detalles.detalles,
        unidades: detalles.unidades,
        imagen: detalles.imagen
      };
  
      // Enviar la información por Ajax
      $.ajax({
        url: 'task-add.php',
        type: 'POST',
        data: JSON.stringify(dataToSend),
        contentType: 'application/json',
        dataType: 'json'
      }).done(function(response) {
        if (response.status === 'success') {
          alert(response.message);
        } else {
          alert(response.message);
        }
      }).fail(function() {
        alert('No se pudo conectar con el servidor');
      });
    });
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
       <td>${task.nombre}</td>
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

$(document).on('click', '.task-delete', function(){
  let element = $(this)[0].parentElement.parentElement;
  let id = $(element).attr('taskID');
  $.post('task-delete.php', {id}, function(response) {
    fetchTask();
  });
});
});
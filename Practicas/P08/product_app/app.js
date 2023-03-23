// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
 } ;
 function agregarProducto(e) {
    e.preventDefault();

    // Validamos los datos ingresados
    var productoJsonString = document.getElementById('description').value;
    var finalJSON = JSON.parse(productoJsonString);
    var errores = validarProducto(finalJSON);
    if (errores.length > 0) {
        console.log(errores);
        return;
    }

    // Si la validación es exitosa, continuamos con el envío del JSON al servidor
    finalJSON['nombre'] = document.getElementById('nombre').value;
    var productoJson = JSON.stringify(finalJSON);
 }

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
        /**
         * NOTA: Las siguientes formas de crear el objeto ya son obsoletas
         *       pero se comparten por motivos historico-académicos.
         */
        try{
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err2){
            try{
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(err3){
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
}

document.getElementById('task-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir comportamiento predeterminado del formulario
  
    var nombre = document.getElementById('nombre').value;
    var descripcion = document.getElementById('description').value;
  
    // Crear objeto JSON a partir de los valores del formulario
    var productoJSON = {
      "nombre": nombre,
      "marca": "NA",
      "modelo": "XX-000",
      "precio": 0.0,
      "unidades": 1,
      "detalles": "NA",
      "imagen": "img/default.png"
    };
    
    try {
      var descripcionJSON = JSON.parse(descripcion); // Convertir la descripción en un objeto JSON
      Object.assign(productoJSON, descripcionJSON); // Combinar los objetos JSON
    } catch (error) {
      console.log("La descripción no es un JSON válido.");
      return;
    }
  
    if (validarJSON(productoJSON)) {
      // Enviar los datos al servidor
      console.log("El JSON es válido y los datos pueden ser enviados al servidor.");
    } else {
      console.log("El JSON no cumple con los requisitos de validación.");
    }
  });
  
  function buscarID(e) {
    /**
     * Revisar la siguiente información para entender porqué usar event.preventDefault();
     * http://qbit.com.mx/blog/2013/01/07/la-diferencia-entre-return-false-preventdefault-y-stoppropagation-en-jquery/#:~:text=PreventDefault()%20se%20utiliza%20para,escuche%20a%20trav%C3%A9s%20del%20DOM
     * https://www.geeksforgeeks.org/when-to-use-preventdefault-vs-return-false-in-javascript/
     */
    e.preventDefault();

    // SE OBTIENE EL ID A BUSCAR
    var texto = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n'+client.responseText);
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);    // similar a eval('('+client.responseText+')');
            
            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if (Object.keys(productos).length > 0) {
                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                let descripcion = '';
                Object.keys(productos[0]).forEach(function (key) {
                    if (key !== 'id' && key !== 'nombre' && key !== 'imagen' && key !== 'eliminado') {
                        descripcion += '<li>' + key + ': ' + productos[0][key] + '</li>';
                    }
                });
            
                // SE CREA UNA PLANTILLA PARA CREAR LA(S) FILA(S) A INSERTAR EN EL DOCUMENTO HTML
                let template = '';
                productos.forEach(function (producto) {
                    template += `
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;
                });
            
                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            }
            
        }
    }
            
        client.send("texto="+texto);
    };
  
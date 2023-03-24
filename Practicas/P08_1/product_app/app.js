// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

// FUNCIÓN CALLBACK DE BOTÓN "Buscar"
function buscarID(e) {
    e.preventDefault();
    // SE OBTIENE EL TEXTO A BUSCAR
    var search = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n'+client.responseText);

            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText); // ahora es un arreglo de objetos

            // SE VERIFICA SI EL ARREGLO JSON TIENE DATOS
            if(productos.length > 0) {
                // SE CREA UNA PLANTILLA PARA CREAR LA(S) FILA(S) A INSERTAR EN EL DOCUMENTO HTML
                let template = '';
                for(let i=0; i<productos.length; i++) {
                    let descripcion = '';
                    descripcion += '<li>precio: '+productos[i].precio+'</li>';
                    descripcion += '<li>unidades: '+productos[i].unidades+'</li>';
                    descripcion += '<li>modelo: '+productos[i].modelo+'</li>';
                    descripcion += '<li>marca: '+productos[i].marca+'</li>';
                    descripcion += '<li>detalles: '+productos[i].detalles+'</li>';

                    template += `
                        <tr>
                            <td>${productos[i].id}</td>
                            <td>${productos[i].nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;
                }

                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            }
        }
    };
    client.send("search="+search);
}


  // FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"
function agregarProducto(e) {
    e.preventDefault();

    // SE OBTIENE DESDE EL FORMULARIO EL JSON A ENVIAR
    var productoJsonString = document.getElementById('description').value;
    // SE CONVIERTE EL JSON DE STRING A OBJETO
    var finalJSON = JSON.parse(productoJsonString);
    // SE AGREGA AL JSON EL NOMBRE DEL PRODUCTO
    finalJSON['nombre'] = document.getElementById('name').value;
    // SE OBTIENE EL STRING DEL JSON FINAL
    productoJsonString = JSON.stringify(finalJSON,null,2);
    
    let errors = validarProducto(finalJSON);
          
    if (errors.length > 0) {
      alert('Se encontraron los siguientes errores:\n\n' + errors.join('\n'));
      return;
    }
  

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
var client = getXMLHttpRequest();
client.open('POST', './backend/create.php', true);
client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
client.onreadystatechange = function () {
    // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
    if (client.readyState == 4 && client.status == 200) {
        var response = JSON.parse(client.responseText);
        if (response.status == "success") {
            window.alert("Producto agregado");
        } else {
            window.alert(response.message);
        }
    }
};
client.send(productoJsonString);

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
function validarProducto(producto) {
    let errores = [];
  
    // Validar el nombre
    if (!producto.nombre || producto.nombre.length > 100) {
      errores.push('El nombre es requerido y debe tener 100 caracteres o menos');
    }
  
    // Validar la marca
    const marcasPermitidas = ['Gamesa', 'Marinela', 'Bimbo', 'Sabritas', 'Barcel'];
    if (!producto.marca || !marcasPermitidas.includes(producto.marca)) {
      errores.push('La marca es requerida y debe ser seleccionada de una lista de opciones');
    }
  
    // Validar el modelo
    if (!producto.modelo || !/^[a-zA-Z0-9\-]+$/.test(producto.modelo) || producto.modelo.length > 25) {
      errores.push('El modelo es requerido, debe ser texto alfanumérico y tener 25 caracteres o menos');
    }
  
    // Validar el precio
    if (!producto.precio || parseFloat(producto.precio) <= 99.99) {
      errores.push('El precio es requerido y debe ser mayor a 99.99');
    }
  
    // Validar los detalles
    if (producto.detalles && producto.detalles.length > 250) {
      errores.push('Los detalles son opcionales y, de usarse, deben tener 250 caracteres o menos');
    }
  
    // Validar las unidades
    if (!producto.unidades || parseInt(producto.unidades) < 0) {
      errores.push('Las unidades son requeridas y el número registrado debe ser mayor o igual a 0');
    }
  
    return errores;
  }
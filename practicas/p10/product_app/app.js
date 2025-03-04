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
function buscarProducto(e) {
    e.preventDefault();

    // SE OBTIENE EL TÉRMINO DE BÚSQUEDA
    var searchTerm = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n' + client.responseText);

            // SE OBTIENE EL ARRAY DE PRODUCTOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);

            // SE VERIFICA SI EL ARRAY TIENE DATOS
            if (Array.isArray(productos) && productos.length > 0) {
                // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                let template = '';
                productos.forEach(producto => {
                    // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                    let descripcion = '';
                    descripcion += '<li>precio: ' + producto.precio + '</li>';
                    descripcion += '<li>unidades: ' + producto.unidades + '</li>';
                    descripcion += '<li>modelo: ' + producto.modelo + '</li>';
                    descripcion += '<li>marca: ' + producto.marca + '</li>';
                    descripcion += '<li>detalles: ' + producto.detalles + '</li>';

                    // SE CREA LA FILA DE LA TABLA
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
            } else {
                // SI NO HAY RESULTADOS, SE MUESTRA UN MENSAJE
                document.getElementById("productos").innerHTML = '<tr><td colspan="3">No se encontraron productos.</td></tr>';
            }
        }
    };
    client.send("search=" + searchTerm);
}

function agregarProducto(e) {
    e.preventDefault();

    // SE OBTIENEN LOS DATOS DEL FORMULARIO
    const nombre = document.getElementById('name').value.trim();
    const descripcion = document.getElementById('description').value.trim();

    // SE VALIDA EL JSON
    try {
        const producto = JSON.parse(descripcion);

        // VALIDACIONES
        if (!nombre || nombre.length > 100) {
            alert("El nombre es requerido y debe tener 100 caracteres o menos.");
            return;
        }
        if (!producto.marca || !["Sony", "Samsung", "Apple", "LG", "Xiaomi"].includes(producto.marca)) {
            alert("La marca es requerida y debe seleccionarse de la lista de opciones.");
            return;
        }
        if (!producto.modelo || producto.modelo.length > 25) {
            alert("El modelo es requerido y debe tener 25 caracteres o menos.");
            return;
        }
        if (!producto.precio || parseFloat(producto.precio) <= 99.99) {
            alert("El precio es requerido y debe ser mayor a 99.99.");
            return;
        }
        if (producto.detalles && producto.detalles.length > 250) {
            alert("Los detalles deben tener 250 caracteres o menos.");
            return;
        }
        if (!producto.unidades || parseInt(producto.unidades) < 0) {
            alert("Las unidades son requeridas y deben ser mayores o iguales a 0.");
            return;
        }
        if (!producto.imagen) {
            producto.imagen = "http://localhost/tecweb/practicas/p09/img/imagen.png"; // Imagen por defecto
        }

        // SE AGREGA EL NOMBRE AL JSON
        producto.nombre = nombre;

        // SE ENVÍA EL JSON AL SERVIDOR
        const client = getXMLHttpRequest();
        client.open('POST', './backend/create.php', true);
        client.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
        client.onreadystatechange = function () {
            if (client.readyState == 4 && client.status == 200) {
                const respuesta = JSON.parse(client.responseText);
                alert(respuesta.mensaje); // MUESTRA EL MENSAJE DEL SERVIDOR
            }
        };
        client.send(JSON.stringify(producto));
    } catch (error) {
        alert("El JSON proporcionado no es válido.");
    }
}

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
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
    // CONVIERTE EL JSON A STRING PARA MOSTRARLO EN EL FORMULARIO
    var JsonString = JSON.stringify(baseJSON, null, 2);
    document.getElementById("description").value = JsonString;

    // ASIGNA LA FUNCIÓN buscarProducto AL BOTÓN DE BÚSQUEDA
    document.querySelector('button[type="submit"]').onclick = buscarProducto;
}
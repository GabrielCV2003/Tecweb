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
    var searchTerm = document.getElementById('search').value.trim();

    if (!searchTerm) {
        alert("Ingrese un término de búsqueda.");
        return;
    }

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n' + client.responseText);

            let productos = JSON.parse(client.responseText);

            if (Array.isArray(productos) && productos.length > 0) {
                let template = '';
                productos.forEach(producto => {
                    let descripcion = `
                        <li>Precio: ${producto.precio}</li>
                        <li>Unidades: ${producto.unidades}</li>
                        <li>Modelo: ${producto.modelo}</li>
                        <li>Marca: ${producto.marca}</li>
                        <li>Detalles: ${producto.detalles}</li>
                    `;

                    template += `
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;
                });

                document.getElementById("productos").innerHTML = template;
            } else {
                document.getElementById("productos").innerHTML = '<tr><td colspan="3">No se encontraron productos.</td></tr>';
            }
        }
    };
    client.send("search=" + encodeURIComponent(searchTerm));
}

function agregarProducto(e) {
    e.preventDefault();

    const nombre = document.getElementById('name').value.trim();
    const descripcion = document.getElementById('description').value.trim();

    try {
        const producto = JSON.parse(descripcion);
        let errores = [];

        if (!nombre || nombre.length > 100) {
            errores.push("El nombre es requerido y debe tener 100 caracteres o menos.");
        }

        const marcasValidas = ["Sony", "Microsoft", "Nintendo", "Otras"];
        if (!producto.marca || !marcasValidas.includes(producto.marca)) {
            errores.push("La marca debe ser Sony, Microsoft, Nintendo o Otras.");
        }

        if (!producto.modelo || producto.modelo.length > 25 || !/^[A-Za-z0-9]+$/.test(producto.modelo)) {
            errores.push("El modelo es requerido, debe tener 25 caracteres o menos y solo contener letras y números.");
        }

        if (!producto.precio || parseFloat(producto.precio) <= 99.99) {
            errores.push("El precio es requerido y debe ser mayor a 99.99.");
        }

        if (producto.detalles && producto.detalles.length > 250) {
            errores.push("Los detalles deben tener 250 caracteres o menos.");
        }

        if (!producto.unidades || parseInt(producto.unidades) < 0) {
            errores.push("Las unidades deben ser mayores o iguales a 0.");
        }

        if (!producto.imagen) {
            producto.imagen = "img/default.png";
        }

        if (errores.length > 0) {
            alert("Errores:\n\n" + errores.join("\n"));
            return;
        }

        producto.nombre = nombre;

        const client = getXMLHttpRequest();
        client.open('POST', './backend/create.php', true);
        client.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');

        const datosJSON = JSON.stringify(producto);
        console.log("Enviando JSON:", datosJSON); 

        client.onreadystatechange = function () {
            if (client.readyState == 4) {
                console.log("Respuesta del servidor:", client.responseText); 
                if (client.status == 200) {
                    const respuesta = JSON.parse(client.responseText);
                    alert(respuesta.mensaje || respuesta.error);
                } else {
                    alert("Error en la solicitud: " + client.status);
                }
            }
        };
        client.send(datosJSON);
    } catch (error) {
        alert("El JSON proporcionado no es válido.");
    }
}

// FUNCIÓN PARA OBTENER UNA INSTANCIA DE XMLHttpRequest
function getXMLHttpRequest() {
    var objetoAjax;
    try {
        objetoAjax = new XMLHttpRequest();
    } catch (err1) {
        try {
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (err2) {
            try {
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (err3) {
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

// FUNCIÓN QUE INICIALIZA EL FORMULARIO CON EL JSON BASE
function init() {
    document.getElementById("description").value = JSON.stringify(baseJSON, null, 2);
    document.querySelector('button[type="submit"]').onclick = buscarProducto;
}

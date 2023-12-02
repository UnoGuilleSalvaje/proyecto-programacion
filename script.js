document.addEventListener("DOMContentLoaded", function () {
    cargarProductos();

    document.getElementById("formulario-producto").addEventListener("submit", function (event) {
        event.preventDefault();
        agregarProducto();
    });
});

function cargarProductos() {
    const listaProductos = document.getElementById("productos-lista");

    // Limpia la lista antes de cargar los productos
    listaProductos.innerHTML = "";

    // Realiza una solicitud AJAX para obtener los productos desde el servidor
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "productos.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            const productos = JSON.parse(xhr.responseText);

            productos.forEach(function (producto) {
                const listItem = document.createElement("li");
                listItem.textContent = `${producto.nombre} - $${producto.precio.toFixed(2)}`;

                const deleteButton = document.createElement("button");
                deleteButton.textContent = "Eliminar";
                deleteButton.addEventListener("click", function () {
                    eliminarProducto(producto.id);
                });

                listItem.appendChild(deleteButton);
                listaProductos.appendChild(listItem);
            });
        }
    };
    xhr.send();
}

function agregarProducto() {
    const nombre = document.getElementById("nombre").value;
    const precio = document.getElementById("precio").value;

    // Realiza una solicitud AJAX para agregar un nuevo producto
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "agregar_producto.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert(JSON.parse(xhr.responseText).message);
            cargarProductos();
        }
    };
    xhr.send(`nombre=${nombre}&precio=${precio}`);
}

function eliminarProducto(id) {
    // Realiza una solicitud AJAX para eliminar un producto
    const xhr = new XMLHttpRequest();
    xhr.open("DELETE", `eliminar_producto.php?id=${id}`, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert(JSON.parse(xhr.responseText).message);
            cargarProductos();
        }
    };
    xhr.send();
}

function logout() {
    // Realiza una solicitud AJAX para cerrar la sesión
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "logout.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert(JSON.parse(xhr.responseText).message);
            window.location = "index.php";
        }
    };
    xhr.send();
}

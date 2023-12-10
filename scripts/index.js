const btnCart = document.querySelector('.container-cart-icon');
const containerCartProducts = document.querySelector(
	'.container-cart-products'
);

btnCart.addEventListener('click', () => {
	containerCartProducts.classList.toggle('hidden-cart');
});

/* ========================= */
const cartInfo = document.querySelector('.cart-product');
const rowProduct = document.querySelector('.row-product');

// Lista de todos los contenedores de productos
const productsList = document.querySelector('.container-items');

// Variable de arreglos de Productos
let allProducts = [];

const valorTotal = document.querySelector('.total-pagar');

const countProducts = document.querySelector('#contador-productos');

const cartEmpty = document.querySelector('.cart-empty');
const cartTotal = document.querySelector('.cart-total');


productsList.addEventListener('click', e => {
    if (e.target.classList.contains('btn-add-cart')) {
        // Acceder al contenedor del producto que tiene el atributo data-cantidad-existencia
        const productContainer = e.target.closest('.item');

        // Verificar que el contenedor del producto fue encontrado
        if (!productContainer) {
            console.error('Contenedor del producto no encontrado');
            return;
        }

        // Obtener la cantidad en existencia
        const cantidadExistencia = parseInt(productContainer.getAttribute('data-cantidad-existencia'));

        // Corregir la referencia a productContainer en lugar de product
        const priceText = productContainer.querySelector('p.price').textContent;
        const priceNumber = parseFloat(priceText.replace(/[^0-9.]/g, ''));

        const infoProduct = {
            quantity: 1,
            title: productContainer.querySelector('h2').textContent,
            price: priceNumber,
            available: cantidadExistencia // Agrega la cantidad disponible
        };

        const exits = allProducts.some(product => product.title === infoProduct.title);

        if (exits) {
            const products = allProducts.map(product => {
                if (product.title === infoProduct.title) {
                    // Verifica si la cantidad agregada no supera la cantidad en existencia
                    if (product.quantity < product.available) {
                        product.quantity++;
                    } else {
                        // Aquí puedes mostrar una alerta o mensaje indicando que no hay suficiente stock
                        console.log('No hay suficiente stock para agregar más de este producto.');
                    }
                    return product;
                } else {
                    return product;
                }
            });
            allProducts = [...products];
        } else {
            // Verifica si hay stock disponible antes de agregar el producto por primera vez
            if (infoProduct.available > 0) {
                allProducts = [...allProducts, infoProduct];
            } else {
                // Mostrar mensaje de que no hay stock
                console.log('No hay stock disponible para este producto.');
            }
        }
        showHTML();
    }
});

rowProduct.addEventListener('click', e => {
	if (e.target.classList.contains('icon-close')) {
		const product = e.target.parentElement;
		const title = product.querySelector('p').textContent;

		allProducts = allProducts.filter(
			product => product.title !== title
		);

		console.log(allProducts);

		showHTML();
	}
});

// Funcion para mostrar  HTML
const showHTML = () => {
	if (!allProducts.length) {
		cartEmpty.classList.remove('hidden');
		rowProduct.classList.add('hidden');
		cartTotal.classList.add('hidden');
	} else {
		cartEmpty.classList.add('hidden');
		rowProduct.classList.remove('hidden');
		cartTotal.classList.remove('hidden');
	}

	// Limpiar HTML
	rowProduct.innerHTML = '';

	let total = 0;
	let totalOfProducts = 0;

	allProducts.forEach(product => {
		const containerProduct = document.createElement('div');
		containerProduct.classList.add('cart-product');

		containerProduct.innerHTML = `
            <div class="info-cart-product">
                <span class="cantidad-producto-carrito">${product.quantity}</span>
                <p class="titulo-producto-carrito">${product.title}</p>
                <span class="precio-producto-carrito">${product.price}</span>
            </div>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="icon-close"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>
        `;

		rowProduct.append(containerProduct);

		// Calcula el total utilizando el precio como número
		total += product.quantity * product.price;
		totalOfProducts += product.quantity;

	});

	valorTotal.innerText = `$${total.toFixed(2)}`;
	countProducts.innerText = totalOfProducts;
};


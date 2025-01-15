const bar = document.getElementById('bar');
const close = document.getElementById('close');
const navbar = document.getElementById('navbar');
if (bar) {
    bar.addEventListener('click', () => {
        navbar.classList.add('active');
    });
}
if (close) {
    close.addEventListener('click', () => {
        navbar.classList.remove('active');
    });
}

let cardNumInput = document.querySelector('#cardNum');
cardNumInput.addEventListener('keyup', () => {
    let cNumber = cardNumInput.value;
    cNumber = cNumber.replace(/\s/g, "");

    if (Number(cNumber)) {
        cNumber = cNumber.match(/.{1,4}/g);
        cNumber = cNumber.join(" ");
        cardNumInput.value = cNumber;
    }
});

// JavaScript for Cart Management
document.addEventListener("DOMContentLoaded", function () {
    loadCart();

    document.querySelectorAll(".add-to-cart").forEach(button => {
        button.addEventListener("click", function () {
            let product = this.dataset.product;
            let price = this.dataset.price;
            addToCart(product, price);
        });
    });
});

function addToCart(product, price) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    let existingItem = cart.find(item => item.product === product);

    if (existingItem) {
        existingItem.quantity++;
    } else {
        cart.push({ product, price, quantity: 1 });
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    loadCart();
}

function removeFromCart(index) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    cart.splice(index, 1);
    localStorage.setItem("cart", JSON.stringify(cart));
    loadCart();
}

function loadCart() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    let cartTable = document.querySelector("#cart tbody");
    cartTable.innerHTML = "";

    cart.forEach((item, index) => {
        let row = `
            <tr>
                <td><button onclick="removeFromCart(${index})">X</button></td>
                <td><img src="../clotes/4.jpg" alt=""></td>
                <td>${item.product}</td>
                <td>${item.price}$</td>
                <td>${item.quantity}</td>
                <td>${item.price * item.quantity}$</td>
            </tr>
        `;
        cartTable.innerHTML += row;
    });
}

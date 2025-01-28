fetch('item.json').then(response => response.json())
.then(data => {
    const pro_continer = document.getElementById('pro_continer');
    all_products_json=data

    data.forEach(products => {
        const new_price = Math.floor((products.old_price - products.price) / products.old_price * 100);
        pro_continer.innerHTML += `
        <div class="products" id="products"
        onclick="window.location.href='single_product.php';">
            <img src="${products.img_src}" alt="">
            <div class="product-dec">
                <span>${products.name}</span>
                <h5> ${products.description} </h5>
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h4>${products.price}$</h4>
                <h4><del>${products.old_price}$</del></h4>
                <h4>${new_price}% Off</h4>
            </div>
            <a><i onclick="addToCart(${products.id},this)" class="fas fa-cart-plus"></i></a>
        </div> 
        `;
    });
});

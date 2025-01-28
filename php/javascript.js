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

var all_products_json;
var items_in_cart=document.getElementById("cart");
let product_cart =[];
function addToCart(id,btn){
    product_cart.push(all_products_json[id])
    btn.classList.add("active")
    console.log(id);
    getcartitem()

}
function getcartitem(){
    let item_c="";
    for(i=0;i<product_cart.length;i++){
        item_c +=`
    <table width="100%">
       
        <tbody>
            <tr>
                <td>
                   <a href=""><i class="far fa-times-circle"></i></a> 
                </td>
                <td>
                    <img src="${products.img_src}" alt="">
                </td>
                <td>
                    hody t-shirt
                </td>
                <td>
                    15$
                </td>
                <td>
                    <input type="namber" value="1">
                </td>
                <td>
                    15$
                </td>
            </tr>
            <tr>
                <td>
                   <a href=""><i class="far fa-times-circle"></i></a> 
                </td>
                <td>
                    <img src="../clotes/4.jpg" alt="">
                </td>
                <td>
                    hody t-shirt
                </td>
                <td>
                    15$
                </td>
                <td>
                    <input type="namber" value="1">
                </td>
                <td>
                    15$
                </td>
            </tr>
            <tr>
                <td>
                   <a href=""><i class="far fa-times-circle"></i></a> 
                </td>
                <td>
                    <img src="../clotes/4.jpg" alt="">
                </td>
                <td>
                    hody t-shirt
                </td>
                <td>
                    15$
                </td>
                <td>
                    <input type="namber" value="1">
                </td>
                <td>
                    15$
                </td>
            </tr>
        </tbody>

    </table>
        `
        
        cart.innerHTML=item_c;

    }
}

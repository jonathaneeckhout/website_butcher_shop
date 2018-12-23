var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var myObj = JSON.parse(this.responseText);
        for (product in myObj) {

            var newProduct = document.createElement('div');
            newProduct.className = 'product';

            var newProductHeader = document.createElement('h2');
            newProductHeader.innerHTML = myObj[product]['productTitle'];
            newProduct.appendChild(newProductHeader);

            var newProductImg = document.createElement('img');
            newProductImg.src = '../images/' + myObj[product]['productImage'];
            newProduct.appendChild(newProductImg);

            var newProductCont = document.createElement('p');
            newProductCont.innerHTML = myObj[product]['productCont'];;
            newProduct.appendChild(newProductCont);

            var newProductPrice = document.createElement('p');
            newProductPrice.id = 'productPrice';
            newProductPrice.innerHTML = myObj[product]['productPrice'] + ' ' + myObj[product]['productPriceUnit'];
            newProduct.appendChild(newProductPrice);

            document.getElementById('myProducts').appendChild(newProduct);
        }
    }
};
xmlhttp.open("GET", "../php/product_getter.php", true);
xmlhttp.send();

function removeAllProducts() {
    var products = document.getElementById('myProducts');
    while (products.firstChild) {
        products.removeChild(products.firstChild);
    }
}

function searchProduct() {
    removeAllProducts();
}

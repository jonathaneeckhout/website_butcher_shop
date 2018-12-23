var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var myObj = JSON.parse(this.responseText);
        for (service in myObj) {

            var newservice = document.createElement('div');
            newservice.className = 'product';

            var newserviceHeader = document.createElement('h2');
            newserviceHeader.innerHTML = myObj[service]['serviceTitle'];
            newservice.appendChild(newserviceHeader);

            var newserviceImg = document.createElement('img');
            newserviceImg.src = '../images/' + myObj[service]['serviceImage'];
            newservice.appendChild(newserviceImg);

            var newserviceCont = document.createElement('p');
            newserviceCont.innerHTML = myObj[service]['serviceCont'];;
            newservice.appendChild(newserviceCont);

            var newservicePrice = document.createElement('p');
            newservicePrice.id = 'productPrice';
            newservicePrice.innerHTML = myObj[service]['servicePrice'] + ' ' + myObj[service]['servicePriceUnit'];
            newservice.appendChild(newservicePrice);

            document.getElementById('myServices').appendChild(newservice);
        }
    }
};

function removeAllservices() {
    var services = document.getElementById('myServices');
    while (services.firstChild) {
        services.removeChild(services.firstChild);
    }
}

function searchService() {
    removeAllservices();
    var searchValue = document.getElementById('searchValue').value;
    xmlhttp.open("GET", "../php/service_getter.php?method=search&query=" + searchValue, true);
    xmlhttp.send();
}

function filterService() {
    removeAllservices();
    var filterFields = document.getElementsByClassName('filterField');
    var query = '';
    var i;
    var j = 0;
    for (i = 0; i < filterFields.length; i++) {
        if(filterFields[i].checked) {
            if(j == 0) {
                query = filterFields[i].value;
            } else {
                query = query + ',' + filterFields[i].value;
            }
            j++;
        }
    }
    xmlhttp.open("GET", "../php/service_getter.php?method=filter&query=" + query, true);
    xmlhttp.send();
}

var input = document.getElementById("searchValue");

input.addEventListener("keyup", function(event) {

    event.preventDefault();

    if (event.keyCode === 13) {
        searchService();
    }
});

xmlhttp.open("GET", "../php/service_getter.php", true);
xmlhttp.send();

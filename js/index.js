document.getElementById('search').onfocus = function() {
    document.getElementById('search_icon').style.right = '18vw';
}

document.getElementById('search').onblur = function() {
    document.getElementById('search_icon').style.right = '15vw';
}

function postAjax(url, data, success) {
    var params = typeof data == 'string'
        ? data
        : Object.keys(data).map(function(k) {
            return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
        }).join('&');

    var xhr = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST', url);
    xhr.onreadystatechange = function() {
        if (xhr.readyState > 3 && xhr.status == 200) {
            success(xhr.responseText);
        }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(params);
    return xhr;
}

document.getElementById("search").addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode == 13) {
        var pathArray = window.location.pathname.split("/");
        var searchType = '';
        if (pathArray[pathArray.length - 2] == 'category') {
            searchType = pathArray.pop() + '/';
        }
        postAjax(searchType + 'search', {
            search_query: "%" + document.getElementById("search").value + "%"
        }, function(data) {
            var jsonData = JSON.parse(data);
            document.getElementById("main_row").innerHTML = '<a href="./category/new_category"><div class="tile col-md-3 create_new"><h3>create New</h3></div></a>'
            for (var i = 0; i < jsonData.length; i++) {
                console.log(jsonData[i]);
                document.getElementById("main_row").innerHTML += '<a href="./category/' + parseInt(jsonData[i].id) + '"><div class="tile col-md-3"><h3>' + jsonData[i].name + '</h3></div></a>'

            }
        });
    }
});

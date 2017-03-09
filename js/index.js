document.getElementById('search').onfocus = function() {
  document.getElementById('search_icon').style.right = '18vw';
}

document.getElementById('search').onblur = function() {
  document.getElementById('search_icon').style.right = '15vw';
}

function postAjax(url, data, success) {
  var params = typeof data == 'string' ? data : Object.keys(data).map(
          function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
      ).join('&');

  var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
  xhr.open('POST', url);
  xhr.onreadystatechange = function() {
      if (xhr.readyState>3 && xhr.status==200) { success(xhr.responseText); }
  };
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send(params);
  return xhr;
}

document.getElementById("search").addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode == 13 && document.getElementById("search").value != "") {
        postAjax('./search', "ads", function(data){ console.log(data); });
        //wyciagnac dane z bazy - id
        //pokazywać tylko te z id które jest w tablicy
    }
});

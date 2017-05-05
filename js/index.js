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
if (document.getElementById('delete_button') != null) {
    document.getElementById('delete_button').onclick = function() {
        if (confirm('Are you sure?')) {
            return true;
        } else {
            return false;
        }
    }
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
            var render_type = 'tile';
            var heading_type = 3
            if(jsonData[0].category_id != null){
              render_type = 'list_item';
              heading_type = 4
            }
            document.getElementById("main_row").innerHTML = '<a href="./category/new_category"><div class="'+render_type+' col-md-3 create_new"><h'+(heading_type)+'>create New</h'+(heading_type)+'></div></a>'
            for (var i = 0; i < jsonData.length; i++) {
                document.getElementById("main_row").innerHTML += '<div class="'+render_type+' col-md-3" onclick="expandList(this)"><div class="col-md-10"><h'+(heading_type+1)+'>' + jsonData[i].name + '</h'+(heading_type+1)+'><span class="details"><div class="col-md-3"><strong>facebook:</strong> ' + jsonData[i].facebook + '<br><strong>webpage:</strong> ' + jsonData[i].webpage + '</div><div class="col-md-3"><strong>email:</strong> ' + jsonData[i].email +
                '<br><strong>phone:</strong> '+jsonData[i].phone+'}</div><div class="col-md-3"><strong>additional:</strong> ' + jsonData[i].additional + '<br></div></span></div><div class="col-md-2"><a href="../../' + parseInt(jsonData[i].category_id) + '/contact/' + parseInt(jsonData[i].id) + '" class="edit_btn"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></div></div>'
            }
        });
    }
});

document.body.onload = function() {
    appendField();
}

function expandList(el){
  el.classList.toggle('expand_list')
  el.getElementsByClassName('details')[0].classList.toggle("show_details")


}

function selectIcon(element) {
    console.log(element.getAttribute("data"))
    document.getElementById("icon-input").value = element.getAttribute("data");
}
function appendField() {
    var fontAwesome = '["fa-address-card-o","fa-adjust","fa-ambulance","fa-anchor","fa-android","fa-angellist","fa-arrows-v","fa-assistive-listening-systems","fa-audio-description","fa-backward","fa-balance-scale","fa-barcode","fa-bars","fa-bath","fa-battery-full","fa-bed","fa-beer","fa-behance","fa-bell","fa-bell-o","fa-bell-slash","fa-bell-slash-o","fa-bicycle","fa-binoculars","fa-birthday-cake","fa-black-tie","fa-blind","fa-book","fa-briefcase","fa-btc","fa-bug","fa-building","fa-calculator","fa-calendar","fa-calendar-check-o","fa-calendar-minus-o","fa-calendar-o","fa-calendar-plus-o","fa-calendar-times-o","fa-camera","fa-camera-retro","fa-car","fa-chrome","fa-circle","fa-circle-o","fa-clipboard","fa-clock-o","fa-clone","fa-cloud","fa-code","fa-coffee","fa-cog","fa-cogs","fa-compass","fa-compress","fa-connectdevelop","fa-contao","fa-copyright","fa-creative-commons","fa-credit-card","fa-credit-card-alt","fa-crop","fa-crosshairs","fa-css3","fa-cube","fa-cubes","fa-cutlery","fa-dashcube","fa-database","fa-deaf","fa-delicious","fa-desktop","fa-deviantart","fa-diamond","fa-digg","fa-dot-circle-o","fa-download","fa-dribbble","fa-dropbox","fa-drupal","fa-edge","fa-eercast","fa-eject","fa-ellipsis-h","fa-ellipsis-v","fa-empire","fa-envelope","fa-envelope-o","fa-envelope-open","fa-envelope-open-o","fa-envelope-square","fa-envira","fa-eraser","fa-etsy","fa-eur","fa-exchange","fa-exclamation","fa-exclamation-circle","fa-exclamation-triangle","fa-expand","fa-expeditedssl","fa-external-link","fa-heartbeat","fa-history","fa-home","fa-hospital-o","fa-hourglass","fa-hourglass-end","fa-hourglass-half","fa-hourglass-o","fa-hourglass-start","fa-houzz","fa-html5","fa-i-cursor","fa-id-badge","fa-id-card","fa-id-card-o","fa-ils","fa-imdb","fa-inbox","fa-indent","fa-industry","fa-info","fa-info-circle","fa-inr","fa-instagram","fa-internet-explorer","fa-ioxhost","fa-italic","fa-joomla","fa-jpy","fa-jsfiddle","fa-key","fa-keyboard-o","fa-krw","fa-language","fa-laptop","fa-lastfm","fa-lastfm-square","fa-leaf","fa-leanpub","fa-lemon-o","fa-level-down","fa-level-up","fa-life-ring","fa-lightbulb-o","fa-line-chart","fa-link","fa-linkedin","fa-linkedin-square","fa-linode","fa-linux","fa-list","fa-list-alt","fa-list-ol","fa-list-ul","fa-location-arrow","fa-lock","fa-long-arrow-down","fa-long-arrow-left","fa-long-arrow-right","fa-long-arrow-up","fa-low-vision","fa-magic","fa-magnet","fa-male","fa-map","fa-map-marker","fa-map-o"]'

    var parsedIconArray = JSON.parse(fontAwesome)
    if (document.getElementById('icon-chooser') != null) {
        for (var i = 0; i < parsedIconArray.length; i++) {
            document.getElementById('icon-chooser').innerHTML += ('<i onclick="selectIcon(this)" data=' + parsedIconArray[i] + ' class="icon-select fa ' + parsedIconArray[i] + ' fa-2x"></i>');
        }

    }

};

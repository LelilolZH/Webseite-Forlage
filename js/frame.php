function contentLoader() {
    var objectLoader = ".app-loader";
    var object = document.querySelectorAll(objectLoader);
    for (var i = 0; i < object.length; i++) {
        var href = object[i].dataset.src;
        if (href === undefined) {
            continue;
        } else {
            requestAndSafe(href, object, i);
        }
    }
}

function requestAndSafe(href, object, i) {
    var req = new XMLHttpRequest();
    req.open("GET", href, true);
    req.onload = function () {
        var res = this.responseText;
        object[i].innerHTML = res;
        linkLoader();
    };
    req.onerror = function () {};
    req.send();
}

function linkLoader() {
    var objectLoader = ".app-link";
    var object = document.querySelectorAll(objectLoader);
    for (var i = 0; i < object.length; i++) {
        var href = object[i].getAttribute("href");
        if (href === undefined) {
            continue;
        } else {
            object[i].setAttribute("onclick", "appRedirect('" + href + "');return false;");
        }
    }
}

function appRedirect(href) {
    var object = document.querySelectorAll(".app-main");
    var i = 0;
    href = "/ajax/req/" + href;
    requestAndSafe(href, object, i);
    return false;
}

contentLoader();
linkLoader();

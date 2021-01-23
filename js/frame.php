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

function requestAndSafe(href, object, i) {
    var req = new XMLHttpRequest();
    req.open("GET", href, true);
    req.onload = function () {
        var res = this.responseText;
        object[i].innerHTML = res;
    };
    req.onerror = function () {};
    req.send();
}

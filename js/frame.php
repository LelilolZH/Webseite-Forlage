var currentLocation = "";

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
    fadeOut();
    var req = new XMLHttpRequest();
    req.open("GET", href, true);
    req.onload = function () {
        var res = this.responseText;
        object[i].innerHTML = res;
        linkLoader();
        lazyLoadInstance.update();
        setTimeout(function () {
            fadeIn();
        }, 500);
    };
    req.onerror = function () {
        wifi_error_handler();
    };
    setTimeout(function () {
        req.send();
    }, 300);
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
    //show info
    window.currentLocation = href;
    window.history.pushState("", "", "/" + href);
    //change css
    filterCss(href);
    //and redirect
    href = "/ajax/req/" + href;
    requestAndSafe(href, object, i);
    return false;
}

function appRedirect_silent(href) {
    var object = document.querySelectorAll(".app-main");
    var i = 0;
    //show info
    window.currentLocation = href;
    //change css
    filterCss(href);
    //and redirect
    href = "/ajax/req/" + href;
    requestAndSafe(href, object, i);
    return false;
}

function verifyLocation() {
    var json = window.links;
    var res = 0;
    json.forEach((e) => {
        if (document.location.pathname === "/" + e) {
            appRedirect(e);
            res++;
        }
    });
    if (res === 0) {
        appRedirect(window.links[0]);
    }
}

function filterCss(href) {
    var objectLoader = ".single-css";
    var object = document.querySelectorAll(objectLoader);
    for (var i = 0; i < object.length; i++) {
        var src = object[i].dataset.enable;
        if (src === undefined) {
            continue;
        } else {
            if (src === href) {
                object[i].disabled = false;
            } else {
                object[i].disabled = true;
            }
        }
    }
}

contentLoader();
linkLoader();
verifyLocation();

//window referer callback

window.onpopstate = function () {
    if (window.currentLocation === document.location.pathname) {
    } else {
        appRedirect_silent(document.location.pathname);
        window.currentLocation = document.location.pathname;
    }
};

// admin js

function redirectAdmin(href) {
    lazyLoadInstance.update();
    var object = document.querySelectorAll(".app-main");
    var i = 0;
    window.history.pushState("", "", href.replace("/ajax", ""));
    //change css
    filterCss(href);
    requestAndSafe(href, object, i);
    return false;
}

window.addEventListener("keydown", function (e) {
    if (e.ctrlKey && e.altKey) {
        if (e.keyCode == 65 || e.keyCode == 97) {
            var href = "/ajax/admin/";
            redirectAdmin(href);
        }
    }
});

function fadeOut() {
    var obj = document.querySelector(".app-main");
    obj.style.opacity = 0;
    obj.style.pointerEvents = "none";
}

function fadeIn() {
    var obj = document.querySelector(".app-main");
    obj.style.opacity = 1;
    obj.style.pointerEvents = "unset";
}

function wifi_error_handler() {
    small_message("Überprüfe deine Internet Verbindung", "red", "#fff");
}

var countMessage = 0;

function small_message(message, bg, color) {
    window.countMessage++;
    var counter = window.countMessage;
    var outher = document.querySelector(".app-message");
    var obj = document.createElement("div");
    obj.setAttribute("class", "app-boxmessage");
    obj.setAttribute("id", "app-boxmessage-" + counter);

    obj.appendChild(document.createTextNode(message));

    var style = "";
    if (bg !== undefined) {
        style += "background-color: " + bg + " !important;";
    }
    if (color !== undefined) {
        style += "color: " + color + " !important;";
    }
    style += "opacity: 0;";
    obj.setAttribute("style", style);

    outher.appendChild(obj);

    document.querySelector("#app-boxmessage-" + counter).style.opacity = 1;
    setTimeout(function () {
        document.querySelector("#app-boxmessage-" + counter).style.opacity = 0;
        setTimeout(function () {
            document.querySelector("#app-boxmessage-" + counter).outerHTML = "";
        }, 400);
    }, 4000);
}

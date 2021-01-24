var lazyLoadInstance;
window.addEventListener("load", function () {
    document.body.style.display = "block";
    setTimeout(function () {
        document.body.style.opacity = 1;
    }, 200);
});

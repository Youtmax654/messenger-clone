document.addEventListener("DOMContentLoaded", function () {
    var error = document.querySelector(".error");
    var success = document.querySelector(".success");
    var errorElement = document.querySelector(".error");
    var successElement = document.querySelector(".success");

    setTimeout(function () {
        if (errorElement) {
            errorElement.classList.add("hidden");
        }
        if (successElement) {
            successElement.classList.add("hidden");
        }
    }, 5000);

    var progressBar = document.getElementById("myBar");

    function animateProgressBar() {
        var width = 100;
        var interval = setInterval(function () {
            if (width <= 0) {
                clearInterval(interval);
            } else {
                width -= 0.2;
                progressBar.style.width = width + "%";
            }
        }, 10);
    }

    // Lancer l'animation après le chargement de la page
    animateProgressBar();
});
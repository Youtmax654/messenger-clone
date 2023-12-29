document.addEventListener('DOMContentLoaded', function () {
    var UserProfile = document.getElementById('Profile');
    var ProfileMenu = document.getElementById('ProfileMenu');

    UserProfile.addEventListener("click", function () {
        ProfileMenu.classList.toggle("hidden");
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var button = document.querySelector('.button');

    button.addEventListener("click", function () {
        window.location.replace("utils/disconnect.php");
    });
});
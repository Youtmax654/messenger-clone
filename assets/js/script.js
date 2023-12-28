document.addEventListener('DOMContentLoaded', function() {
    var UserProfile = document.getElementById('Profile');
    var ProfileMenu = document.getElementById('ProfileMenu');

    UserProfile.addEventListener("click", function() {
        ProfileMenu.classList.toggle("hidden");
    });
});
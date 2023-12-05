document.addEventListener('DOMContentLoaded', function() {
    var closeButtons = document.querySelectorAll('.btn-close');

    closeButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var notification = this.parentElement;
            notification.style.display = 'none';
        });
    });
});
setTimeout(() => {
    $(".notification-toast").hide();
}, 3000);

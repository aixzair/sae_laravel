const buttons = document.getElementsByClassName('buttonRoute');

for (var i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener('click', function() {
        window.location.href = this.getAttribute('data-route');
    });
}
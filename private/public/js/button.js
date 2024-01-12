const buttonsRoute = document.getElementsByClassName('buttonRoute');
const buttonsBack = document.getElementsByClassName('buttonBack');

for (let i = 0; i < buttonsRoute.length; i++) {
    buttonsRoute[i].addEventListener('click', function() {
        window.location.href = this.getAttribute('data-route');
    });
}

for (let i = 0; i < buttonsBack.length; i++) {
    buttonsBack[i].addEventListener('click', function() {
        window.history.back();
    });
}

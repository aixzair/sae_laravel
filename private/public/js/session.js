const SESSION_DATE = document.getElementById('addSessionDate');
const SESSION_HOUR = document.getElementById('sessionHour');

SESSION_DATE.min = new Date().toISOString().split('T')[0];

function check() {
    const date = new Date(SESSION_DATE.value);

    if (date.getDay() === 0 && SESSION_HOUR.value != "morning") {
        alert("Le dimanche vous pouvez plannifier une plongée seulement le diamche matin");
        return false;
    }

    return true;
}
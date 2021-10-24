function openPopup() {
    document.getElementsByTagName("body")[0].style.backgroundColor = "black";
    document.getElementById("myPopup").style.display = "block";
}

function closePopup() {
    document.getElementsByTagName("body")[0].style.backgroundColor = "white";
    document.getElementById("myPopup").style.display = "none";
}

function openThanksPopup() {
    document.getElementById("thanksPopup").style.display = "block";
}

function closeThanksPopup() {
    document.getElementById("thanksPopup").style.display = "none";
}

function openWrongNumberPopup() {
    document.getElementById("wrongNumberPopup").style.display = "block";
}

function closeWrongNumberPopup() {
    document.getElementById("wrongNumberPopup").style.display = "none";
}

function handlePhoneInput(e) {
    e.target.value = phoneMask(e.target.value);
}

function phoneMask(phone) {
    return phone.replace(/\D/g, '')  // оставляем только цифры
        .replace(/^(\d)/, '+7 (') //берем только цифру и перед ней ставим +7 (
        .replace(/^\+7 (\(\d{3})(\d)/, '+7 $1) $2') // берем цифры и делаем первую группу в скобках
        .replace(/(\d{3})(\d{1,2})/, '$1-$2') // делаем первую пару цифр после -
        .replace(/(-\d{2})(\d{1,2})/, '$1-$2');  // и вторую пару цифр
}

// Подставляем +7 ( при клике на поле для номера телефона
function addFirstNumber(e) {
    e.target.value = '+7 (';
}

let phone = document.getElementById('phone');
let form = document.getElementsByTagName("form")[0];

phone.addEventListener('click', addFirstNumber);
phone.addEventListener('input', handlePhoneInput);

form.onsubmit = function(evt) {
    // проверяем число символов в номере телефона
    if (phone.value.length == 18) {
        evt.preventDefault();      

        // отправляем данные в php 
        let formData = new FormData(document.forms.webform);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/action.php");
        xhr.send(formData);
        xhr.onload = function() {
            document.forms.webform.reset();
            openThanksPopup();
        };
    } else {
        evt.preventDefault();
        openWrongNumberPopup();
    }
};


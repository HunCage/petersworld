/* Form Validation */
const form = document.getElementsByClassName("postForm");
const username = document.getElementById("username");
const email = document.getElementById("email");
const password = document.getElementById("password");
const submit = document.getElementById("submit");
const textUser = document.querySelector(".textUser");
const textEmail = document.querySelector(".textEmail");
const textPassword = document.querySelector(".textPassword");
const indicatorUser = document.querySelector(".indicatorUser");
const indicatorEmail = document.querySelector(".indicatorEmail");
const indicatorPassword = document.querySelector(".indicatorPassword");

function regValidation() {
    const pattern =
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{1,}))$/;
    const usernameValue = username.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();

    if (usernameValue != "" && usernameValue.length >= 3) {
        username.classList.add("valid");
        username.classList.remove("invalid");
        indicatorUser.classList.add("valid");
        indicatorUser.classList.remove("invalid");
        textUser.textContent = "Username is good";
        username.style.color = "#0f0";
    } else {
        username.classList.remove("valid");
        username.classList.add("invalid");
        indicatorUser.classList.remove("valid");
        indicatorUser.classList.add("invalid");
        textUser.textContent = "Benutzername musst mindensten 4 Zeichen sein";
        username.style.color = "#f00";
        return false;
    }

    if (emailValue.match(pattern)) {
        email.classList.add("valid");
        email.classList.remove("invalid");
        indicatorEmail.classList.add("valid");
        indicatorEmail.classList.remove("invalid");
        textEmail.textContent = "email is good";
        email.style.color = "#00ff00";
    } else {
        email.classList.remove("valid");
        email.classList.add("invalid");
        indicatorEmail.classList.remove("valid");
        indicatorEmail.classList.add("invalid");
        textEmail.textContent = "email is Not good";
        email.style.color = "#ff0000";
        return false;
    }

    if (
        passwordValue != "" &&
        passwordValue != 0 &&
        passwordValue.length >= 4 &&
        passwordValue.length <= 32
    ) {
        password.classList.add("valid");
        password.classList.remove("invalid");
        indicatorPassword.classList.add("valid");
        indicatorPassword.classList.remove("invalid");
        textPassword.textContent = "Password is good";
        password.style.color = "#00ff00";
    } else {
        password.classList.remove("valid");
        password.classList.add("invalid");
        indicatorPassword.classList.remove("valid");
        indicatorPassword.classList.add("invalid");
        textPassword.textContent = "Passwort musst mindenstens 6 Zeichen lang sein";
        password.style.color = "#ff0000";
        return false;
    }
    return true;
}

function logValidation() {

    const usernameValue = username.value.trim();
    const passwordValue = password.value.trim();

    if (usernameValue != "" && usernameValue.length >= 3) {
        username.classList.add("valid");
        username.classList.remove("invalid");
        indicatorUser.classList.add("valid");
        indicatorUser.classList.remove("invalid");
        textUser.textContent = "Username is good";
        username.style.color = "#0f0";
    } else {
        username.classList.remove("valid");
        username.classList.add("invalid");
        indicatorUser.classList.remove("valid");
        indicatorUser.classList.add("invalid");
        textUser.textContent = "Username is Not good";
        username.style.color = "#f00";
        return false;
    }

    if (
        passwordValue != "" &&
        passwordValue != 0 &&
        passwordValue.length >= 4 &&
        passwordValue.length <= 32
    ) {
        password.classList.add("valid");
        password.classList.remove("invalid");
        indicatorPassword.classList.add("valid");
        indicatorPassword.classList.remove("invalid");
        textPassword.textContent = "Password is good";
        password.style.color = "#00ff00";
    } else {
        password.classList.remove("valid");
        password.classList.add("invalid");
        indicatorPassword.classList.remove("valid");
        indicatorPassword.classList.add("invalid");
        textPassword.textContent = "Password is Not good";
        password.style.color = "#ff0000";
        return false;
    }
    return true;
}
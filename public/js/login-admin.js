const iconEyes = document.getElementById("ic-eyes");
const passInput = document.getElementById("input-pass");
const btnLoginAsAdmin = document.getElementById("btn-login-as-admin");
const btnLoginAsParticipant = document.getElementById("btn-login-participant");

let isPasswordHidden = true;

iconEyes.addEventListener("click", () => {
    isPasswordHidden = !isPasswordHidden;
    passInput.type = isPasswordHidden ? "password" : "text";
    iconEyes.src = isPasswordHidden
        ? "/assets/icons/ic-eyes-open.svg"
        : "/assets/icons/ic-eyes-close.svg";
});

btnLoginAsAdmin.addEventListener("click", function (event) {
    event.preventDefault();

    const username = document.getElementById("input-username").value;
    const password = document.getElementById("input-pass").value;

    let isValid = true;

    document.getElementById("username-error").style.display = "none";
    document.getElementById("pass-error").style.display = "none";
    document.getElementById("input-username").classList.remove("error");
    document.getElementById("input-pass").classList.remove("error");

    if (!username) {
        document.getElementById("username-error").textContent =
            "Username is required";
        document.getElementById("username-error").style.display = "block";
        document.getElementById("input-username").classList.add("error");
        isValid = false;
    }

    if (!password) {
        document.getElementById("pass-error").textContent =
            "Password is required";
        document.getElementById("pass-error").style.display = "block";
        document.getElementById("input-pass").classList.add("error");
        document
            .getElementById("input-pass")
            .parentElement.classList.add("error");
        isValid = false;
    } else if (password.length < 8) {
        document.getElementById("pass-error").textContent =
            "Password must be at least 8 characters";
        document.getElementById("pass-error").style.display = "block";
        document.getElementById("input-pass").classList.add("error");
        document
            .getElementById("input-pass")
            .parentElement.classList.add("error");
        isValid = false;
    } else {
        document.getElementById("input-pass").classList.remove("error");
        document
            .getElementById("input-pass")
            .parentElement.classList.remove("error");
    }

    if (isValid) {
        console.log("Form is valid, proceed with login...");
        event.preventDefault();
        window.location.href = "/admin/dashboard";
    }
});

btnLoginAsParticipant.addEventListener("click", function (event) {
    window.location.href = "/login";
});

const imgTest = new Image();
imgTest.src = "../../public/assets/icons/ic-eyes-open.svg";
imgTest.onload = () => console.log("Image loaded successfully.");
imgTest.onerror = () => console.error("Failed to load image.");

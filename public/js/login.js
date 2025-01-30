const iconEyes = document.getElementById("ic-eyes");
const passInput = document.getElementById("input-pass");
const btnLogin = document.getElementById("btn-login");
const btnLoginAdmin = document.getElementById("btn-login-admin");

let isPasswordHidden = true;

iconEyes.addEventListener("click", () => {
    isPasswordHidden = !isPasswordHidden;
    passInput.type = isPasswordHidden ? "password" : "text";
    iconEyes.src = isPasswordHidden
        ? "/assets/icons/ic-eyes-open.svg"
        : "/assets/icons/ic-eyes-close.svg";
});

btnLogin.addEventListener("click", function (event) {
    event.preventDefault();

    const teamName = document.getElementById("input-team").value;
    const password = document.getElementById("input-pass").value;

    let isValid = true;

    document.getElementById("team-error").style.display = "none";
    document.getElementById("pass-error").style.display = "none";
    document.getElementById("input-team").classList.remove("error");
    document.getElementById("input-pass").classList.remove("error");

    if (!teamName) {
        document.getElementById("team-error").textContent =
            "Nama team tidak boleh kosong";
        document.getElementById("team-error").style.display = "block";
        document.getElementById("input-team").classList.add("error");
        isValid = false;
    }

    if (!password) {
        document.getElementById("pass-error").textContent =
            "Password tidak boleh kosong";
        document.getElementById("pass-error").style.display = "block";
        document.getElementById("input-pass").classList.add("error");
        document
            .getElementById("input-pass")
            .parentElement.classList.add("error");
        isValid = false;
    } else if (password.length < 8) {
        document.getElementById("pass-error").textContent =
            "Password harus mengandung minimal 8 karakter";
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
        window.location.href = "/user/dashboard";
    }
});

btnLoginAdmin.addEventListener("click", function (event) {
    window.location.href = "/login/admin";
});

const imgTest = new Image();
imgTest.src = "../../public/assets/icons/ic-eyes-open.svg";
imgTest.onload = () => console.log("Image loaded successfully.");
imgTest.onerror = () => console.error("Failed to load image.");

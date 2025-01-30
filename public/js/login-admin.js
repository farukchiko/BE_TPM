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

if (localStorage.getItem("isLoggedIn") === "true") {
    window.location.href = "/admin/dashboard";
}

btnLoginAsAdmin.addEventListener("click", async function (event) {
    event.preventDefault();

    const email = document.getElementById("input-email").value;
    const password = document.getElementById("input-pass").value;

    let isValid = true;

    document.getElementById("email-error").style.display = "none";
    document.getElementById("pass-error").style.display = "none";
    document.getElementById("input-email").classList.remove("error");
    document.getElementById("input-pass").classList.remove("error");

    if (!email) {
        document.getElementById("email-error").textContent =
            "Email tidak boleh kosong";
        document.getElementById("email-error").style.display = "block";
        document.getElementById("input-email").classList.add("error");
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
        try {
            const response = await fetch(
                "http://127.0.0.1:8000/api/login-admin",
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        email: email,
                        password: password,
                    }),
                }
            );

            if (!response.ok) {
                console.log(`Error status: ${response.status}`);
                const data = await response.json();
                console.log("Response data:", data);

                if (data.message === "Invalid credentials") {
                    document.getElementById("email-error").textContent =
                        "Invalid email or password.";
                    document.getElementById("email-error").style.display =
                        "block";
                    document.getElementById("pass-error").textContent =
                        "Invalid email or password.";
                    document.getElementById("pass-error").style.display =
                        "block";
                    document
                        .getElementById("input-email")
                        .classList.add("error");
                    document
                        .getElementById("input-eyes")
                        .classList.add("error")
                        .parentElement.classList.add("error");

                    isValid = false;
                } else {
                    alert(data.message || "Login failed.");
                }
            } else {
                const data = await response.json();
                if (data.token) {
                    alert("Login successful!");
                    localStorage.setItem("adminToken", data.token);
                    localStorage.setItem("isLoggedIn", "true");
                    window.location.href = "/admin/dashboard";
                } else {
                    alert(data.message || "Login failed.");
                }
            }
        } catch (error) {
            console.error("Error:", error.message);
            // alert("An error occurred during login. Please try again.");
        }
    }
});

btnLoginAsParticipant.addEventListener("click", function (event) {
    window.location.href = "/login";
});

const imgTest = new Image();
imgTest.src = "../../public/assets/icons/ic-eyes-open.svg";
imgTest.onload = () => console.log("Image loaded successfully.");
imgTest.onerror = () => console.error("Failed to load image.");

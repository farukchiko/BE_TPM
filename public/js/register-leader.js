function validateStep1() {
    const inputs = [
        { id: "leaderName", message: "Nama tidak boleh kosong" },
        { id: "lineId", message: "Line ID tidak boleh kosong" },
        {
            id: "email",
            message: "Masukkan email yang valid seperti user@gmail.com",
            validate: (value) => value.includes("@gmail.com")
        },
        {
            id: "whatsappNumber",
            message: "Nomor Whatsapp harus berupa numerik yang valid",
            validate: (value) => /^\d+$/.test(value)
        },
        { id: "gitId", message: "Github/Gitlab ID tidak boleh kosong" },
    ];

    let isValid = true;

    inputs.forEach(({ id, message, validate }) => {
        const input = document.getElementById(id);
        const parent = input ? input.parentElement : null;

        const errorMessage = parent ? parent.querySelector(".error-message") : null;
        if (errorMessage) errorMessage.style.display = "none";

        if (input && !input.value.trim() && !validate) {
            isValid = false;
            input.classList.add("input-error");

            const error = parent.querySelector(".error-message") || document.createElement("p");
            error.className = "error-message";
            error.innerText = message;
            error.style.display = "block";
            parent.appendChild(error);
        } else if (validate && !validate(input.value.trim())) {
            isValid = false;
            input.classList.add("input-error");

            const error = parent.querySelector(".error-message") || document.createElement("p");
            error.className = "error-message";
            error.innerText = message;
            error.style.display = "block";
            parent.appendChild(error);
        } else {
            if (input) input.classList.remove("input-error");
        }
    });

    return isValid;
}

function validateStep2() {
    let isValid = true;

    const birthPlace = document.getElementById("birthPlace");
    if (!birthPlace.value.trim()) {
        isValid = false;
        birthPlace.classList.add("input-error");
    } else {
        birthPlace.classList.remove("input-error");
    }

    const month = document.getElementById("month");
    const day = document.getElementById("day");
    const year = document.getElementById("year");

    [month, day, year].forEach((input) => {
        if (!input.value.trim()) {
            isValid = false;
            input.classList.add("input-error");
        } else {
            input.classList.remove("input-error");
        }
    });

    const cvInput = document.getElementById("uploadCv");
    const flazzInput = document.getElementById("uploadFlazz");
    const idInput = document.getElementById("uploadId");

    const fileInputs = [
        { id: "uploadCv", message: "CV belum diunggah" },
        { id: "uploadFlazz", message: "Flazz Card belum diunggah" },
        { id: "uploadId", message: "ID Card belum diunggah" },
    ];

    const cvWrapper = cvInput.closest(".upload-cv-wrapper");
    if (cvInput.files.length === 0) {
        isValid = false;
        cvWrapper.classList.add("input-error");
    } else {
        cvWrapper.classList.remove("input-error");
    }

    const flazzWrapper = flazzInput.closest(".upload-flazz-wrapper");
    const idWrapper = idInput.closest(".upload-id-wrapper");

    if (flazzInput.files.length === 0 && idInput.files.length === 0) {
        isValid = false;
        flazzWrapper.classList.add("input-error");
        idWrapper.classList.add("input-error");
    } else {
        flazzWrapper.classList.remove("input-error");
        idWrapper.classList.remove("input-error");
    }

    return isValid;
}

function goToStep(stepNumber) {
    const step1 = document.getElementById("step-1");
    const step2 = document.getElementById("step-2");

    if (stepNumber === 1) {
        step1.classList.add("active");
        step2.classList.remove("active");
    } else if (stepNumber === 2) {
        step1.classList.remove("active");
        step2.classList.add("active");
    }
}

document.getElementById("nextButton").addEventListener("click", function () {
    if (validateStep1()) {
        goToStep(2);
    }
});

document.getElementById("previousButton").addEventListener("click", function () {
    goToStep(1);
});

document.getElementById("register-button").addEventListener("click", function (e) {
    if (!validateStep2()) {
        e.preventDefault();
        goToStep(2);
    } else {
        // Gabungkan nilai tanggal lahir menjadi format YYYY-MM-DD
        const birthDate = `${document.getElementById("year").value}-${document.getElementById("month").value}-${document.getElementById("day").value}`;

        const data = {
            leaderName: document.getElementById("leaderName").value,
            lineId: document.getElementById("lineId").value,
            email: document.getElementById("email").value,
            whatsappNumber: document.getElementById("whatsappNumber").value,
            gitId: document.getElementById("gitId").value,
            birthPlace: document.getElementById("birthPlace").value,
            birthDate: birthDate,
        };

        localStorage.setItem("registerData", JSON.stringify(data));
        window.location.href = "/register-member";
    }
});

document.querySelectorAll('input[type="file"]').forEach((fileInput) => {
    fileInput.addEventListener("change", function () {
        const fileName = this.files[0]?.name || "Tidak ada file yang dipilih";
        const fileLabel = this.nextElementSibling;
        if (fileLabel) {
            fileLabel.textContent = fileName;
            fileLabel.style.color = "#0054A5";
            fileLabel.style.marginRight = "45px";
        }
    });
});

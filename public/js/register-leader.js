document.addEventListener("DOMContentLoaded", function () {
    const storedGroupData = localStorage.getItem("groupData");

    const flazzCardWrapper = document.querySelector(".flazz-wrapper");
    const idCardWrapper = document.querySelector(".id-wrapper");

    if (storedGroupData) {
        const groupData = JSON.parse(storedGroupData);
        console.log("Data yang diambil:", groupData);

        const { team_name, password, is_binusian } = groupData;

        const teamNameDisplay = document.getElementById("teamNameDisplay");
        const passwordDisplay = document.getElementById("passwordDisplay");
        const isBinusianDisplay = document.getElementById("isBinusianDisplay");

        if (teamNameDisplay)
            teamNameDisplay.innerText = team_name || "Nama tim tidak ditemukan";
        if (passwordDisplay)
            passwordDisplay.innerText = password || "Password tidak ditemukan";
        if (isBinusianDisplay)
            isBinusianDisplay.innerText = is_binusian === "1" ? "Yes" : "No";

        const isBinusian = is_binusian === "1";

        if (isBinusian) {
            flazzCardWrapper.style.display = "block";
            idCardWrapper.style.display = "none";
        } else {
            flazzCardWrapper.style.display = "none";
            idCardWrapper.style.display = "block";
        }
    } else {
        console.error("Data tidak ditemukan di localStorage.");
    }
});

function validateStep1() {
    const inputs = [
        { id: "leaderName", message: "Nama tidak boleh kosong" },
        { id: "lineId", message: "Line ID tidak boleh kosong" },
        {
            id: "email",
            message: "Masukkan email yang valid seperti user@gmail.com",
            validate: (value) => value.includes("@gmail.com"),
        },
        {
            id: "whatsappNumber",
            message: "Nomor Whatsapp harus berupa numerik yang valid",
            validate: (value) => /^\d+$/.test(value),
        },
        { id: "gitId", message: "Github/Gitlab ID tidak boleh kosong" },
    ];

    let isValid = true;

    inputs.forEach(({ id, message, validate }) => {
        const input = document.getElementById(id);
        const parent = input ? input.parentElement : null;

        const errorMessage = parent
            ? parent.querySelector(".error-message")
            : null;
        if (errorMessage) errorMessage.style.display = "none";

        if (input && !input.value.trim() && !validate) {
            isValid = false;
            input.classList.add("input-error");

            const error =
                parent.querySelector(".error-message") ||
                document.createElement("p");
            error.className = "error-message";
            error.innerText = message;
            error.style.display = "block";
            parent.appendChild(error);
        } else if (validate && !validate(input.value.trim())) {
            isValid = false;
            input.classList.add("input-error");

            const error =
                parent.querySelector(".error-message") ||
                document.createElement("p");
            error.className = "error-message";
            error.innerText = message;
            error.style.display = "block";
            parent.appendChild(error);
        } else {
            if (input) {
                input.classList.remove("input-error");
                if (errorMessage) errorMessage.style.display = "none";
            }
        }
    });

    return isValid;
}

function showErrorMessage(parent, message) {
    const error =
        parent.querySelector(".error-message") || document.createElement("p");
    error.className = "error-message";
    error.innerText = message;
    error.style.display = "block";
    parent.appendChild(error);
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

    if (!month.value || !day.value || !year.value) {
        isValid = false;
        if (!month.value) month.classList.add("input-error");
        if (!day.value) day.classList.add("input-error");
        if (!year.value) year.classList.add("input-error");
    } else {
        month.classList.remove("input-error");
        day.classList.remove("input-error");
        year.classList.remove("input-error");
    }

    const isBinusian = localStorage.getItem("groupData")
        ? JSON.parse(localStorage.getItem("groupData")).is_binusian === "1"
        : false;

    const fileInputs = [
        { id: "uploadCv", message: "CV belum diunggah" },
        {
            id: isBinusian ? "uploadFlazz" : "uploadId",
            message: isBinusian
                ? "Flazz Card belum diunggah"
                : "ID Card belum diunggah",
        },
    ];

    fileInputs.forEach(({ id, message }) => {
        const input = document.getElementById(id);
        const wrapper = input.closest(".upload-wrapper");
        if (input && input.files.length === 0) {
            isValid = false;
            if (wrapper) {
                wrapper.classList.add("input-error");
                showErrorMessage(wrapper, message);
            }
        } else {
            if (wrapper) {
                wrapper.classList.remove("input-error");
            }
        }
    });

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

document
    .getElementById("previousButton")
    .addEventListener("click", function () {
        goToStep(1);
    });

function convertFileToBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onloadend = () => resolve(reader.result);
        reader.onerror = reject;
        reader.readAsDataURL(file);
    });
}

const registerButton = document.getElementById("register-button");

registerButton.addEventListener("click", function (e) {
    if (!validateStep2()) {
        e.preventDefault();
        goToStep(2);
    } else {
        // merge data birthdate
        const birthDate = `${document.getElementById("year").value}-${
            document.getElementById("month").value
        }-${document.getElementById("day").value}`;

        const cvFile = document.getElementById("uploadCv").files[0];
        const flazzCardFile = document.getElementById("uploadFlazz").files[0];
        const idCardFile = document.getElementById("uploadId").files[0];

        const isBinusian = localStorage.getItem("groupData")
            ? JSON.parse(localStorage.getItem("groupData")).is_binusian === "1"
            : false;

        Promise.all([
            cvFile ? convertFileToBase64(cvFile) : Promise.resolve(null),
            isBinusian && flazzCardFile
                ? convertFileToBase64(flazzCardFile)
                : Promise.resolve(null),
            !isBinusian && idCardFile
                ? convertFileToBase64(idCardFile)
                : Promise.resolve(null),
        ])
            .then(([cvBase64, flazzCardBase64, idCardBase64]) => {
                const data = {
                    leaderName: document.getElementById("leaderName").value,
                    lineId: document.getElementById("lineId").value,
                    email: document.getElementById("email").value,
                    whatsappNumber:
                        document.getElementById("whatsappNumber").value,
                    gitId: document.getElementById("gitId").value,
                    birthPlace: document.getElementById("birthPlace").value,
                    birthDate: birthDate,
                    cv: cvBase64,
                    flazzCard: isBinusian ? flazzCardBase64 : null,
                    idCard: !isBinusian ? idCardBase64 : null,
                };

                localStorage.setItem("leaderData", JSON.stringify(data));
                window.location.href = "/register-member";
            })
            .catch((error) => {
                console.error("Error saat mengonversi file:", error);
            });
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

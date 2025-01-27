document.addEventListener("DOMContentLoaded", function () {
    const storedGroupData = localStorage.getItem("groupData");

    const isBinusian = document.getElementById("isBinusianDisplay").innerText.trim() === "Yes";

    const flazzCardWrapper = document.querySelector(".flazz-wrapper");
    const idCardWrapper = document.querySelector(".id-wrapper");

    if (isBinusian) {
        flazzCardWrapper.style.display = "block";
        idCardWrapper.style.display = "none";
    } else {
        flazzCardWrapper.style.display = "none";
        idCardWrapper.style.display = "block";
    }

    if (storedGroupData) {
        const groupData = JSON.parse(storedGroupData);
        console.log("Data yang diambil:", groupData);

        const { team_name, password, is_binusian } = groupData;

        const teamNameDisplay = document.getElementById("teamNameDisplay");
        const passwordDisplay = document.getElementById("passwordDisplay");
        const isBinusianDisplay = document.getElementById("isBinusianDisplay");

        if (teamNameDisplay) teamNameDisplay.innerText = team_name || "Nama tim tidak ditemukan";
        if (passwordDisplay) passwordDisplay.innerText = password || "Password tidak ditemukan";
        if (isBinusianDisplay) isBinusianDisplay.innerText = is_binusian === "1" ? "Yes" : "No";
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
            showErrorMessage(parent, message);
        } else if (validate && !validate(input.value.trim())) {
            isValid = false;
            input.classList.add("input-error");
            showErrorMessage(parent, message);
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
    const error = parent.querySelector(".error-message") || document.createElement("p");
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

    const fileInputs = [
        { id: "uploadCv", message: "CV belum diunggah" },
        { id: "uploadFlazz", message: "Flazz Card belum diunggah" },
        { id: "uploadId", message: "ID Card belum diunggah" },
    ];

    fileInputs.forEach(({ id, message }) => {
        const input = document.getElementById(id);
        const wrapper = input.closest(".upload-wrapper");
        if (input.files.length === 0) {
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

document.getElementById("previousButton").addEventListener("click", function () {
    goToStep(1);
});

document.getElementById("register-button").addEventListener("click", function (e) {
    if (!validateStep2()) {
        e.preventDefault();
        goToStep(2);
    } else {
        const birthDate = `${document.getElementById("year").value}-${document.getElementById("month").value}-${document.getElementById("day").value}`;

        const storedData = localStorage.getItem("registerData");
        const registerData = storedData ? JSON.parse(storedData) : {};

        const storedGroupData = localStorage.getItem("groupData");
        const groupData = storedGroupData ? JSON.parse(storedGroupData) : {};

        const data = {
            team_name: groupData.team_name || document.getElementById("groupName").value,
            is_binusian: document.getElementById("isBinusianDisplay").innerText.trim() === "Yes",
            password: groupData.password || document.getElementById("groupPassword").value,
            leader: {
                name: document.getElementById("leaderName").value,
                email: document.getElementById("email").value,
                phone: document.getElementById("whatsappNumber").value,
                line_id: document.getElementById("lineId").value,
                github_id: document.getElementById("gitId").value,
                birth_place: document.getElementById("birthPlace").value,
                birth_date: birthDate,
            },
            files: {
                cv: document.getElementById("uploadCv").files[0],
                id_card: document.getElementById("uploadId").files[0],
            },
            group_data: groupData
        };

        localStorage.setItem("leaderData", JSON.stringify(data));
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

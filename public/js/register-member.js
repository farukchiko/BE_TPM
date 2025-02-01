// switch tab display
function switchTab(tabNumber) {
    const allPanes = document.querySelectorAll(".tab-pane");
    allPanes.forEach((pane) => pane.classList.remove("active"));

    const activePane = document.getElementById(`pane${tabNumber}`);
    activePane.classList.add("active");

    const allTabs = document.querySelectorAll(".tab");
    allTabs.forEach((tab) => tab.classList.remove("active"));

    const activeTab = document.getElementById(`tab${tabNumber}`);
    activeTab.classList.add("active");
}

// convert string to file
function convertBase64ToFile(base64String, fileName, mimeType) {
    const byteCharacters = atob(base64String.split(",")[1]);
    const byteArrays = [];

    for (let offset = 0; offset < byteCharacters.length; offset += 1024) {
        const slice = byteCharacters.slice(offset, offset + 1024);
        const byteNumbers = new Array(slice.length);
        for (let i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
        }
        byteArrays.push(new Uint8Array(byteNumbers));
    }

    const blob = new Blob(byteArrays, { type: mimeType });
    return new File([blob], fileName, { type: mimeType });
}

// handler regist
document.addEventListener("DOMContentLoaded", function () {
    // load data
    const groupData = localStorage.getItem("groupData");
    const leaderData = localStorage.getItem("leaderData");

    if (groupData && leaderData) {
        const storedGroupData = JSON.parse(groupData);
        console.log("Group Data: ", storedGroupData);

        const storedLeaderData = JSON.parse(leaderData);
        console.log("Leader Data: ", storedLeaderData);
    }

    const form = document.getElementById("form-member");
    const registerButton = document.querySelector(".final-register-button");
    const inputs = document.querySelectorAll("input");

    function validateEmail(email) {
        return email.includes("@gmail.com");
    }

    function validateForm() {
        let isValid = true;

        inputs.forEach((input) => {
            const value = input.value.trim();
            const id = input.id;
            const errorSpan = input.nextElementSibling;

            if (!value) {
                isValid = false;
                errorSpan.style.display = "block";
            } else if (id.includes("Email") && !validateEmail(value)) {
                isValid = false;
                errorSpan.textContent = "Email harus menggunakan @gmail.com";
                errorSpan.style.display = "block";
            } else {
                errorSpan.style.display = "none";
            }
        });

        registerButton.disabled = !isValid;
        registerButton.style.backgroundColor = isValid ? "#0054A5" : "#B0B0B0";

        return isValid;
    }

    inputs.forEach((input) => {
        input.addEventListener("input", validateForm);
    });

    form.addEventListener("submit", async function (event) {
        event.preventDefault();

        if (validateForm()) {
            const formData = new FormData(form);
            const membersData = {};

            formData.forEach((value, key) => {
                const parts = key.match(/members\[(\d+)\]\[(\w+)\]/);
                if (parts) {
                    const memberIndex = parts[1];
                    const field = parts[2];

                    if (!membersData[memberIndex]) {
                        membersData[memberIndex] = {};
                    }

                    membersData[memberIndex][field] = value;
                }
            });

            // save members data
            localStorage.setItem("membersData", JSON.stringify(membersData));

            const storedGroupData = JSON.parse(
                localStorage.getItem("groupData")
            );
            const storedLeaderData = JSON.parse(
                localStorage.getItem("leaderData")
            );

            const apiFormData = new FormData();

            // group
            apiFormData.append("team_name", storedGroupData.team_name);
            apiFormData.append("is_binusian", storedGroupData.is_binusian);
            apiFormData.append("password", storedGroupData.password);
            apiFormData.append(
                "password_confirmation",
                storedGroupData.password_confirmation
            );

            // leader
            apiFormData.append("leader[name]", storedLeaderData.leaderName);
            apiFormData.append("leader[email]", storedLeaderData.email);
            apiFormData.append(
                "leader[phone]",
                storedLeaderData.whatsappNumber
            );
            apiFormData.append("leader[line_id]", storedLeaderData.lineId);
            apiFormData.append("leader[github_id]", storedLeaderData.gitId);
            apiFormData.append(
                "leader[birth_place]",
                storedLeaderData.birthPlace
            );
            apiFormData.append(
                "leader[birth_date]",
                storedLeaderData.birthDate
            );

            // members
            Object.keys(membersData).forEach((index) => {
                apiFormData.append(
                    `members[${index}][name]`,
                    membersData[index].name
                );
                apiFormData.append(
                    `members[${index}][email]`,
                    membersData[index].email
                );
            });

            // files
            if (storedLeaderData.cv) {
                const cvFile = convertBase64ToFile(
                    storedLeaderData.cv,
                    "CV.pdf",
                    "application/pdf"
                );
                apiFormData.append("files[cv]", cvFile);
            }

            if (storedGroupData.is_binusian === "1") {
                if (storedLeaderData.flazzCard) {
                    const flazzCardFile = convertBase64ToFile(
                        storedLeaderData.flazzCard,
                        "FlazzCard.pdf",
                        "application/pdf"
                    );
                    apiFormData.append("files[id_card]", flazzCardFile);
                }
            } else {
                if (storedLeaderData.idCard) {
                    const idCardFile = convertBase64ToFile(
                        storedLeaderData.idCard,
                        "IDCard.pdf",
                        "application/pdf"
                    );
                    apiFormData.append("files[id_card]", idCardFile);
                }
            }

            try {
                const response = await fetch(
                    "http://127.0.0.1:8000/api/register-user",
                    {
                        method: "POST",
                        body: apiFormData,
                    }
                );

                const result = await response.json();

                if (response.ok) {
                    alert("Registrasi berhasil!");
                    window.location.href = "/";
                } else {
                    alert("Registrasi gagal: " + result.message);
                    console.log("error : " + result.error);
                }
            } catch (error) {
                console.error("Terjadi kesalahan:", error);
                alert("Terjadi kesalahan saat mengirim data.");
            }
        }
    });

    validateForm();
});

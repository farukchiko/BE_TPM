// document.addEventListener("DOMContentLoaded", function () {
//     const storedData = localStorage.getItem("registerData");
//     if (storedData) {
//         const data = JSON.parse(storedData);
//         document.getElementById("leaderName").value = data.leaderName || "";
//         document.getElementById("lineId").value = data.lineId || "";
//         document.getElementById("email").value = data.email || "";
//         document.getElementById("whatsappNumber").value = data.whatsappNumber || "";
//         document.getElementById("gitId").value = data.gitId || "";
//         document.getElementById("birthPlace").value = data.birthPlace || "";

//         const [year, month, day] = (data.birthDate || "").split("-");
//         document.getElementById("year").value = year || "";
//         document.getElementById("month").value = month || "";
//         document.getElementById("day").value = day || "";
//     }

//     const storedGroupData = localStorage.getItem("groupData");
//     if (storedGroupData) {
//         const groupData = JSON.parse(storedGroupData);
//         groupNameInput.value = groupData.team_name || "";
//     }
// });

function switchTab(tabNumber) {
    const allPanes = document.querySelectorAll('.tab-pane');
    allPanes.forEach(pane => pane.classList.remove('active'));

    const activePane = document.getElementById(`pane${tabNumber}`);
    activePane.classList.add('active');

    const allTabs = document.querySelectorAll('.tab');
    allTabs.forEach(tab => tab.classList.remove('active'));

    const activeTab = document.getElementById(`tab${tabNumber}`);
    activeTab.classList.add('active');
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('form');
    const registerButton = form.querySelector('.register-button');
    const inputs = form.querySelectorAll('input');

    function validateEmail(email) {
        return email.includes('@gmail.com');
    }

    function validateForm() {
        let isValid = true;

        inputs.forEach(input => {
            const value = input.value.trim();
            const id = input.id;
            const spanMessage = input.nextElementSibling;

            if (!value) {
                isValid = false;
            } else if (id.includes('Email') && !validateEmail(value)) {
                isValid = false;
            }
        });

        registerButton.disabled = !isValid;
        if (isValid) {
            registerButton.style.backgroundColor = "#0054A5";
        } else {
            registerButton.style.backgroundColor = "#B0B0B0";
        }
    }

    inputs.forEach(input => {
        input.addEventListener('input', validateForm);
    });

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        if (validateForm()) {
            const formData = new FormData(form);

            const membersData = {};
            formData.forEach((value, key) => {
                const parts = key.split('[');
                if (parts.length === 2) {
                    const memberIndex = parts[1].replace(']', '');
                    const field = parts[0];
                    if (!membersData[memberIndex]) {
                        membersData[memberIndex] = {};
                    }
                    membersData[memberIndex][field] = value;
                }
            });

            fetch('/submit-form', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ members: membersData })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Form submitted successfully!");
                } else {
                    alert("There was an error.");
                }
            })
            .catch(error => {
                console.error("Error submitting form:", error);
            });
        }
    });

    validateForm();
});



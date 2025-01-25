const form = document.querySelector(".input-form");
const groupNameInput = document.getElementById("groupName");
const memberInputs = [
  document.getElementById("member1"),
  document.getElementById("member2"),
  document.getElementById("member3")
];

function showError(inputElement, message) {
  inputElement.classList.add("input-error");

  if (
    !inputElement.parentElement.querySelector(".error-message")
  ) {
    const error = document.createElement("p");
    error.className = "error-message";
    error.textContent = message;
    inputElement.parentElement.appendChild(error);
  }
}

function clearError(inputElement) {
  inputElement.classList.remove("input-error");

  const errorMessage = inputElement.parentElement.querySelector(".error-message");
  if (errorMessage) {
    inputElement.parentElement.removeChild(errorMessage);
  }
}

form.addEventListener("submit", function (event) {
  event.preventDefault();
  let isValid = true;

  if (groupNameInput.value.trim() === "") {
    isValid = false;
    showError(groupNameInput, "Nama grup tidak boleh kosong");
  } else {
    clearError(groupNameInput);
  }

  memberInputs.forEach((input) => {
    if (input.value.trim() === "") {
      isValid = false;
      showError(input, "Nama anggota tidak boleh kosong");
    } else {
      clearError(input);
    }
  });

  if (isValid) {
    form.submit();
    window.location.href = "/user-dashboard";
  }
});

document.addEventListener("DOMContentLoaded", function () {
    const storedData = localStorage.getItem("registerData");
    if (storedData) {
        const data = JSON.parse(storedData);
        document.getElementById("leaderName").value = data.leaderName || "";
        document.getElementById("lineId").value = data.lineId || "";
        document.getElementById("email").value = data.email || "";
        document.getElementById("whatsappNumber").value = data.whatsappNumber || "";
        document.getElementById("gitId").value = data.gitId || "";
        document.getElementById("birthPlace").value = data.birthPlace || "";
       
        const [year, month, day] = (data.birthDate || "").split("-");
        document.getElementById("year").value = year || "";
        document.getElementById("month").value = month || "";
        document.getElementById("day").value = day || "";
    }
});

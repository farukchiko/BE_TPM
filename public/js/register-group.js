const form = document.querySelector(".input-form");
const groupNameInput = document.getElementById("groupName");
const passwordInput = document.getElementById("groupPassword");
const confirmPasswordInput = document.getElementById("confirmPassword");
const passwordRequirements = document.querySelector(
  ".password-wrapper .requirement ul"
);

const requirements = {
  length: /^(?=.{8,})/,
  uppercase: /^(?=.*[A-Z])/,
  lowercase: /^(?=.*[a-z])/,
  number: /^(?=.*\d)/,
  special: /^(?=.*[-_.@$!%*?&])/,
};

function validatePassword(password) {
  return (
    requirements.length.test(password) &&
    requirements.uppercase.test(password) &&
    requirements.lowercase.test(password) &&
    requirements.number.test(password) &&
    requirements.special.test(password)
  );
}

function showError(inputElement, message) {
  inputElement.classList.add("input-error");

  if (
    !inputElement.nextElementSibling ||
    !inputElement.nextElementSibling.classList.contains("error-message")
  ) {
    const error = document.createElement("p");
    error.className = "error-message";
    error.textContent = message;
    inputElement.parentElement.appendChild(error);
  }
}

function updatePasswordRequirements(isValid) {
  const requirementItems = document.querySelectorAll(
    ".password-wrapper .requirement ul li"
  );
  requirementItems.forEach((item) => {
    if (!isValid) {
      item.classList.add("requirement-invalid");
    } else {
      item.classList.remove("requirement-invalid");
    }
  });
}

function clearError(inputElement) {
  inputElement.classList.remove("input-error");

  if (
    inputElement.nextElementSibling &&
    inputElement.nextElementSibling.classList.contains("error-message")
  ) {
    inputElement.parentElement.removeChild(inputElement.nextElementSibling);
  }
}

function showRadioError() {
  const radioLabels = document.querySelectorAll(".radio-wrapper label");

  radioLabels.forEach((label) => {
    label.classList.add("error-radio-label");
  });
}

function clearRadioError() {
  const radioLabels = document.querySelectorAll(".radio-wrapper label");

  radioLabels.forEach((label) => {
    label.classList.remove("error-radio-label");
  });
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

  if (!validatePassword(passwordInput.value)) {
    isValid = false;
    passwordInput.classList.add("input-error");

    updatePasswordRequirements(false);
  } else {
    passwordInput.classList.remove("input-error");

    updatePasswordRequirements(true);
  }

  if (passwordInput.value !== confirmPasswordInput.value) {
    isValid = false;
    showError(confirmPasswordInput, "Harus sama persis dengan Password");
  } else {
    clearError(confirmPasswordInput);
  }

  const radioButtons = document.querySelectorAll('input[name="is_binusian"]');
  let isRadioSelected = false;
  radioButtons.forEach((radio) => {
    if (radio.checked) {
      isRadioSelected = true;
    }
  });

  if (!isRadioSelected) {
    isValid = false;
    showRadioError();
  } else {
    clearRadioError();
  }

  if (isValid) {
    window.location.href = "/register-leader";
  }
});

document
  .getElementById("togglePassword1")
  .addEventListener("click", function () {
    var passwordField = document.getElementById("groupPassword");
    var type = passwordField.type === "password" ? "text" : "password";
    passwordField.type = type;

    var eyeIcon = this.querySelector("img");
    if (type === "password") {
      eyeIcon.src = "/assets/icons/ic-eyes-open.svg";
    } else {
      eyeIcon.src = "/assets/icons/ic-eyes-close.svg";
    }
  });

document
  .getElementById("togglePassword2")
  .addEventListener("click", function () {
    var confirmPasswordField = document.getElementById("confirmPassword");
    var type = confirmPasswordField.type === "password" ? "text" : "password";
    confirmPasswordField.type = type;

    var eyeIcon = this.querySelector("img");
    if (type === "password") {
      eyeIcon.src = "/assets/icons/ic-eyes-open.svg";
    } else {
      eyeIcon.src = "/assets/icons/ic-eyes-close.svg";
    }
  });

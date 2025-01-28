const modalDelete = document.getElementById("modal-delete");
const modalView = document.getElementById("modal-view");

const btnDelete = document.getElementById("btn-delete");
const btnConfirmDelete = document.getElementById("btn-confirm-delete");

const btnView = document.getElementById("btn-view");

const btnClose = document.getElementById("btn-close");
const btnCloseView = document.getElementById("btn-close-view");

// delete handler
btnDelete.addEventListener("click", () => {
    modalDelete.classList.remove("hidden");
});

btnClose.addEventListener("click", () => {
    modalDelete.classList.add("hidden");
});

btnConfirmDelete.addEventListener("click", () => {
    // dummy action
    alert("Success delete!");
});

// view handler
btnView.addEventListener("click", () => {
    modalView.classList.remove("hidden");
});

btnCloseView.addEventListener("click", () => {
    modalView.classList.add("hidden");
});

// logout
const isLoggedIn = localStorage.getItem("isLoggedIn");
if (isLoggedIn !== "true") {
    window.location.href = "/login/admin";
}

const btnLogout = document.getElementById("btn-logout");

btnLogout.addEventListener("click", () => {
    localStorage.removeItem("adminToken");
    localStorage.removeItem("isLoggedIn");
    window.location.href = "/login/admin";
});

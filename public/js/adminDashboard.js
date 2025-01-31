const modalDelete = document.getElementById("modal-delete");
const modalEdit = document.getElementById("modal-edit");
const modalView = document.getElementById("modal-view");

const btnDelete = document.getElementById("btn-delete");
const btnConfirmDelete = document.getElementById("btn-confirm-delete");

const btnEdit = document.getElementById("btn-edit");
const btnSaveEdit = document.getElementById("btn-save");

const btnView = document.getElementById("btn-view");

const btnClose = document.getElementById("btn-close");
const btnCloseEdit= document.getElementById("btn-close-edit");
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

// edit handler
btnEdit.addEventListener("click", () => {
    modalEdit.classList.remove("hidden");
});

btnCloseEdit.addEventListener("click", () => {
    modalEdit.classList.add("hidden");
});

btnSaveEdit.addEventListener("click", () => {
    // dummy action
    alert("Success Edit!");
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

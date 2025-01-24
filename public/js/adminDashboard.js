// delete handler
const modalDelete = document.getElementById("modal-delete");
const btnDelete = document.getElementById("btn-delete");
const btnClose = document.getElementById("btn-close");
const btnConfirmDelete = document.getElementById("btn-confirm-delete");

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

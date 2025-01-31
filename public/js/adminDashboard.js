const modalDelete = document.getElementById("modal-delete");
const modalEdit = document.getElementById("modal-edit");
const modalView = document.getElementById("modal-view");

const btnClose = document.getElementById("btn-close");
const btnCloseEdit= document.getElementById("btn-close-edit");
const btnCloseView = document.getElementById("btn-close-view");

function fetchTeamData(teamId) {
    fetch(`/api/getTeamData?team_id=${teamId}`)
        .then(response => response.json())
        .then(teamData => {
            processTeamData(teamData); // Proses data setelah diterima
        })
        .catch(error => {
            console.error("Error fetching team data:", error);
        });
}

function processTeamData(teamData) {
    let leader = '';
    let members = [];

    teamData.forEach(member => {
        if (member.is_leader === 1) {
            leader = member.member_name;
        } else {
            members.push(member.member_name);
        }
    });

    console.log('Leader:', leader);
    console.log('Members:', members);

    openEditModal(teamName, members, leader);
}

// delete handler
document.querySelectorAll(".btn-delete").forEach((btnDelete) => {
    btnDelete.addEventListener("click", () => {
        modalDelete.classList.remove("hidden");
    });
});

btnClose.addEventListener("click", () => {
    modalDelete.classList.add("hidden");
});

document.querySelectorAll(".btn-confirm").forEach((btnConfirmDelete) => {
    btnConfirmDelete.addEventListener("click", () => {
        // dummy action
        alert("Success delete!");
    });
});

// edit handler
function openEditModal(teamName, members, leader) {

    document.querySelector('.team-name').innerText = `Team ${teamName}`;

    document.getElementById('edit-team-name-display').innerText = teamName;
    document.getElementById('edit-team').value = "(Editable text field)";

    document.getElementById('edit-leader-name-display').innerText = leader;
    document.getElementById('edit-leader').value = "(Editable text field)";

    const memberList = document.getElementById('edit-member-list');
    memberList.innerHTML = '';
    members.split(',').forEach(member => {
    memberList.innerHTML += `
        <div class="member-edit">
        <li>${member}</li>
        <input type="text" class="edit-member" placeholder="(Editable text field)">
        </div>
    `;
    });

    document.getElementById('modal-edit').classList.remove('hidden');
}

document.querySelectorAll(".btn-edit").forEach((btnEdit) => {
    btnEdit.addEventListener("click", () => {
        modalEdit.classList.remove("hidden");
    });
});

btnCloseEdit.addEventListener("click", () => {
    modalEdit.classList.add("hidden");
});

document.querySelectorAll(".btn-save").forEach((btnSaveEdit) => {
    btnSaveEdit.addEventListener("click", () => {
        // dummy action
        alert("Success Edit!");
    });
});

// view handler
function openViewModal(teamName, members, registrationDate) {
    document.getElementById('view-team-name').innerText = teamName;
    document.getElementById('view-members').innerText = members;
    document.getElementById('view-registration-date').innerText = registrationDate;
    document.getElementById('modal-view').classList.remove('hidden');
}

document.querySelectorAll(".btn-view").forEach((btnView) => {
    btnView.addEventListener("click", () => {
        modalView.classList.remove("hidden");
    });
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

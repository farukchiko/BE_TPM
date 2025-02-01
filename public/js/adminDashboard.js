const modalDelete = document.getElementById("modal-delete");
const modalEdit = document.getElementById("modal-edit");
const modalView = document.getElementById("modal-view");

const btnClose = document.getElementById("btn-close");
const btnCloseEdit = document.getElementById("btn-close-edit");
const btnCloseView = document.getElementById("btn-close-view");

let teamToDelete = null;
let teamToUpdate = null;

// function fetchTeamData(teamId) {
//     console.log("Test");
//     fetch(`/api/getTeamData?team_id=${teamId}`)
//         .then(response => response.json())
//         .then(teamData => {
//             processTeamData(teamData); // Proses data setelah diterima
//         })
//         .catch(error => {
//             console.error("Error fetching team data:", error);
//         });
// }

// function processTeamData(teamData) {
//     let leader = '';
//     let members = [];

//     teamData.forEach(member => {
//         if (member.is_leader === 1) {
//             leader = member.member_name;
//         } else {
//             members.push(member.member_name);
//         }
//     });

//     console.log('Leader:', leader);
//     console.log('Members:', members);

//     openEditModal(teamName, members, leader);
// }

// delete handler
function openDeleteModal(teamName, teamId) {
    teamToDelete = teamId;

    modalDelete.classList.remove("hidden");

    document.getElementById("team-to-delete").textContent = teamName;
}

btnClose.addEventListener("click", () => {
    modalDelete.classList.add("hidden");
    teamToDelete = null;
});
document.querySelectorAll(".btn-confirm").forEach((btnConfirmDelete) => {
    btnConfirmDelete.addEventListener("click", () => {
        // action delete
        console.log("team delete id", teamToDelete);
        if (!teamToDelete) return;

        fetch(`http://127.0.0.1:8000/api/admin/delete-teams/${teamToDelete}`, {
            method: "DELETE",
            headers: {
                Authorization: `Bearer ${localStorage.getItem("adminToken")}`,
                Accept: "application/json",
            },
        })
            .then((response) => {
                console.log(response.status);
                if (!response.ok) {
                    throw new Error("Failed to delete team.");
                }
                return response.json();
            })
            .then((data) => {
                console.log("Team deleted:", data);
                alert("Team berhasil dihapus!");
                modalDelete.classList.add("hidden");

                // reload
                location.reload();
            })
            .catch((error) => {
                console.error("Error deleting team:", error);
            });
    });
});
// end delete handler

// edit handler
function openEditModal(
    teamName,
    members,
    membersEmail,
    leaderName,
    leaderEmail,
    teamId
) {
    teamToUpdate = teamId;
    console.log("update tim", teamToUpdate);

    modalEdit.classList.remove("hidden"); // show modal

    document.querySelector(".team-name").innerText = `Team ${teamName}`;

    document.getElementById("edit-team-name-display").innerText = teamName;
    document.getElementById("edit-team").value = "(Editable text field)";

    document.getElementById("edit-leader-name-display").innerText = leaderName;
    document.getElementById("edit-leader").value = "(Editable text field)";

    document.getElementById("edit-leader-email-display").innerText =
        leaderEmail;
    document.getElementById("edit-leader").value = "(Editable text field)";

    const memberList = document.getElementById("edit-member-list");
    memberList.innerHTML = "";
    members.forEach((member, index) => {
        const memberEmail = membersEmail[index] || "No Email";
        memberList.innerHTML += `
            <div class="member-edit">
                <div id="memb-name">
                    <li>${member}</li>
                    <input type="text" class="edit-member" placeholder="(Editable text field)" data-default="${member}">
                </div>
                <div id="memb-email">
                    <li>${memberEmail}</li>
                    <input type="text" class="edit-member" placeholder="(Editable text field)" data-default="${memberEmail}" >
                </div>
            </div>
        `;
    });

    document.querySelectorAll(".btn-save").forEach((btnSaveEdit) => {
        btnSaveEdit.addEventListener("click", () => {
            const updatedData = {
                team_name: document.getElementById("edit-team").value,
                leader: {
                    name: document.getElementById("edit-leader").value,
                    email: document.getElementById("edit-leader-email-display")
                        .innerText,
                },
                members: [],
            };

            // members
            document
                .querySelectorAll(".member-edit")
                .forEach((memberElement) => {
                    const memberName =
                        memberElement.querySelector("#memb-name input").value;
                    const memberEmail =
                        memberElement.querySelector("#memb-email input").value;
                    updatedData.members.push({
                        name: memberName,
                        email: memberEmail,
                    });
                });

            // api req
            fetch(`http://127.0.0.1:8000/api/admin/edit-team/${teamToUpdate}`, {
                method: "PUT",
                headers: {
                    Authorization: `Bearer ${localStorage.getItem(
                        "adminToken"
                    )}`,
                    Accept: "application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(updatedData),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert("Team berhasil diedit!");
                        modalEdit.classList.add("hidden");

                        // reload
                        location.reload();
                    } else {
                        console.error("Error team:", data);
                        alert("Gagal untuk update team. Coba lagi!");
                    }
                })
                .catch((error) => {
                    console.error("Error updating team:", error);
                    alert("Terjadi error");
                });
        });
    });

    document.getElementById("modal-edit").classList.remove("hidden");
}

btnCloseEdit.addEventListener("click", () => {
    modalEdit.classList.add("hidden"); // close modal
});
// end edit handler

// view handler
function openViewModal(teamName, members, registrationDate) {
    document.getElementById("view-team-name").innerText = teamName;
    document.getElementById("view-members").innerText = members;
    document.getElementById("view-registration-date").innerText =
        registrationDate;
    document.getElementById("modal-view").classList.remove("hidden");
}
document.querySelectorAll(".btn-view").forEach((btnView) => {
    btnView.addEventListener("click", () => {
        modalView.classList.remove("hidden");
    });
});
btnCloseView.addEventListener("click", () => {
    modalView.classList.add("hidden");
});
// end view handler

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
// end logout

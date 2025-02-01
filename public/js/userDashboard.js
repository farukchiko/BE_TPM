// format date
function formattedDate(date) {
    console.log("Received date:", date);

    const months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];

    const dateObj = new Date(date);
    if (isNaN(dateObj)) {
        console.error("Invalid date format:", date);
        return "invalid date";
    }

    const day = dateObj.getDate();
    const month = months[dateObj.getMonth()];
    const year = dateObj.getFullYear();

    const formattedDate = `${month} ${day}, ${year}`;
    console.log("Formatted date:", formattedDate);

    return formattedDate;
}

// check login status & integrasi
const isLoggedIn = localStorage.getItem("isLoggedIn");
if (isLoggedIn !== "true") {
    window.location.href = "/login";
}

// ambil team_id dari URL
const teamId = window.location.pathname.split("/").pop();

async function fetchData(teamId) {
    try {
        const response = await fetch(
            `http://127.0.0.1:8000/api/user/dashboard/${teamId}`,
            {
                method: "GET",
                headers: {
                    Authorization: `Bearer ${localStorage.getItem(
                        "userToken"
                    )}`,
                    Accept: "application/json",
                },
            }
        );

        if (!response.ok) {
            throw new Error("Network response was not ok");
        }

        const data = await response.json();
        console.log("Data:", data);
        populateData(data);
    } catch (error) {
        console.error("There was a problem with the fetch operation:", error);
    }
}
fetchData(teamId);
// end check login status & integrasi

// populate data
function populateData(data) {
    const birthDate = data.leader.birth_date;
    console.log("bd", birthDate);
    const formattedBirthDate = formattedDate(birthDate);

    const leaderData = [
        { label: "Fullname", value: data.leader.name },
        { label: "Email", value: data.leader.email },
        { label: "Whatsapp", value: data.leader.phone },
        { label: "Line ID", value: data.leader.line_id },
        { label: "Github ID/GitLab ID", value: data.leader.github_id },
        { label: "Birth Place", value: data.leader.birth_place },
        { label: "Birth Date", value: formattedBirthDate },
        {
            label: "CV",
            value: `<a href="${data.cv_url}" target="_blank">View CV</a>`,
        },
        {
            label: "ID Card/Flazz",
            value: `<a href="${data.id_card_or_flazz_url}" target="_blank">View Card</a>`,
        },
    ];

    const leaderContainer = document.querySelector(".detail-container");
    leaderContainer.innerHTML = "";
    leaderData.forEach((detail) => {
        const div = document.createElement("div");
        div.classList.add("detail-wrap");

        const label = document.createElement("p");
        label.textContent = detail.label;

        const value = document.createElement("p");
        value.textContent = detail.value;

        div.appendChild(label);
        div.appendChild(value);
        leaderContainer.appendChild(div);
    });

    // update data member
    const memberContainer = document.querySelector(".member-list-container");
    memberContainer.innerHTML = "";
    data.members.forEach((member) => {
        const div = document.createElement("div");
        div.classList.add("detail-wrap-member");

        const memberName = document.createElement("p");
        memberName.textContent = member.name;

        div.appendChild(memberName);
        memberContainer.appendChild(div);
    });
}
// end populate data

// logout handler
const btnLogout = document.getElementById("btn-logout");
const btnClose = document.getElementById("btn-close");
const btnCancelLogout = document.getElementById("btn-cancel-logout");
const btnConfirmLogout = document.getElementById("btn-confirm-logout");
const modalLogout = document.getElementById("modal-logout");

btnLogout.addEventListener("click", () => {
    modalLogout.classList.remove("hidden");
});
btnConfirmLogout.addEventListener("click", () => {
    localStorage.removeItem("userToken");
    localStorage.removeItem("isLoggedIn");
    window.location.href = "/login";
});
btnCancelLogout.addEventListener("click", () => {
    modalLogout.classList.add("hidden");
});
btnClose.addEventListener("click", () => {
    modalLogout.classList.add("hidden");
});
// end logout handler

// check login status & integrasi
const isLoggedIn = localStorage.getItem("isLoggedIn");
if (isLoggedIn !== "true") {
    window.location.href = "/login";
}

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
        populateData(data);
    } catch (error) {
        console.error("There was a problem with the fetch operation:", error);
    }
}

const teamId = 1;
fetchData(teamId);
// end check login status & integrasi

// populate data
function populateData(data) {
    // Update detail section
    const detailSection = [
        {
            icon: "../../assets/icons/ic-person.svg",
            desc: "Fullname",
            value: data.leader.name,
        },
        {
            icon: "../../assets/icons/ic-email.svg",
            desc: "Email",
            value: data.leader.email,
        },
        {
            icon: "../../assets/icons/ic-whatsapp.svg",
            desc: "Whatsapp",
            value: data.leader.phone,
        },
        {
            icon: "../../assets/icons/ic-line.svg",
            desc: "Line ID",
            value: data.leader.line_id,
        },
        {
            icon: "../../assets/icons/ic-github.svg",
            desc: "Github/GitLab ID",
            value: data.leader.github_id,
        },
        {
            icon: "../../assets/icons/ic-location.svg",
            desc: "Birth Place",
            value: data.leader.birth_place,
        },
        {
            icon: "../../assets/icons/ic-person.svg",
            desc: "Birth Date",
            value: data.leader.birth_date,
        },
    ];

    const descContainer = document.querySelector(".detail-container");
    descContainer.innerHTML = ""; // Clear existing content before appending new content
    detailSection.forEach((detail) => {
        const detailWrap = document.createElement("div");
        detailWrap.classList.add("detail-wrap");

        const iconText = document.createElement("div");
        iconText.classList.add("icon-text");

        const img = document.createElement("img");
        img.src = detail.icon;
        img.alt = `Icon ${detail.desc}`;

        const desc = document.createElement("p");
        desc.classList.add("detail-name");
        desc.textContent = detail.desc;

        iconText.appendChild(img);
        iconText.appendChild(desc);

        const value = document.createElement("p");
        value.classList.add("detail-desc");
        value.textContent = detail.value;

        detailWrap.appendChild(iconText);
        detailWrap.appendChild(value);

        descContainer.appendChild(detailWrap);
    });

    // Update team members section
    const membContainer = document.querySelector(".member-list-container");
    membContainer.innerHTML = ""; // Clear existing content before appending new content
    data.members.forEach((member) => {
        const detailWrap = document.createElement("div");
        detailWrap.classList.add("detail-wrap-member");

        const iconText = document.createElement("div");
        iconText.classList.add("icon-text");

        const img = document.createElement("img");
        img.src = member.icon;
        img.alt = `Icon ${member.desc}`;

        const value = document.createElement("p");
        value.classList.add("member-list");
        value.textContent = member.name;

        detailWrap.appendChild(iconText);
        detailWrap.appendChild(value);

        membContainer.appendChild(detailWrap);
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

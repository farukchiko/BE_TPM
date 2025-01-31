function toggleAccordion(element) {
    const accordionItem = element.parentElement;
    const content = accordionItem.querySelector(".accordion-content");

    const isActive = accordionItem.classList.contains("active");

    document.querySelectorAll(".accordion-item").forEach((item) => {
        item.classList.remove("active");
        item.querySelector(".accordion-content").style.maxHeight = null;
        item.querySelector(".accordion-icon").textContent = "+";
    });

    if (!isActive) {
        accordionItem.classList.add("active");
        content.style.maxHeight = content.scrollHeight + "px";
        accordionItem.querySelector(".accordion-icon").textContent = "-";
    }
}

// contact us
const btnSubmitContact = document.getElementById("btn-submit-contact");
const apiContact = "http://127.0.0.1:8000/api/contact";

btnSubmitContact.addEventListener("click", async function (event) {
    let inputName = document.getElementById("name");
    let inputEmail = document.getElementById("email");
    let inputSubject = document.getElementById("subject");
    let inputMessage = document.getElementById("message");

    event.preventDefault();

    const inputs = document.querySelectorAll(
        ".contact-form input, .contact-form textarea"
    );
    let hasError = false;

    inputs.forEach((input) => {
        const errorText = input.parentElement.querySelector(".error-message");

        input.style.border = "";
        if (errorText) {
            errorText.remove();
        }

        if (!input.value.trim()) {
            hasError = true;
            input.style.border = "2px solid rgba(178, 1, 16, 1)";

            const errorMessage = document.createElement("span");
            errorMessage.classList.add("error-message");
            errorMessage.textContent = "Tidak boleh kosong";
            input.parentElement.appendChild(errorMessage);
        }
    });

    if (hasError) return;

    try {
        let response = await fetch(apiContact, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                name: inputName.value,
                email: inputEmail.value,
                subject: inputSubject.value,
                message: inputMessage.value,
            }),
        });

        let result = await response.json();
        if (response.ok) {
            alert("Berhasil dikirim!");
            inputName.value = "";
            inputEmail.value = "";
            inputSubject.value = "";
            inputMessage.value = "";
        } else {
            console.error("Error Response:", result);
            alert(result.message || "Terjadi kesalahan pada server");
        }
    } catch (error) {
        console.error("Fetch Error:", error);
        alert("Gagal mengirim pesan");
    }
});

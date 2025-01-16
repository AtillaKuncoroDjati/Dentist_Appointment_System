document.addEventListener("DOMContentLoaded", function () {
    fetchContactMessages();

    document
        .getElementById("closeModalBtn")
        .addEventListener("click", closeModal);
    document
        .getElementById("closeModalBtnFooter")
        .addEventListener("click", closeModal);
    document
        .getElementById("sendResponseBtn")
        .addEventListener("click", sendResponse);
    document
        .getElementById("closeSuccessBtn")
        .addEventListener("click", closeSuccessModal);
});

function fetchContactMessages() {
    fetch("/contact/messages")
        .then((response) => response.json())
        .then((data) => {
            const messagesContainer =
                document.getElementById("contact-messages");
            messagesContainer.innerHTML = "";

            data.forEach((message) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                <td>${message.name}</td>
                <td>${message.email}</td>
                <td>${message.subject}</td>
                <td>${message.message}</td>
                <td>
                    ${
                        message.responded
                            ? '<button class="responded-btn" disabled>Responded</button>'
                            : `<button class="respond-btn" data-id="${message.id}" data-email="${message.email}">Respond</button>`
                    }
                </td>
            `;
                messagesContainer.appendChild(row);
            });

            document.querySelectorAll(".respond-btn").forEach((button) => {
                button.addEventListener("click", function () {
                    const messageId = this.getAttribute("data-id");
                    openModal(messageId);
                });
            });
        })
        .catch((error) =>
            console.error("Error fetching contact messages:", error)
        );
}

function openModal(messageId) {
    document.getElementById("messageId").value = messageId;
    document.getElementById("responseModal").style.display = "block";
}

function closeModal() {
    document.getElementById("responseModal").style.display = "none";
}

function closeSuccessModal() {
    document.getElementById("successModal").style.display = "none";
}

function sendResponse() {
    const messageId = document.getElementById("messageId").value;
    const responseMessage = document.getElementById("response").value;
    const loadingOverlay = document.getElementById("loading-overlay");

    closeModal(); // Close response modal before showing loading overlay
    loadingOverlay.style.display = "block";

    fetch("/contact/send-response", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
        },
        body: JSON.stringify({
            messageId: messageId,
            response: responseMessage,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            loadingOverlay.style.display = "none";

            if (data.status === "success") {
                // Show success modal
                document.getElementById("successModal").style.display = "block";

                // Close success modal and update button text after closing
                document
                    .getElementById("closeSuccessBtn")
                    .addEventListener("click", function () {
                        document.getElementById("successModal").style.display =
                            "none";

                        // Update button in the table to 'responded'
                        const respondBtn = document.querySelector(
                            `button[data-id="${messageId}"]`
                        );
                        if (respondBtn) {
                            respondBtn.classList.remove("respond-btn");
                            respondBtn.classList.add("responded-btn");
                            respondBtn.disabled = true;
                            respondBtn.innerHTML = "Responded";
                        }
                    });
            } else {
                alert("Failed to send response.");
            }
            fetchContactMessages(); // Refresh contact messages list
        })
        .catch((error) => {
            console.error("Error sending response:", error);
            loadingOverlay.style.display = "none";
            alert("Failed to send response.");
        });
}

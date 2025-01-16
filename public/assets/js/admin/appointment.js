function updateStatus(id, action) {
    const statusElement = document.getElementById(`status-${id}`);
    const acceptButton = document.getElementById(`accept-btn-${id}`);
    const cancelButton = document.getElementById(`cancel-btn-${id}`);
    const loadingOverlay = document.getElementById("loading-overlay");
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const url =
        action === "accept"
            ? `/appointment/accept/${id}`
            : `/appointment/cancel/${id}`;

    // Show loading overlay and disable buttons
    loadingOverlay.style.display = "block";
    acceptButton.disabled = true;
    cancelButton.disabled = true;

    fetch(url, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "Content-Type": "application/json",
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                if (action === "accept") {
                    statusElement.textContent = "Accepted";
                    statusElement.className = "status status-accepted";
                } else if (action === "cancel") {
                    statusElement.textContent = "Canceled";
                    statusElement.className = "status status-canceled";
                }

                // Disable action buttons after status update
                acceptButton.disabled = true;
                cancelButton.disabled = true;
            } else {
                console.error("Error:", data);
                alert("Failed to update status. Please try again.");
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("An error occurred while processing your request.");
        })
        .finally(() => {
            // Hide loading overlay
            loadingOverlay.style.display = "none";
        });
}

function filterAppointments() {
    const doctorFilter = document.getElementById("doctor-filter").value;
    const statusFilter = document
        .getElementById("status-filter")
        .value.toLowerCase(); // Ubah filter ke huruf kecil

    document.querySelectorAll("tbody tr").forEach(function (row) {
        const doctor = row.getAttribute("data-doctor");
        const status = row.getAttribute("data-status").toLowerCase(); // Ubah status data ke huruf kecil

        const doctorMatch = !doctorFilter || doctor === doctorFilter;
        const statusMatch = !statusFilter || status === statusFilter;

        if (doctorMatch && statusMatch) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}

function resetFilters() {
    document.getElementById("doctor-filter").value = "";
    document.getElementById("status-filter").value = "";
    filterAppointments();
}

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".accept-btn").forEach(function (button) {
        button.addEventListener("click", function () {
            const appointmentId = this.getAttribute("data-id");
            updateStatus(appointmentId, "accept");
        });
    });

    document.querySelectorAll(".cancel-btn").forEach(function (button) {
        button.addEventListener("click", function () {
            const appointmentId = this.getAttribute("data-id");
            updateStatus(appointmentId, "cancel");
        });
    });

    document
        .getElementById("doctor-filter")
        .addEventListener("change", filterAppointments);
    document
        .getElementById("status-filter")
        .addEventListener("change", filterAppointments);
    document
        .getElementById("reset-filters-btn")
        .addEventListener("click", resetFilters);
});

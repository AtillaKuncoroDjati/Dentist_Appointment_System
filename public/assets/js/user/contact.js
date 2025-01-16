$(document).ready(function () {
    $("#messageForm").submit(function (event) {
        event.preventDefault();
        var form = $(this);
        var formData = form.serialize();

        $.ajax({
            type: "POST",
            url: form.attr("action"),
            data: formData,
            dataType: "json",
            success: function (response) {
                $("#successMessage")
                    .text("Pesan berhasil terkirim!")
                    .slideDown();
                $("#errorMessage").hide();
                form.trigger("reset");
            },
            error: function (xhr, status, error) {
                $("#errorMessage")
                    .text(
                        "Error: Gagal mengirim appointment. Please try again."
                    )
                    .slideDown();
                $("#successMessage").hide();
                form.trigger("reset");
            },
        });
    });
});

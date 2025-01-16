$(document).ready(function () {
    var today = new Date();
    var endOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);

    var flatpickrOptions = {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true,
        minuteIncrement: 60,
        defaultHour: 10,
        defaultMinute: 0,
        minDate: today,
        maxDate: endOfMonth,
        disableMobile: true,
        disable: [
            function (date) {
                return date.getDay() === 0 || date.getDay() === 6;
            },
            function (date) {
                if (
                    date.toDateString() === today.toDateString() &&
                    today.getHours() >= 18
                ) {
                    return true;
                }
                return false;
            },
        ],
        onChange: function (selectedDates, dateStr, instance) {
            if (selectedDates.length > 0) {
                var selectedDate = selectedDates[0];
                var minTime = "10:00";
                if (selectedDate.toDateString() === today.toDateString()) {
                    var currentHour = today.getHours();
                    if (currentHour < 10) {
                        minTime = "10:00";
                    } else if (currentHour >= 10 && currentHour < 18) {
                        minTime = currentHour + ":00";
                    } else {
                        minTime = "18:00";
                    }
                }
                instance.set("minTime", minTime);
                instance.set("maxTime", "18:00");
            }
        },
    };

    if (today.getHours() >= 18) {
        flatpickrOptions.disable.push(today);
    }

    var flatpickrInstance = flatpickr("#date", flatpickrOptions);

    $("#date, #doctor").on("change", function () {
        var date = $("#date").val().split(" ")[0];
        var doctor = $("#doctor").val();

        if (date && doctor) {
            $.ajax({
                type: "POST",
                url: $("#appointmentForm").data("availability-url"),
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    date: date,
                    doctor: doctor,
                },
                success: function (response) {
                    var bookedHours = response.booked;
                    var availableHours = response.available;

                    var selectedDate = flatpickrInstance.selectedDates[0];
                    var selectedHour = selectedDate.getHours();
                    var selectedTime = selectedHour + ":00";

                    if (bookedHours.includes(selectedTime)) {
                        var availableTimesHtml = availableHours
                            .map(function (time) {
                                return "<li>" + time + "</li>";
                            })
                            .join("");

                        $("#availableTimesList").html(availableTimesHtml);
                        $("#availabilityModal").modal("show");
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                },
            });
        }
    });

    $("#appointmentForm").submit(function (event) {
        event.preventDefault();

         // Check if the file input (proof) is empty
         if (!$("#proof")[0].files.length) {
            $("#errorMessage").text("Please upload proof of transfer.").show();
            return; // Prevent form submission if no file is selected
        }

        var form = $(this);
        var formData = new FormData(form[0]); // Use FormData to include file inputs

        $.ajax({
            type: "POST",
            url: form.attr("action"),
            data: formData,
            processData: false, // Required for FormData
            contentType: false, // Required for FormData
            success: function (response) {
                $("p").hide();
                $("#appointmentForm").children().not(".my-3").hide();
                $("#appointmentForm").trigger("reset");
                $("#successMessage").show();
                $("#errorMessage").hide();
            },
            error: function (xhr, status, error) {
                if (xhr.status === 422) {
                    var errorMessage = JSON.parse(xhr.responseText).message;
                    $("#errorMessage").text(errorMessage).show();
                    $("#successMessage").hide();
                } else {
                    $("#errorMessage")
                        .text(
                            "Error: Failed to submit appointment. Please try again later."
                        )
                        .show();
                    $("#successMessage").hide();
                }
            },
        });
    });
});

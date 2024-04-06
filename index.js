document.addEventListener("DOMContentLoaded", function() {
    const showFormButton = document.getElementById("show-form-button");
    const appointmentForm = document.getElementById("appointment-form");
    const confirmationContainer = document.getElementById("confirmation-container");

    showFormButton.addEventListener("click", function() {
        showFormButton.classList.add("hidden");
        appointmentForm.classList.remove("hidden");
    });

    appointmentForm.addEventListener("submit", function(event) {
        event.preventDefault();

        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const service = document.getElementById("service").value;
        const date = document.getElementById("date").value;

        const confirmationMessage = document.createElement("p");
        confirmationMessage.textContent = "Appointment booked successfully!";

        const appointmentDetails = document.createElement("div");
        appointmentDetails.innerHTML = `
            <p><strong>Name:</strong> ${name}</p>
            <p><strong>Email:</strong> ${email}</p>
            <p><strong>Service:</strong> ${service}</p>
            <p><strong>Date:</strong> ${date}</p>
        `;


        confirmationContainer.appendChild(confirmationMessage);
        confirmationContainer.appendChild(appointmentDetails);

        appointmentForm.classList.add("hidden");
        confirmationContainer.classList.remove("hidden");
    });
});

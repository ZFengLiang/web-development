document.addEventListener("DOMContentLoaded", function () {
    const serviceList = document.querySelectorAll(".service-item");
    const priceDisplay = document.getElementById("servicePrice");
    const nextBtn = document.getElementById("goToStep2");
    const serviceIdInput = document.getElementById("selectedServiceId");

    const step1 = document.getElementById("step-1");
    const step2 = document.getElementById("step-2");

    const dateInput = document.getElementById("appointmentDate");
    const barberSelect = document.getElementById("barberSelect");
    const timeSelect = document.getElementById("appointmentTime");

    // Step 1: Handle service selection
    serviceList.forEach(button => {
        button.addEventListener("click", function () {
            serviceList.forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");

            const price = this.getAttribute("data-price");
            const id = this.getAttribute("data-id");

            priceDisplay.textContent = "€" + parseFloat(price).toFixed(2);
            serviceIdInput.value = id;
            nextBtn.disabled = false;
        });
    });

    // Move to Step 2
    nextBtn.addEventListener("click", function () {
        step1.style.display = "none";
        step2.style.display = "block";
    });

    // Go back to Step 1
    document.getElementById("backToStep1").addEventListener("click", function () {
        step2.style.display = "none";
        step1.style.display = "block";
    });

    // Step 2: Fetch available time slots
    function fetchAvailableSlots() {
        const date = dateInput.value;
        const barberId = barberSelect.value;

        if (date && barberId) {
            fetch(`/appointment/available-slots?barber_id=${barberId}&date=${date}`)
                .then(res => res.json())
                .then(slots => {
                    timeSelect.innerHTML = '';

                    if (slots.length === 0) {
                        const option = document.createElement("option");
                        option.textContent = "No available time slots";
                        option.disabled = true;
                        option.selected = true;
                        timeSelect.appendChild(option);
                    } else {
                        const defaultOption = document.createElement("option");
                        defaultOption.textContent = "Select a time";
                        defaultOption.disabled = true;
                        defaultOption.selected = true;
                        timeSelect.appendChild(defaultOption);

                        slots.forEach(time => {
                            const option = document.createElement("option");
                            option.value = time;
                            option.textContent = time;
                            timeSelect.appendChild(option);
                        });
                    }
                })
                .catch(err => {
                    console.error("Error loading slots:", err);
                });
        }
    }

    dateInput.addEventListener("change", fetchAvailableSlots);
    barberSelect.addEventListener("change", fetchAvailableSlots);
});

document.addEventListener("DOMContentLoaded", function () {
    const dateInput = document.getElementById("appointmentDate");
    const barberSelect = document.getElementById("barberSelect");
    const timeSelect = document.getElementById("appointmentTime");

    function fetchAvailableSlots() {
        const date = dateInput.value;
        const barberId = barberSelect.value;

        if (date && barberId) {
            fetch(`/appointment/available-slots?barber_id=${barberId}&date=${date}`)
                .then(res => res.json())
                .then(slots => {
                    timeSelect.innerHTML = '';
                    if (slots.length === 0) {
                        timeSelect.innerHTML = '<option disabled selected>No available time slots</option>';
                    } else {
                        timeSelect.innerHTML = '<option disabled selected>Select a time</option>';
                        slots.forEach(time => {
                            const option = document.createElement('option');
                            option.value = time;
                            option.textContent = time;
                            timeSelect.appendChild(option);
                        });
                    }
                })
                .catch(error => console.error('Error fetching time slots:', error));
        }
    }

    dateInput.addEventListener("change", fetchAvailableSlots);
    barberSelect.addEventListener("change", fetchAvailableSlots);
});
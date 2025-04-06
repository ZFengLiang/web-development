<div class="container py-5">
    <h2 class="mb-4">Reschedule Appointment</h2>

    <form action="/appointment/reschedule" method="POST">
        <input type="hidden" name="appointment_id" value="<?= htmlspecialchars($appointment['appointment_id']) ?>">

        <!-- Current Appointment Info -->
        <div class="mb-3">
            <label class="form-label">Current Appointment</label>
            <p><?= htmlspecialchars($appointment['appointment_date']) ?> at <?= htmlspecialchars($appointment['appointment_time']) ?></p>
        </div>

        <!-- Barber Selection -->
        <div class="mb-3">
            <label for="barberSelect" class="form-label">Select Barber</label>
            <select name="barber_id" id="barberSelect" class="form-select" required>
                <option value="" disabled selected>Select a barber</option>
                <?php foreach ($barbers as $barber): ?>
                    <option value="<?= $barber['user_id'] ?>" <?= $barber['user_id'] == $appointment['barber_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($barber['username']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- New Date -->
        <div class="mb-3">
            <label for="appointmentDate" class="form-label">New Date</label>
            <input type="date" name="appointment_date" id="appointmentDate" class="form-control" required min="<?= date('Y-m-d') ?>">
        </div>

        <!-- New Time -->
        <div class="mb-3">
            <label for="appointmentTime" class="form-label">New Time</label>
            <select name="appointment_time" id="appointmentTime" class="form-select" required>
                <option value="">Select a time</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit New Time</button>
    </form>
</div>

<!-- JS -->
<script src="/assets/js/reschedule.js"></script>
<div class="container py-5">
    <h2 class="mb-4">My Bookings</h2>

    <?php if (empty($appointments)): ?>
        <p>No appointments yet.</p>
    <?php else: ?>
        <div class="list-group">
            <?php foreach ($appointments as $appt): ?>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h5><?= htmlspecialchars($appt['service_name']) ?> for <?= htmlspecialchars($appt['customer_name']) ?></h5>
                        <p><?= htmlspecialchars($appt['appointment_date']) ?> at <?= htmlspecialchars($appt['appointment_time']) ?> | <strong><?= $appt['status'] ?></strong></p>
                    </div>
                    <?php if ($appt['status'] === 'booked'): ?>
                        <form action="/appointment/cancel" method="POST" class="d-inline">
                            <input type="hidden" name="appointment_id" value="<?= $appt['appointment_id'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<div class="container py-5">
    <h2 class="mb-4">My Appointments</h2>

    <?php if (empty($appointments)): ?>
        <p>No appointments found.</p>
    <?php else: ?>
        <div class="list-group">
            <?php foreach ($appointments as $appt): ?>
                <div class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h5 class="mb-1"><?= htmlspecialchars($appt['service_name']) ?> with <?= htmlspecialchars($appt['barber_name']) ?></h5>
                        <p class="mb-1">
                            <?= htmlspecialchars($appt['appointment_date']) ?> at <?= htmlspecialchars($appt['appointment_time']) ?> |
                            Status: <strong><?= htmlspecialchars($appt['status']) ?></strong>
                        </p>
                    </div>

                    <?php if ($appt['status'] === 'booked'): ?>
                        <div class="d-flex gap-2 mt-2 mt-md-0">
                            <form action="/appointment/cancel" method="POST" class="d-inline">
                                <input type="hidden" name="appointment_id" value="<?= $appt['appointment_id'] ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
                            </form>

                            <form action="/appointment/reschedule" method="GET" class="d-inline">
                                <input type="hidden" name="appointment_id" value="<?= $appt['appointment_id'] ?>">
                                <button type="submit" class="btn btn-sm btn-warning">Reschedule</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
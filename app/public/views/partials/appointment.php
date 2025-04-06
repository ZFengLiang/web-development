<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Appointment</title>
    <link rel="stylesheet" href="../../assets/css/ServiceStyle.css"/>
</head>
<body>
    
<div class="container py-5">
    <h2 class="text-center mb-4">Book an Appointment</h2>

    <!-- Step 1: Service Selection -->
    <div id="step-1">
        <h4 class="mb-3">Choose a Service</h4>

        <!-- Scrollable list container -->
        <div class="scrollable-service-list mb-3 p-2 border rounded bg-light">
            <?php
            $groupedServices = [];
            foreach ($services as $service) {
                $groupedServices[$service['category']][] = $service;
            }
            ?>
            <?php foreach ($groupedServices as $category => $serviceGroup): ?>
                <div class="mb-4">
                    <h5 class="fw-bold"><?= htmlspecialchars($category) ?></h5>
                    <div class="list-group">
                        <?php foreach ($serviceGroup as $service): ?>
                            <button type="button"
                                    class="list-group-item list-group-item-action service-item"
                                    data-id="<?= $service['service_id'] ?>"
                                    data-price="<?= $service['price'] ?>">
                                <div class="fw-bold"><?= htmlspecialchars($service['service_name']) ?></div>
                                <small class="d-block text-muted"><?= htmlspecialchars($service['description']) ?></small>
                                <small class="text-muted">€<?= number_format($service['price'], 2) ?></small>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mb-4">
            <label class="form-label">Price</label>
            <div id="servicePrice" class="fw-bold">€0.00</div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary" id="goToStep2" disabled>Next</button>
        </div>
    </div>
    <?php if (isset($_GET['slot_taken']) && $_GET['slot_taken'] == 1): ?>
    <script>
        alert("⚠️ This time slot is already taken. Please choose another.");
    </script>
<?php endif; ?>
    <!-- Form for Step 2 -->
    <form action="/appointment/save" method="POST" id="appointmentForm">
        <!-- Hidden Service ID (must be inside the form to be submitted) -->
        <input type="hidden" name="service_id" id="selectedServiceId" />

        <!-- Step 2: Date & Time Selection -->
        <div id="step-2" style="display:none;">
            <h4 class="mb-3">Choose Date & Time</h4>

            <!-- Select Barber -->
            <div class="mb-3">
                <label class="form-label">Select a Barber</label>
                <select class="form-select" name="barber_id" id="barberSelect" required>
                    <option value="" disabled selected>Select a Barber</option>
                    <?php foreach ($barbers as $barber): ?>
                        <option value="<?= $barber['user_id'] ?>"><?= htmlspecialchars($barber['username']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Select Date -->
            <div class="mb-3">
                <label class="form-label">Select a Date</label>
                <input type="date" name="appointment_date" id="appointmentDate" class="form-control" required min="<?= date('Y-m-d') ?>">
            </div>

            <!-- Time Slots -->
            <div class="mb-3">
                <label class="form-label">Available Time Slots</label>
                <select class="form-select" name="appointment_time" id="appointmentTime" required>
                    <option value="">Select a time</option>
                    <!-- Options will be populated via JS -->
                </select>
            </div>

            <!-- Navigation Buttons -->
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" id="backToStep1">Back</button>
                <button type="submit" class="btn btn-success">Confirm Appointment</button>
            </div>
        </div>
    </form>
</div>

<script src="/assets/js/appointment.js"></script>
</body>
</html>

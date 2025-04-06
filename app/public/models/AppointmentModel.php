<?php
require_once(__DIR__ . '/BaseModel.php');

class AppointmentModel extends BaseModel
{
    public function createAppointment($data)
    {
    $stmt = self::$pdo->prepare("
        INSERT INTO appointment (customer_id, barber_id, service_id, appointment_date, appointment_time, status)
        VALUES (:customer_id, :barber_id, :service_id, :appointment_date, :appointment_time, :status)
    ");
    $stmt->execute($data);
    }
    public function getAppointmentsByCustomerId($customerId)
    {
    $stmt = self::$pdo->prepare("
        SELECT a.*, s.service_name, u.username AS barber_name
        FROM appointment a
        JOIN service s ON a.service_id = s.service_id
        JOIN user u ON a.barber_id = u.user_id
        WHERE a.customer_id = :customerId
        ORDER BY a.appointment_date DESC, a.appointment_time DESC
    ");
    $stmt->execute(['customerId' => $customerId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cancelAppointment($appointmentId, $customerId)
    {
    $stmt = self::$pdo->prepare("
        UPDATE appointment 
        SET status = 'cancelled'
        WHERE appointment_id = :appointmentId AND customer_id = :customerId
    ");
    return $stmt->execute([
        'appointmentId' => $appointmentId,
        'customerId' => $customerId
    ]);
    }
    public function getAppointmentById($appointmentId)
{
    $stmt = self::$pdo->prepare("SELECT * FROM appointment WHERE appointment_id = :id");
    $stmt->execute(['id' => $appointmentId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    public function updateAppointment($id, $barberId, $date, $time)
    {
    $stmt = self::$pdo->prepare("
        UPDATE appointment 
        SET barber_id = :barber, appointment_date = :date, appointment_time = :time, status = 'booked', updated_at = NOW()
        WHERE appointment_id = :id
    ");
    return $stmt->execute([
        'id' => $id,
        'barber' => $barberId,
        'date' => $date,
        'time' => $time
    ]);
    }
    public function isTimeSlotAvailable($barberId, $date, $time, $excludeAppointmentId = null)
    {
    $sql = "SELECT COUNT(*) FROM appointment 
            WHERE barber_id = :barberId AND appointment_date = :date AND appointment_time = :time AND status = 'booked'";

    if ($excludeAppointmentId) {
        $sql .= " AND appointment_id != :excludeId";
    }

    $stmt = self::$pdo->prepare($sql);

    $stmt->bindParam(':barberId', $barberId);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':time', $time);

    if ($excludeAppointmentId) {
        $stmt->bindParam(':excludeId', $excludeAppointmentId);
    }

    $stmt->execute();
    return $stmt->fetchColumn() == 0; // true = available
    }
    public function getAppointmentsByBarberId($barberId)
{
    $stmt = self::$pdo->prepare("
        SELECT a.*, u.username AS customer_name, s.service_name
        FROM appointment a
        JOIN user u ON a.customer_id = u.user_id
        JOIN service s ON a.service_id = s.service_id
        WHERE a.barber_id = :barberId
        ORDER BY a.appointment_date, a.appointment_time
    ");
    $stmt->execute(['barberId' => $barberId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}

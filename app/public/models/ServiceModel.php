<?php
require_once(__DIR__ . "/BaseModel.php");

class ServiceModel extends BaseModel
{
    public function getAllServices()
    {
        $stmt = self::$pdo->query("SELECT * FROM service");
        return $stmt->fetchAll();
    }

    public function getBookedSlotsByBarberAndDate($barberId, $date)
    {
    $stmt = self::$pdo->prepare("
        SELECT appointment_time 
        FROM appointment 
        WHERE barber_id = :barberId AND appointment_date = :date AND status = 'booked'
    ");
    $stmt->execute([
        'barberId' => $barberId,
        'date' => $date
    ]);

    return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}

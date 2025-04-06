<?php
require_once(__DIR__ . '/../models/ServiceModel.php');
require_once(__DIR__ . '/../models/UserModel.php');
require_once(__DIR__ . '/../models/AppointmentModel.php');

class AppointmentController
{
    private $serviceModel;
    private $userModel;
    private $appointmentModel;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
        $this->userModel = new UserModel();
        $this->appointmentModel = new AppointmentModel();
    }

    public function showAppointmentForm()
    {
        $services = $this->serviceModel->getAllServices();
        $barbers = $this->userModel->getAllBarbers(); 

        require(__DIR__ . '/../views/pages/appointment.php');
    }

    public function getAvailableSlots($barberId, $date)
    {
        $bookedTimes = $this->serviceModel->getBookedSlotsByBarberAndDate($barberId, $date);

        $dayOfWeek = date('w', strtotime($date));
        $start = ($dayOfWeek == 6) ? "10:00" : "09:00";
        $end = "18:00";

        $slots = [];
        $current = strtotime($start);
        $endTime = strtotime($end);

        while ($current < $endTime) {
            $time = date("H:i", $current);
            if (!in_array($time, $bookedTimes)) {
                $slots[] = $time;
            }
            $current = strtotime("+30 minutes", $current);
        }

        header('Content-Type: application/json');
        echo json_encode($slots);
    }

    public function saveAppointment()
{
    $customerId = $_SESSION['user_id'] ?? null;

    if (!$customerId) {
        header("Location: /login");
        exit;
    }

    $data = [
        'customer_id'       => $customerId,
        'barber_id'         => $_POST['barber_id'],
        'service_id'        => $_POST['service_id'],
        'appointment_date'  => $_POST['appointment_date'],
        'appointment_time'  => $_POST['appointment_time'],
        'status'            => 'booked'
    ];

    if (!$this->appointmentModel->isTimeSlotAvailable($data['barber_id'], $data['appointment_date'], $data['appointment_time'])) {
        header("Location: /appointment?slot_taken=1");
        exit;
    }

    $this->appointmentModel->createAppointment($data);
    header("Location: /appointment/success");
    exit;
}

    public function showCustomerDashboard()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

        $customerId = $_SESSION['user_id'];
        $appointments = $this->appointmentModel->getAppointmentsByCustomerId($customerId);

        require(__DIR__ . '/../views/pages/dashboard.php');
    }

    public function cancelAppointment()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

        $appointmentId = $_POST['appointment_id'];
        $customerId = $_SESSION['user_id'];

        $this->appointmentModel->cancelAppointment($appointmentId, $customerId);
        header("Location: /dashboard");
        exit;
    }

    public function showRescheduleForm()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

        $appointmentId = $_GET['appointment_id'];
        $appointment = $this->appointmentModel->getAppointmentById($appointmentId);

        if (!$appointment || $appointment['customer_id'] != $_SESSION['user_id']) {
            echo "Unauthorized access.";
            exit;
        }

        $barbers = $this->userModel->getAllBarbers();
        require(__DIR__ . '/../views/pages/reschedule.php');
    }

    public function saveReschedule()
{
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error'] = "Please login to reschedule your appointment.";
        header("Location: /login");
        exit;
    }

    $appointmentId = $_POST['appointment_id'];
    $barberId = $_POST['barber_id'];
    $date = $_POST['appointment_date'];
    $time = $_POST['appointment_time'];

    if (!$this->appointmentModel->isTimeSlotAvailable($barberId, $date, $time, $appointmentId)) {
        $_SESSION['error'] = "⚠️ That time is already taken. Please choose a different one.";
        header("Location: /appointment/reschedule?appointment_id=" . $appointmentId);
        exit;
    }

    $this->appointmentModel->updateAppointment($appointmentId, $barberId, $date, $time);
    $_SESSION['success'] = "✅ Appointment rescheduled successfully!";
    header("Location: /dashboard");
    exit;
}
public function showBarberDashboard()
{
    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'barber') {
        header("Location: /login");
        exit;
    }

    $barberId = $_SESSION['user_id'];
    $model = new AppointmentModel();
    $appointments = $model->getAppointmentsByBarberId($barberId);

    require(__DIR__ . '/../views/pages/barber_dashboard.php');
}
}
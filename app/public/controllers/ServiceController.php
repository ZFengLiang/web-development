<?php
require_once(__DIR__ . '/../models/ServiceModel.php');

class ServiceController {
    private $serviceModel;

    public function __construct() {
        $this->serviceModel = new ServiceModel();
    }

    public function getAllServices() {
        return $this->serviceModel->getAllServices();
    }

    public function showServices() {
        $services = $this->getAllServices();

        $groupedServices = [];
        foreach ($services as $service) {
            $groupedServices[$service['category']][] = $service;
        }

        require(__DIR__ . '/../views/pages/service.php');
    }
    
}

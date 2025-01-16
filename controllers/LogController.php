<?php

class LogController
{
    private $db;
    private $logger;

    public function __construct()
    {
        $this->db = new Database();
        $this->logger = new Logger($this->db);
    }

    public function index() {
        $sql = "SELECT * FROM logs ORDER BY date_time DESC";
        $stmt = $this->db->query($sql);
        $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        include __DIR__ . '/../views/logs/index.php';
    }
}
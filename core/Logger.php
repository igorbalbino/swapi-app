<?php

class Logger
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function log($request, $message = '')
    {
        $sql = "INSERT INTO logs (date_time, request, message) VALUES (:date_time, :request, :message)";
        $date_time = date('Y-m-d H:i:s');
        $params = [
            ':date_time' => $date_time,
            ':request' => $request,
            ':message' => $message,
        ];
        
        try {
          $this->db->query($sql, $params);
          return true;
        } catch (Exception $e) {
            return false;
        }
        
    }
}
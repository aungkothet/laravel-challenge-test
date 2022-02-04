<?php

namespace App\Services\EmployeeManagement;

class Staff implements Employee
{
    public function applyJob()
    {
        return true;
    }
    
    public function salary(): int
    {
        return 200;
    }
}
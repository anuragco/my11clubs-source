<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index()
    {
        // Sample data to pass to the view
        $salaries = [
            ['name' => 'John Doe', 'amount' => 5000],
            ['name' => 'Jane Smith', 'amount' => 6000],
            ['name' => 'Michael Johnson', 'amount' => 5500],
        ];

        // Pass the data to the view
        return view('admin.salary.index', compact('salaries'));
    }
}

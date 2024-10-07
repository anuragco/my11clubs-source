<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class UserDetailsController extends Controller
{
  public function index()
  {
    $users = User::all();
    $pageTitle = 'User Details';

    return view('admin.userdetails', compact('users', 'pageTitle'));
  }

 public function exportPdf()
    {
        $users = User::all();

        // Load PDF view
        $pdf = PDF::loadView('admin.pdf', compact('users'));

        // Optional: Set PDF properties
        $pdf->setPaper('A4', 'portrait');

        // Generate and return PDF
        return $pdf->stream('user_details.pdf');
    }
}

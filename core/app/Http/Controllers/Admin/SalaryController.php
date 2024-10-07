<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index(Request $request): View
    {
        $pageTitle = 'Salary Management';
        $emptyMessage = 'No user data found';

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Get sorting direction from request, default to 'desc'
        $sortDirection = $request->get('sort', 'desc');
        // Get search query from request
        $search = $request->get('search', '');

        // Fetch users and their referrer details
        $users = User::select('users.id', 'users.username', 'users.balance', 'users.ref_by', 'referrer.username as referrer_username')
            ->leftJoin('users as referrer', 'users.ref_by', '=', 'referrer.id')
            ->leftJoin('commission_logs as total_directs', function ($join) {
                $join->on('users.id', '=', 'total_directs.to_id')
                    ->where('total_directs.level', 1);
            })
            ->leftJoin('commission_logs as npm_directs', function ($join) use ($currentMonth, $currentYear) {
                $join->on('users.id', '=', 'npm_directs.to_id')
                    ->where('npm_directs.level', 1)
                    ->whereMonth('npm_directs.created_at', $currentMonth)
                    ->whereYear('npm_directs.created_at', $currentYear);
            })
            ->groupBy('users.id', 'users.username', 'users.balance', 'users.ref_by', 'referrer.username')
            ->select(
                'users.id',
                'users.username',
                'users.balance',
                DB::raw('COUNT(DISTINCT total_directs.from_id) as total_direct'),
                DB::raw('COUNT(DISTINCT npm_directs.from_id) as npm_direct'),
                'referrer.username as referrer_username'
            )
            ->when($search, function($query, $search) {
                return $query->where('users.username', 'like', '%' . $search . '%');
            })
            ->orderBy('total_direct', $sortDirection) // Apply sorting
            ->paginate(15);

        return view('admin.salary', compact('pageTitle', 'emptyMessage', 'users', 'sortDirection', 'search'));
    }
}

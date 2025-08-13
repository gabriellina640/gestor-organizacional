<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\Meeting;

class DashboardController extends Controller
{
    public function index()
{
    $participantsCount = Participant::count();
    $meetingsCount = Meeting::count();
    $meetings = Meeting::latest()->take(5)->get(); // últimas 5 reuniões
    return view('dashboard.index', compact('participantsCount', 'meetingsCount', 'meetings'));
}

}

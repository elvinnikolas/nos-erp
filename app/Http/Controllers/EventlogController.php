<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\eventlog;

class EventlogController extends Controller
{
    public function index()
    {
        $eventlog = eventlog::orderBy('id', 'DESC')->paginate(20);
        return view('eventlog.index', compact('eventlog'));
    }
}

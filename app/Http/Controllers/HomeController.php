<?php

namespace App\Http\Controllers;

use App\Services\DataService;

class HomeController extends Controller
{
    protected $dataService;

    /**
     * Create a new controller instance.
     *
     * HomeController constructor.
     * @param DataService $dataService
     */
    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('index', $this->dataService->getFormData());
    }
}

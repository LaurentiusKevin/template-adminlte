<?php

namespace App\View\Components\Admin;

use App\Services\DashboardService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class SidebarComponent extends Component
{
    private $service;

    /**
     * Create a new component instance.
     *
     * @param DashboardService $service
     */
    public function __construct(DashboardService $service)
    {
        $this->service = $service;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.admin.sidebar-component')
            ->with([
                'sidebar' => $this->service->sidebar(),
                'user' => Auth::user()
            ]);
    }
}

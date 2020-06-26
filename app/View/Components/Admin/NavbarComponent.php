<?php

namespace App\View\Components\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NavbarComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.admin.navbar-component')
            ->with([
                'user' => Auth::user()
            ]);
    }
}

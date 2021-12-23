<?php

namespace App\Http\Livewire;

use App\Models\Invoices;
use Livewire\Component;

class Dashboard extends Component
{
    public $inv_count;
    public $pending,$processed;


    public function mount(){
        $this->inv_count=Invoices::count();

        $this->pending=Invoices::where('processed',null)->count();


        $this->processed=Invoices::where('processed','!=',null)->count();

    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Invoices;
use Livewire\Component;

class ProcessedInvoices extends Component
{

    public $chickenProject,$cornProject;

    public $selectedInvoice;


    public function mount(){

        $this->chickenProject=Invoices::
         where('processed',true)
        ->where('project',1)
        ->get();

        $this->cornProject=Invoices::
         where('processed',true)
        ->where('project',2)
        ->get();
    }

    public function setSelectedId(Invoices $invoice)
    {
         $this->selectedInvoice=$invoice;
    }

    public function downloadInvoice($path){

        return response()->download(public_path('storage/'.$path));

     }

     public function resetSelected()
     {
        return redirect()->route('processed-invoice');
    }



    public function render()
    {
        return view('livewire.processed-invoices');
    }
}

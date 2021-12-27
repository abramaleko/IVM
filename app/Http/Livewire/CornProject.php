<?php

namespace App\Http\Livewire;

use App\Models\Invoices;
use Livewire\WithPagination;



use Livewire\Component;

class CornProject extends Component
{
    use WithPagination;

    public $selectedInvoice;

    public $search;


    public function setSelectedId(Invoices $invoice)
    {
        $this->selectedInvoice = $invoice;
    }

    public function downloadInvoice($path)
    {

        return response()->download(public_path('storage/' . $path));
    }

    public function resetSelected()
    {
        $this->reset('selectedInvoice');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        $cornProject = $this->search == ''

            ? Invoices::where('processed', true)
            ->where('project', 2)
            ->paginate(10)

            :
            Invoices::where('project', 2)
            ->where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);


        return view('livewire.corn-project', [
            'cornProject' => $cornProject,
        ]);
    }
}

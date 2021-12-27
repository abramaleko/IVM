<?php

namespace App\Http\Livewire;

use App\Models\Invoices;
use Livewire\WithPagination;


use Livewire\Component;

class RearingProject extends Component
{
    use WithPagination;

    public $selectedInvoice;

    public $search = '';

    public $filter="",$range="",$showRange=false;


    public function setSelectedId(Invoices $invoice)
    {
         $this->selectedInvoice=$invoice;
    }

    public function downloadInvoice($path){

        return response()->download(public_path('storage/'.$path));
     }

     public function resetSelected()
     {
         $this->reset('selectedInvoice');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedFilter(){
        switch ($this->filter) {
            case '1':
                $this->showRange=true;
                break;
                case '2':
                    $this->showRange=false;
                    $this->showSubmitted();

                    break;
                    case '3':
                        $this->showRange=false;
                        $this->showPendingSubmit();
                        break;

        }
    }

    public function updatedRange()
    {
        dd($this->range);
    }

    function showSubmitted()
    {

    }

    function showPendingSubmit(){

    }

    public function render()
    {
        $chickenProduct = $this->search == ''

        ? Invoices::
        where('processed',true)
       ->where('project',1)
       ->paginate(10)

       :
       Invoices::
       where('project',1)
       ->where('name', 'like', '%'.$this->search.'%')
       ->paginate(10);


        return view('livewire.rearing-project',
        [
            'chickenProject' => $chickenProduct,
        ]);
    }
}

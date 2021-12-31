<?php

namespace App\Http\Livewire;

use App\Models\Invoices;
use Livewire\WithPagination;



use Livewire\Component;

class CornProject extends Component
{
    use WithPagination;

    public  $filterSelected;    //holds the selected filter from route

    public $selectedInvoice,$submitToClient;

    public $search;

    public $filter='';

    public function mount($filter='all'){
        $this->filterSelected=$filter;
        $this->reset('filter');
    }


    public function setSelectedId(Invoices $invoice)
    {
        $this->selectedInvoice = $invoice;
        $this->submitToClient=$this->selectedInvoice->submit;

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

    public function updatedSubmitToClient()
    {
        $this->selectedInvoice->submit=$this->submitToClient;
        $this->selectedInvoice->save();
    }

    public function updatedFilter(){

        switch ($this->filter) {
            case '0':
                return redirect()->route('corn-project');
                break;
                case '1':
                    return redirect()->route('corn-project',[
                        'filter' => 'submitted',
                    ]);
                    break;
                    case '2':
                        return redirect()->route('corn-project',[
                            'filter' => 'pendingSubmits',
                        ]);
                        break;

        }
    }

    public function getFilterProperty(){
        //if no filtering or no search has been done
        if (($this->filterSelected == "all") && !$this->search) {
            return Invoices::
           where('processed',true)
          ->where('project',2)
          ->paginate(10);
        }

          //if no filtering and search has been done
          if (($this->filterSelected == "all") && $this->search) {
           //updates the record on searchs
           return Invoices::
           where('project',2)
           ->where('processed',true)
           ->where('name', 'like', '%'.$this->search.'%')
           ->paginate(10);
        }

        //when filter is set to submitted and there is no user such on the data
        if (($this->filterSelected == "submitted") && !$this->search) {
            return Invoices::where('processed',true)
            ->where('project',2)
            ->where('submit',true)
            ->paginate(10);
        }

         //when filter is set to submitted and there is  user such on the data
         if (($this->filterSelected == "submitted") && $this->search) {
            return Invoices::where('processed',true)
            ->where('project',2)
            ->where('submit',true)
            ->where('name', 'like', '%'.$this->search.'%')
            ->paginate(10);
        }

          //when filter is set to pending submitts and there is no user such on the data
          if (($this->filterSelected == "pendingSubmits") && !$this->search) {
            return Invoices::where('processed',true)
            ->where('project',2)
            ->where('submit',false)
            ->paginate(10);
        }

         //when filter is set pending submits and there is user such on the data
         if (($this->filterSelected == "submitted") && $this->search) {
            return Invoices::where('processed',true)
            ->where('project',2)
            ->where('submit',false)
            ->where('name', 'like', '%'.$this->search.'%')
            ->paginate(10);
        }
    }


    public function render()
    {

        return view('livewire.corn-project', [
            'cornProject' => $this->getFilterProperty(),
        ]);

    }
}

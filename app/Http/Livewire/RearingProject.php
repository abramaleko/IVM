<?php

namespace App\Http\Livewire;

use App\Models\Invoices;
use Livewire\WithPagination;


use Livewire\Component;

class RearingProject extends Component
{
    use WithPagination;

    public $selectedInvoice,$submitToClient;

    public $search = '';

    public $filter="",$range="",$showRange=false;

    public $filterSelected,$rangeSelected;



    public function mount($filter='all',$range=null){
        $this->filterSelected=$filter;
        $this->reset('filter');
        if ($range != null) {
            $this->rangeSelected=$range;
            $this->showRange=true;
        }

    }

    //shows the selected invoice from the table
    public function setSelectedId(Invoices $invoice)
    {
         $this->selectedInvoice=$invoice;
         $this->submitToClient=$this->selectedInvoice->submit;
    }

    public function downloadInvoice($path){

        return response()->download(public_path('storage/'.$path));
     }

     //go back function
     public function resetSelected()
     {
         $this->reset('selectedInvoice');
     }

    public function updatingSearch()
    {
        //resets the pagination page
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
                return redirect()->route('rearing-project');
                break;
            case '1':
                $this->showRange=true;
                break;
                case '2':
                    return redirect()->route('rearing-project',[
                        'filter' => 'submitted',
                    ]);

                    break;
                    case '3':
                        return redirect()->route('rearing-project',[
                            'filter' => 'pendingSubmits',
                        ]);
                        break;

        }
    }

    //redirect function to filter data depending on the range selected
    public function updatedRange()
    {
        switch ($this->range) {
            case '1':
                 return redirect()->route('rearing-project',[
                     'filter' => "amount",
                      'range' =>  1,
                 ]);
                break;
                case '2':
                    return redirect()->route('rearing-project',[
                        'filter' => "amount",
                         'range' =>  2,
                    ]);
                    break;
                    case '3':
                        return redirect()->route('rearing-project',[
                            'filter' => "amount",
                             'range' =>  3,
                        ]);
                        break;

                 }
   }

    public function getFilterProperty(){
        //if no filtering or no search has been done
        if (($this->filterSelected == "all") && !$this->search) {
            return Invoices::
           where('processed',true)
          ->where('project',1)
          ->paginate(10);
        }

          //if no filtering and search has been done
          if (($this->filterSelected == "all") && $this->search) {
           //updates the record on searchs
           return Invoices::
           where('project',1)
           ->where('processed',true)
           ->where('name', 'like', '%'.$this->search.'%')
           ->paginate(10);
        }

        //when filter is set to amount then filter depending on the range
        //when there is no search input
        if (($this->filterSelected == "amount") && !$this->search) {
            if ($this->range== "1") {
                return Invoices::where('processed',true)
                ->where('project',1)
                ->where('amount','>=',500000)
                ->where('amount','<=',4999999)
                ->paginate(10);
            }
            elseif ($this->range== "2") {
                return Invoices::where('processed',true)
                ->where('amount','>=',5000000)
                ->where('amount','<=',9999999)
                ->paginate(10);
            }
            else{
                return Invoices::where('processed',true)
                ->where('amount','>=',10000000)
                ->paginate(10);
            }
        }


        //when filter is set to amount then filter depending on the range
        //when there is a search input
        if (($this->filterSelected == "amount") && $this->search) {
            if ($this->range== "1") {
                return Invoices::where('processed',true)
                ->where('project',1)
                ->where('amount','>=',500000)
                ->where('amount','<=',4999999)
                ->where('name', 'like', '%'.$this->search.'%')
                ->paginate(10);
            }
            elseif ($this->range== "2") {
                return Invoices::where('processed',true)
                ->where('project',1)
                ->where('amount','>=',5000000)
                ->where('amount','<=',9999999)
                ->where('name', 'like', '%'.$this->search.'%')
                ->paginate(10);
            }
            else{
                return Invoices::where('processed',true)
                ->where('project',1)
                ->where('amount','>=',10000000)
                ->where('name', 'like', '%'.$this->search.'%')
                ->paginate(10);
            }
        }

        //when filter is set to submitted and there is no user such on the data
        if (($this->filterSelected == "submitted") && !$this->search) {
            return Invoices::where('processed',true)
            ->where('project',1)
            ->where('submit',true)
            ->paginate(10);
        }

         //when filter is set to submitted and there is  user such on the data
         if (($this->filterSelected == "submitted") && $this->search) {
            return Invoices::where('processed',true)
            ->where('project',1)
            ->where('submit',true)
            ->where('name', 'like', '%'.$this->search.'%')
            ->paginate(10);
        }

          //when filter is set to pending submitts and there is no user such on the data
          if (($this->filterSelected == "pendingSubmits") && !$this->search) {
            return Invoices::where('processed',true)
            ->where('project',1)
            ->where('submit',false)
            ->paginate(10);
        }

         //when filter is set pending submits and there is user such on the data
         if (($this->filterSelected == "submitted") && $this->search) {
            return Invoices::where('processed',true)
            ->where('project',1)
            ->where('submit',false)
            ->where('name', 'like', '%'.$this->search.'%')
            ->paginate(10);
        }




    }

    public function render()
    {
        return view('livewire.rearing-project',
        [
            'chickenProject' => $this->getFilterProperty(),
        ]);
    }
}

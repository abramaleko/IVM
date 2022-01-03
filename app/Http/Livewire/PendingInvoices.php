<?php

namespace App\Http\Livewire;

use App\Models\Invoices;
use Livewire\Component;
use Livewire\WithFileUploads;

class PendingInvoices extends Component
{
    use WithFileUploads;

    public $search= '';
     public $selectedInvoice;
     protected $listeners = ['refreshComponent' => '$refresh'];
     public $invoiceDocs=[],$paths=[];

     protected $rules = [
        'invoiceDocs' => 'required|max:3',
        'invoiceDocs.*' => 'mimes:pdf,jpg,jpeg,png,webp|max:5120', // 1MB Max
    ];

    protected $messages = [
        'invoiceDocs.*.image' => 'The submitted document is not an image or pdf file.',
        'invoiceDocs.*.mimes' => 'The submitted document is not an image or pdf file.',
        'invoiceDocs.*.max' => 'The submitted document must not be greater than 5Mb',
    ];

    public function setSelectedId(Invoices $invoice)
    {
         $this->selectedInvoice=$invoice;
    }

    public function deleteSelected(Invoices $invoice){

        $invoice->delete();

        return redirect()->route('pending-invoice');

    }

    public function resetSelected()
     {
         $this->reset('selectedInvoice');
     }

     public function UploadInvoice(){
         $this->paths=[];

         $this->validate();

        //save the payment slips in the payment-slips directory
        foreach ($this->invoiceDocs as $invoice) {
            $path=$invoice->store('invoices','public');
            array_push($this->paths, $path);
        }

          $this->selectedInvoice->invoices_path=serialize($this->paths);
          $this->selectedInvoice->processed=true;
          $this->selectedInvoice->save();

          return session()->flash('success', 'Invoice Uploaded Successfully');
     }

     public function downloadInvoice($path){

        return response()->download(public_path('storage/'.$path));

     }

    public function render()
    {
       $pendingInvoices=$this->search != ''
       ? Invoices::where('processed',null)
                  ->where('name', 'like', '%'.$this->search.'%')
                  ->orderBy('id','desc')
                  ->paginate(10)

       : Invoices::where('processed',null)
       ->orderBy('id','desc')
       ->paginate(10);




        return view('livewire.pending-invoices',[
            'pendingInvoices' => $pendingInvoices
        ]);
    }
}

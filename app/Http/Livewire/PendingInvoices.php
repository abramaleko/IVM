<?php

namespace App\Http\Livewire;

use App\Models\Invoices;
use Livewire\Component;
use Livewire\WithFileUploads;

class PendingInvoices extends Component
{
    use WithFileUploads;

     public $pendingInvoices;
     public $selectedInvoice;
     protected $listeners = ['refreshComponent' => '$refresh'];
     public $invoiceDocs=[],$paths=[];

     protected $rules = [
        'invoiceDocs' => 'required|max:3',
        'invoiceDocs.*' => 'mimes:pdf,jpeg,jpg,png|max:5120', // 1MB Max
    ];

    protected $messages = [
        'invoiceDocs.*.image' => 'The submitted document is not an image or pdf file.',
        'invoiceDocs.*.mimes' => 'The submitted document is not an image or pdf file.',
        'invoiceDocs.*.max' => 'The submitted document must not be greater than 5Mb',
    ];

    public function mount()
    {
        $this->pendingInvoices=Invoices::where('processed',null)
        ->orderBy('id','desc')
        ->get();
    }

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
         return redirect()->route('pending-invoice');
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
        return view('livewire.pending-invoices');
    }
}

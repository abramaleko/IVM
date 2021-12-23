<?php

namespace App\Http\Livewire;

use App\Models\Invoices;
use Livewire\Component;

class NewInvoice extends Component
{
    public $name, $phone_no, $email, $project = "", $amount, $acres;

    protected $rules = [
        'name' => 'required|string',
        'phone_no' => 'required',
        'email' => 'nullable|email',
        'project' => 'required',

    ];

    public function updatedProject(){
        $this->reset(['amount','acres']);
    }

    public function submitRequest()
    {
        $this->validate();

        $invoice = new Invoices();

        $invoice->name = ucfirst($this->name);

        $invoice->phone_no = $this->phone_no;

        if ($this->email) {
            $invoice->email = $this->email;
        }

        $invoice->amount = $this->amount;

        $invoice->acres = $this->acres;

        $invoice->project = $this->project;

        $invoice->save();

        //reset inputs
        $this->reset();

        return session()->flash('success', 'Uploaded Successfully');
    }

    public function render()
    {
        return view('livewire.new-invoice');
    }
}

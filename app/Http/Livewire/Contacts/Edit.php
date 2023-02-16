<?php

namespace App\Http\Livewire\Contacts;

use Livewire\Component;
use App\Models\Contact;

class Edit extends Component
{
    public $contactId;
    public $contact;

    protected $rules = [
        'contact.title' => 'required|string',
        'contact.first_name' => 'required|string',
        'contact.last_name' => 'required|string',
        'contact.contact_number' => 'required|string',
        'contact.company_name' => 'required|string',
    ];

    protected $messages = [
        'contact.title.required' => 'The title cannot be empty.',
        'contact.first_name.required' => 'The first name cannot be empty.',
        'contact.last_name.required' => 'The last name cannot be empty.',
        'contact.contact_number.required' => 'The mobile number cannot be empty.',
        'contact.company_name.required' => 'The company name cannot be empty.',
    ];

    public function mount()
    {
        $this->contact = Contact::findOrFail($this->contactId)->toArray();
    }

    public function render()
    {
        return view('livewire.contacts.edit');
    }

    public function update()
    {
        $this->validate();

        $contact = Contact::find($this->contactId);
        $contact->title = $this->contact['title'];
        $contact->first_name = $this->contact['first_name'];
        $contact->last_name = $this->contact['last_name'];
        $contact->contact_number = $this->contact['contact_number'];
        $contact->company_name = $this->contact['company_name'];
        $contact->save();

        return redirect('/home')->with('status', 'Successfully updated user');
    }
}

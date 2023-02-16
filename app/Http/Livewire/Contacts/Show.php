<?php

namespace App\Http\Livewire\Contacts;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class Show extends Component
{
    use WithFileUploads;

    public $contactFile;
    public $search;

    public $title = 'title';
    public $first_name = 'first_name';
    public $last_name = 'last_name';
    public $contact_number = 'contact_number';
    public $company_name = 'company_name';

    public $selectedContact;

    protected $rules = [
        'contactFile' => 'mimes:csv,txt'
    ];

    protected $messages = [
        'contactFile.mimes' => 'File should be of type csv.',
    ];

    public function render()
    {
        if (! empty($this->search)) {
            $contacts = Contact::query()
                ->where('title', 'like', $this->search . '%')
                ->orWhere('first_name', 'like', $this->search . '%')
                ->orWhere('last_name', 'like', $this->search . '%')
                ->orWhere('contact_number', 'like', $this->search . '%')
                ->orWhere('company_name', 'like', $this->search . '%')
                ->get();
        } else {
            $contacts = Contact::all();
        }

        return view('livewire.contacts.show', [
            'contacts' => $contacts
        ]);
    }

    public function save()
    {
        $this->validate();

        $csvContent = $this->getCsvFileContent();
        $contacts = $this->structureContent($csvContent);

        DB::beginTransaction();

        try {
            foreach ($contacts as $contact) {
                Contact::create([
                    $this->title => $contact['title'],
                    $this->first_name => $contact['first_name'],
                    $this->last_name => $contact['last_name'],
                    $this->contact_number => $contact['contact_number'],
                    $this->company_name => $contact['company_name'],
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Failed to add contact with CSV", ['message' => $e->getMessage()]);
        }
    }

    public function delete($contactId)
    {
        $this->selectedContact = Contact::findOrFail($contactId);
    }

    public function destroy($contactId)
    {
        Contact::destroy($contactId);

        $this->emit('deleteContact');

        $this->selectedContact = null;
    }

    private function getCsvFileContent()
    {
        $file = fopen($this->contactFile->getRealPath(), 'r');

        while (($data = fgetcsv($file, 1000, ',')) !== FALSE) {
            $content[] = $data;
        }

        fclose($file);

        return $content;
    }

    private function structureContent($csvContent) {
        $headerDbColumn = ['title', 'first_name', 'last_name', 'contact_number', 'company_name'];

        $contacts = [];

        $headers = $csvContent[0];
        unset($csvContent[0]);

        foreach ($csvContent as $contentkey => $row) {
            foreach ($row as $key => $data) {
                $contacts[$contentkey - 1][$headerDbColumn[$key]] = $data;
            }
        }

        return $contacts;
    }
}

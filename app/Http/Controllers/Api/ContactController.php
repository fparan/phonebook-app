<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();

        return response()->json([
            'contacts' => $contacts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        $success = 1;
        $message = 'Successfully added contact';

        try{
            $contact = Contact::create([
                'title' => $request->title,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'contact_number' => $request->contact_number,
                'company_name' => $request->company_name,
            ]);
        } catch (\Exception $e) {
            $success = 0;
            $message = 'Failed to add contact';
        }

        return response()->json([
            'success' => $success,
            'messsage' => $message,
            'contact' => $contact
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $success = 1;
        $message = 'Successfully updated contact';

        try{
            $contact = Contact::find($id);
            $contact->title = $request->title;
            $contact->first_name = $request->first_name;
            $contact->last_name = $request->last_name;
            $contact->contact_number = $request->contact_number;
            $contact->company_name = $request->company_name;
            $contact->save();
        } catch (\Exception $e) {
            $success = 0;
            $message = 'Failed to update contact';
        }

        return response()->json([
            'success' => $success,
            'messsage' => $message,
            'contact' => $contact
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $success = 1;
        $message = 'Successfully deleted contact';

        try {
            Contact::destroy($id);
        } catch (\Exception $e) {
            $success = 0;
            $message = 'Failed to delete contact';
        }

        return response()->json([
            'success' => $success,
            'messsage' => $message,
            'contact' => $id
        ]);
    }
}

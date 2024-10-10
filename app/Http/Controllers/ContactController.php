<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\admincontact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = admincontact::all();
        return view('admin.contacts.index1',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function showcontact()
    {
        $data['contact'] = Contact::get();

        return view('admin.contacts.show', $data);
    }

    public function create(){
        return view('admin.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate(['name', 'email', 'address', 'aname']);
        $data = new admincontact;
        $data->name = Crypt::encrypt($request->aname);
        $data->phone = Crypt::encrypt($request->name);
        $data->email = Crypt::encrypt($request->email);
        $data->address = Crypt::encrypt($request->address);
        $data->save();

        return redirect()->back()->with('success', 'Contacts Added! ');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['contact']=admincontact::findorFail($id);
        return view('admin.contacts.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|',
            'phone' => 'required|',
            'address' => 'required',
        ]);
    // dd($id);
        // Find the existing contact
        $contact = admincontact::findOrFail($id);

        // Update the contact attributes with decrypted values
        $contact->name = Crypt::encrypt($request->input('name'));
        $contact->email = Crypt::encrypt($request->input('email'));
        $contact->phone = Crypt::encrypt($request->input('phone'));
        $contact->address = Crypt::encrypt($request->input('address'));

        // Save the updated contact
        $contact->save();

        // Redirect to the contacts index page with a success message
        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function user()
    {
        $data['admincontacts'] = admincontact::get();

        return view('admin.contacts.index', $data);

    }

    public function usercontact(Request $request)
    {
        // dd($request->all());
        $request->validate(['name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'des', 'required'],
            ['name' => 'Name is Required',
                'phone' => 'Phone Number is Required',
                'email' => 'Email is Required',
                'des' => 'Message is Required',
            ]);

       try {
        $contact = new Contact;
        $contact->name = Crypt::encrypt($request->name);
        $contact->phone_number = Crypt::encrypt($request->phone);
        $contact->email = Crypt::encrypt($request->email);
        $contact->message = Crypt::encrypt($request->des);
        $contact->save();

        return redirect()->back()->with('success', 'Thanks For Contact');
       } catch (\Throwable $th) {
        return redirect()->back()->with('fail','Try After Sometime!');
       }
    }
}

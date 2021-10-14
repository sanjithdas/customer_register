<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Contact as ResourceContact;
use App\Models\Customer;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'work_phone' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/'
        ]);

        if ($validator->fails()) {
            return response()->json(["validation_errors" => $validator->errors()]);
        }


        $contact = Contact::create([
            'customer_id' => $request->customer_id,
            'address' => $request->address,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'work_phone' => $request->work_phone
        ]);

        if (!is_null($contact)) {
            return (new ResourceContact($contact))
                ->response()
                ->setStatusCode(201);
        } else {
            return response()->json(["status" => "failed", "message" => "Registration failed!"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $contact)
    {
        $customer = Customer::with('contacts')->where('id', $contact->id)->get();
        // return $customer;
        if (!is_null($customer)) {
            return response()->json($customer)
                ->setStatusCode(201);
        } else {
            return response()->json(["status" => "failed", "message" => "Registration failed!"]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}

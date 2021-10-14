<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerCreateRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\Customer as ResourcesCustomer;
use App\Http\Resources\CustomerCollection;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return response()->json(new CustomerCollection($customers));
    }

    /**
     * Show the form for creating a new resource.
     * Create customers
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * Custom Request - CustomerCreateRequest
     * @param  \Illuminate\Http\CustomerCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validatedData = $request->validated();
        // // return $validatedData;
        // // return $request->last_name;

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'email' => 'required|email:rfc|unique:customers',
            'phone' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/'
        ]);

        if ($validator->fails()) {
            return response()->json(["validation_errors" => $validator->errors()]);
        }


        $customer = Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        if (!is_null($customer)) {
            return (new ResourcesCustomer($customer))
                ->response()
                ->setStatusCode(201);
        } else {
            return response()->json(["status" => "failed", "message" => "Registration failed!"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return response()->json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return response()->json(['status' => 200, 'customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'email' => 'required|email:rfc',
            'phone' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/'
        ]);

        if ($validator->fails()) {
            return response()->json(["validation_errors" => $validator->errors()]);
        }

        $customer->update($request->all());
        return response()->json(['message' => 'User updated successfully', 'cutomer' => $customer]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $contact = Contact::where('customer_id', $customer->id);
        $contact->delete();
        $customer->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}

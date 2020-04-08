<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Address;
use Carbon\Carbon;

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
        return view('customer.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'birthday'=>'required',
            'cpf'=>'required',
            'rg' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $customer = Customer::create([
            'name' => $request->get('name'),
            'birthday' => Carbon::createFromFormat('d/m/Y', $request->get('birthday')),
            'cpf' => $request->get('cpf'),
            'rg' => $request->get('rg'),
            'phone' => $request->get('phone')
        ]);

        if (!empty($request->address)) {
            foreach ($request->address as $addr) {
                list($street, $number, $neighborhood) = explode(',', $addr);
                $address = Address::create([
                       'street' => trim($street),
                       'number' => trim($number),
                       'neighborhood' => trim($neighborhood)
                ]);

                $customer->addresses()->attach($address->id);
            }
        }

        return redirect()->route('customer.index')->with('success', $customer->name . ' foi salvo com sucesso!');
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
        $customer = Customer::findOrfail($id);
        return view('customer.edit', ['customer' => $customer]);
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
        $request->validate([
            'name'=>'required',
            'birthday'=>'required',
            'cpf'=>'required',
            'rg' => 'required',
            'phone' => 'required'
        ]);

        $customer = Customer::findOrfail($id);
        $customer->update([
            'name' => $request->get('name'),
            'birthday' => Carbon::createFromFormat('d/m/Y', $request->get('birthday')),
            'cpf' => $request->get('cpf'),
            'rg' => $request->get('rg'),
            'phone' => $request->get('phone')
        ]);

        return redirect()->route('customer.index')->with('info', $customer->name . ' foi atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrfail($id);

        $customer->addresses()->detach();
        $customer->delete();

        foreach ($customer->addresses as $addr) {
            $addr->delete();
        }

        return redirect()->route("customer.index");
    }
}

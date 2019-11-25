<?php

namespace App\Http\Controllers;

use App\Sales;
use App\Discount;
use App\Sold;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verifyRoles');
        $this->middleware('getRoles');
    }
    
    public function index()
    {
        $dat = Sold::all();
        return view('sales.show')->with(compact('dat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Sales::where("available", ">", 0)->get();
        $discount = Discount::where('');
        return view('sales.create')->with(compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'quantity' => 'required|numeric',
            'customers_name' => 'required',
            'customers_phone' => 'required|numeric',
            'customers_email' => 'required|email:rfc',
        ], [
            'quantity.numeric' => 'Invalid quantity value.',
            'customers_phone.numeric' => 'Invalid Phone Number.',
            'customers_email.email' => 'Invalid Email address.'
        ]);
        $product = Sales::where('name', '=', $request->name)->get()->first();

        $editor = Sales::where('name', '=', $request->name)->get()->first();
        $available = $editor->available - $request->quantity;
        if ($request->quantity > $editor->available)
        {
            $validator = Validator::make([], []); // Empty data and rules fields
            $validator->errors()->add('quantityExceeded', 'The quantity is more than the available products!');
            throw new ValidationException($validator);
        }
        elseif ($request->quantity < 0)
        {
            $validator = Validator::make([], []);
            $validator->errors()->add('quantityInvalid', 'The product quantity is invalid!');
            throw new ValidationException($validator);
        }
        elseif ($editor->quantity == 0)
        {
            $validator = Validator::make([], []);
            $validator->errors()->add('oos', 'The product is currently out of stock!');
            throw new ValidationException($validator);
        }

        $discount = Discount::where('product_id', '=', $product->id)->get()->first();
        $price = 0;
        $discount_amount = 0;
        if (is_null($discount))
        {
            $discount_amount = 0;
        }
        else
        {
            $discount_amount = $discount->amount;
        }
        if (!is_null($discount))
        {
            $price = $product->price - $discount->amount;
        }


        $values[] = array('name' => $request->name, 'quantity' => $request->quantity, 'price_per_unit' => $product->price, 'discount_amount' => $discount_amount, 'customers_name' => $request->customers_name,
            'customers_phone' => $request->customers_phone, 'customers_email' => $request->customers_email, 'order_token' => substr(sha1
            (Carbon::now()), 0, 7));
//        var_dump($values);
        return view('sales.invoice')->with('values', $values);
    }


    public function GenerateVoucher(Request $request)
    {
        $this->validate($request, [
            'json_val' => 'required'
        ]);
        $a = json_decode($request->json_val, true);
        $injector = new Sold;
        $injector->name = $a[0]['name'];
        $injector->quantity = $a[0]['quantity'];
        $injector->customers_name= $a[0]['customers_name'];
        $injector->customers_phone = $a[0]['customers_phone'];
        $injector->customers_email = $a[0]['customers_email'];
        $injector->order_token = $a[0]['order_token'];

        // Calculate the discount if there is any
        $editor = Sales::where('name', '=', $a[0]['name'])->get()->first();
        $available = $editor->available - $a[0]['quantity'];
        $editor->available = $available;
        $editor->save();
        $injector->save();
        return redirect(route('sales.index'))->with('inssuccess', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Sold::find($id);
        return view('sales.edit')->with(compact('data'));
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
        $this->validate($request, [
            'name' => 'required',
            'quantity' => 'required'
        ]);
        $updator = Sold::find($id);
        $updator->name = $request->name;
        $updator->quantity = $request->quantity;
        $updator->save();
        return redirect(route('sales.index'))->with('edtsuccess', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sold::find($id)->delete();
        return redirect(route('sales.index'))->with('dltsuccess', 'success');
    }
}

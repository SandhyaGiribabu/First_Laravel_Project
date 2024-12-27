<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\Invoices;
use App\Filters\V1\InvoicesFilter;
use Illuminate\Http\Request;

use App\Http\Requests\StoreInvoicesRequest;
use App\Http\Requests\UpdateInvoicesRequest;
use App\Http\Resources\V1\InvoiceResource;
use App\Http\Resources\V1\InvoiceCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;

use Illuminate\Support\Arr;
use App\Http\Requests\V1\BulkStoreInvoiceRequest;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $filter = new InvoicesFilter();
    $queryItems = $filter->transform($request); // [['column', 'operator', 'value']]

    if (count($queryItems) == 0) {
        return new  InvoiceCollection( Invoices::paginate());
    } else {
        $invoices = Invoices::where($queryItems)->paginate();

        return new InvoiceCollection($invoices->appends($request->query()));
        }
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoicesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoices $invoices)
    {
        return new InvoiceResource($invoices);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoices $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoicesRequest $request, Invoices $invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoices $invoices)
    {
        //
    }

    public function bulkStore(BulkStoreInvoiceRequest $request)
{
    $bulk = collect($request->all())->map(function ($arr) {
        return Arr::except($arr, ['customerId', 'billedDate', 'paidDate']);
    });

    // Insert bulk data into the Invoices table
    Invoices::insert($bulk->toArray());

    return response()->json(['message' => 'Invoices created successfully']);
}



}

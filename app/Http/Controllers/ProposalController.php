<?php


namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Customer;

use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function index(){

        $proposals = Proposal ::all();
        return view('proposals.index', ['proposals' => $proposals]);
    }

    public function create()
{
    $customers = Customer::all();

    return view('proposals.create',compact('customers'));
}

public function store(Request $request)
{
    $request->validate([
        'customer_id' => 'required|exists:customers,id',
            'title' => 'required',
            'details' => 'required',
            'status' => 'required|in:active,N/A',
    ]);

    Proposal::create($request->all());

    return redirect()->route('proposals.index')->with('success', 'Proposal created successfully.');
}

public function edit(Proposal $proposal)
{
    $customers = Customer::all();
    return view('proposals.edit', compact('proposal','customers'));
}

public function update(Request $request, Proposal $proposal)
{
    $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'title' => 'required',
        'details' => 'required',
        'status' => 'required|in:active,N/A',
    ]);

    $proposal->update($request->all());

    return redirect()->route('proposals.index')->with('success', 'Proposal updated successfully.');
}

public function destroy(Proposal $proposal)
{
    $proposal->delete();

    return redirect()->route('proposals.index')->with('success', 'Proposal deleted successfully.');
}

}

<?php

namespace App\Http\Controllers;

use App\Rate;
use Illuminate\Http\Request;

class RatesController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /rates
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all rates, sorted by latest updated
        // A better approach: pagination
        $rates = Rate::orderBy('updated_at', 'desc')->get();

        // Display all rates (index.blade.php)
        return view('rates.index', compact('rates'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /rates/create
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // View form to add a new rate (create.blade.php)
        return view('rates.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /rates
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate and add a new rate
        $rate = Rate::create($request->validate([
            'rate' => 'bail|required|max:999999.99',
            'description' => 'bail|required|max: 48'
        ]));

        // show new rate (show.blade.php)
        return view('rates.show', compact('rate'));
    }

    /**
     * Display the specified resource.
     * GET /rates/{rate}
     * @param  Rate $rate
     * @return \Illuminate\Http\Response
     */
    public function show(Rate $rate)
    {
        // Read (show.blade.php)
        return view('rates.show', compact('rate'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /rates/{rate}/edit
     * @param  Rate $rate
     * @return \Illuminate\Http\Response
     */
    public function edit(Rate $rate)
    {
        // View form to edit a rate
        return view('rates.update', compact('rate'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /rates/{rate}
     * @param  \Illuminate\Http\Request  $request
     * @param  Rate $rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rate $rate)
    {
        // validate and update rate
        $rate->update($request->validate([
            'rate' => 'bail|required|max:999999.99',
            'description' => 'bail|required|max: 48'
        ]));

        // redirect to updated rate
        return redirect(route('rates.show'));
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /rates/{rate}
     * @param  Rate $rate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rate $rate)
    {
        // Delete a rate
        try {
            $rate->delete();
        }
        catch(\Exception $e) {
            // TODO: handle this case (e.g. rate not found or could not connect to database)
            dd($e);
        } finally {
            return redirect(route('rates.index'));
        }
    }
}

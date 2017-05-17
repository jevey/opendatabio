<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BibReference;

class BibReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $references = BibReference::paginate(10);
	    return view('references.index', [
        'references' => $references
    ]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	return redirect('persons');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	$this->checkValid($request);
	$person = Person::create($request->all());
	return redirect('persons');
    }

    protected function checkValid(Request $request, $id = null) {
	$this->validate($request, [
		'full_name' => 'required|max:191',
		'abbreviation' => ['required','max:191','regex:'.config('app.valid_abbreviation'), 'unique:persons,abbreviation,'. $id],
		'email' => ['nullable', 'max:191', 'email', 'unique:persons,email,'.$id]
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
	    $person = Person::find($id);
	    return view('persons.show', [
		    'person' => $person
	    ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	 return redirect('persons/'.$id);
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
	    $person = Person::find($id);
	    $this->checkValid($request, $id);
	    $person->update($request->all());
	return redirect('persons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	    Person::find($id)->delete();
	return redirect('persons');
    }
    //
}
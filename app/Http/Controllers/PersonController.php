<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use App\Person;
use App\Herbarium;
use Illuminate\Support\Facades\Lang;
use Datatables;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//	    $persons = Person::orderBy('abbreviation')->paginate(10);
	    $herbaria = Herbarium::all();
	    return view('persons.index', [
//		    'persons' => $persons,
		    'herbaria' => $herbaria,
    ]);
        //
    }
    public function getdata() {
	    return Datatables::of(Person::query())
		    ->editColumn('abbreviation', function ($person) {
			    return '<a href="' . url('persons/' . $person->id) . '">' . 
				    // Needs to escape special chars, as this will be passed RAW
				    htmlspecialchars($person->abbreviation) . '</a>';
		    }) 
		    ->rawColumns(['abbreviation'])
		    ->make(true);
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
	return redirect('persons')->withStatus(Lang::get('messages.stored'));
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
	    $person = Person::findOrFail($id);
	    $herbaria = Herbarium::all();
	    return view('persons.show', [
		    'person' => $person,
		    'herbaria' => $herbaria,
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
	    $person = Person::findOrFail($id);
	    $this->checkValid($request, $id);
	    $person->update($request->all());
	return redirect('persons')->withStatus(Lang::get('messages.saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	    try {
		    Person::findOrFail($id)->delete();
	    } catch (\Illuminate\Database\QueryException $e) {
		    return redirect()->back()
			    ->withErrors([Lang::get('messages.fk_error')])->withInput();
	    }

	return redirect('persons')->withStatus(Lang::get('messages.removed'));
    }
}

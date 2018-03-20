<?php

namespace App\Http\Controllers;

use App\Form;
use Illuminate\Http\Request;
use App\DataTables\FormsDataTable;
use Auth;
use Lang;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FormsDataTable $dataTable)
    {
        return $dataTable->render('forms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Form::class);
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'measured_type' => 'required|string',
            'trait_id' => 'required|array|min:1',
        ]);
        $form = new Form($request->only(['name', 'measured_type']));
        $form->user_id = Auth::user()->id;
        $form->save(); // to generate id
        foreach ($request->trait_id as $order => $odbtrait) {
            $form->traits()->attach($odbtrait, ['order' => $order]);
        }
        $form->save();
        return redirect('forms/'.$form->id)->withStatus(Lang::get('messages.stored'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $form = Form::with('traits')->findOrFail($id);
        return view('forms.show', compact('form'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $form = Form::findOrFail($id);
        return view('forms.create', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        //
    }
}

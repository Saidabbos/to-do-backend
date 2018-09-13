<?php

namespace App\Http\Controllers;

use App\Plans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return response()->json([
            'status'=>TRUE,
            'data'=>[
                'items'=>Plans::orderBy('id','desc')->where('author', Auth::user()->id)->forPage($request->get('page'), $request->get('limit'))->get(),
                'count'=>Plans::all()->where('author', Auth::user()->id)->count()
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $plan = $request->all();
        $plan['author'] = Auth::user()->id;
        return response()->json(['status'=>TRUE,
            'data'=>Plans::create($plan)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id, Request $request)
    {
        //
        $plan = Plans::find($id);
        if (!is_null($request->input('done'))) {
            $plan->done = $request->input('done');
        }
        if ($request->input('name')) {
            $plan->name = $request->input('name');
        }
        return response()->json([
            'status'=>TRUE,
            'data'=>$plan->save()]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $plan = Plans::find($id);
        return response()->json([
            'status'=>TRUE,
            'data'=>$plan->delete()
        ]);
    }
}

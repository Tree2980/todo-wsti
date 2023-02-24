<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class Todo extends Controller
{

    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $todos = DB::table('todos')
                        ->where('status', '<>', '1')
                        ->where('user_id', '=', Auth::id())
                        ->get();
        $todos_end = DB::table('todos')
                        ->where('status', '=', '1')
                        ->where('user_id', '=', Auth::id())
                        ->get();
        $days = DB::table('days')
                        ->get();
        
        return view('welcome', ['todos' => $todos, 'todos_end' => $todos_end, 'days' => $days]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // validate the form
    $request->validate([
        'task' => 'required|max:200',
        'date_expired' => 'required'
    ]);

    // store the data
    DB::table('todos')->insert([
        'task' => $request->task,
        'user_id' => Auth::id(),
        'date_expired' => $request->date_expired
    ]);

    // redirect
    return redirect('/')->with('status', 'Zadanie dodane!');
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
        //
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
        // validate the form
    $request->validate([
        'task' => 'required|max:200',
        'date_expired' => 'required'
    ]);

    // update the data
    DB::table('todos')->where('id', $id)->update([
        'task' => $request->task,
        'date_expired' => $request->date_expired
    ]);

    // redirect
    return redirect('/')->with('status', 'Zadanie zaktualizowane!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete the todo
    DB::table('todos')->where('id', $id)->delete();

    // redirect
    return redirect('/')->with('status', 'Zadanie usunięte!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_status(Request $request, $id)
    {
        $mytime = Carbon::now();
    // update the data
    DB::table('todos')->where('id', $id)->update([
        'status' => '1',
        'date_end' => $mytime
    ]);

    // redirect
    return redirect('/')->with('status', 'Zadanie wykonane!');
    }
/**
     * Remove all resources from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_all()
    {
        // delete the todo
    DB::table('todos')->where('user_id', Auth::id())->delete();

    // redirect
    return redirect('/')->with('status', 'Lista wyczyszczona!');
    }
/**
    * Remove all resources from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy_completed()
   {
       // delete the todo
   DB::table('todos')->where('status', '1')
                     ->where('user_id', Auth::id())
                     ->delete();

   // redirect
   return redirect('/')->with('status', 'Lista zakończonych zadań wyczyszczona!');
   }
}

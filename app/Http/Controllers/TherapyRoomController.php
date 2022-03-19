<?php

namespace App\Http\Controllers;

use App\Models\Therapy_room;
use Illuminate\Http\Request;

class TherapyRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('viewAny',Therapy_room::class);

        $trooms=Therapy_room::paginate(10);
        return view('therapy_rooms.index',['trooms'=>$trooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('create',Therapy_room::class);
        return view('therapy_rooms.create');
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
        $this->authorize('create',Therapy_room::class);

        $this->validate($request, [	
            'name' => 'required|min:4|max:20|unique:therapy_rooms,name',
        ]);

        Therapy_room::create(['name'=>$request->name]);

        return back()->with('status','Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Therapy_room  $therapy_room
     * @return \Illuminate\Http\Response
     */
    public function show(Therapy_room $therapyRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Therapy_room  $therapy_room
     * @return \Illuminate\Http\Response
     */
    public function edit(Therapy_room $therapyRoom)
    {
        $this->authorize('update',$therapyRoom);
        return view('therapy_rooms.edit',['therapy_room'=>$therapyRoom]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Therapy_room  $therapy_room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Therapy_room $therapyRoom)
    {
        //
        $this->authorize('update',$therapyRoom);

        $this->validate($request, [	
            'name' => 'required|min:4|max:20',
        ]);

        $nameExists=Therapy_room::where('name','!=',$therapyRoom->name)->where('name',$request->name)->exists();
        if($nameExists){
            return back()->with('error','Name is not available');
        }

        $therapyRoom->update([ 'name'=>$request->name ]);


        return back()->with('status','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Therapy_room  $therapy_room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Therapy_room $therapyRoom)
    {
        //
        $this->authorize('delete',$therapyRoom);

        $therapyRoom->delete();

        return back()->with('status','Deleted successfully');
    }
}

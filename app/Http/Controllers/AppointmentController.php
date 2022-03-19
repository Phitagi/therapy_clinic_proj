<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Therapy_room;
use App\Models\User; use App\Models\Roles;
use Illuminate\Http\Request; 
use DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //
        if(User::is_admin()){
            $apps=Appointment::orderBy('id', 'DESC')->paginate(7);
        }else{
            $apps=Appointment::where('therapist_id',auth()->user()->id)->orderBy('id', 'DESC')->paginate(7);
        }
        
        $trooms=Therapy_room::get();
        $therapists=User::where('role_id',Roles::THERAPIST)->orderBy('id', 'DESC')->get();
        $therapist='All';  $troom='All';
        return view('appointments.index',['apps'=>$apps,'trooms'=>$trooms,'troom'=>$troom,'therapists'=>$therapists,'therapist'=>$therapist]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('create',Appointment::class);

        $trooms=Therapy_room::get();
        $therapists=User::where('role_id',Roles::THERAPIST)->orderBy('id', 'DESC')->get();
        return view('appointments.create',['trooms'=>$trooms,'therapists'=>$therapists]);
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
        $this->authorize('create',Appointment::class);

        $this->validate($request, [	
            'name' => 'required|min:5|max:20',
        ]);

        Appointment::create(['name'=>$request->name,'description'=>$request->description,'therapist_id'=>$request->therapist,'therapy_room_id'=>$request->troom,'start_at'=>$request->time,'status'=>'scheduled']);

        return back()->with('status','Added successfully');
    }

    public function filter(Request $request)
    {
        $datefrom1=$request->datefrom;   $dateto1=$request->dateto;
        $defFromDate=User::FROMDATE;   $defToDate=User::TODATE;

        $datefrom=empty($datefrom1) ? $defFromDate : date('Y-m-d H:i:s',strtotime($datefrom1)); //if dates are empty fall back to default dates
        $dateto=empty($dateto1) ? $defToDate : date('Y-m-d H:i:s',strtotime($dateto1));

        $therapist_id=$request->therapist; //$troom_id=$request->troom; 
        $therapist='All'; $troom='All'; //default value for therapist & troom if they are not filtered
        $status=$request->status;
        
        if($therapist_id=='All' && $status=='All'){
            $apps=Appointment::whereBetween('start_at',[$datefrom,$dateto])->orderBy('id', 'DESC')->paginate(7);  
        }elseif($therapist_id=='All'){
            $apps=Appointment:: where('status',$status)->
            whereBetween('start_at',[$datefrom,$dateto])->orderBy('id', 'DESC')->paginate(7);
        }elseif($status=='All'){
            $apps=Appointment:: where('therapist_id',$therapist_id)->
            whereBetween('start_at',[$datefrom,$dateto])->orderBy('id', 'DESC')->paginate(7);
            $therapist=User::find($therapist_id);
        }else{
            $apps=Appointment::where('therapist_id',$therapist_id)->
                where('status',$status)->
                whereBetween('start_at',[$datefrom,$dateto])->orderBy('id', 'DESC')->paginate(7);
            $therapist=User::find($therapist_id);
        }

        /*$trooms=Therapy_room::get();*/ $therapists=User::where('role_id',Roles::THERAPIST)->orderBy('id', 'DESC')->get();

        return view('appointments.index',['apps'=>$apps,'status'=>$status,'therapists'=>$therapists,'therapist'=>$therapist,'datefrom'=>$datefrom1,'dateto'=>$dateto1]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
        $trooms=Therapy_room::get();
        $therapists=User::where('role_id',Roles::THERAPIST)->get();
        $date=date("Y-m-d H:i",strtotime($appointment->start_at));
        $date=date("Y-m-d\TH:i:s",strtotime($date));
        return view('appointments.edit',['appointment'=>$appointment,'date'=>$date,'trooms'=>$trooms,'therapists'=>$therapists]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {

        if(Appointment::canUpdate()){

            $this->validate($request, [	
                'name' => 'required|min:5|max:20',
            ]);

            $appointment->update([
                'name'=>$request->name,
                'description'=>$request->description,
                'therapist_id'=>$request->therapist,
                'therapy_room_id'=>$request->troom,
                'start_at'=>$request->time,
                'status'=>$request->status,
                'ended_at'=>$request->ended_at
            ]);

        }else{
            $appointment->update([
                'status'=>$request->status,
                'ended_at'=>$request->ended_at
            ]);
        }

        return back()->with('status','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
        $this->authorize('delete',$appointment);

        $appointment->delete();

        return back()->with('status','Deleted successfully');
    }
}

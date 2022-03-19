@extends('app')
@section('content')
    <style>
        .head-div,.filter-div1,.filter-form,.datefilter-div{
          display:flex; flex-direction:row; justify-content:space-between; flex-wrap:wrap; flex:; align-items:;
        }
        .filter-form{padding: 10px; border-bottom: 1px solid; border-top: 1px solid; margin: 5px;}
        .filter-form div{padding:;}
        .filter-form button{width:200px;  padding:10px; border-radius:4px; cursor:pointer;}
        .filter-div1{width:35%; height: fit-content;}
        .filter-div1 div{width:45%;}
        .filter-div1 select{width:100%; padding:8px 10px;  border:1px solid;}
        .datefilter-div{width:40%; padding:; margin:0 auto; height: fit-content;}
        .datefilter-div div{width:50%;}
        .datefilter-div input{padding:6px 10px; border:1px solid;}
        .filbut{position:relative; top:; width:; padding:10px 0; height: fit-content; margin:; margin-top:auto;}
        .filbutdiv{}
    </style>
    <h2>Appointments</h2>
    @can('create',\App\Models\Appointment::class)
        <button class='addButton'><a href="{{route('appointments.create')}}">New appointment</a></button><br>
    @endcan

    <!--FILTER FORM -->
    <form action="{{route('appointments.filter')}}" method="POST" class='filter-form'>
        @csrf
      <div class='filter-div1'>
        @can('viewAny',\App\Models\User::class)
          <div>
              <label>Therapist</label><br> 
              <select name='therapist' class='tfilter'>
                @if($therapist!='All')<option value={{$therapist->id}}>{{$therapist->name}}</option>@endif
                <option>All</option>
                @foreach($therapists as $therapist)
                  <option value={{$therapist->id}}>{{$therapist->name}}</option>
                @endforeach
              </select>
          </div>
        @endcan

        <div>
            <label>Status</label><br> 
            <select name='status' class='stfilter'>
              @if(isset($status)) @if($status!='All')<option>{{$status}}</option> @endif @endif
              <option>All</option>
              <option>Scheduled</option>
              <option>Ongoing</option>
              <option>Completed</option>
            </select>
        </div>
      </div>

      <div class='datefilter-div'>
        <div class=''>
          <label>Appointments from</label><br> 
          <input type='datetime-local' name='datefrom' value={{ isset($datefrom) ? date('Y-m-d\TH:i:s',strtotime($datefrom)) :'' }} class='datefrom'>
        </div> 
        <div class=''>
          <label>To</label><br>
          <input type='datetime-local' name='dateto' value={{ isset($dateto) ? date('Y-m-d\TH:i:s',strtotime($dateto)) :'' }} class='dateto'>
        </div>
      </div>
      <button type="submit" class="btn btn-primary filbut">Filter</button>
    </form>

    <!--endFILTER FORM -->

    @if(session('status'))
        <i>{{ session('status') }} </i>
    @endif

     <table id="users" class="table table-bodered">

            <tr>

              <th>Name</th>
              <th>Description</th>
              <th>Therapist</th>
              <th>Therapy room</th>
              <th>Start at</th>
              <th>End at</th>
              <th>Status</th>
              <th></th>

            </tr>

            @foreach($apps as $app)
              @can('view',[\App\Models\Appointment::class,$app])
                <tr>
                  <td>{{ $app->name}}</td>
                  <td>{{ $app->description}}</td>
                  <td>{{ $app->therapist->name}}</td>
                  <td>{{ $app->therapyRoom->name}}</td>
                  <td>{{ $app->start_at}}</td>
                  <td>{{ $app->ended_at}}</td>
                  <td>{{ $app->status}}</td>
                  <td>

                       <div class="btn-group">
                            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Action <span class="caret"></span>
                            </button>
                    
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{route('appointments.edit',$app->id)}}">Update</a></li> 
                                @can('delete',[\App\Models\Appointment::class,$app])
                                  <li><form action="{{route('appointments.destroy',$app->id)}}" method='POST'>@csrf @method('DELETE') <button>Delete</button></form></li>
                                @endcan
                            </ul>
                        </div>

                  </td>
                </tr>
              @endcan
            @endforeach
           
          </table>
          
           {{ $apps->links() }}

@endsection
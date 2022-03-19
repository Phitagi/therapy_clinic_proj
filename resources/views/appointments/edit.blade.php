@extends('app')
@section('content')
    <h2>Update appointment - {{ $appointment->name }}</h2>
    <div><button><a href="{{route('appointments.index')}}">Back to appointments</button></a></div><br>
    @if(session('status'))
        <i>{{ session('status') }} </i>
    @endif
    <div class='formdiv formdiv2'>
         <form action="{{route('appointments.update',$appointment->id)}}" method="POST">
            @csrf
            @method('PUT')

            @can('update',[\App\Models\Appointment::class,$appointment])

                <label for="name" >Name<label><br>
                <input name="name"  value="{{ $appointment->name }}" required><br>
                @error('name')
                    <span class="" role="alert">
                        <strong>{{ $message }}</strong>
                    </span><br>
                @enderror

                <label for="" >Description<label><br>
                <textarea name="description">{{ $appointment->description }}</textarea><br>
                @error('description')
                    <span class="" role="alert">
                        <strong>{{ $message }}</strong>
                    </span><br>
                @enderror

                <label for="" >Therapist<label><br>
                <select name='therapist'>
                    <option value={{$appointment->therapist->id}}> {{$appointment->therapist->name}} </option>
                    @foreach ($therapists as $therapist)
                        @if($therapist->id !== $appointment->therapist->id)
                            <option value={{$therapist->id}}> {{$therapist->name}} </option>
                        @endif
                    @endforeach
                </select><br>

                <label for="" >Therapy room<label><br>
                <select name='troom'>
                    <option value={{$appointment->therapyRoom->id}}> {{$appointment->therapyRoom->name}} </option>
                    @foreach ($trooms as $troom)
                        @if($troom->id !== $appointment->therapyRoom->id)
                            <option value={{$troom->id}}> {{$troom->name}} </option>
                        @endif
                    @endforeach
                </select><br>

                <label for="" >Time<label><br>
                <input type='datetime-local' name="time"  value={{ !empty($appointment->start_at) ? date('Y-m-d\TH:i:s',strtotime($appointment->start_at)) : '' }} required><br>

            @endcan

            <label for="" >Status<label><br>
            <select name='status'>
                <option>{{$appointment->status}}</option>
                <option>Scheduled</option>
                <option>Ongoing</option>
                <option>Completed</option>
            </select><br>    
            <label for="" >Ended at<label><br>
            <input type='datetime-local' name="ended at"  value={{ !empty($appointment->ended_at) ? date('Y-m-d\TH:i:s',strtotime($appointment->ended_at)) : '' }}><br>  
            
            <button type="submit" class="btn btn-primary">Submit</button>
            
        </form><br><br>
    </div>
@endsection
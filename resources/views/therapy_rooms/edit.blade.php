@extends('app')
@section('content')
    <h2>Update room - {{ $therapy_room->name }}</h2>
    <div><button><a href="{{route('therapyRooms.index')}}">Back to all rooms</button></a></div><br>
    @if(session('status'))
        <i>{{ session('status') }} </i>
    @endif
    @if(session('error'))
        <i style='color:red;'>{{ session('error') }} </i>
    @endif
    <div class='formdiv formdiv2'>
         <form action="{{route('therapyRooms.update',$therapy_room->id)}}" method="POST">
            @csrf
            @method('PUT')
            <label for="name" >Name<label><br>
            <input name="name"  value="{{ $therapy_room->name }}" required><br>
            @error('name')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span><br>
            @enderror
           
            <button type="submit" class="btn btn-primary">Submit</button>
        </form><br><br>
    </div>
@endsection
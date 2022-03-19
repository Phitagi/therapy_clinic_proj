@extends('app')
@section('content')
    <h2>New therapy room</h2>
    <div><button><a href="{{route('therapyRooms.index')}}">Back to all rooms</button></a></div><br>
    @if(session('status'))
        <i>{{ session('status') }} </i>
    @endif
    <div class='formdiv formdiv2'>
         <form action="{{route('therapyRooms.store')}}" method="POST">
            @csrf
            <label for="name" >Name<label><br>
            <input name="name"  value="{{ old('name') }}" required><br>
            @error('name')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span><br>
            @enderror
            <button type="submit" class="btn btn-primary">Submit</button>
        </form><br><br>
    </div>
@endsection
@extends('app')
@section('content')
    <h2>New appointment</h2>
    <div><button><a href="{{route('appointments.index')}}">Back to appointments</button></a></div><br>
    @if(session('status'))
        <i>{{ session('status') }} </i>
    @endif
    <div class='formdiv formdiv2'>
         <form action="{{route('appointments.store')}}" method="POST">
            @csrf
            <label for="name" >Name<label><br>
            <input name="name"  value="{{ old('name') }}" required><br>
            @error('name')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span><br>
            @enderror
            <label for="" >Description<label><br>
            <textarea name="description">{{ old('description') }}</textarea><br>
            @error('description')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span><br>
            @enderror
            <label for="" >Therapist<label><br>
            <select name='therapist'>
                @foreach ($therapists as $therapist)
                        <option value={{$therapist->id}}> {{$therapist->name}} </option>
                @endforeach
            </select><br>
            @error('therapist')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span><br>
            @enderror
            <label for="" >Therapy room<label><br>
            <select name='troom'>
                @foreach ($trooms as $troom)
                        <option value={{$troom->id}}> {{$troom->name}} </option>
                @endforeach
            </select><br>
            @error('troom')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span><br>
            @enderror
            <label for="" >Time<label><br>
            <input type='datetime-local' name="time" value="{{ old('time') }}" required><br>
            @error('time')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span><br>
            @enderror
            <button type="submit" class="btn btn-primary">Submit</button>
        </form><br><br>
    </div>
@endsection
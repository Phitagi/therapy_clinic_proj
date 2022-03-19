@extends('app')
@section('content')
    <style>
        
    </style>
    <div class='formdiv'>
       <h3>Log in </h3>
       @if(session('status')) <span style=""><u>{{ session('status') }} </u></span> <br><br>@endif
       @if(session('error')) <span style="color:red;"><u>{{ session('error') }} </u></span> <br><br>@endif
        <form action="{{route('login')}}" method="POST">
                @csrf
                <label for="email" >email<label><br>
                <input name="email"  value="{{ old('email') }}" required><br>
                @error('email')
                    <span class="" role="alert">
                        <strong>{{ $message }}</strong>
                    </span><br>
                @enderror
                <label for="pass" >password<label><br>
                <input type="password" name="password" required><br>
                @error('password')
                    <span class="" role="alert">
                        <strong>{{ $message }}</strong>  
                    </span><br>
                @enderror
                <button type="submit" class="btn btn-primary">Submit</button>
        </form><br><br>
        <div>Don't have an account?  &nbsp; &nbsp;<a href="{{route('register')}}" style='cursor:pointer;'><u>Sign up</u></a></div>
    </div>
 
@endsection
@extends('app')
@section('content')
     <div class='formdiv'>
        <h3>Register</h3>
        <form action="{{route('register')}}" method="POST">
                @csrf
                <label for="" >Username<label><br>
                <input name="username" value="{{ old('username') }}" required><br>
                @error('username')
                    <span class="" role="alert">
                        <strong>{{ $message }}</strong>  
                    </span><br>
                @enderror
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
                <label for="pass" >Confirm password<label><br>
                <input type="password" name="password_confirmation" required><br>
                @error('password')
                    <span class="" role="alert">
                        <strong>{{ $message }}</strong>  
                    </span><br>
                @enderror
                <button type="submit" class="btn btn-primary">Submit</button>
        </form><br><br>
        <div>Already have an account?  &nbsp; &nbsp;<a href="{{route('login')}}" style='cursor:pointer;'><u>Log in</u></a></div>
     </div>
@endsection
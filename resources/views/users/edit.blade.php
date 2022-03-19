@extends('app')
@section('content')
    <h2>Update person - {{ $user->name }}</h2>
    <div><button><a href="{{route('users.index')}}">Back to all users</button></a></div><br>
    @if(session('status'))
        <i>{{ session('status') }} </i>
    @endif

    @if(session('error'))
        <i style='color:red;'>{{ session('error') }} </i>
    @endif
    <div class='formdiv formdiv2'>
         <form action="{{route('users.update',$user->id)}}" method="POST">
            @csrf
            @method('PUT')
            <label for="name" >Name<label><br>
            <input name="name"  value="{{ $user->name }}" required><br>
            @error('name')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span><br>
            @enderror
            <label for="" >Email<label><br>
           <input type="email" name="email"  value="{{ $user->email }}" required><br>
            @error('description')
                <span class="" role="alert">
                    <strong>{{ $message }}</strong>
                </span><br>
            @enderror
            @can('update',[\App\Models\User::class,$user])
                <label for="" >Role<label><br>
                <select name='role'>
                    <option value={{$user->role_id}}> {{$user->role->name}} </option>
                    @foreach ($roles as $role)
                        @if($role->id !== $user->role_id)
                            <option value={{$role->id}}> {{$role->name}} </option>
                        @endif
                    @endforeach
                </select><br>
            @endcan
            <label for="" >Password<label> &nbsp; <small><i>Leave blank if there's no change.</i></small><br>
            <input type="password" name="password"  value=""><br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form><br><br>
    </div>
@endsection
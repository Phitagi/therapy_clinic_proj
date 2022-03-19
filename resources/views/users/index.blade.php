@extends('app')
@section('content')
    <h2>System users</h2>
    <!--<div><button><a href="{{route('users.create')}}">New user</button></a></div><br>-->
    @if(session('status'))
        <i>{{ session('status') }} </i>
    @endif
     <table id="users" class="table table-bodered">

            <thead>

              <th>Name</th>
              <th>Email</th>
              <th>Position</th>
              <th></th>

            </thead>
            <tbody>

            @foreach($users as $user)
      
                <tr>
                  <td>{{ $user->name}}</td>
                  <td>{{ $user->email}}</td>
                  <td>{{ $user->role->name}}</td>
                  <td>

                       <div class="btn-group">
                            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                Action <span class="caret"></span>
                            </button>
                    
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{route('users.edit',$user->id)}}">Update</a></li> 
                                @can('delete',[\App\Models\User::class,$user])
                                  <li><form action="{{route('users.destroy',$user->id)}}" method='POST'>@csrf @method('DELETE') <button>Remove</button></form></li>
                                @endcan
                            </ul>
                        </div>

                  </td>
                </tr>
  
            @endforeach


            </tbody>

          </table>

          {{ $users->links() }}

@endsection
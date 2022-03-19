@extends('app')
@section('content')
    <h2>Therapy rooms</h2>
    <button class='addButton'><a href="{{route('therapyRooms.create')}}">New room</a></button><br>
    @if(session('status'))
        <i>{{ session('status') }} </i>
    @endif
     <table id="users" class="table table-bodered">
            <thead>

              <th>Name</th>
              <th></th>

            </thead>
            <tbody>

            @foreach($trooms as $troom)

                <tr>
                  <td>{{ $troom->name}}</td>
                  <td>

                       <div class="btn-group">
                            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                Action <span class="caret"></span>
                            </button>
                    
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{route('therapyRooms.edit',$troom->id)}}">Update</a></li> 
                                <li><form action="{{route('therapyRooms.destroy',$troom->id)}}" method='POST'>@csrf @method('DELETE') <button>Delete</button></form></li>
                            </ul>
                        </div>

                  </td>
                </tr>

              @endforeach


            </tbody>

          </table>
          {{ $trooms->links() }}

@endsection
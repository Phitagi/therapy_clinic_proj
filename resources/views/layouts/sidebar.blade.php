
<div class="sidebar">
        <li style='background-color: #a8a8cb;'><h2 class='mx-auto'><i><a href="{{ route('/') }}">Therapy Clinic</a></i></h2></li>
        <li><a href="{{ route('/') }}" class="text-md text-gray-700">Appointments</a></li>
        @can('viewAny',[\App\Models\Therapy_room::class])
                <li><a href="{{ route('therapyRooms.index') }}" class="text-md text-gray-700">Rooms</a></li>
        @endcan
        <li><a href="{{ route('users.index') }}" class="text-md text-gray-700">
                @if(\App\Models\User::is_admin(auth()->user()->id)) Users @else {{auth()->user()->name}} @endif
        </a></li>
</div> 

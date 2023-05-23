@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
              <!-- show data in table -->
              @if($users->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Follow</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td scope="row">{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    @if($user->follow_id)
                                        <form action="{{ route('users.unfollow', $user) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Unfollow</button>
                                        </form>
                                    @else
                                        <form action="{{ route('users.follow', $user) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Follow</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
                <!-- end table -->
                @else
                    <p style="display: flex;justify-content: center;">
                        <td colspan="3">No users found.</td>
                    </p>
                @endif
            </div>
        </div>
    </div>


@endsection
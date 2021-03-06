@extends('layouts.app',['title'=>'Edit Password'])

@section('content')

    <nav aria-label="breadcrumb" id="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('landing_page') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user', ['user' => Auth::user()->id]) }}">User Profile</a></li>
            <li class="breadcrumb-item"><a href="#">Change Password</a></li>
        </ol>
    </nav>

    <section class="container">
        <div class="text-center my-4">
            <h3 class="display-7">
                Change password
            </h3>

        </div>
    </section>

    <section class="container">
        <div class="d-flex justify-content-center ">



            <form class="col-lg-6 border border-10 justify-content-center bg-white rounded-2 pl-3 action"
                action="{{ route('edit_password', ['user_id' => $user->id]) }}" method="POST"
                enctype="multipart/form-data">
                @if (session('status'))
                    <div class=".bg-danger text-danger text-center">
                        {{ session('status') }}
                    </div>
                @endif
                @csrf

                <label for="current_password" class="form-label mt-3">Current Password *</label>
                <input type="password"
                    class="col-7 form-control border border-1rounded-1 m-auto text-center @error('current_password') border-danger @enderror"
                    name="current_password" id="current_password" aria-describedby="current_password" required>

                @error('current_password')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror

                <label for="new_password" class="form-label mt-3 ">New Password *</label>
                <input type="password"
                    class="col-7 form-control border border-1rounded-1 m-auto text-center @error('new_password') border-danger @enderror"
                    name="new_password" id="new_password" aria-describedby="new_password" required>

                @error('new_password')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror

                <label for="new_password_confirmation" class="form-label mt-3 ">New Password Confirmation *</label>
                <input type="password"
                    class="col-7 form-control border border-1rounded-1 m-auto text-center @error('new_password_confirmation') border-danger @enderror"
                    name="new_password_confirmation" id="new_password_confirmation"
                    aria-describedby="new_password_confirmation" required>

                @error('new_password_confirmation')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror

                <div class="row mt-3">

                    <div class="col d-flex">
                        <input class="btn btn-outline-secondary mt-3 mb-3 " type="button" value="Cancel">
                    </div>

                    <div class="col d-flex justify-content-end ">
                        <input class="btn btn-outline-secondary mt-3 mb-3 " type="submit" value="Add">
                    </div>


                </div>
            </form>



        </div>
    </section>

@endsection

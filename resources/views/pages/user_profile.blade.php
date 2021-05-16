@extends('layouts.app')

@section('content')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="col-lg-12 col-12 mt-5 row mx-auto">
    <aside id="user_info" class="col-xl-4 col-lg-5 col-12 fixed sticky_left_aside">
        <div class="card mx-3">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                    <div class="position-relative">
                        <img src="{{asset($user->photo)}}" alt="Admin" class="rounded-circle d-block" width="150">
                        <!-- <svg href="#" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="position-absolute top-0 end-0 bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg> -->
                    </div>
                    <div class="mt-3">
                        <h4>{{$user->name}}</h4>
                        <p class="text-secondary mb-1">{{$user->username}}</p>
                        <p class="text-muted font-size-sm">{{\Carbon\Carbon::parse($user->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y Years Old')}}</p>
                        <p class="font-size-sm">{{$user->email}}</p>
                        @if($user != auth()->user())
                        <button class="btn btn-primary">Send Request</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <section id="collapsable_section ">
            <div class="text-center">
                <h4 class="mt-3 text-center">Friends</h4>
                <a class="nav-link py-0" href="friends_page.php">view all</a>
                
            </div>
            <section class="d-flex flex-lg-row flex-column me-3" id="down_section">
                <div class="row col-md-6 col-12 ms-auto me-auto my-4 mx-1">
                    <a href="user_profile.php" class="list-group-item list-group-item-action" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Mickey Mouse</h5>
                        </div>
                        <p class="mb-1">@the_real_mickey</p>
                    </a>
                    <a href="user_profile.php" class="list-group-item list-group-item-action" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">The Beast</h5>
                        </div>
                        <p class="mb-1">@im_the_beast</p>
                    </a>
                    <a href="user_profile.php" class="list-group-item list-group-item-action" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Beauty</h5>
                        </div>
                        <p class="mb-1">@im_a_beauty</p>
                    </a>
                </div>
                <div class="row col-md-6 col-12 ms-auto me-auto my-4 mx-1">
                    <a href=" user_profile.php" class="list-group-item list-group-item-action" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Sonic</h5>
                        </div>
                        <p class="mb-1">@fasterthanflash</p>
                    </a>
                    <a href=" user_profile.php" class="list-group-item list-group-item-action" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Androis</h5>
                        </div>
                        <p class="mb-1">@imagreendroid</p>
                    </a>
                    <a href="user_profile.php" class="list-group-item list-group-item-action" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Sleepy Beaty</h5>
                        </div>
                        <p class="mb-1">@sleep4ever</p>
                    </a>
                </div>
            </section>
            
        </section>
    </aside>
    <section class="col-xl-8 col-lg-7 col-12 scrollit me-3 ms-auto">
        <h4 class="text-center">
            Latest Reviews
        </h4>
         @each('partials.review', $reviews, 'review')
        
    </section>
</div>

@endsection
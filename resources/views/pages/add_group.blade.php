@extends('layouts.app')

@section('content')

<section class="container">
    <div class="text-center my-4">
        <h3 class="display-7">
            Create a Group
        </h3>
        
    </div>
</section>

<section class="container">
    <div class="d-flex justify-content-center ">
        
        <form class="col-10 col-lg-3 border border-10  bg-white rounded-2 pl-3 action" action="groups_list.php" method="post">

            <label for="name" class="form-label mt-3 ">Group Name</label>
            <input type="text" class="col-7 form-control border border-1rounded-1 " id="name" aria-describedby="name">

            <label for="description" class="form-label mt-3 ">Group Description</label>
            <textarea type="text" rows="3" class="row-4 form-control border border-1rounded-1 " id="description" aria-describedby="description"></textarea>

            <label class="form-label mt-3" for="photo">Upload Photo</label>
            <input type="file" class="form-control" id="photo" />

            <div class="d-flex justify-content-center ">
                <input class="btn btn-outline-secondary mt-3 mb-3 " type="submit" value="Submit">
            </div>
            

        </form>
        
        
        
    </div>
</section>
 
@endsection
<div class="card-header row review-header " onclick="location.href='{{route('review',[$review->id])}}'">
    <div class="col col-12 col-lg-9 no-padding">
        {{$review->title}}
    </div>
    <div class="col col-12 col-lg-3 review-author no-padding">
        <a class="btn text-dark" href="#">
            by {{$review->user->username}}
        </a> 
        @can('delete',$review)
            <button class="btn btn-primary" id="deleteButton">
                Delete
            </button>                     
        @else 
            <form method="POST" action="{{route('report_review',['id' => $review->id])}}">
                @csrf
                <button class="btn btn-primary" >
                    Report
                </button>  
            </form>
            
        @endcan
        
    </div>
    <div class="col col-12 no-padding">
        <small col>
            {{$review->date}}
        </small>
    </div>
</div>
<div class="card-body d-flex flex-column " onclick="location.href='{{route('review',[$review->id])}}'">
    {{$review->text}}
</div>
<div class="card-footer d-flex d-flex justify-content-between review-footer">
    <div class="like_button no-padding">
        <i onclick="myFunction(this)" class="fa fa-thumbs-up"> {{$review->likes->count()}}</i>
    </div>
    <a class="btn" data-toggle="collapse" href="#comments{{$review->id}}" role="button" aria-expanded="false"
        aria-controls="comments{{$review->id}}"> 
        {{$review->comments->count()}} comments 
    </a>
</div>

 <div class="comment-section mt-3 collapse" id="comments{{$review->id}}">
    @if($review->comments->count() > 0)
        @each('partials.comment',$review->comments,'comment')
    @endif
    @auth
    <form class="add-comment">
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Add a commment</label>
            <div class=" d-flex ">
                <textarea class="form-control comment-textarea" id="exampleFormControlTextarea1"
                    rows="1"></textarea>
                <button class="btn btn-primary ms-3">
                    Send
                </button>
            </div>
        </div>
    </form>
    @endauth
</div>     
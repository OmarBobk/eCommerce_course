@if(session()->has('msg'))
    <div class="alert alert-{{session()->get('alert-type')}} alert-dismissible fade show" role="alert">
        {{session()->get('msg')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

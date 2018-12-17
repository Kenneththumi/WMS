
@if($errors->count())
    <div class="alert alert-danger alert-dismissible fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <ul>
            @foreach ($errors->all() as $error)
                <li><strong>Error!</strong>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
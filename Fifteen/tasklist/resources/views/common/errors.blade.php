
@if(count($errors) > 0)

<div class="alert alert-danger">

    <strong>STH Went Wrong!!</strong>

    <br><br>

    <ul>
        @foreach($errors->all() as $errors)
        <li>{{$error}}</li>
        @endforeach
    </ul>

</div>

@endif

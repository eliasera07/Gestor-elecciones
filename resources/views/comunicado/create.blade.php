<form action="{{ url('/comunicados')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('comunicado.form');


</form>
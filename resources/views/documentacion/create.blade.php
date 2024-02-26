<form action="{{ url('/documentaciones')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('documentacion.form');


</form>
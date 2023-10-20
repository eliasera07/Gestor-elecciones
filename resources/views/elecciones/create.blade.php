<form action="{{ url('/elecciones')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('elecciones.form');


</form>
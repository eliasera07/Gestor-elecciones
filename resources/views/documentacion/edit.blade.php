<form action="{{ url('/documentaciones/'. $documentacion->id )}}" method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH') }}
    @include('documentacion.form');

</form>
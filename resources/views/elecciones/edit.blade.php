formulario de edicion de elecciones

<form action="{{ url('/elecciones/'.$elecciones->id )}}" method="post" enctype="multipart/form-data">
@csrf
{{ method_field('PATCH') }}
@include('elecciones.form');

</form>
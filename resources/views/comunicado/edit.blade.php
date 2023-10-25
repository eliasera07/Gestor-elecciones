<form action="{{ url('/comunicados/'. $comunicado->id )}}" method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH') }}
    @include('comunicado.form');

</form>
<form action="{{ url('/votante/'. $votante->id )}}" method="post" enctype="multipart/form-data">
@csrf
{{ method_field('PATCH') }}
@include('votante.form');

</form>
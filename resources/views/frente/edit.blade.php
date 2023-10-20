<form action="{{ url('/frente/'. $frente->id )}}" method="post" enctype="multipart/form-data">
@csrf
{{ method_field('PATCH') }}
@include('frente.form');

</form>
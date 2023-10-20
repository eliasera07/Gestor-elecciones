<form action="{{ url('/comite/'. $comite->id )}}" method="post" enctype="multipart/form-data">
@csrf
{{ method_field('PATCH') }}
@include('comite.form');

</form>


<form action="{{ url('/jurados/'. $jurados->id )}}" method="post" enctype="multipart/form-data">
@csrf
{{ method_field('PATCH') }}
@include('jurados.form');

</form>
<form action="{{ url('/jurados')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('jurados.form');


</form>
<form action="{{ url('/votante')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('votante.form');

</form>
<form action="{{ url('/mesas')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('mesas.form');


</form>
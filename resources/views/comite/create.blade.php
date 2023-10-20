<form action="{{ url('/comite')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('comite.form');


</form>
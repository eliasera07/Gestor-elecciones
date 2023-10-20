<form action="{{ url('/frente')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('frente.form');


</form>
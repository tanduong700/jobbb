@extends('layouts.metronic.guest')
@section('content')
<body>
<div class="container">

    <h3 class="jumbotron">{{ $title ?? 'chưa có tiêu đề' }}</h3>
    <form method="post" action="{{url('image/upload/store')}}" enctype="multipart/form-data"
                  class="dropzone" id="dropzone">
    @csrf
</form>

</body>
@endsection

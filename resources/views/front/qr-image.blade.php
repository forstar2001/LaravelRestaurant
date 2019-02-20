@extends('front.partials.mainLayout-front')
@section('content')
  <style> #main > header{ display: none; } </style>
  <!--=============== Hero content ===============-->
  <div class="container">
    <div class="col-lg-12">
      <div class="row">
        <div  style="">
          <img src="{{ asset_domain('storage/qr/'.'hotel-'.request()->route('id').'.png') }}" class="img-thumbnail" alt="Please regenerate Qr code"></div>
      </div>
    </div>
  </div>
@endsection()

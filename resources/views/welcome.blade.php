@extends('welcomeBodyPart.fullBody')
@section('main_body')

@include('welcomeBodyPart.slider')
<!-- Main  -->
<main id="main">

  <!-- About -->
  @include('welcomeBodyPart.about')


  <!-- Service -->
  @include('welcomeBodyPart.service')

  <!-- Portfolio -->
  @include('welcomeBodyPart.portfolio')


  <!-- Clients -->
  @include('welcomeBodyPart.clients')

</main>
<!-- End #main -->
@endsection
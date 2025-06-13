@extends('frontend.layouts.app')

@section('title', 'Beranda')

@section('content')
  @include('frontend.sections.hero')
  @include('frontend.sections.lokasi')
  @include('frontend.sections.gambaran')
  @include('frontend.sections.lingkungan')
  @include('frontend.sections.pendidikan')
  @include('frontend.sections.kebudayaan')
  @include('frontend.sections.pemerintahan')
  @include('frontend.sections.kelembagaan')
  @include('frontend.sections.ekonomi')
  @include('frontend.sections.lahan')
  @include('frontend.sections.proyek')
@endsection
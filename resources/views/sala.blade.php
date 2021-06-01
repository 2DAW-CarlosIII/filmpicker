@extends('layouts.app')

@section('content')
Sala {{__(Auth::user()->sala_id)}}
@endsection

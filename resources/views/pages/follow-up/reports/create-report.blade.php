@extends('layouts.app')

@section('content')

<livewire:followup-reports.list-reports :target="$target" :lifeCoach="$lifeCoach">

@endsection



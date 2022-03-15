@extends('layouts.app')
@section('content')

<livewire:salary.new-salary-schedule-preview :month_of_salary="$month_of_salary" :year_of_salary="$year_of_salary" :salary_schedule_id="$salary_schedule_id">

@endsection

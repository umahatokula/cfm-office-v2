<div>
    <style>
        .table td, .table th {
            padding: 5px 20px!important;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <h3> <b>{{ $salarySchedule->name }}</b> - {{ $months[$salary->month_of_salary] }}, {{ $salary->year_of_salary }} </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-style-light" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-style-light" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('salaries.staff.export', [$salary->id]) }}" class="btn btn-success btn-sm float-end mb-3 mx-2" type="submit">CSV</a>
                                <a href="{{ route('salaries.staff.pdf', [$salary->id]) }}" class="btn btn-danger btn-sm float-end mb-3" type="submit">PDF</a>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-inverse table-nowrap" style="font-size: 0.8rem">
                                    <thead class="">
                                        <tr>
                                            <th><b>Staff</b></th>
                                            <th class="text-end"><b>Gross Salary</b></th>
                                            @forelse ($salarySchedule->scheduleDetails as $scheduleDetail)
                                            <th class="text-center">{{ $scheduleDetail->SalaryScheduleElement->name }}({{ $scheduleDetail->percentage }}%)</th>
                                            @empty
                                            <th colspan="{{ count($lastSalarySchedule->scheduleDetails) }}">No schedule elements</th>
                                            @endforelse
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($salaries as $key => $salary)
                                        <tr>
                                            <td><b>{{ $salary?->staff?->name }}</b></td>
                                            <td class="text-end"><b>{{ number_format($salary?->staff?->gross_salary, 2) }}</b></td>

                                            @forelse ($salary?->breakdown as $k => $breakdown)

                                                @if (in_array($k, $scheduleDetailsElements))
                                                    <td class="text-center">
                                                        {{ number_format($breakdown, 2) }}
                                                    </td>
                                                @endif

                                            @empty
                                                <td colspan="">No schedule elements</td>
                                            @endforelse

                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">No records</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<link href="{{ public_path('assets/bootstrap-4.6.1-dist/css/bootstrap.min.css') }}" rel="stylesheet">
<style>
.printView {
    font-size: 0.5rem;
}
.table-bordered {
    border: 1px solid #000000;
}
.table-bordered th {
    border: 1px solid #000000;
}
.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #000000;
}
.table-bordered td, .table-bordered th {
    border: 1px solid #000000;
}

</style>

<div class="row printView">
    <div class="col-md-12">

        <h3> <b>{{ $salarySchedule->name }} - {{ $months[$month_of_salary] }}, {{ $year_of_salary }}</b> </h3>

        <table class="table printView" style="font-size: 0.8rem">
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
                    <td><b>{{ $salary->staff->name }}</b></td>
                    <td class="text-end"><b>{{ number_format($salary->staff->gross_salary, 2) }}</b></td>

                    @forelse ($salary->breakdown as $k => $breakdown)

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


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
                                <h3>Staff Salaries </h3>
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

                    <form wire:submit.prevent="generateSalarySheet">
                        <div class="row my-3">
                            <div class="col-md-2 mb-2">
                                Create salary
                            </div>
                            <div class="col-md-2 mb-2">
                                <select wire:model="salaryMonth"  class="form-control" style="
                                    padding: 3px 10px;
                                    text-align: left;
                                ">
                                    <option value="">Month</option>
                                    @foreach ($months as $key => $month)
                                        <option value="{{ $key }}" {{ $salaryMonth == $key ? 'selected' : null }}>{{ $month }}</option>
                                    @endforeach
                                </select>
                                @error('salaryMonth') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-1 mt-md-1 mb-2">
                                / {{ $salaryYear }}
                            </div>
                            <div class="col-md-3 mb-2">
                                <select wire:model="salary_schedule_id"  class="form-control" style="
                                    padding: 3px 10px;
                                    min-width: 100%;
                                    width: 200px;
                                    text-align: left;
                                ">
                                    <option value="">Salary Schedules</option>
                                    @foreach ($salarySchedules as $salarySchedule)
                                        <option value="{{ $salarySchedule->id }}">{{ $salarySchedule->name }}</option>
                                    @endforeach
                                </select>
                                @error('salary_schedule_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-dark btn-sm float-end mb-3" type="submit">Generate new salaries</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    @if (!$salarySchedulesForTheMonth)
                    <table class="table table-bordered table-inverse table-nowrap" style="font-size: 0.8rem">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Month</th>
                                <th class="text-center">Year</th>
                                <th class="text-center">Schedule</th>
                                <th class="text-center">Action(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($salaries as $salary)
                                <tr>
                                    <td class="text-center" scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $months[$salary->month_of_salary] }}</td>
                                    <td class="text-center">{{ $salary->year_of_salary }}</td>
                                    <td class="text-center">{{ $salary->salarySchedule->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('salaries.staff.preview', $salary)}}" class="text-primaryp-0" data-original-title="" title="Details">
                                            Preview
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No salaries records</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @endif

                    @if ($salarySchedulesForTheMonth)
                    <form wire:submit.prevent="saveSalaries">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-inverse table-nowrap" style="font-size: 0.8rem">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th>Staff name</th>
                                                <th class="text-end">Gross Salary</th>
                                                @if ($salarySchedule)
                                                    @forelse ($salarySchedule->scheduleDetails as $scheduleDetail)
                                                        <th class="text-center">{{ $scheduleDetail->SalaryScheduleElement->name }}({{ $scheduleDetail->percentage }}%)</th>
                                                    @empty
                                                        <th colspan="{{ count($salarySchedule->scheduleDetails) }}">No schedule elements</th>
                                                    @endforelse
                                                @endif
                                                {{-- <td>&nbsp;</td> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($staffs as $key => $staff)
                                            <tr>
                                                <td>{{ $staff->name }}</td>
                                                <td class="text-end">{{ number_format($staff->gross_salary, 2) }}</td>
                                                @if ($salarySchedulesForTheMonth)
                                                    @forelse ($salarySchedulesForTheMonth[$key] as $k => $amount)

                                                        @if (in_array($k, $scheduleDetailsElements))
                                                        <td class="text-center">
                                                            <input wire:model.defer="salarySchedulesForTheMonth.{{$key}}.{{$k}}" type="text" class="text-end" style="max-width: 100px;">
                                                        </td>
                                                        @endif

                                                    @empty
                                                        <td colspan="{{ count($salarySchedulesForTheMonth) }}">No schedule elements</td>
                                                    @endforelse
                                                @endif
                                                {{-- <td>
                                                    <a data-bs-toggle="modal" data-bs-target="#modal-large" data-toggle="modal" data-keyboard="false" data-remote="{{ route('salaries.staff.edit', $staff)}}" href="#" class="text-success p-0" title="Edit Salary">
                                                        <span class="material-icons-outlined">edit</span>
                                                    </a>
                                                </td> --}}
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary btn-sm float-end mb-3" type="submit">Save Schedule</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>

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
                    
                    <form wire:submit.prevent="saveSalaries">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                Month of Salary Schedule
                            </div>
                            <div class="col-md-4">
                                <select wire:model="salaryMonth"  class=" mb-2" style="
                                    padding: 3px 10px;
                                    min-width: 100px;
                                    width: 200px;
                                    text-align: left;
                                ">
                                    <option value="">Month</option>
                                    @foreach ($months as $month)
                                        <option value="{{ $month }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5 mb-2">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-dark btn-sm float-end mb-3" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-inverse table-nowrap" style="font-size: 0.8rem">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>Staff name</th>
                                        <th class="text-end">Gross Salary</th>
                                        @if ($lastSalarySchedule)
                                            @forelse ($lastSalarySchedule->scheduleComponents as $scheduleComponent)
                                                <th class="text-center">{{ $scheduleComponent->SalaryScheduleElement->name }}({{ $scheduleComponent->percentage }}%)</th>
                                            @empty
                                                <th colspan="{{ count($lastSalarySchedule->scheduleComponents) }}">No schedule elements</th>
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
                                        @if ($lastSalarySchedule)
                                            @forelse ($salarySchedulesForTheMonth[$key] as $k => $amount)
                                                <td class="text-center">
                                                    <input wire:model.defer="salarySchedulesForTheMonth.{{$key}}.{{$k}}" type="text" class="text-end" style="max-width: 100px;">
                                                </td>
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
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
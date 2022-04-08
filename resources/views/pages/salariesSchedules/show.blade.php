<div class="row">
    <div class="col-md-12">
        <h5 class="mb-4">Schedule Elements</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-nowrap">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Schedule Elements</th>
                        <th class="text-center">Percentage (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($salarySchedule->scheduleDetails as $key => $scheduleDetail)
                    <tr>
                        <td  class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            {{ $scheduleDetail->SalaryScheduleElement->name }}
                        </td>
                        <td class="text-center">
                            {{ $scheduleDetail->percentage }}
                        </td>
                    </tr>
                    @empty
                    <p class="" colspan="5">No data</p>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

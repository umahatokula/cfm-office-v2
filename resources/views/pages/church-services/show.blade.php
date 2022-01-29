<table class="table table-bordered">
    <tbody>
      <tr>
        <td>Service Date</td>
        <td>{{ $churchService->service_date ? $churchService->service_date->toFormattedDateString() : '' }}</td>
      </tr>
      <tr>
        <td>Type</td>
        <td>{{ $churchService->serviceType ? $churchService->serviceType->service_type : '' }}</td>
      </tr>
      <tr>
        <td>Attendance (Men)</td>
        <td class="text-end">{{ $churchService->attendance_men }}</td>
      </tr>
      <tr>
        <td>Attendance (Women)</td>
        <td class="text-end">{{ $churchService->attendance_women }}</td>
      </tr>
      <tr>
        <td>Attendance (Children)</td>
        <td class="text-end">{{ $churchService->attendance_children }}</td>
      </tr>
      <tr>
        <td>First Time Guests (Men)</td>
        <td class="text-end">{{ $churchService->first_timers_men }}</td>
      </tr>
      <tr>
        <td>First Time Guests (Women)</td>
        <td class="text-end">{{ $churchService->first_timers_women }}</td>
      </tr>
      <tr>
        <td>First Time Guests (Children)</td>
        <td class="text-end">{{ $churchService->first_timers_children }}</td>
      </tr>
      <tr>
        <td>Born Again (Men)</td>
        <td class="text-end">{{ $churchService->born_again_men }}</td>
      </tr>
      <tr>
        <td>Born Again (Women)</td>
        <td class="text-end">{{ $churchService->born_again_women }}</td>
      </tr>
      <tr>
        <td>Born Again (Children)</td>
        <td class="text-end">{{ $churchService->born_again_children }}</td>
      </tr>
      <tr>
        <td>Filled (Men)</td>
        <td class="text-end">{{ $churchService->filled_men }}</td>
      </tr>
      <tr>
        <td>Filled (Women)</td>
        <td class="text-end">{{ $churchService->filled_women }}</td>
      </tr>
      <tr>
        <td>Filled (Children)</td>
        <td class="text-end">{{ $churchService->filled_children }}</td>
      </tr>
      <tr>
        <td>Regular Offering</td>
        <td class="text-end">&#8358; {{ number_format($churchService->regular_offering, 2) }}</td>
      </tr>
      <tr>
        <td>Tithe</td>
        <td class="text-end">&#8358; {{ number_format($churchService->tithes, 2) }}</td>
      </tr>
      <tr>
        <td>Connection</td>
        <td class="text-end">&#8358; {{ number_format($churchService->connection, 2) }}</td>
      </tr>
      <tr>
        <td>Honourarium</td>
        <td class="text-end">&#8358; {{ number_format($churchService->honourarium, 2) }}</td>
      </tr>
      <tr>
        <td>First Fruit</td>
        <td class="text-end">&#8358; {{ number_format($churchService->first_fruit, 2) }}</td>
      </tr>
      <tr>
        <td>Thanksgiving Offering</td>
        <td class="text-end">&#8358; {{ number_format($churchService->thanksgiving_offering, 2) }}</td>
      </tr>
      <tr>
        <td>Special Offering</td>
        <td class="text-end">&#8358; {{ number_format($churchService->special_offering, 2) }}</td>
      </tr>
      <tr>
        <td>Project Offering</td>
        <td class="text-end">&#8358; {{ number_format($churchService->project_offering, 2) }}</td>
      </tr>
      <tr>
        <td>POS</td>
        <td class="text-end">&#8358; {{ number_format($churchService->pos, 2) }}</td>
      </tr>
      <tr>
        <td>Others</td>
        <td class="text-end">&#8358; {{ number_format($churchService->others, 2) }}</td>
      </tr>
      <tr>
        <td>Total Offering</td>
        <td class="text-end">&#8358; {{ number_format($churchService->total_offering, 2) }}</td>
      </tr>
      <tr>
        <td>Submitted by</td>
        <td>{{ $churchService->submittedBy ? $churchService->submittedBy->full_name : ''}}</td>
      </tr>
    </tbody>
  </table>
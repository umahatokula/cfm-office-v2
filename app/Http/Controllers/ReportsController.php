<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ChurchService;
use App\Models\Church;
use App\Models\ServiceType;
use Carbon\Carbon;

class ReportsController extends Controller
{

    function __construct() {
        $this->middleware('auth');
    }


    /**
     * Generate report from church service information
     */
    public function serviceDays(Request $request) {

        $service_type_id = null;

        $first_date_from = Carbon::now()->startOfMonth();
        $first_date_to = Carbon::now()->endOfMonth();

        $second_date_from = null;
        $second_date_to = null;

        $churches = Church::isActive()->get();

        $data = [];
        foreach ($churches as $church) {

            // FIRST QUERY
            $first_services = ChurchService::where('church_id', $church->id)->whereHas('church', function ($query) {
					$query->where('is_active', '=', 1);
			})->with('church')->get();
            // dd($first_services);

            if ($request->first_date_from) {

                $first_date_from = $request->first_date_from;
                $first_date_to = $request->first_date_to;

            }
        
            if ($first_date_from === $first_date_to) {
                $first_services = $first_services->where('service_date', '=', Carbon::parse($first_date_from));

            } else {

                $first_services = $first_services->whereBetween('service_date', [ $first_date_from, $first_date_to ]);

            }

            if ($request->service_type_id) {

                $service_type_id = $request->service_type_id;
                $first_services = $first_services->where('service_type_id', $service_type_id);

            }

            // FIRST QUERY
            $data[$church->name]['first_records'] = [
                'attendance_men'      => $first_services->sum('attendance_men'),
                'attendance_women'    => $first_services->sum('attendance_women'),
                'attendance_children' => $first_services->sum('attendance_children'),
                'attendance_total'    => $first_services->sum('attendance_total'),
                'first_timers_total'  => $first_services->sum('first_timers_total'),
                'born_again_total'    => $first_services->sum('born_again_total'),
                'offering'            => $first_services->sum('regular_offering') + $first_services->sum('connection') + $first_services->sum('honourarium') + $first_services->sum('first_fruit') + $first_services->sum('thanksgiving_offering') + $first_services->sum('special_offering') + $first_services->sum('project_offering') + $first_services->sum('pos') + $first_services->sum('others'),
                'tithes'              => $first_services->sum('tithes'),
                'total'               => $first_services->sum('total_offering'),
            ];

            // SECOND QUERY
            if ($request->second_date_from) {
                $second_services = ChurchService::where('church_id', $church->id)->whereHas('church', function ($query) {
					$query->where('is_active', '=', 1);
            })->get();
                    
                $second_date_from = $request->second_date_from;
                $second_date_to = $request->second_date_to;

    
                if ($second_date_from === $second_date_to) {

                    $second_services = $second_services->where('service_date', '=', Carbon::parse($second_date_from));

                } else {

                    $second_services = $second_services->whereBetween('service_date', [ $request->second_date_from, $request->second_date_to ]);

                }

                if ($request->service_type_id) {

                    $service_type_id = $request->service_type_id;
                    $second_services = $second_services->where('service_type_id', $service_type_id);

                }

                $data[$church->name]['second_records'] = [
                    'attendance_men'      => $second_services->sum('attendance_men'),
                    'attendance_women'    => $second_services->sum('attendance_women'),
                    'attendance_children' => $second_services->sum('attendance_children'),
                    'attendance_total'    => $second_services->sum('attendance_total'),
                    'first_timers_total'  => $second_services->sum('first_timers_total'),
                    'born_again_total'    => $second_services->sum('born_again_total'),
                    'offering'            => $second_services->sum('total_offering') - $second_services->sum('tithes'),
                    'tithes'              => $second_services->sum('tithes'),
                    'total'               => $second_services->sum('total_offering'),
                ];

            }
        }

        $data['combined_records'] = $data;

        $data['first_date_from'] = $first_date_from;
        $data['first_date_to'] = $first_date_to;
        $data['second_date_from'] = $second_date_from;
        $data['second_date_to'] = $second_date_to;
        $data['service_type_id'] = $service_type_id;
        $data['service_type'] = ServiceType::find($service_type_id);
        $data['serviceTypes'] = ServiceType::pluck('service_type', 'id');


        // dd($data);


        return view('reports.serviceDays', $data);
    }


    /**
     * Generate PDF report from church service information
     */
    public function reportsChurchServicesPdf($first_date_from, $first_date_to, $second_date_from = null, $second_date_to = null) {

        $churches = Church::all();

        $data = [];
        foreach ($churches as $church) {

            // FIRST QUERY
            $first_services = ChurchService::where('church_id', $church->id)->get();

            if ($first_date_from) {

                $first_services = $first_services->whereBetween('service_date', [ $first_date_from, $first_date_to ]);

            }

            $data[$church->name]['first_records'] = [
                'attendance' => $first_services->sum('attendance_men') + $first_services->sum('attendance_women'),
                'children' => $first_services->sum('attendance_children'),
                'offering' => $first_services->sum('total_offering') - $first_services->sum('tithes'),
                'tithes' => $first_services->sum('tithes'),
                'total' => $first_services->sum('regular_offering') + $first_services->sum('tithes'),
                'first_timers_total' => $first_services->sum('first_timers_total'),
                'born_again_total' => $first_services->sum('born_again_total'),
            ];


            // SECOND QUERY

            if ($second_date_from) {
                $second_services = ChurchService::where('church_id', $church->id)->get();

                    $second_services = $second_services->whereBetween('service_date', [ $second_date_from, $second_date_to ]);

                $data[$church->name]['second_records'] = [
                    'attendance' => $second_services->sum('attendance_men') + $second_services->sum('attendance_women'),
                    'children' => $second_services->sum('attendance_children'),
                    'offering' => $second_services->sum('total_offering') - $second_services->sum('tithes'),
                    'tithes' => $second_services->sum('tithes'),
                    'total' => $second_services->sum('regular_offering') + $second_services->sum('tithes'),
                    'first_timers_total' => $second_services->sum('first_timers_total'),
                    'born_again_total' => $second_services->sum('born_again_total'),
                ];

            }
        }

        $data['combined_records'] = $data;

        $data['first_date_from'] = $first_date_from;
        $data['first_date_to'] = $first_date_to;
        $data['second_date_from'] = $second_date_from;
        $data['second_date_to'] = $second_date_to;

        $pdf = \PDF::loadView('pdf.churchServiceReport', $data)->setPaper('a4', 'landscape');
        return $pdf->download('SUMMARY_SERVICE_REPORTS.pdf');

    }


    /**
     * Generate report from church service information
     */
    public function serviceDays2(Request $request) {

        $churches = Church::pluck('name', 'id');
        $first_date_from = Carbon::now()->startOfMonth();
        $first_date_to = Carbon::now()->endOfMonth();

        $second_date_from = Carbon::now()->startOfMonth();
        $second_date_to = Carbon::now()->endOfMonth();

        $q = ChurchService::query();

        if ($request->first_date_from) {
            $first_date_from = $request->first_date_from;
            $first_date_to = $request->first_date_to;
        }

        $q->whereBetween('service_date', [$first_date_from, $first_date_to]);

        $first_records = $q->with('church')->orderBy('service_date', 'desc')->get();
        $first_records = $first_records->groupBy('church_id');


        $data = []; // initialize data array
        $first_records->each(function ($item, $key) use(&$data) {

            $data['attendance']['first_records'][] = $item->sum('attendance_men') + $item->sum('attendance_women');
            $data['children']['first_records'][] = $item->sum('attendance_children');
            $data['offering']['first_records'][] = $item->sum('total_offering') - $item->sum('tithes');
            $data['tithes']['first_records'][] = $item->sum('tithes');
            $data['total']['first_records'][] = $item->sum('regular_offering') + $item->sum('tithes');
            $data['first_timers_total']['first_records'][] = $item->sum('first_timers_total');
            $data['born_again_total']['first_records'][] = $item->sum('born_again_total');

            $data['church']['first_records'][] = Church::where('id', $key)->first();

        });


        $data['first_date_from'] = $first_date_from;
        $data['first_date_to'] = $first_date_to;


        /**
         * Compare reports between two periods
         * @var [type]
         */
        $q_compare = ChurchService::query();

        if ($request->second_date_from) {
            $second_date_from = $request->second_date_from;
            $second_date_to = $request->second_date_to;
        }

        $q_compare->whereBetween('service_date', [$second_date_from, $second_date_to]);

        $second_records = $q_compare->with('church')->orderBy('service_date', 'desc')->get();
        $second_records = $second_records->groupBy('church_id');

        $second_records->each(function ($item, $key) use(&$data) {

            $data['attendance']['second_records'][] = $item->sum('attendance_men') + $item->sum('attendance_women');
            $data['children']['second_records'][] = $item->sum('attendance_children');
            $data['offering']['second_records'][] = $item->sum('total_offering') - $item->sum('tithes');
            $data['tithes']['second_records'][] = $item->sum('tithes');
            $data['total']['second_records'][] = $item->sum('regular_offering') + $item->sum('tithes');
            $data['first_timers_total']['second_records'][] = $item->sum('first_timers_total');
            $data['born_again_total']['second_records'][] = $item->sum('born_again_total');

            $data['church']['second_records'][] = Church::where('id', $key)->first();

            // return $data;
        });

        $data['second_date_from'] = $second_date_from;
        $data['second_date_to'] = $second_date_to;


        // dd($data);

        $data['combined_records'] = $data;


        return view('reports.serviceDays', $data);
    }


    /**
     * Generate PDF report from church service information
     */
    public function reportsChurchServicesPdf2($date_from, $date_to) {

        $q = ChurchService::query();

        $q->whereBetween('service_date', [$date_from, $date_to]);

        $churchServices = $q->with('church')->orderBy('service_date', 'desc')->get();
        $churchServices = $churchServices->groupBy('church_id');

        $records = $churchServices->map(function ($item, $key) {
            $data['attendance'] = $item->sum('attendance_men') + $item->sum('attendance_women');
            $data['children'] = $item->sum('attendance_children');
            $data['offering'] = $item->sum('total_offering') - $item->sum('tithes');
            $data['tithes'] = $item->sum('tithes');
            $data['total'] = $item->sum('regular_offering') + $item->sum('tithes');
            $data['first_timers_total'] = $item->sum('first_timers_total');
            $data['born_again_total'] = $item->sum('born_again_total');

            $data['church'] = Church::where('id', $key)->first();

            return $data;
        });

        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;
        $data['records'] = $records;

        $pdf = \PDF::loadView('pdf.churchServiceReport', $data)->setPaper('a4', 'landscape');
        return $pdf->download('SUMMARY_SERVICE_REPORTS.pdf');

    }


    public function general() {

        $service_type_id = null;
        $serviceTypes = ServiceType::isActive()->pluck('service_type', 'id');

        $churches = Church::isActive()->get();

        $date_from = Carbon::today()->startOfYear();
        $date_to = Carbon::today()->endOfYear();

        $data['ovarall_attendance_total']   = 0;
        $data['ovarall_attendance_avg']     = 0;
        $data['ovarall_first_timers_total'] = 0;
        $data['ovarall_born_again_total']   = 0;
        $data['ovarall_total_offering']     = 0;
        $data['ovarall_tithes']             = 0;

        $reports = [];
        foreach ($churches as $church) {

            // FIRST QUERY
            $servicesQuery = ChurchService::query();
            $servicesQuery = $servicesQuery->where('church_id', $church->id);

            if (request('date_from')) {
                $date_from = request('date_from');
                $date_to = request('date_to');
            }
            $servicesQuery = $servicesQuery->whereBetween('service_date', [ $date_from, $date_to ]);

            if (request('service_type_id')) {
                $service_type_id = request('service_type_id');
                $servicesQuery = $servicesQuery->where('service_type_id', $service_type_id);
            }

            $services = $servicesQuery->get();
            

            $attendance_total = $services->sum('attendance_total');
            $attendance_avg = $services->count() > 0 ? $attendance_total / $services->count() : 0;

            $data['ovarall_attendance_total']   += $attendance_total;
            $data['ovarall_attendance_avg']     += $attendance_avg;
            $data['ovarall_first_timers_total'] += $services->sum('first_timers_total');
            $data['ovarall_born_again_total']   += $services->sum('born_again_total');
            $data['ovarall_total_offering']     += $services->sum('total_offering');
            $data['ovarall_tithes']             += $services->sum('tithes');

            $reports[] = [
                'church'             => $church,
                'attendance_total'   => $attendance_total,
                'attendance_avg'     => $attendance_avg,
                'first_timers_total' => $services->sum('first_timers_total'),
                'born_again_total'   => $services->sum('born_again_total'),
                'total_offering'     => $services->sum('total_offering'),
                'tithes'             => $services->sum('tithes')
            ];

            $data['reports'] = $reports;
        }

        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;
        $data['serviceTypes'] = $serviceTypes;
        $data['service_type_id'] = $service_type_id;
        $data['selectedService'] = ServiceType::find($service_type_id);
        
        return view('reports.general', $data);
    }
}

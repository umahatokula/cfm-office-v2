<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Member;
use App\Models\SMSGroup;
use App\Models\SMS;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;

class SMSController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct() {
        $this->middleware('auth');
  }

  public function index() {
    $data['smsMenu'] = 1;
    $data['title'] = 'SMS';
    $data['sms_menu'] = 1;
    $data['groups'] = SMSGroup::all();


    // get balance
    $sms = new SMS;
    $data['balance'] = $sms->get_balance();

    return view('sms.index', $data);

  }


  /**
  * send SMS
  * @param  Request $request [description]
  * @return [type]           [description]
  */
  public function send(Request $request) {
    // dd($request->all());
    $phoneNumbers = $request->compose_1.$request->compose_2;
    $message = $request->message;

    // send sms
    $sms = new SMS;
    $sent = $sms->send($phoneNumbers, $message);

    return redirect()->back();
  }


  /**
  * get the phone number of one parent
  * @param  Request $request [description]
  * @return [type]           [description]
  */
  public function parentsPhoneNumber(Request $request) {

    $parent = StudentParent::find($request->parent_id);

    return response()->json(['parentPhoneNumber' => $parent->phone.',']);
  }


  /**
  * create sms group
  * @param  Request $request [description]
  * @return [type]           [description]
  */
  public function createGroup(Request $request) {
    // dd($request->all());

    $groupName      = $request->groupName;
    $groupPhoneNumbers  = $request->groupPhoneNumbers;

    $grp = new SMSGroup;
    $grp->groupName     = $groupName;
    $grp->groupPhoneNumbers = json_encode($groupPhoneNumbers);

    $grp->save();

    return redirect('sms');

  }


  /**
  * create sms group
  * @param  Request $request [description]
  * @return [type]           [description]
  */
  public function editGroup(Request $request) {
    // dd($request->all());

    $grp     = SMSGroup::find($request->group_id);
    $grp->groupName = $request->groupName;
    $grp->groupPhoneNumbers = json_encode($request->groupPhoneNumbers);

    $grp->save();

    return redirect('sms');

  }


  public function getGroupPhoneNumbers($id) {
    // dd($id);

    $smsGrp = SMSGroup::find($id);

    if ($smsGrp) {
      return response()->json(['groupName' => $smsGrp->groupName, 'smsGroupPhoneNumbers' => json_decode($smsGrp->groupPhoneNumbers)]);
    } else {
      return 'Error';
    }
    
  }


  public function showSingle(Member $Member) {
    $data['Member'] = Member::find($Member->id);

    return view('sms.send-single', $data);
  }


  public function sendSingle(Request $request) {
    // dd($request->all());
    $sms = new SMS;
    $sent = $sms->send($request->phone, $request->message);

    return redirect()->back();
  }

  public function myMembers() {
    $members = Member::select('phone')->where('church_id', \Auth::user()->member->church_id)->get();
    $phone = [];
    $end = end($members);

    foreach ($members as $member) {
        $phone[] = $member->phone . ',';
    }

    return $phone;
  }
}

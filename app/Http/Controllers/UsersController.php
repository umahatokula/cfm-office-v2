<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Member;
use App\Models\Role;
use App\Models\User;
use DB;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
    	$this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return $this->create();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$data['title'] = 'Manage Users';
    	$data['manage_users'] = 1;
    	$data['members'] = Member::pluck('full_name', 'id');
    	$data['roles'] = Role::pluck('name', 'id');
    	$data['users'] = User::where('email', '!=', 'dev@ovalsofttechnologies.com')->get();
    	$data['permissions'] = [];
    	return view('users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

    	$rules = [
    	'assign_roles' => 'required',
    	];

    	$messages = [
    	'assign_roles.required' => 'Select at least one role',
    	];

    	$validator = \Validator::make($request->all(), $rules, $messages);

    	if($validator->fails()){

    		if ($request->ajax()) {
    			return response()->json(['success' => FALSE, 'message' => $validator->errors()->first('assign_roles') ]);
    		}

    		session()->put('flash_message', 'Something went wrong. User was not added.');
    		return \Redirect::back()->withInput()->withErrors($validator);

    	}

        //get the members details
    	$member = Member::find($request->member_id);

        //create new user
    	try{
    		$user = new User;
    		$user->email 		= $member->email;
    		$user->password     = \Hash::make($request->password);
    		$user->name   		= $member->fname.' '.$member->lname;
    		$user->member_id   	= $member->id;
    		$user->save();
    	} catch (\Illuminate\Database\QueryException $e){
    		$errorCode = $e->errorInfo[1];
    		if($errorCode == 1062){

    			if ($request->ajax()) {
    				return response()->json(['success' => FALSE, 'message' => 'A user with this email already exist.' ]);
    			}

    			session()->flash('errorMessage', 'A user with this email already exist.');
    			return redirect()->route('users.create')->withInput($request->except('fee_element_id', 'amount'));
    		}
    	}


        //assign new user to role(s)
    	foreach ($request->assign_roles as $role_id) {

    		$role = Role::find($role_id);

            //assign user this role
    		$user->attachRole($role);
    	}

    	if($request->ajax()){
    		return response()->json(['success' => true, 'message' => 'User added']);
    	}

    	session()->flash('successMessage', 'User was successfully added.');
    	return redirect('users/create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['title'] = 'User details';
        $data['manage_users'] = 1;
        $data['user'] = User::find($id);

        return view('users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$data['title'] = 'Edit Users';
    	$data['manage_users'] = 1;
    	$data['user'] = User::find($id);
    	$data['members'] = Member::pluck('full_name', 'id');
    	$data['roles'] = Role::pluck('name', 'id');

        //get the id(s) of the roles of this user in an array
    	$roles = array();
    	foreach ($data['user']->roles as $value) {
    		$roles[] = $value->id;
    	}
    	$data['user_roles'] = $roles;

    	$data['permissions'] = [];
    	return view('users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

    	$rules = [
    	'assign_roles' => 'required',
    	];

    	$messages = [
    	'assign_roles.required' => 'Select at least one role',
    	];

    	$validator = \Validator::make($request->all(), $rules, $messages);

    	if($validator->fails()){

    		if ($request->ajax()) {
    			return response()->json(['success' => FALSE, 'message' => $validator->errors()->first('assign_roles') ]);
    		}

    		session()->put('flash_message', 'Something went wrong. User was not added.');
    		return \Redirect::back()->withInput()->withErrors($validator);

    	}

        //get the members details
    	$member = Member::find($request->member_id);

        //get user
    	$user = User::find($id);
    	$user->password     = \Hash::make($request->password);
    	$user->save();

    	//delete existing roles for this user
    	DB::table('role_user')->where('user_id', $user->id)->delete();


        //assign new user to role(s)
    	foreach ($request->assign_roles as $role_id) {

    		$role = Role::find($role_id);

            //assign user this role
    		$user->attachRole($role);
    	}

    	if($request->ajax()){
    		return response()->json(['success' => true, 'message' => 'User added']);
    	}

    	session()->flash('successMessage', 'User was successfully updated.');
    	return redirect('users/create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	dd($id);
    	$user = User::destroy($id);
    	return redirect('users');
    }


        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function delete($id)
        {
        	$user = User::destroy($id);

        	session()->flash('successMessage', 'User was deleted.');
        	return redirect('users');
        }


            /**
     * Activate Resource
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
            public function activate($id)
            {
            	$user = User::find($id);
            	$user->status_id = 1;
            	$user->save();

            	return redirect('users');
            }


            /**
     * Deactivate Resource
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
            public function deactivate($id)
            {
            	$user = User::find($id);
            	$user->status_id = 2;
            	$user->save();

            	return redirect('users');
            }


        /**
         * show form to change password
         * @param  Request $request [description]
         * @return [type]           [description]
         */
        public function changePassword() {
        	return view('settings.users.changePassword');
        }


        /**
         * store changed password
         * @param  Request $request [description]
         * @return [type]           [description]
         */
        public function storeChangedPassword(Request $request) {
            // dd($request->all());
            //password update.
        	$now_password       = $request->now_password;
        	$password           = $request->password;
        	$passwordconf       = $request->password_confirmation;
        	$id                 = $request->id;

        	$rules = array(
        		'now_password'          => 'required',
        		'password'              => 'required|min:5|confirmed|different:now_password',
        		'password_confirmation' => 'required_with:password|min:5'
        		);

        	$messages = array(
        		'now_password.required' => 'Your current password is required',
        		'password.required' => 'Your new password is required',
        		'password.confirmed' => 'New password and confirmationn must match',
        		'password.different' => 'You new password must be different from current password',
        		'password.min' => 'New passwordmust be at least 5 characters' );


        	$validator = \Validator::make($request->only('now_password', 'password', 'password_confirmation'), $rules, $messages);                  

        	if ($validator->fails()) {    

        		return redirect()->back()->withErrors($validator);

        	} elseif (\Hash::check($now_password, \Auth::user()->password)) {

        		$user = User::find($id);
        		$user->password = \Hash::make($password);
        		$user->save();
        		return redirect()->back()->with('success', true)->with('successMessage','Password changed successfully.');

        	} else  {

        		return redirect()->back()->with('errorMessage','Old password is incorrect');

        	}

        	return view('settings.users.changePassword');
        }
    }

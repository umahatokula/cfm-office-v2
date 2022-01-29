<?php

namespace App\Http\Controllers;

use DB;

use App\Models\Role;
use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\Users\Store;
use App\Http\Requests\Users\Update;

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
    public function create() {
    	$data['members'] = Member::orderBy('lname')->get();
    	$data['roles'] = Role::pluck('name', 'id');
    	$data['users'] = User::where('email', '!=', 'dev@ovalsofttechnologies.com')->get();
    	$data['permissions'] = [];

		return view('pages.users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request) {
        // dd($request->all());

        //get the members details
    	$member = Member::find($request->member_id);

        //create new user
		$user = new User;
		$user->email 		= $member->email;
		$user->phone 		= $request->phone;
		$user->password     = \Hash::make($request->password);
		$user->name   		= $member->fname.' '.$member->lname;
		$user->member_id   	= $member->id;
		$user->save();

		// assign roles
		$user->syncRoles($request->assign_roles);

    	session()->flash('successMessage', 'User was successfully added.');

    	return redirect('users/create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $data['title'] = 'User details';
        $data['manage_users'] = 1;
        $data['user'] = User::find($id);

        return view('pages.users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
		
    	$data['user'] = User::find($id);
    	$data['members'] = Member::all();
    	$data['roles'] = Role::pluck('name', 'id');

        //get the id(s) of the roles of this user in an array
    	$roles = array();
    	foreach ($data['user']->roles as $value) {
    		$roles[] = $value->id;
    	}
    	$data['user_roles'] = $roles;

    	$data['permissions'] = [];
		
    	return view('pages.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, $id) {
        // dd($request->all());

        //get the members details
    	$member = Member::find($request->member_id);

        //get user
    	$user = User::find($id);
		$user->phone 		= $request->phone;
    	$user->password     = \Hash::make($request->password);
    	$user->save();

		// assign updated roles
		$user->syncRoles($request->assign_roles);

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
	public function activate($id) {
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
	public function deactivate($id) {
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

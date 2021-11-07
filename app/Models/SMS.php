<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;

// define(CFC_ABUJA_SESSION_ID, '4195840d-a848-4e80-8f14-d13d5f2ca848');

class SMS extends Model
{

        private $CFC_ABUJA_SESSION_ID = '4195840d-a848-4e80-8f14-d13d5f2ca848';
        private $CFC_GBOKO_SESSION_ID = '65e43c77-6905-4804-88c9-72ff50b9207b';
        private $CFC_MAKURDI_SESSION_ID = 'bdab2680-60be-4536-bf4e-5427bdc66a25';
        private $CFC_KADUNA_SESSION_ID = '83834324-afc5-4ae6-8f5a-dea994c7c93a';
        private $CFC_SAGAMU_SESSION_ID = '5cd28cb7-09f2-4ac2-abbc-42c8feaccaa2';
        private $CFC_WARRI_SESSION_ID = 'b200d122-d4d4-43a2-b2e5-64169045c5d2';

    	/**
    	* check SMS credit balance
    	* @param  Request $request [description]
    	* @return [type]           [description]
    	*/
        public function get_balance() {

            $sender = 'rUPDATE';
          $sessionID = '';

            try {
                $client = new Client();

                //=======SMSLIVE247======//
                if (\Auth::user()->member->church->email == 'cfc_abuja@christfamilyministries.org') {

                    $sessionID = urlencode($this->CFC_ABUJA_SESSION_ID);

                } elseif (\Auth::user()->member->church->email == 'cfc_gboko@christfamilyministries.org') {

                    $sessionID = urlencode($this->CFC_GBOKO_SESSION_ID);

                } elseif (\Auth::user()->member->church->email == 'cfc_makurdi@christfamilyministries.org') {

                    $sessionID = urlencode($this->CFC_MAKURDI_SESSION_ID);

                } elseif (\Auth::user()->member->church->email == 'cfc_kaduna@christfamilyministries.org') {

                    $sessionID = urlencode($this->CFC_KADUNA_SESSION_ID);

                } elseif (\Auth::user()->member->church->email == 'cfc_sagamu@christfamilyministries.org') {

                    $sessionID = urlencode($this->CFC_SAGAMU_SESSION_ID);

                } elseif (\Auth::user()->member->church->email == 'cfc_warri@christfamilyministries.org') {

                    $sessionID = urlencode($this->CFC_WARRI_SESSION_ID);
                }
                

                $balance = $client->get("http://www.smslive247.com/http/index.aspx?cmd=querybalance&sessionid=".$sessionID);

                        $balance = (string) $balance->getBody();

                if (substr($balance, 0, 2) == "OK") //SMSLIVE247
                {

                    return substr($balance, 3);

                }
                else
                {
                    session()->put('errormessage', 'SMS was sent NOT sent!');
                        return redirect()->back();

                    }


                } catch (RequestException $e) {
                // dd($e);
                    if ($e->hasResponse()) {
                        session()->put('flash_message', 'Network error. SMS was not sent!');
                            return redirect()->back()->withInput();
                        }
                    }
                }

        /**
         * Send sms
         * @param  [type] $phoneNumbers [description]
         * @param  [type] $message      [description]
         * @return [type]               [description]
         */
        public function send($phoneNumbers, $message) {

          $sender = 'rUPDATE';
          $sessionID = '';

          try {
             $client = new Client();

    			//=======SMSLIVE247======//
                if (\Auth::user()->member->church->email == 'cfc_abuja@christfamilyministries.org') {

                    $sessionID = urlencode($this->CFC_ABUJA_SESSION_ID);

                } elseif (\Auth::user()->member->church->email == 'cfc_gboko@christfamilyministries.org') {

                    $sessionID = urlencode($this->CFC_GBOKO_SESSION_ID);

                } elseif (\Auth::user()->member->church->email == 'cfc_makurdi@christfamilyministries.org') {

                    $sessionID = urlencode($this->CFC_MAKURDI_SESSION_ID);

                } elseif (\Auth::user()->member->church->email == 'cfc_kaduna@christfamilyministries.org') {

                    $sessionID = urlencode($this->CFC_KADUNA_SESSION_ID);

                } elseif (\Auth::user()->member->church->email == 'cfc_sagamu@christfamilyministries.org') {

                    $sessionID = urlencode($this->CFC_SAGAMU_SESSION_ID);

                } elseif (\Auth::user()->member->church->email == 'cfc_warri@christfamilyministries.org') {

                    $sessionID = urlencode($this->CFC_WARRI_SESSION_ID);
                }

                
            $answer    = $client->get("http://www.smslive247.com/http/index.aspx?cmd=sendmsg&sessionid=".$sessionID ."&message=".$message."&sender=".$sender."&sendto=".$phoneNumbers."&msgtype=0");

    			//=======SMS FACTORY=====//
    			// $answer = $client->get("http://www.sendsmsnigeria.com/api/?email=umahatokula@gmail.com&password=addiction&sender=".$sender."&message=".$message."&numbers=".$phoneNumbers);

                 $answer = (string) $answer->getBody();

    			if (substr($answer, 0, 2) == "OK") //SMSLIVE247
    			// if ($answer > 0) //SMS Factory
    			{

    				session()->put('successMessage', 'SMS was sent!');
    				// return redirect('sms');

    			}
    			else
    			{
    				$errorMsg = '';

    				// get error code

    				// SMSLIVE247
    				$answer = substr($answer, 5, 3);
    				// dd($answer);

                        if($answer == 100) {
                           $errorMsg = 'General Error';
                       } elseif($answer == 401) {
                           $errorMsg = 'Invalid Session ID';
                       } elseif($answer == 402) {
                           $errorMsg = 'Invalid Sub-Account or Password';
                       } elseif($answer == 403) {
                           $errorMsg = 'Invalid Recharge Voucher code';
                       } elseif($answer == 404) {
                           $errorMsg = 'Insufficient Credit';
                       } elseif($answer == 405) {
                           $errorMsg = 'Recharge Voucher is disabled';
                       } elseif($answer == 406) {
                           $errorMsg = 'Recharge Voucher is already used';
                       } elseif($answer == 407) {
                           $errorMsg = 'Forbidden/Access Denied';
                       } elseif($answer == 408) {
                           $errorMsg = 'Data supplied is not in expected format.';
                       } elseif($answer == 409) {
                           $errorMsg = 'Gateway Error';
                       } elseif($answer == 410) {
                           $errorMsg = 'Account is disabled';
                       }

    				// SMS FACTORY
    				// if($answer == -1) {
    				// 	$errorMsg = 'Missing telephone number(s)';
    				// } elseif($answer == -2) {
    				// 	$errorMsg = 'Missing message';
    				// } elseif($answer == -3) {
    				// 	$errorMsg = 'Missing email address';
    				// } elseif($answer == -4) {
    				// 	$errorMsg = 'Missing password';
    				// } elseif($answer == -5) {
    				// 	$errorMsg = 'Wrong email or password';
    				// } elseif($answer == -6) {
    				// 	$errorMsg = 'Not enough credit';
    				// } elseif($answer == -7) {
    				// 	$errorMsg = 'Error message not sent';
    				// }

                       session()->put('errorMessage', 'SMS was sent NOT sent! - '.$answer);

                   }


               } catch (RequestException $e) {
    			// dd($e);
                 if ($e->hasResponse()) {
                    session()->put('errorMessage', 'Network error. SMS was not sent!');
                }
            }
        }

    }

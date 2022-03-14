<?php

namespace App\Helpers;

use Twilio\Rest\Client as TwilioClient;
use Illuminate\Support\Facades\Http;

class Sms {

  /**
   * Send an SMS using Twilio
   *
   * @param  mixed $to
   * @param  mixed $message
   * @return void
   */
  public static function sendSMSMessage($to, $message) {

      // $response = Http::post('http://www.sendsmsnigeria.com/api/', [
      //   'email' => 'umahatokula@gmail.com',
      //   'password' => 'addiction',
      //   'sender' => config('app.name'),
      //   'numbers' => $to,
      //   'message' => $message,
      // ]);

      // $response = Http::post('https://www.bulksmsnigeria.com/api/v1/sms/create', [
      //   'api_token' => config('services.send_bulk_sms_nigeria.api_token'),
      //   'from' => config('app.name'),
      //   'to' => $to,
      //   'body' => $message,
      //   'dnd' => 2,
      // ]);

      $response = Http::get('http://www.smslive247.com/http/index.aspx', [
        'cmd' => 'sendmsg',
        'sessionid' => urlencode('0a5606fc-a473-4fe4-86a0-cb108551c525'),
        // 'sessionid' => urlencode('7909799f-437b-4adc-831e-fb1fda06b295'),
        'sender' => 'CFC ABUJA',
        'sendto' => $to,
        'message' => $message,
        'msgtype' => 0,
      ]);

      if (strpos($response->body(), "ERR") !== false) {
        return [
          'status' => false,
          'message' => $response->body()
        ];
      }

      if ($response->ok()) {
        return [
          'status' => true,
          'message' => $response->body()
        ];
      }

      // try {
      //
      //     $account_sid = getenv("TWILIO_SID");
      //     $auth_token = getenv("TWILIO_TOKEN");
      //     $twilio_number = getenv("TWILIO_FROM");
      //
      //     $twilioClient = new TwilioClient($account_sid, $auth_token);
      //     $twilioClient->messages->create($to, [
      //         'from' => $twilio_number,
      //         'body' => $message]);
      //
      // } catch (Exception $e) {
      //     \Log::info("Error: ". $e->getMessage());
      // }
      //
      // return 1;
}

  /**
   * Send a WhatsApp message using Twilio
   *
   * @param  mixed $to
   * @param  mixed $message
   * @return void
   */
  public static function sendWhatsAppMessage($to, $message) {

      return 1; // remove this line eventually

      // try {
      //
      //     $account_sid = getenv("TWILIO_SID");
      //     $auth_token = getenv("TWILIO_TOKEN");
      //     $from = getenv("TWILIO_WHATSAPP_FROM");
      //
      //     $twilio = new TwilioClient($account_sid, $auth_token);
      //
      //     $message = $twilio->messages
      //         ->create("whatsapp:".$to, // to
      //                 [
      //                     "from" => "whatsapp:".$from,
      //                     "body" => $message
      //                 ]
      //         );
      //
      // } catch (Exception $e) {
      //     \Log::info("Error: ". $e->getMessage());
      // }
      //
      // return 1;
  }
}

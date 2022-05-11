<?php

namespace App\Http\Controllers;

use App\Models\Whatsapp;
use App\Models\Client;
use App\Models\Group;
use Illuminate\Http\Request;
use Twilio\Rest\Client as TwilioClient;


class WhatsappController extends Controller
{
    public function groupMessage()
    {
        return view('whatsapp.index', ['groups' => Group::where('status', 1)->get()]);
    }

    public function create()
    {
        //
    }

    public function sendMessage(Request $request)
    {
        $media = '';
        if ($request->has('file')) {
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('images'), $imageName);
            $media = env('APP_URL') . '/images/' . $imageName;
        }

        if ($request->whatsappNo != '') {
            $this->messageContent($request->message, $request->whatsappNo, $media);
            return back()->with('message', 'Successfully sent to' . $request->whatsappNo);
        } else if ($request->client_id != '') {
            $clients = Client::where('id', $request->client_id)->get();
            $message = 'Successfully sent!!';
        } else {
            $clients = Client::where('group_id', $request->group_id)->get();
            $message = 'Successfully sent!! The total sent message count is ' . count($clients) . '.';
        }
        foreach ($clients as $value) {
            $this->messageContent($request->message, $value->mobile_phone, $media);
        }
        return back()->with('message', $message);
    }

    public function singleMessage()
    {
        return view('whatsapp.single', ['groups' => Group::where('status', 1)->get()]);
    }

    public function messageContent($message, $number, $media)
    {
        $twilio = new TwilioClient(env("TWILIO_AUTH_SID"), env("TWILIO_AUTH_TOKEN"));
        if ($media != '') {
            $twilio->messages->create(
                "whatsapp:$number", // to 
                [
                    "from" => env("TWILIO_WHATSAPP_FROM"),
                    "body" => $message,
                    "mediaUrl" => [$media]
                ]
            );
        } else {
            $twilio->messages->create(
                "whatsapp:$number", // to 
                [
                    "from" => env("TWILIO_WHATSAPP_FROM"),
                    "body" => $message,
                ]
            );
        }
    }

    public function update(Request $request, Whatsapp $whatsapp)
    {
        //
    }

    public function destroy(Whatsapp $whatsapp)
    {
        //
    }
}

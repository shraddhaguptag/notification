<?php

namespace App\Http\Controllers;

#vendor packages
use Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use App\Notifications\EmailNotification;

#models
use App\Models\User;
use App\Models\NotificationTemplate;

use App\Http\Resources\NotificationResource;

class NotificationTemplateController extends Controller
{
    #variables
    protected $notificationTemplate;

    /**
     * @method constructor for Create a new  instance.
     * @return
     * @param 
     */
    public function __construct()
    {
    }

    public function index()
    {
        return NotificationResource::collection(NotificationTemplate::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //check and validate fields as per requirements
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:100',
                'subject' => 'required|max:255',
                'body' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(["status" => "error", "message" => implode(', ', $validator->errors()->all())], 400);
        }

        //condition if user is click on save button then saves data otherwise only send notifiction
        if ($request->type == 'submit') {
            $template = NotificationTemplate::create([
                'title' => $request->title,
                'subject' => $request->subject,
                'body'    => $request->body
            ]);
        }
        //fetch all user for sending notification mail
        $users = User::all()->toArray();

        Str::macro("swapKeyword", function ($map, $string) {
            return str_replace(array_keys($map), array_values($map), $string);
        });

        //send notification to each user
        foreach ($users as $user) {
            $swapBody = Str::swapKeyword([
                '#name' => $user['name'],
                '#email' => $user['email'],
                '#phone' => $user['phone']
            ], $request->body);

            $swapSubject = Str::swapKeyword([
                '#name' => $user['name'],
                '#email' => $user['email'],
                '#phone' => $user['phone']
            ], $request->subject);

            $notification = [
                'body' => $swapBody,
                'subject' => $swapSubject
            ];
            Notification::route('mail', $user['email'])->notify(new EmailNotification($notification));
        }
        return response()->json(["status" => "success", "message" => "Notification send successfully.!"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $NotificationTemplate = NotificationTemplate::find($id);
        return response()->json($NotificationTemplate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $template = NotificationTemplate::find($id);
        //check and validate fields as per requirements
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:100',
                'subject' => 'required|max:255',
                'body' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(["status" => "error", "message" => implode(', ', $validator->errors()->all())], 400);
        }

        $template->update($request->all());
        //fetch all user for sending notification mail
        $users = User::all()->toArray();

        Str::macro("swapKeyword", function ($map, $string) {
            return str_replace(array_keys($map), array_values($map), $string);
        });

        //send notification to each user
        foreach ($users as $user) {
            $swapBody = Str::swapKeyword([
                '#name' => $user['name'],
                '#email' => $user['email'],
                '#phone' => $user['phone']
            ], $request->body);

            $swapSubject = Str::swapKeyword([
                '#name' => $user['name'],
                '#email' => $user['email'],
                '#phone' => $user['phone']
            ], $request->subject);

            $notification = [
                'body' => $swapBody,
                'subject' => $swapSubject
            ];
            Notification::route('mail', $user['email'])->notify(new EmailNotification($notification));
        }
        return response()->json(["status" => "success", "message" => "Notification update successfully.!"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $NotificationTemplate = NotificationTemplate::find($id);
        $NotificationTemplate->delete();
        return response()->json('NotificationTemplate deleted!');
    }

}

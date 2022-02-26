<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Contact_customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendEmailContactCustomerQueue;
use App\Traits\deleteTraits;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use deleteTraits;
    private $contact;
    private $contact_customer;
    public function __construct(Contact $contact, Contact_customer $contact_customer)
    {
        $this->contact = $contact;
        $this->contact_customer = $contact_customer;
    }
    public function index(Request $request)
    {
        $contact_customers = $this->contact_customer->latest()->paginate(5);
        if ($request->ajax()) {
            $contact_customers_paginate_html = view('admin.Contact.components.data', compact('contact_customers'))->render();
            return Response()->json([
                'status' => 200,
                'contact_customers_paginate_html' => $contact_customers_paginate_html,
                'lastPage' => $contact_customers->lastPage(),
            ]);
        }
        return view('admin.Contact.index', compact('contact_customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $contact = $this->contact->first();
        return view('admin.Contact.components.information', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $this->contact->updateOrCreate(['id' => 1], [
                'info_shop' => $request->info_shop,
                'phone' => $request->phone,
                'fb_link' => $request->facebook_link,
                'fb_fanpage' => $request->fb_fanpage,
                'twitter_link' => $request->twitter_link,
                'email_link' => $request->email,
                'youtube_link' => $request->youtube_link,
                'ifream_ggmap' => $request->iframe_ggmap,
            ]);
            session()->put('success_setting_information', 'Success setting information');
            return redirect()->route('contact.index');
        } catch (\Exception $e) {
            $error = Log::error('Message: ' . $e->getMessage() . ' Line: ' . $e->getLine());
            return Response()->json([
                'status' => 500,
                'message' => $error,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->DeleteTraits($this->contact_customer, $id);
    }

    public function fetch(Request $request, $id)
    {
        $contact_customer = $this->contact_customer->find($id);
        return Response()->json([
            'status' => 200,
            'contact_customer' => $contact_customer
        ]);
    }
    public function reply_contact(Request $request, $id)
    {
        $contact_customer = $this->contact_customer->find($id);
        $from_name = "P-Shopping";
        //$from_email = Auth::user()->email; //gửi từ email
        $from_email = "nobita9cs6vk@gmail.com"; //gửi từ email
        $to_email = $contact_customer->email_customer; //gủi đến email người dùng

        $content_email = [
            'name' => 'Cảm ơn bạn đã liên hê shop',
            'body' => $request->reply_contact,
        ];
        $contact_customer->update([
            'status' => 1,
        ]);
        SendEmailContactCustomerQueue::dispatch($from_name, $from_email, $to_email, $content_email); //giui email bằng queue
        return Response()->json([
            'status' => 200,
            'contact_customer' => $contact_customer,
        ]);
    }
}

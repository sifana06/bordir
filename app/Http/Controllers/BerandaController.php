<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class BerandaController extends Controller
{
    public function index()
    {
        $checkadmin = User::where('role', 'admin')->first();
        // Check phone
        $admin_phone = $checkadmin->phone;
        if ($admin_phone[0] == '+')
            $admin_phone = str_replace('+', '', $admin_phone);
        if ($admin_phone[0] == 0)
            $admin_phone = '62' . substr($admin_phone, 1);
        if ($admin_phone[0] == 8)
            $admin_phone = '62' . $admin_phone;

        $suffix = 'Halo kak '.$checkadmin->name.', saya ingin bergabung dengan ResBor. Tolong di bantu yah..';
        $url = "https://api.whatsapp.com/send?phone=".$admin_phone."&text=" . urlencode($suffix);
        $data['url'] = str_replace("+", "%20", $url);
        return view('layouts.landing_page.app',$data);
    }
}

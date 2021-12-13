<?php

namespace App\Http\Controllers;

use App\Models\Oder;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\File;

class dashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $user;
    private $product;
    private $oder;
    public function __construct(User $user, Product $product, Oder $oder)
    {
        $this->middleware('auth');
        $this->user = $user;
        $this->product = $product;
        $this->oder = $oder;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count_User = $this->user->all()->count();
        $count_Product = $this->product->where('active', 0)->get()->count();
        $count_Oder = $this->oder->where('active', 'Đang chờ xử lý')->get()->count();
        return view('admin.dashboard', compact('count_User', 'count_Product', 'count_Oder'));
    }
    public function SettingsProfile()
    {
        return view('admin.ProfileSetting.index');
    }
    public function updateProfile(Request $request, $id)
    {
        //dd($request->first_name);
        $profileUser = [
            'name' => $request->first_name,
            'lastname' => $request->last_name,
            'phone' => $request->phone,
            'location' => $request->location,
            'dateBirth' => $request->dateBirth,
        ];
        User::find($id)->update($profileUser);
        return redirect()->route('home.SettingsProfile');
    }
    public function updateAvatar(Request $request, $id)
    {
        $path = 'uploads/AvatarUser/' . Auth::user()->id . '/' . Auth::user()->path_image_avatar;
        if (File::exists($path)) {
            File::delete($path);
        }
        if ($request->hasFile('avatarUser')) {
            $file = $request->file('avatarUser');
            $extension = $file->getClientOriginalExtension();
            $path_image = time() . '.' . $extension;
            $file->move('uploads/AvatarUser/' . Auth::user()->id, $path_image);
            User::find($id)->update([
                'path_image_avatar' => $path_image,
            ]);
        };
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

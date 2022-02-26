<?php

namespace App\Http\Controllers;

use App\Models\Oder;
use App\Models\Post;
use App\Models\Video;
use App\Models\Product;
use App\Models\Statistics;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;
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
    private $post;
    private $video;
    private $visitor;
    private $statistics;
    public function __construct(User $user, Product $product, Oder $oder, Post $post, Video $video, Visitor $visitor, Statistics $statistics)
    {
        $this->middleware('auth');
        $this->user = $user;
        $this->product = $product;
        $this->oder = $oder;
        $this->post = $post;
        $this->video = $video;
        $this->visitor = $visitor;
        $this->statistics = $statistics;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count_User = $this->user->all()->count();
        $count_Product = $this->product->get()->count();
        $count_Post = $this->post->get()->count();
        $count_Post = $this->post->get()->count();
        $count_Video = $this->video->get()->count();
        $count_Oder = $this->oder->where('active', 'Đang chờ xử lý')->get()->count();

        $products = $this->product->latest('view_count')->take(15)->get();
        $posts = $this->post->latest('view_count')->take(15)->get();

        $date_now = Carbon::now('Asia/Ho_Chi_Minh');

        // $start_month_now = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth();
        // $start_month_before = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth();
        // $end_month_before = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth();
        $date_year = Carbon::now('Asia/Ho_Chi_Minh')->subYear();

        // dd($chart_data1);
        // $visitor_month_now = $this->visitor->whereBetween('created_at', [$start_month_now, $date_now])->count();
        // $visitor_month_before = $this->visitor->whereBetween('created_at', [$start_month_before, $end_month_before])->count();
        $visitor_year = $this->visitor->whereBetween('created_at', [$date_year, $date_now])->count();

        return view('admin.dashboard', compact('count_User', 'count_Product', 'count_Oder', 'count_Post', 'count_Video', 'products', 'posts', 'visitor_year'));
    }

    public function chart_data_truycap(Request $request)
    {
        $visitor_ofMonths = $this->visitor->select('id', 'date_just_visiter', 'created_at')->get()->groupBy(function ($data) {
            return Carbon::parse($data->created_at)->format('m-Y');
        });
        foreach ($visitor_ofMonths as $key => $visitor_ofMonth) {
            $chart_data[] = [
                'year' => 'Tháng ' . $key,
                'value' => count($visitor_ofMonth),
                'returning_visitors' =>  $visitor_ofMonth->filter(function ($value, $key) {
                    return Carbon::now('Asia/Ho_Chi_Minh')->diffInDays($value->date_just_visiter) <= 30;
                })->count(),
            ];
        };
        return Response()->json([
            'chart_data' => $chart_data
        ]);
    }
    public function chart_data_area_doanhthu_daily(Request $request)
    {
        $statistics = $this->statistics->latest()->take(7)->get();
        // dd($statistics);
        foreach ($statistics as $statistic) {
            $chart_data[] = [
                'date' => $statistic->date_day_statistic,
                'oder_quantity' => $statistic->oder_quantity,
                'sales' => $statistic->sales,
                'profit' => $statistic->profit,
            ];
        }
        return Response()->json([
            'status' => 200,
            'chart_data' => $chart_data,
        ]);
    }
    public function chart_data_area_doanhthu_month(Request $request)
    {
        $statistics = $this->statistics->oldest()->get()->groupBy(function ($data) {
            return Carbon::parse($data->date_day_statistic)->format('m-Y');
        });
        foreach ($statistics as $key => $statistic) {
            $chart_data[] = [
                'date' => 'Tháng ' . $key,
                'oder_quantity' => $statistic->sum('oder_quantity'),
                'sales' => $statistic->sum('sales'),
                'profit' => $statistic->sum('profit'),
            ];
        }
        return Response()->json([
            'status' => 200,
            'chart_data' => $chart_data,
        ]);
    }
    public function chart_data_area_doanhthu_yearly()
    {
        $statistics = $this->statistics->oldest()->get()->groupBy(function ($data) {
            return Carbon::parse($data->date_day_statistic)->format('Y');
        });
        foreach ($statistics as $key => $statistic) {
            $chart_data[] = [
                'date' => 'Năm ' . $key,
                'oder_quantity' => $statistic->sum('oder_quantity'),
                'sales' => $statistic->sum('sales'),
                'profit' => $statistic->sum('profit'),
            ];
        }
        return Response()->json([
            'status' => 200,
            'chart_data' => $chart_data,
        ]);
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Image;
use App\Http\Middleware\ImageFilter;
use App\Http\Requests\ExampleRequest;
use App\Example;
use App\Property;
use App\Contract;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:painter')->except(['show', 'publish', 'list']);
    }

    /**
     * Get the guard.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('painter');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Example::where('painter_id', $this->guard()->id())->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(config('const.template.example.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $param = [
            'painter_id' => $this->guard()->id(),
            'contract_id' => $request->contract_id
        ];

        Example::firstOrNew($param)->save();

        return Example::where($param)->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Example::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view(config('const.template.example.edit'), ['example' => Example::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Request\ExampleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExampleRequest $request, $id)
    {
        $example = Example::find($id);

        // ??????????????????????????????
        $dir = config('const.directory.example');

        // ????????????????????????????????????????????????
        $dname = storage_path('app/public/' . $dir);

        if (!file_exists($dname)) {
            mkdir($dname, 0777, true);
        }

        for ($i = 1; $i <= 6; $i++) {
            $filename = '';
            $del_flg = false;
            $field = 'image_file' . $i;

            // ??????????????????????????????
            if ($request->hasFile($field)) {
                // ???????????????????????????
                $filename = md5(uniqid(rand(), true)) . '.jpg';
                $file = $request->file($field);

                Image::make($file)->filter(new ImageFilter())->save($dname . $filename);

                // ???????????????????????????????????????????????????????????????????????????????????????????????????????????????
                $del_flg = filled($example->value($field));

                $filename = $dir . $filename;
            } else if (filled($example->value($field))) {
                // ?????????????????????????????????????????????????????????????????????????????????????????????????????????
                $del_flg = $request->boolean('del_flg' . $i);
            }

            if ($del_flg) {
                // ?????????????????????????????????
                unlink(storage_path('app/public/' . $example->value($field)));
            } else {
                // ????????????????????????
                if (filled($example->value($field))) {
                    $filename = $example->value($field);
                }
            }

            $example->fill([$field => $filename]);
        }

        $example->comment = $request->comment;

        // ???????????????????????????????????????????????????????????????
        if ($request->filled('public_consent')) {
            $example->public_consent = $request->public_consent;
        }

        $example->save();

        // return Example::where('painter_id', $this->guard()->id())->get();
        return redirect()->route('painter.mypage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Example::destroy($id);

        // return Example::where('painter_id', $this->guard()->id())->get();
        return redirect()->route('painter.mypage');
    }

    /**
     * ??????????????????????????????????????????
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function example(Request $request)
    {
        // ?????????????????????
        $request->validate([
            'name'           => 'nullable|string|max:48',
            'address'        => 'nullable|string|max:256',
            'area'           => 'nullable|numeric|max:9999',
            'area_b'         => 'nullable|numeric|max:9999',
            'floors'         => 'nullable|numeric|max:99',
            'age'            => 'nullable|numeric|max:99',
            'type'           => 'nullable|numeric',
            'type_wall'      => 'nullable|numeric',
            'type_roof'      => 'nullable|numeric',
            'category'       => 'nullable|numeric',
            'plan'           => 'nullable|string|max:256',
            'period'         => 'nullable|numeric|max:999',
            'paint'          => 'nullable|string|max:256',
            'memo'           => 'nullable|string',
            'complete_date'  => 'nullable|date',
            'amount'         => 'nullable|numeric|max:99999999', // ?????????
            'image_file1'    => "nullable|file|image|max:{$max_size}|mimes:jpg,jpeg,gif,png",
            'image_file2'    => "nullable|file|image|max:{$max_size}|mimes:jpg,jpeg,gif,png",
            'image_file3'    => "nullable|file|image|max:{$max_size}|mimes:jpg,jpeg,gif,png",
            'image_file4'    => "nullable|file|image|max:{$max_size}|mimes:jpg,jpeg,gif,png",
            'image_file5'    => "nullable|file|image|max:{$max_size}|mimes:jpg,jpeg,gif,png",
            'image_file6'    => "nullable|file|image|max:{$max_size}|mimes:jpg,jpeg,gif,png",
            'comment'        => 'nullable|string',
            'public_consent' => 'nullable|boolean',
        ]);

        // ????????????????????????
        $property_id = Property::insertGetId([
            'user_id' => 0, 
            'name' => $request->name, 
            'address' => $request->address,
            'area' => $request->area,
            'area_b' => $request->area_b,
            'floors' => $request->floors,
            'age' => $request->age,
            'type' => $request->type,
            'type_wall' => $request->type_wall,
            'type_roof' => $request->type_roof
        ]);

        // ????????????????????????
        $contract_id = Contract::insertGetId([
            'user_id' => 0, 
            'property_id' => $property_id, 
            'request_id' => 0, 
            'painter_id' => $this->guard()->id(), 
            'category' => $request->category, 
            'plan' => $request->plan, 
            'period' => $request->period, 
            'paint' => $request->paint, 
            'memo' => $request->memo, 
            'complete_date' => $request->complete_date, 
            'amount' => $request->amount
        ]);

        // ??????????????????????????????
        $example = new Example();

        $example->painter_id = $this->guard()->id();
        $example->contract_id = $contract_id;

        // ??????????????????????????????
        $dir = config('const.directory.example');

        // ????????????????????????????????????????????????
        $dname = storage_path('app/public/' . $dir);

        if (!file_exists($dname)) {
            mkdir($dname, 0777, true);
        }

        for ($i = 1; $i <= 6; $i++) {
            $filename = '';
            $field = 'image_file' . $i;

            // ??????????????????????????????
            if ($request->hasFile($field)) {
                // ???????????????????????????
                $filename = md5(uniqid(rand(), true)) . '.jpg';
                $file = $request->file($field);

                Image::make($file)->filter(new ImageFilter())->save($dname . $filename);

                $filename = $dir . $filename;
            }

            $example->fill([$field => $filename]);
        }

        $example->comment = $request->comment;
        $example->public_consent = $request->public_consent;

        $example->save();

        // return Example::where('painter_id', $this->guard()->id())->get();
        return redirect()->route('painter.mypage');
    }

    /**
     * ??????????????????
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publish($id)
    {
        $example = Example::find($id);

        // ????????????????????????1??????????????????????????????
        $example->public_consent = 1;

        $example->save();

        return $example;
    }

    /**
     * ????????????????????????????????????????????????
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        // ????????????????????????????????????
        $example = Example::where('public_consent', 1);

        if ($request->has('painter_id')) {
            $painter_id = $request->painter_id;

            // ??????ID?????????????????????????????????????????????????????????????????????
            if (is_array($painter_id)) {
                $example = $example->whereIn('painter_id', $painter_id);
            } else {
                $example = $example->where('painter_id', $painter_id);
            }
        }

        // ????????????????????????????????????
        $example = $example->orderby('updated_at', 'desc')->get();

        // return $example;
        return view(config('const.template.example.list'), ['example' => $example]);
    }
}

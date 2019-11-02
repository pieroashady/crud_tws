<?php

namespace App\Http\Controllers;

use App\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Symfony\Component\Console\Input\Input;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Biodata::all();
        if ($data) {
            return response()->json(array(
                'status' => 1,
                'message' => 'success',
                'data' => $data
            ), 200);
        } else {
            return response()->json(array(
                'status' => 0,
                'message' => 'Failed',
                'data' => null
            ), 502);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        // $check = $request->validate([
        //     'nim' => 'required|unique:biodata'
        // ]);

        $biodata = new Biodata();
        $biodata->nim = $request->nim;
        $biodata->nama = $request->nama;
        $biodata->alamat = $request->alamat;
        $data = $request->nim;

        $uniq = DB::table('biodata')->where(['nim' => $data])->get();

        if (count($uniq) == 0) {
            $biodata->save();
            return response()->json(array(
                'status' => 1,
                'data' => $biodata
            ), 200);
        } else {
            return response()->json(array(
                'status' => 0,
                'message' => $data . ' is duplicated'
            ), 502);
        }
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
     * @param  \App\Biodata  $biodata
     * @return \Illuminate\Http\Response
     */
    public function show(Biodata $biodata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Biodata  $biodata
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Biodata::find($id);

        if ($data) {
            return response()->json([
                'status' => 1,
                'message' => 'Success',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Failed',
                'data' => null
            ], 502);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Biodata  $biodata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Biodata::find($id);
        $data->nim = $request->nim;
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;

        if ($data != null) {
            $data->save();
            return response()->json(array(
                'status' => 1,
                'message' => 'success',
                'data' => $data
            ), 200);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'failed',
                'data' => null
            ], 502);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Biodata  $biodata
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Biodata::find($id);

        if ($data != null) {
            $data->delete();
            return response()->json([
                'status' => 1,
                'message' => 'Success',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Cannot find user with ID ' . $id,
                'data' => null
            ], 502);
        }
    }
}

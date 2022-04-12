<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Staff;
use DataTables;

class StaffController extends Controller
{
    public function index()
    {
        return view('staff');
    }

    public function send()
    {
       
    }

    public function getStaffs(Request $request)
    {
        if ($request->ajax()) {
            $data = Staff::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}

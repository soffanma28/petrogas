<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\Item_request;
use App\Models\Item_request_detail;
use App\Models\Item_category;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;
use Backpack\CRUD\app\Http\Controllers\CrudController;


class ItemRequestController extends Controller
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;

    public function index(){


        return view('item_request.list');

    }

    public function create(){

    	$employees = Employee::all();
        $items = Item::all();
        $categories = Item_category::all();

    	return view('item_request.create', compact('employees', 'items', 'categories'));

    }

    public function dept(Request $request){

    	if ($request->ajax()) {
    		return response()->json([
    			'user' => User::find($request->id)
    		]);
    	}


    }

    public function store(Request $request){

        // dd($request->input('qty_request'));
        $emp = [];
        foreach ($request->input('employee') as $key => $value) {
            $emp[$key] = ['empid' => $value, 'empname' => Employee::where('employee_id',$value)->first()->name];
        }
        $validate = $request->validate([
            'employee' => 'required',
            'typeofrequest' => 'required',
            'status' => 'required',
            'remark' => 'required',
            'items' => 'required',
            'qty_request' => 'required',
        ]);

        switch ($request->input('action')) {
            case 'draft':
            $itemrequest = Item_request::create([
                'requestor_id' => $request->input('requestor_id'),
                'employee' => $emp,
                'status' => 'Draft',
                'typeofrequest' => $request->input('typeofrequest'),
                'remark' => $request->input('remark')
            ]);
                break;
            case 'saveprove':
            $itemrequest = Item_request::create([
                'requestor_id' => $request->input('requestor_id'),
                'employee' => $emp,
                'status' => 'Requested',
                'typeofrequest' => $request->input('typeofrequest'),
                'remark' => $request->input('remark')
            ]);

                break;
            default:
                # code...
                break;
        }

        $rules = [];
        foreach ($request->input('items') as $key => $value) {
            $rules["items.{$key}"] = 'required';
        }
        foreach ($request->input('qty_request') as $key => $value) {
            $rules["qty_request.{$key}"] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $req_id = $itemrequest->id;
            foreach ($request->input('items') as $key => $value) {

                Item_request_detail::create([
                    'req_id' => $req_id,
                    'item_id' => $value,
                    'qty_request' => $request->input('qty_request.'.$key),
                ]);
            }
        }

        switch ($request->input('action')) {
            case 'draft':
            \Alert::success('Request drafted')->flash();
                break;
            case 'saveprove':
            \Alert::success('Request submitted')->flash();
                break;
            default:
                # code...
                break;
        }
        return redirect()->route('item_request.index');

    }

    public function edit($id){

        $itemrequest = Item_request::find($id);
        $employees = Employee::all();
        $items = Item::all();
        $categories = Item_category::all();

        return view('item_request.create', compact('itemrequest','employees', 'items', 'categories'));

    }

    public function draft($id){

        Item_request::find($id)->update(['status' => 'Draft', 'req_date' => null]);
        \Alert::success('Request drafted')->flash();
        return redirect()->route('item_request.index');

    }

    public function request($id){
        Item_request::find($id)->update(['status' => 'Requested', 'req_date' => Carbon::now()]);
        \Alert::success('Request submitted')->flash();
        return redirect()->route('item_request.index'); 
    }


}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackpackUser;
use App\Models\Item;
use App\Models\Item_request;
use App\Models\Item_request_detail;
use App\Models\Item_category;
use App\Models\Adminrequest;
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

    	$employees = Employee::where('requestor_id', backpack_user()->id)->get();
        $items = Item::all();
        $categories = Item_category::all();

    	return view('item_request.create', compact('employees', 'items', 'categories'));

    }

    public function store(Request $request){

        // dd($request->input('qty_request'));
        $validate = $request->validate([
            'employee' => 'required',
            'typeofrequest' => 'required',
            'status' => 'required',
            'remark' => 'required',
            'items' => 'required',
            'qty_request' => 'required',
        ]);
        $emp = [];
        foreach ($request->input('employee') as $key => $value) {
            $emp[$key] = ['empid' => $value, 'empname' => Employee::where('employee_id',$value)->first()->name];
        }

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
                'req_date' => Carbon::now(),
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
            $tem = [];
            foreach ($request->input('items') as $key => $value) {
                
                if (Item::where('name', $value)->exists()) {
                    $tem[$key] = Item::where('name', $value)->first();
                    Item_request_detail::create([
                        'req_id' => $req_id,
                        'item_id' => $tem[$key]->id,
                        'qty_request' => $request->input('qty_request.'.$key),
                    ]);
                } else {
                    $tem[$key] = Item::create([
                        'name' => $value,
                        'category_id' => 1,
                        'qty' => 1,
                        'price' => 1, 
                    ]); 
                    Item_request_detail::create([
                        'req_id' => $req_id,
                        'item_id' => $tem[$key]->id,
                        'qty_request' => $request->input('qty_request.'.$key),
                    ]);
                }
                
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
        $itemdetail = Item_request_detail::where('req_id', $id)->get();
        $items = Item::all();
        $employees = Employee::where('requestor_id', backpack_user()->id)->get();
        $categories = Item_category::all();

        return view('item_request.edit', compact('itemrequest', 'itemdetail', 'items', 'employees', 'categories'));

    }

    public function update(Request $request, $id){
        
        
        // dd($request->input('items'));
        switch ($request->input('action')) {
            case 'approved':
                $validate = $request->validate([
                    'remark' => 'required',
                    'qty_actual' => 'required',
                ]);
                Item_request::find($id)->update([
                    'status' => 'Approved',
                    'approver_id' => backpack_user()->id, 
                    'approve_date' => Carbon::now(),
                    'remark' => $request->input('remark'),
                ]);
                Adminrequest::updateOrInsert([
                    'request_id' => $id,
                    'adminstatus' => 'Open',
                ]);
                $rules = [];
                foreach ($request->input('qty_actual') as $key => $value) {
                    $rules["qty_actual.{$key}"] = 'required';
                }

                $validator = Validator::make($request->all(), $rules);

                if ($validator->passes()) {
                    // dd($request->input('qty_actual'));
                    $itemdetail = [];
                    foreach($request->input('items') as $key => $item){
                        ${'itemdetail'.$key} = Item_request_detail::where('req_id', $id)->where('item_id', $item)->first();
                    }
                    foreach ($request->input('qty_actual') as $key => $value) {
                        ${'itemdetail'.$key}->update([
                            'qty_actual' => $value,
                        ]);
                        \Alert::success($value)->flash();
                    }
                }

                \Alert::success('Request approved')->flash();
                break;
            case 'draft':
                $validate = $request->validate([
                    'employee' => 'required',
                    'typeofrequest' => 'required',
                    'status' => 'required',
                    'remark' => 'required',
                    'items' => 'required',
                    'qty_request' => 'required',
                ]);
                $emp = [];
                foreach ($request->input('employee') as $key => $value) {
                    $emp[$key] = ['empid' => $value, 'empname' => Employee::where('employee_id',$value)->first()->name];
                }
                $rules = [];
                foreach ($request->input('items') as $key => $value) {
                    $rules["items.{$key}"] = 'required';
                }
                foreach ($request->input('qty_request') as $key => $value) {
                    $rules["qty_request.{$key}"] = 'required';
                }

                $validator = Validator::make($request->all(), $rules);
                $itemrequest = Item_request::find($id)->update([
                    'requestor_id' => $request->input('requestor_id'),
                    'employee' => $emp,
                    'status' => 'Draft',
                    'typeofrequest' => $request->input('typeofrequest'),
                    'remark' => $request->input('remark')
                ]);

                if ($validator->passes()) {
                    foreach ($request->input('items') as $key => $value) {
                        Item_request_detail::updateOrInsert([
                            'req_id' => $id,
                            'item_id' => $value,
                            'qty_request' => $request->input('qty_request.'.$key),
                        ]);
                    }
                }
                \Alert::success('Request drafted')->flash();
                break;
            case 'saveprove':
                $validate = $request->validate([
                    'employee' => 'required',
                    'typeofrequest' => 'required',
                    'status' => 'required',
                    'remark' => 'required',
                    'items' => 'required',
                    'qty_request' => 'required',
                ]);
                $emp = [];
                foreach ($request->input('employee') as $key => $value) {
                    $emp[$key] = ['empid' => $value, 'empname' => Employee::where('employee_id',$value)->first()->name];
                }
                $rules = [];
                foreach ($request->input('items') as $key => $value) {
                    $rules["items.{$key}"] = 'required';
                }
                foreach ($request->input('qty_request') as $key => $value) {
                    $rules["qty_request.{$key}"] = 'required';
                }

                $validator = Validator::make($request->all(), $rules);
                $itemrequest = Item_request::find($id)->update([
                    'requestor_id' => $request->input('requestor_id'),
                    'employee' => $emp,
                    'status' => 'Requested',
                    'req_date' => Carbon::now(),
                    'typeofrequest' => $request->input('typeofrequest'),
                    'remark' => $request->input('remark')
                ]);
                if ($validator->passes()) {
                    foreach ($request->input('items') as $key => $value) {
                        Item_request_detail::updateOrInsert([
                            'req_id' => $id,
                            'item_id' => $value,
                            'qty_request' => $request->input('qty_request.'.$key),
                        ]);
                    }
                }
                \Alert::success('Request submitted')->flash();
                break;
            default:
                # code...
                break;
        }

        return redirect()->route('item_request.index');

    }

    public function draft($id){

        Item_request::find($id)->update(['status' => 'Draft', 'req_date' => null]);
        \Alert::success('Request drafted')->flash();
        return redirect()->route('item_request.index');

    }

    public function send($id){
        $itemrequest = Item_request::find($id)->update([
            'status' => 'Requested',
            'req_date' => Carbon::now(),
        ]);
        \Alert::success('Request submitted')->flash();
        return redirect()->route('item_request.index');
    }

    public function approve($id){
        $itemrequest = Item_request::find($id);
        $itemdetail = Item_request_detail::where('req_id', $id)->get();
        $items = Item::all();
        $employees = Employee::where('requestor_id', backpack_user()->id)->get();
        $categories = Item_category::all();

        return view('item_request.approve', compact('itemrequest', 'itemdetail', 'items', 'employees', 'categories'));
    }

    public function request($id){
        $adminrequest = Adminrequest::find($id);
        $itemdetail = Item_request_detail::where('req_id', $adminrequest->request_id)->get();

        $items = Item::all();
        $employees = Employee::where('requestor_id', backpack_user()->id)->get();
        $categories = Item_category::all();

        return view('adminrequest.request', compact('adminrequest', 'itemdetail', 'items', 'employees', 'categories'));
    }

    public function adminupdate(Request $request, $id){
        
        switch ($request->input('action')) {
            case 'saveprove':
                $adminrequest = Adminrequest::find($id);
                Item_request::find($adminrequest->request_id)->update([
                    'status' => 'On Process',
                    'on_process_id' => backpack_user()->id,
                    'process_date' => Carbon::now(),
                    'remark' => $request->input('remark'),
                ]);
                Adminrequest::find($id)->update([
                    'adminstatus' => 'Requested',
                ]);

                \Alert::success('Request submitted')->flash();
                break;
            case 'approve':
                $adminrequest = Adminrequest::find($id);
                Item_request::find($adminrequest->request_id)->update([
                    'status' => 'Ready',
                    'ready_id' => backpack_user()->id,
                    'ready_date' => Carbon::now(),
                    'remark' => $request->input('remark'),
                ]);
                Adminrequest::find($id)->update([
                    'adminstatus' => 'Approved',
                    'adminprove_id' => backpack_user()->id,
                    'adminprove_date' => Carbon::now(),
                ]);

                \Alert::success('Request approved')->flash();
                break;
            default:
                # code...
                break;
        }

        return redirect()->route('adminrequest.index'); 
    }

    public function adminprove($id){

        $adminrequest = Adminrequest::find($id);
        Adminrequest::find($id)->update([
            'adminstatus' => 'Requested',
        ]);
        Item_request::find($adminrequest->request_id)->update([
            'status' => 'On Process',
            'on_process_id' => backpack_user()->id,
            'process_date' => Carbon::now(),
        ]);
        \Alert::success('Requested')->flash();
        return redirect()->route('adminrequest.index');

    }

    public function complete($id){

        $adminrequest = Adminrequest::find($id);
        Adminrequest::find($id)->update([
            'adminstatus' => 'Completed',
            'admincompleted_id' => backpack_user()->id,
            'admincomplete_date' => Carbon::now(),
        ]);
        Item_request::find($adminrequest->request_id)->update([
            'status' => 'Completed',
            'completed_id' => backpack_user()->id,
            'complete_date' => Carbon::now(),
        ]);
        \Alert::success('Request completed')->flash();
        return redirect()->route('adminrequest.index');

    }


}

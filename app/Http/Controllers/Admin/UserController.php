<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function deleteMultiple(Request $request){
        $users=User::whereIn('id',$request->id)->delete();
        return response(['success'=>true,'message'=>'Selected row deleted successfully...']);
    }
    public function deleteUser($id){

        $user=User::find($id);
        if ($user){
            $user->delete();
            return response(['success'=>true,'message'=>'User deleted successfully...']);
        }
        return response(['success'=>true,'message'=>'Error while deleting...']);
    }

    public function index(){


        return view('admin.user.index');
    }
    public function fetch(Request $request){
        $users=User::with('roles')
            ->select('*')->when($request->type!='',function($q) use ($request){


                return $q->whereHas('roles',function($query) use ($request){
                    return $query->where('name',$request->type);
                });

            });
        return DataTables::of($users) ->editColumn('id',function($application){
            return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="'.$application->id.'" />
                                        </div>';
        })->addColumn('role',function($user){

            if ($user->roles->first()) {

                return '<span class="badge badge-primary">' . $user->roles->first()->name . '</span>';

            }

            return '<span class="badge badge-danger">No Role Assigned</span>';


        })->editColumn('name',function($user){
            return ' <div class="d-flex align-items-center">
                                            <!--begin::Thumbnail-->
                                            <a href="#" class="symbol symbol-50px">
                                                <span class="symbol-label" style="background-image:url('.$user->avatar1.');"></span>
                                            </a>
                                            <!--end::Thumbnail-->
                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-kt-ecommerce-product-filter="product_name">'.$user->name.'</a>
                                                <br><span>'.$user->email.'</span>
                                                <!--end::Title-->
                                            </div>
                                        </div>';
        })->addColumn('actions',function ($user){
            $role='';
            if ($user->roles->first()) {
                $role = $user->roles->first()->name;
            }

            return '<a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer" data-role="'.$role.'" data-dt=\''.json_encode($user).'\' data-id="'.$user->id.'" class="menu-link btn-edit px-3">Edit</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="'.route('admin.user.delete',$user->id).'" data-kt-customer-table-filter="delete_row" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                            </div>
                                           ';
        })->rawColumns(['id','name','actions','role'])->make(true);
    }
    public function store(Request $request){


        $path=null;
        if ($request->hasFile('avatar')){
            $path=$request->file('avatar')->store('avatar',['disk'=>'public']);
        }
        if ($request->edit=='true'){
            $request->validate(['name'=>'required','email'=>'required|email|unique:users,email,'.$request->id,'phone'=>'required|unique:users,phone,'.$request->id]);
            $user=User::find($request->id);
            $user->name=$request->name;
            $user->email=$request->email;
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->phone=$request->phone;
            if ($path){
                $user->avatar=$path;
            }
            $user->assignRole($request->role);
            $user->save();

        }else{
            $request->validate(['name'=>'required','email'=>'required|email|unique:users','phone'=>'required|unique:users,phone']);
            $user=new User();
            $user->name=$request->name;
            $user->email=$request->email;

            $user->password=bcrypt($request->password);
            $user->phone=$request->phone;
//            $user->role=$request->role;
            if ($path){
                $user->avatar=$path;
            }
            $user->save();
            $user->assignRole($request->role);
        }
    }

}

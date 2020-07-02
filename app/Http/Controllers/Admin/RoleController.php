<?php

namespace App\Http\Controllers\Admin;

use App\Model\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class RoleController
 * @package App\Http\Controllers\Admin
 * 角色控制器
 */
class RoleController extends Controller
{
    /**
     * 角色列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $role = Role::get();
        return view('admin.role.list',compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     * 返回创建一个添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //角色添加页面
        return view('admin.role.add');
        
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

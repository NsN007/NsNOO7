@extends('layout.adminindex')
@section('con')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>用户添加</span>
    </div>
    <!--验证错误-->
   
    <div class="mws-panel-body no-padding">
        <form action="/admin/user/insert" class="mws-form" method='post'>
        {{csrf_field()}}
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">姓名</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" name='name' value="{{old('name')}}">
                    </div>
                </div>
            </div>
    <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">账号</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" name='username' value="{{old('username')}}">
                    </div>
                </div>
            </div>
                <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">密码</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" name='pass' value="{{old('pass')}}">
                    </div>
                </div>
            </div>
                <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">确认密码</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" name='repass' value="{{old('repass')}}">
                    </div>
                </div>
            </div>
                <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">邮箱</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" name='email' value="{{old('email')}}">
                    </div>
                </div>
            </div>
                <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">电话</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" name='phone' value="{{old('phone')}}">
                    </div>
                </div>
            </div>
            <div class="mws-button-row">
                <input type="submit" class="btn btn-danger" value="添加">
                <input type="reset" class="btn " value="重置">
            </div>
        </form>
    </div>      
</div>
@endsection
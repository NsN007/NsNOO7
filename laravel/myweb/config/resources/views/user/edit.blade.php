@extends('layout.adminindex')
@section('con')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>用户修改</span>
    </div>
    <!--验证错误-->
   
    <div class="mws-panel-body no-padding">
        <form action="/admin/user/update" class="mws-form" method='post'>
        {{csrf_field()}}
        <!--添加隐藏域 传递用户的id-->
        <input type="hidden" name='id' value='{{$vo['id']}}'>
        <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">邮箱</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" name='email' value="{{$vo['email']}}">
                    </div>
                </div>
        </div>
                <div class="mws-form-inline">
        <div class="mws-form-row">
                    <label class="mws-form-label">状态</label>
                    <div class="mws-form-item">
                        <select name="status" class='small' id="">
                            <option value="0"@if($vo['status']=='0') selected @endif>禁用</option>
                            <option value="1"@if($vo['status']=='1') selected @endif>启用</option>

                        </select>
                    </div>
        </div>
            </div>
            <div class="mws-button-row">
                <input type="submit" class="btn btn-danger" value="修改">
                <input type="reset" class="btn " value="重置">
            </div>
        </form>
    </div>      
</div>
@endsection
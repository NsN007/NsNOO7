@extends('layout.adminindex')
@section('con')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>分类修改</span>
    </div>
    <div class="mws-panel-body no-padding">
        <form action="/admin/cate/update" class="mws-form" method='post'>
        {{csrf_field()}}
        <!--添加隐藏域传递用户的id-->
        <input type="hidden" name='id' value='{{$vo['id']}}'>
        <div class="mws-form-inline">
        <div class="mws-form-row">
            <label class="mws-form-label">父分类</label>
            <div class="mws-form-item">
                <input type="text" class="small" value='{{$funame}}' readonly name='cate'>
            </div>
        </div>

        <div class="mws-form-row">
            <label class="mws-form-label">子分类</label>
            <div class="mws-form-item">
                <input type="text" class="small" value='{{$vo['cate']}}' name='cate'>
            </div>
        </div>
    
    </div>
                <div class="mws-form-inline">
     
            <div class="mws-button-row">
                <input type="submit" class="btn btn-danger" value="修改">
                <input type="reset" class="btn " value="重置">
            </div>
        </form>
    </div>      
</div>
@endsection
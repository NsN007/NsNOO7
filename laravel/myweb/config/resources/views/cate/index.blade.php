@extends('layout.adminindex')

@section('con')
<div class="mws-panel grid_8">
<div class="mws-panel-header">
	<span><i class="icon-table"></i>分类浏览</span>
</div>
<div class="mws-panel-body no-padding">
    <div role="grid" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">
  
    <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
        <thead>
            <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 169px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 229px;" aria-label="Browser: activate to sort column ascending">分类名称</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 213px;" aria-label="Platform(s): activate to sort column ascending">PID</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 145px;" aria-label="Engine version: activate to sort column ascending">PATH</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 106px;" aria-label="CSS grade: activate to sort column ascending">操作</th>
            </tr>
        </thead>
        <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($list as $k=>$v)
        	@if($k%2==0)
        		<tr class='odd'>
        	@else
        		<tr class='even'>
        	@endif
                <td class="sorting_1">{{$v['id']}}</td>
                <td class=" ">{{$v['cate']}}</td>
                <td class=" ">{{\App\Http\Controllers\CateController::funame($v['pid'])}}</td>
                <td class=" ">{{$v['path']}}</td>
               
                <td class=" ">
                    <a href="/admin/cate/del/{{$v['id']}}" class='icon-trash' style='font-size:30px;color:red'></a>
                    &nbsp
                    <a href="/admin/cate/add/{{$v['id']}}" class='icon-plus' style='font-size:30px;color:red'></a>
                    &nbsp
                    <a href="/admin/cate/edit/{{$v['id']}}" class='icon-wrench' style='font-size:30px;color:red'></a>

                </td>
            </tr>
		@endforeach
   		</tbody>
    </table>
    </div>
    </div>
</div>
</div>
@endsection
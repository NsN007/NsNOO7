<ul>
	@foreach($list as $v)
		<li>
			<span>{{$v['cate']}}</span>


				<ul>
					@foreach($v['sub'] as $val)
					<li>
					<span>{{$val['cate']}}</span>

					
				<ul>
					@foreach($val['sub'] as $value)
					<li>{{$value['cate']}}</li>
					@endforeach
				</ul>
					</li>
						@endforeach
				</ul>
		</li>
	@endforeach
</ul>
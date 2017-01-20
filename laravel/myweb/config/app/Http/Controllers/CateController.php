<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CateController extends Controller
{
    //分类添加
    public function getAdd($id=''){
        // dd($id);
    	//获取格式化类别数据
    	$cate= self::getCates();
    	return view('cate.add',['list'=>$cate,'id'=>$id]);
    }

    //获取格式化类别数据
    public static function getCates(){
    	//select *,concat(path,id) as paths from cate order by paths
    	// $cate=DB::table('cate')->get();
    	$cate=DB::table('cate')->select('*',DB::raw('concat(path,id) as paths'))->orderBy('paths')->get();//select 指定字段  DB:raw  原生代码
    	//dd($cate);
    	//修改类别的样式 
    	foreach($cate as $k=>$v){
    		//分配的级别  0 顶级
    		$num=(count(explode(',',$v['path']))-2);//0
    		$cate[$k]['cate']=str_repeat('☆',$num).$v['cate'];
    		// dd($cate);
    		// echo (count(explode(',',$v['path']))-2).'---'.$v['cate'].'<br>';
    	}
    	// dd();
    	return $cate;
    }

    //执行插入
    public function postInsert(Request $request){
   	if($request->input('id')==0){
    		//添加顶级类
   		$data['cate']=$request->input('cate');
   		$data['pid']=0;
   		$data['path']='0,';
    	}else{
    	//添加某一个类下面的子类
    		$data['cate']=$request->input('cate');
    		$data['pid']=$request->input('id');//子类的pid父类的id
    		$path=DB::table('cate')->where('id',$request->input('id'))->first()['path'];
    		$data['path']=$path.$request->input('id').',';//父类path,父类的id
    	}

    	$res=DB::table('cate')->insert($data);
    	if($res){
    		return redirect('/admin/cate/index')->with('success','添加分类成功');
    	}else{
    		return back()->with('error','添加失败');
    	}
    }
    //分类列表
    public function getIndex(){
    	//查询数据
    	return view('cate.index',['list'=>self::getCates()]);
    }
    //根据子类的pid转化父类类名
    public static function funame($pid){
        // echo $pid;
    	$funame=DB::table('cate')->where('id',$pid)->first()['cate'];
    	echo empty($funame)?'顶级分类':$funame;
    }

    //删除分类
    public function getDel($id){
        // dd($id);
        //如果该分类有子类不能删除  只有删除没有子类的父类
        $date=DB::table('cate')->where('pid',$id)->get();
        if(count($date)>0){
            //有子类
            return back()->with('error','该类下面有子类不能直接删除');
        }else{
            //没有子类
        $res=DB::table('cate')->where('id',$id)->delete();
        if($res){
            return redirect('/admin/cate/index')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
        }
    }


    //加载修改表单
    public function getEdit($id){
        //根据子类的id查询父类的名称
        //select c1.*,c2.cate as funame from cate as c1,cate as c2 where c1.pid=c2.id and c1.id=12;
            $funame=DB::table('cate as c1')
                    ->join('cate as c2','c1.pid','=','c2.id')
                    ->select('c2.cate as funame')
                    ->where('c1.id',$id)
                    ->first()['funame'];//根据子类的id查询父类的名称
            // dd($funame);
            $funame=empty($funame)?"顶级类":$funame;
            // dd($funame);
            return view('cate.edit',[
            'vo'=>DB::table('cate')->where('id',$id)->first(),
            'funame'=>$funame
            ]);
        }
      //执行修改
            public function postUpdate(Request $request){
                //dd($request->all());
                if(DB::table('cate')->where('id',$request->input('id'))->update($request->only('cate'))){
                    return redirect('/admin/cate/index')->with('success','修改成功');
                }else{
                    return back()->with('error','修改失败');
                }
        }




        public function getCatesarr(){
            // dd(self::getCatesByPid(0));//查询某一个分类下面的子类
            //  $cates=self::getAllCates();

            //  $cates=self::getCatesInfo($cates,0);
            // // // 永久缓存
            //  \Cache::forever('key',$cates);

            return view('cate.nav',['list'=>\Cache::get('key')]);

            // //放在缓存中(以文件的形式做缓存)
            // \Cache::put('key',$cates,1); //1分钟时间
            // //获取缓存中的数据 适合固定的数据
            //\Cache::get('key');
           
        }
        //返回所有的分类数据
        public static function getAllCates(){
            return DB::table('cate')->get();
        }

        public static function getCatesInfo($cates,$pid){
            $data=[];
            foreach($cates as $k=>$v){
                if($v['pid']==$pid){
                    $v['sub']=self::getCatesInfo($cates,$v['id']);
                    $data[]=$v;
                }

               
            }
            return $data;
        }



        // public  function getCatesarr(){
        //     dd(self::getCatesByPid(0));//查询某一个分类下面的子类
        // }

        // public static function getCatesByPid($pid){
        //     $res=DB::table('cate')->where('pid','=',$pid)->get();
        //     $data=[];
        //     foreach($res as $k=>$v){
        //         $v['sub']=self::getCatesByPid($v['id']);//查询这pid下面的所有子类
        //         $data[]=$v;
        //     } 
        //     return $data;
        // }
}

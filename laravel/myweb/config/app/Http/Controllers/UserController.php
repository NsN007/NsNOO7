<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{	
	//添加表单
    public function getAdd(){
    	return view('user.add');
    }
   	//执行添加
   	public function postInsert(Request $request){
   		// if(!$request->input('name')){
   		// 	return back()->withInput();
   		// }

   		//1.验证表单数据
   		$this->validate($request,[
	   			'name'=>'required', //name字段必填
	   			'username'=>'required|unique:user',//账号必填
	   			'repass'=>'same:pass|required',
	   			'email'=>'required|email',
   			],[
   				'name.required'=>'姓名必须填写',
   				'username.required'=>'账号必须填写',
   				'username.unique'=>'账号已存在',
   				'repass.same'=>'俩次密码不一致',
   				'repass.required'=>'重复密码必须填写',
   				'email.email'=>'邮箱格式不正确'
   			]);
   		//2.数据插入
   		$data=$request->except(['_token','repass']);
   		$data['pass'] = Hash::make($data['pass']);//密码加密,每次密码结果不一样   解密Hash::check()
   		$data['token']=str_random(50);//邮箱注册的身份验证
   		$data['status']=0;  //0 禁用  1启用

   	//3.数据插入
   	$res=DB::table('user')->insert($data);
   	if($res){
   		return redirect('/admin/user/index')->with('success','添加成功');
   	}else{
   		return back()->with('error','添加失败');//session(['error'=>'添加失败'])  session('error')  //withInput  做闪存
   	}
   }

   //用户的浏览
   public function getIndex(Request $request){
      //查询数据
      // $data=DB::table('user')->where('name','like','%'.$request->input('name').'%')->paginate($request->input('num',5));//指定按照2条数据分页  input('num'),input 只想获取数据里面的num
      $data=DB::table('user')->where(function($query) use($request){//query  就是数据库user的模型  相当于是DB::table('user') 这个对象  
            if ($request->input('keyword')){          //use给当前匿名函数引入外部的$request变量
                        //按照name 字段搜索
               $query->where('name','like','%'.$request->input('keyword').'%')
                        //按照email 字段搜索
                     ->orWhere('email','like','%'.$request->input('keyword').'%');
            }
      })->paginate($request->input('num',5));//指定按照2条数据分页  input('num'),input 只想获取数据里面的num
      //分页页码
      // dd($data->render());
      return view('user.index',['list'=>$data,'request'=>$request->all()]);
   }
   //删除方法
   public function getDel($id){
      $res=DB::table('user')->where('id',$id)->delete();
      if($res){
         return redirect('/admin/user/index')->with('success','删除成功');
      }else{
         return back()->with('error','删除失败');
      }
   } 
   //加载修改表单
   public function getEdit($id){

      return view('user.edit',[
         'vo'=>DB::table('user')->where('id','=',$id)->first()
         ]);
   }

   //执行修改
   public function postUpdate(Request $request){
      //获取数据
      $data=$request->only(['email','status']);
      $res=DB::table('user')->where('id',$request->input('id'))->update($data);
         $this->validate($request,[
               'email'=>'required|email',
            ],[
               'email.email'=>'邮箱格式不正确'
            ]);
      if($res){
         return redirect('/admin/user/index')->with('success','修改成功');
      }else{
         return back()->with('error','修改失败');
      }
   }
}

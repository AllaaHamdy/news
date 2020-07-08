<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use  Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res= Http::get('https://api-task1.adminssw.com/news/allnews');
        $all_news=json_decode($res->body())->newsData;
     
        return view('admin.news.news_home',compact('all_news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = [
            'titel'=>'required',
            'description'=>'required',
            'activeDateFrom'=>'required',
            'activeDateTo'=>'required',
          ];
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails()) {
            return redirect(admin_url('create-new'))->withErrors($validator);
            }
            $res= Http::post('https://api-task1.adminssw.com/news/addNews', [
                'imageNews' => $request->imageNews,
                'userId' =>$request->userId,
                'titel'=>$request->titel,
                'description'=>$request->description,
                'activeDateFrom'=>$request->activeDateFrom,
                'activeDateTo'=>$request->activeDateTo,
                'language'=>$request->language
            ]);
            
            if(json_decode($res->body())->status==1){
                return view('admin/news/create')->with('success_msg','News Addedd Succefully..');
              // return  redirect(admin_url('home'));
            }else{
                return view('admin/news/create')->with('error_msg',json_decode($res->body())->msg);
            }
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

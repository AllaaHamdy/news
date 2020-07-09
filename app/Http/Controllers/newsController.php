<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class newsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $lang=session()->get('lang');
        
        $res= Http::get('https://api-task1.adminssw.com/news/allnews');
        $all_news=json_decode($res->body())->newsData;
    
         
        return view('front.home',compact('all_news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $res= Http::get('https://api-task1.adminssw.com/news/allnews');
        $all_news=json_decode($res->body())->newsData;
        $single_news=array();
        foreach( $all_news as $news){
           if($news->newsId==$id){
            $single_news=$news;
           }
        }
        ///number of watches
        $path = storage_path(). "/"."news.json"; // ie: /var/www/laravel/app/storage/json/filename.json
        $news_arr[$id]=1;
        //Load the file
      $contents = file_get_contents($path);
      if(empty($contents)){
        file_put_contents($path, json_encode($news_arr));
      }
        
        $news = json_decode(file_get_contents($path), true); 
    
        $news_data=array();  
       
        foreach($news as $key=>$val){
            if($key==$id){
                $news[$id] = ++$val;
            }else{
                
                $news[$id] = 1;
                
            }
           
        }
        file_put_contents($path, json_encode($news));
        $single_news->views_num=$news[$id];
        return view('front.profile',compact('single_news'));
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

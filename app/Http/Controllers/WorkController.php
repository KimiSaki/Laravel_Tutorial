<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Work;
use App\HashTag;

class WorkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['create', 'store', 'edit', 'update', 'destroy']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $works = Work::All();

        // return view('work.index', [
        //     'works' => $works
        // ]);
        $keyword = $request->input('keyword');
        $query = Work::query();

        if(!empty($keyword)){
            $query->orwhere('title', 'LIKE', '%'.$keyword.'%')
                  ->orwhere('caption', 'LIKE', '%'.$keyword.'%')
                  ->orwhere('contents', 'LIKE', '%'.$keyword.'%');
        }
        $works = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('work.index', [
            'works' => $works,
            'keyword' => $keyword
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('work.create');
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
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'caption' => ['string', 'max:1024']
        ]);

        $work = new Work;
        $work->title = $request->input('title');
        $work->caption = $request->input('caption');
        $work->contents = $request->input('contents');
        $work->user_id = $request->user()->id;
        $work->is_published = $request->input('is_published');
        $work->save();

        //HashTagの新規保存
        $hash_tag_names = preg_split('/\s+/', $request->input('hash_tags'), -1, PREG_SPLIT_NO_EMPTY);
        foreach( $hash_tag_names as $hash_tag_name){
            //既存のレコードがあれば何もしない
            //なければ新規保存
            $hash_tag = HashTag::firstOrCreate([
                'name' => $hash_tag_name
            ]);
            $hash_tags_id[] = $hash_tag->id;
        }

        //中間テーブルの保存
        $work->hashTags()->sync($hash_tags_id);

        // フラッシュデータの保存
        $request->session()->flash('flash_message', '作品の新規投稿が完了しました');

        return redirect('/works');
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
        $work = Work::find($id);
        return view('work.show', [
            'work' => $work
        ]);
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
        $work = Work::find($id);
        return view('work.edit', [
            'work' => $work
        ]);
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
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'caption' => ['string', 'max:1024']
        ]);

        $work = Work::find($id);
        $work->title = $request->input('title');
        $work->caption = $request->input('caption');
        $work->contents = $request->input('contents');
        $work->is_published = $request->input('is_published');
        $work->save();

        //HashTagの新規保存
        $hash_tag_names = preg_split('/\s+/', $request->input('hash_tags'), -1, PREG_SPLIT_NO_EMPTY);
        foreach( $hash_tag_names as $hash_tag_name){
            //既存のレコードがあれば何もしない
            //なければ新規保存
            $hash_tag = HashTag::firstOrCreate([
                'name' => $hash_tag_name
            ]);
            $hash_tags_id[] = $hash_tag->id;
        }

        //中間テーブルの保存
        $work->hashTags()->sync($hash_tags_id);

        // フラッシュデータの保存
        $request->session()->flash('flash_message', '作品を更新しました');

        return view('work.show', [
            'work' => $work
        ]);
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
        $work = Work::find($id);
        $work->delete();
        
        return redirect('/works');
    }

    public function showByHashTag($id){
        $hash_tag = HashTag::find($id)->paginate(20);
        return view('work.index', [
            'works' => $hash_tag->works
        ]);
    }

    public function showByKeyword(Request $request){
        //
        $keyword = $request->input('keyword');
        $query = Work::query();

        if(!empty($keyword)){
            $query->where('caption', 'LIKE', '%'.$keyword.'%')->orwhere('contents', 'LIKE', '%'.$keyword.'%');
        }
        $works = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('work.index', [
            'works' => $works,
            'keyword' => $keyword
        ]);
    }

    public function read($id){
        $work = Work::find($id);
        return view('work.read', [
            'work' => $work
        ]);
    }
}

<?php

namespace App\Repositories;
use App\Contracts\TagContracts;
use App\Models\Tag;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Request;

class TagRepository implements TagContracts
{
    private $apiReturnData = [];

    public function __construct(Tag $tag, Request $request)
    {
        $this->model = $tag;
        $this->request = $request;
    }
    public function tagList(){
        if ($this->request->ajax()) {

            $page = $this->request->pagination['page'];
            $perpage = $this->request->pagination['perpage'];

            $field = $this->request->sort['field'];
            $sort = $this->request->sort['sort'];

            $skip = ($page - 1) * $perpage;

            $search = array();

            if ($this->request['query'] != null) {
                // $search = $request->input('query');
                $search = array_values($this->request['query']);

                Log::info("search ", $search);
            }
            $search_string = implode(" ", $search);
            Log::info('search string',[$search_string]);

            $tags = Tag::orderBy($field,$sort)->where('user_id',Session('id'))->where(function ($query) use ($search_string) {
                $query->where('name', 'like',  $search_string . '%');
            })->skip($skip)->take($perpage)->get();

            if (!empty($search_string)) {
                // Log::info("inside if", $search);
                $total_records = count($tags);
            } else {
                $total_records = Tag::where('user_id',Session('id'))->count();
            }
            Log::info("inside else", [$total_records]);
            $this->apiReturnData['data'] = $tags;
            $this->apiReturnData['meta'] = array("page" => $page, "pages" => ceil($total_records / $perpage), "perpage" => $perpage, "total" => $total_records);
            return $this->apiReturnData;
    }
    }

    public function store(){
        $tag = Tag::create([
            'user_id' => Session('id'),
            'name' => $this->request->tagname
        ]);
        return $tag;
    }

    public function edit(string $id){
        $this->apiReturnData['tagname'] = Tag::select('name')->where('id',$id)->first();
        return $this->apiReturnData;
    }

    public function update(string $id){
        $status = Tag::Where('id',$id)->update(['name' => $this->request->tagname]);
      
        return $status;
    }

    public function destroy(string $id){
        $status = Tag::where('id',$id)->delete();
        Log::info('delete tag status ',[$status]);
        return $status;
    }
}
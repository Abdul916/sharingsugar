<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin\Post;
use Session, Validator, DB, Str;
class PostController extends Controller
{
	public function index(Request $request)
	{
		$query = Post::query();
		$search_query = $request->input('search_query');
		$query->join('categories', 'posts.category_id', '=', 'categories.id')
		->select('posts.*');
		if ($request->has('search_query') && !empty($search_query)) {
			$query->where(function ($query) use ($search_query) {
				$query->where('posts.title', 'like', '%' . $search_query . '%')
				->orWhere('categories.name', 'like', '%' . $search_query . '%');
			});
		}
		$data['posts'] = $query->orderBy('posts.id', 'DESC')->paginate(50);
		$data['searchParams'] = $request->all();
		return view('admin/posts/posts', $data);
	}
	public function create()
	{
		return view('admin/posts/add_post');
	}
	public function store(Request $request)
	{
		$data = $request->all();
		$validator = Validator::make($request->all(), [
			'category' => 'required',
			'title' => 'required',
			'keywords' => 'required',
			'short_description' => 'required',
			'description' => 'required',
		]);
		if ($validator->fails()) {
			return response()->json(array('msg' => 'lvl_error', 'response'=>$validator->errors()->all()));
		}
		$thumbnail = '';
		if(!empty($data['thumbnail'])){
			$image = $request->file('thumbnail');
			$file_name = explode('.', $image->getClientOriginalName())[0];
			$thumbnail = $file_name.'_'.time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/assets/posts_img');
			$image->move($destinationPath, $thumbnail);
		}
		$slug = create_slug('posts', $data['title'], '');
		$query = Post::create([
			'title' => $data['title'],
			'category_id' => $data['category'],
			'keywords'=> $data['keywords'],
			'short_description'=> $data['short_description'],
			'description'=> $data['description'],
			'slug' => $slug,
			'thumbnail' => $thumbnail,
			'created_by' => Auth()->user()->id,
			'created_at' => date('Y-m-d H:i:s')
		]);
		$response_status = $query->id;
		if($response_status > 0) {
			return response()->json(['msg' => 'success', 'response'=>'Post successfully added.']);
		} else {
			return response()->json(['msg' => 'error', 'response'=>'Something went wrong!']);
		}
	}
	public function edit($id, Request $request)
	{
		$data['post'] = Post::where('id', $id)->first();
		return view('admin/posts/edit_post', $data);
	}
	public function update(Request $request)
	{
		$data = $request->all();
		$validator = Validator::make($request->all(), [
			'title' => 'required',
			'category' => 'required',
			'keywords' => 'required',
			'short_description' => 'required',
			'description' => 'required',
		]);
		if ($validator->fails()) {
			return response()->json(array('msg' => 'lvl_error', 'response'=>$validator->errors()->all()));
		}
		if(isset($data['status'])){
			$status = "1";
		}else {
			$status = "0";
		}
		if(!empty($data['thumbnail'])){
			$image = $request->file('thumbnail');
			$file_name = explode('.', $image->getClientOriginalName())[0];
			$data['thumbnail'] = $file_name.'_'.time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/assets/posts_img');
			$image->move($destinationPath, $data['thumbnail']);
			DB::table('posts')
			->where('id', $data['id'])->update([
				'thumbnail' => $data['thumbnail']
			]);
		}
		$slug = create_slug('posts', $data['title'], $data['id']);
		$post_status = Post::where('id', $data['id'])->update([
			'title' => $data['title'],
			'category_id' => $data['category'],
			'keywords'=> $data['keywords'],
			'short_description'=> $data['short_description'],
			'description'=> $data['description'],
			'slug' => $slug,
			'status' => $status,
			'updated_at' => date('Y-m-d H:i:s'),
			'updated_by' => Auth()->user()->id,
		]);
		if($post_status > 0) {
			return response()->json(['msg' => 'success', 'response'=>'Post successfully updated!']);
		} else {
			return response()->json(['msg' => 'error', 'response'=>'Something went wrong!']);
		}
	}
	public function destroy(Request $request)
	{
		$data = $request->all();
		$status = Post::find($data['id'])->delete();
		if($status > 0) {
			return response()->json(['msg' => 'success', 'response'=>'Post successfully deleted.']);
		} else {
			return response()->json(['msg' => 'error', 'response'=>'Something went wrong!']);
		}
	}
}
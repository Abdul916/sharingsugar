<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use Session, Validator, DB, Str;
class CategoryController extends Controller
{
	public function index(Request $request)
	{
		$query = Category::query();
		$search_query = $request->input('search_query');
		if ($request->has('search_query') && !empty($search_query)) {
			$query->where(function ($query) use ($search_query) {
				$query->where('name', 'like', '%' . $search_query . '%');
			});
		}
		$data['categories'] = $query->orderBy('id', 'DESC')->paginate(50);
		$data['searchParams'] = $request->all();
		return view('admin/categories/categories', $data);
	}
	public function create()
	{
		return view('admin/categories/add_category');
	}
	public function store(Request $request)
	{
		$data = $request->all();
		$validator = Validator::make($request->all(), [
			'name' => 'required',
		]);
		if ($validator->fails()) {
			return response()->json(array('msg' => 'lvl_error', 'response'=>$validator->errors()->all()));
		}
		$picture = '';
		if(!empty($data['picture'])){
			$image = $request->file('picture');
			$file_name = explode('.', $image->getClientOriginalName())[0];
			$picture = $file_name.'_'.time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/assets/posts_img');
			$image->move($destinationPath, $picture);
		}
		$slug = create_slug('categories', $data['name'], '');
		$query = Category::create([
			'name' => $data['name'],
			'slug' => $slug,
			'picture' => $picture,
			'created_by' => Auth()->user()->id,
			'created_at' => date('Y-m-d H:i:s')
		]);
		$response_status = $query->id;
		if($response_status > 0) {
			return response()->json(['msg' => 'success', 'response'=>'Category successfully added.']);
		} else {
			return response()->json(['msg' => 'error', 'response'=>'Something went wrong!']);
		}
	}
	public function edit($id, Request $request)
	{
		$data['category'] = Category::where('id', $id)->first();
		return view('admin/categories/edit_category', $data);
	}
	public function update(Request $request)
	{
		$data = $request->all();
		$validator = Validator::make($request->all(), [
			'name' => 'required',
		]);
		if ($validator->fails()) {
			return response()->json(array('msg' => 'lvl_error', 'response'=>$validator->errors()->all()));
		}
		if(isset($data['status'])){
			$status = "1";
		}else {
			$status = "0";
		}
		if(!empty($data['picture'])){
			$image = $request->file('picture');
			$file_name = explode('.', $image->getClientOriginalName())[0];
			$data['picture'] = $file_name.'_'.time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/assets/posts_img');
			$image->move($destinationPath, $data['picture']);
			DB::table('categories')
			->where('id', $data['id'])->update([
				'picture' => $data['picture']
			]);
		}
		$slug = create_slug('categories', $data['name'], $data['id']);
		$post_status = Category::where('id', $data['id'])->update([
			'name' => $data['name'],
			'slug' => $slug,
			'status' => $status,
			'updated_at' => date('Y-m-d H:i:s'),
			'updated_by' => Auth()->user()->id,
		]);
		if($post_status > 0) {
			return response()->json(['msg' => 'success', 'response'=>'Category successfully updated!']);
		} else {
			return response()->json(['msg' => 'error', 'response'=>'Something went wrong!']);
		}
	}
	public function destroy(Request $request)
	{
		$data = $request->all();
		$status = Category::find($data['id'])->delete();
		if($status > 0) {
			return response()->json(['msg' => 'success', 'response'=>'Category successfully deleted.']);
		} else {
			return response()->json(['msg' => 'error', 'response'=>'Something went wrong!']);
		}
	}
}
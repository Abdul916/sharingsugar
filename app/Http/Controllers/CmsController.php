<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session, Validator, DB;
use App\Models\Admin\Post;
use App\Models\Admin\Category;
use App\Models\Plans;

class CmsController extends Controller
{
    public function index()
    {
        return view('cms/contact_us');
    }
    public function send_email(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            $finalResult = response()->json(array('msg' => 'lvl_error', 'response'=>$validator->errors()->all()));
            return $finalResult;
        }
        $inserted_id = DB::table('contactus_msgs')->insertGetId([
            'name' => $data['name'],
            'email' => $data['email'],
            'message' => $data['message'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        if($inserted_id > 0) {
            $this->send_contact_email($data);
            $finalResult = response()->json(array('msg' => 'success', 'response'=>'Thank you for submitting your request we will get in touch with you shortly.'));
            return $finalResult;
        } else {
            $finalResult = response()->json(array('msg' => 'error', 'response'=>'Something went wrong.'));
            return $finalResult;
        }
    }
    public function send_contact_email($data)
    {
        $to = get_section_content('project', 'admin_email');
        $subject = 'Contact Us - ' . get_section_content('project', 'site_title');
        $email_body = view('emails/contact_email', compact("data"));
        $body = $email_body;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$data['email'].'>' . "\r\n";
        @mail($to, $subject, $body, $headers);
        return true;
    }
    public function about_us()
    {
        return view('cms/about_us');
    }
    public function faqs()
    {
        return view('cms/faqs');
    }
    public function blog(Request $request)
    {
        $data['blogs'] = Post::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('cms/blog', $data);
    }
    public function blog_detail($slug='')
    {
        if(!empty($slug)){
            $data['blog'] = Post::where('status', 1)->where('slug', $slug)->first();
            if(!empty($data['blog'])){
                return view('cms/full_blog', $data);
            }else{
                return redirect('blog');
            }
        }else{
            return redirect('blog');
        }
    }
    public function blog_category($slug='')
    {
        if(!empty($slug)){
            $data['category'] = Category::where('status', 1)->where('slug', $slug)->first();
            if(!empty($data['category'])){
                $data['blogs'] = Post::where('status', 1)->where('category_id', $data['category']['id'])->orderBy('id', 'DESC')->get();
                if(!empty($data['blogs'])){
                    return view('cms/blog', $data);
                }else{
                    return redirect('blog');
                }
            }else{
                return redirect('blog');
            }
        }else{
            return redirect('blog');
        }
    }

    public function membership()
    {
        $plans = Plans::all();
        return view('cms/membership', compact('plans'));
    }
    public function privacy_policy()
    {
        return view('cms/privacy_policy');
    }
    public function terms_of_conditions()
    {
        return view('cms/terms_of_conditions');
    }
}
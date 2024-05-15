<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Article;
use App\Models\Review;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\News;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;
use App\Models\Services;

class HomeController extends Controller
{
    public function index()
    {
        $slide = Banner::where('publish', 1)->orderBy('sort', 'asc')->get();
        // $product = Product::where('publish', 1)->orderBy('sort', 'asc')->skip(0)->take(5)->get();
        $news = News::where('publish', 1)->orderBy('sort', 'asc')->skip(0)->take(6)->get();
        $service = Services::where('publish', 1)->orderBy('sort', 'asc')->skip(0)->take(6)->get();
        $article = Article::where('publish', 1)->orderBy('sort', 'asc')->skip(0)->take(6)->get();
        // $procate = ProductCategory::where('publish', 1)->orderBy('sort', 'asc')->get();
        $reviews = Review::where('publish', 1)->orderBy('sort', 'asc')->get();

        return view('client.home', compact('slide', 'news', 'service','reviews','article'));
    }

    public function showproduct(Product $product)
    {
        $products = Product::where('publish', 1)->orderBy('created_at', 'desc')->skip(0)->take(5)->get();
        return view('client.product.show', compact('product', 'products'));
    }

    public function productall()
    {
        $product = Product::where('publish', 1)->orderBy('sort', 'asc')->get();
        return view('client.product.index', compact('product'));
    }

    public function shownews(News $news)
    {
        $rec = News::where([['publish', '=', 1], ['id', '!=', $news->id]])->skip(0)->take(5)->orderBy('created_at', 'desc')->get();
        return view('client.suppa.newsdetail', compact('news', 'rec'));
    }

    public function newsall()
    {
        $news = News::where('publish', 1)->orderBy('sort', 'asc')->get();
        return view('client.suppa.newsall', compact('news'));
    }

    public function linenotify(Request $request)
    {
        $request->validate([
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $message = [
            'name' => $request->name,
            'tel' => $request->tel,
            'remark' => $request->remark,
            'email' => $request->email,
            'subject' => $request->subject
        ];
        // $message = "\nชื่อผู้ติดต่อ : ".$request->name."\n"
        // ."อีเมล : ".$request->email."\n"
        // ."เรื่อง : ".$request->title."\n"
        // ."รายละเอียด : ".$request->subject;

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->title = $request->subject;
        $contact->data = json_encode($message);
        // dd($message);
        if($contact->save()){
            Mail::to('sittipol1123@gmail.com')->send(new \App\Mail\ContactMail(json_encode($message)));
        }

        return redirect()->back();
        // dd($message);
        // $request->validate([
        //     'g-recaptcha-response' => 'required|captcha'
        // ]);

        // $url        = 'https://notify-api.line.me/api/notify';
        // $token      = 'tZ9F2A7jNeYaGPUJztYrIYqz07mIPABvfHxAM8t0jDr';
        // $headers    = [
        //     'Content-Type: application/x-www-form-urlencoded',
        //     'Authorization: Bearer ' . $token
        // ];
        // $fields     = 'message='.$message;

        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // $result = curl_exec($ch);
        // curl_close($ch);

        // var_dump($result);
        // // $result = json_decode($result, TRUE);
        // return redirect()->back();
    }

    public function contact(){
        return view('client.suppa.contact');
    }
}

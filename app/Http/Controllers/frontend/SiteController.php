<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Product;
use App\Models\Post;
use App\Models\Brand;






class SiteController extends Controller
{
    public function index($slug = null)
    {
        if ($slug == null) {
            return $this->home();
        } else {
            $link = Link::where('slug', '=', $slug)->first();
            if ($link != NULL) {
                $type = $link->type;
                switch ($type) {
                    case 'category': {
                            return $this->product_category($slug);
                        }
                    case 'brand': {
                            return $this->product_brand($slug);
                        }
                    case 'topic': {
                            return $this->post_topic($slug);
                        }
                    case 'page': {
                            return $this->post_page($slug);
                        }
                }
            } else {
                $product = Product::where([['slug', '=', $slug], ['status', '=', 1]])->first();
                if ($product != Null) {
                    return $this->product_detail($product);
                } else {
                    $args = [
                        ['slug', '=', $slug],
                        ['status', '=', 1],
                        ['type', '=', 'post']
                    ];
                    $post = Post::where($args)->first();
                    if ($post != NULL) {
                        return $this->post_detail($post);
                    } else {
                        return $this->error_404($slug);
                    }
                }
            }
        }
    }
    #Home
    private function home()
    {
        $list_category=Category::where([['parent_id', '=', 0], ['status', '=', 1]])->get();
        return view('frontend.home', compact('list_category'));
    }
    #Product - TAT CA SAN PHAM
    public function product()
    {   $list_product=Product::where('status','=',1)->paginate(8);

        return view('frontend.product',compact('list_product'));
    }
    #Product category
    public function product_category($slug)
    {
        // return view('frontend.product_category');
        $category=Category::where([['slug', '=', $slug], ['status', '=', 1]])->first();
        if($category==null)
        {
            return $this->error_404($slug);
        }
        //
        $listcatid = array();
        array_push($listcatid, $category->id);
        $list_category1 = Category::where([['parent_id', '=', $category->id], ['status', '=', 1]])->get();
        if (count($list_category1)) {
            foreach ($list_category1 as $category1) {
                array_push($listcatid, $category1->id);
                $list_category2 = Category::where([['parent_id', '=', $category1->id], ['status', '=', 1]])->get();
if (count($list_category2)) {
                    foreach ($list_category2 as $category2) {
                        array_push($listcatid, $category2->id);
                        $list_category3=Category::where([['parent_id', '=', $category2->id], ['status', '=', 1]])->get();
                        if (count($list_category3))
                        {
                            foreach ($list_category3 as $category3)
                            {
                                array_push($listcatid, $category3->id);
                            }
                        }
                    }
                }
            }
        }
        $categoryName = $category->name;
        $list_product = Product::where('status', 1)
        ->whereIn('category_id', $listcatid)
        ->paginate(8);
        return view('frontend.product-category', compact('list_product','categoryName'));
    }
    #Product Brand
    public function product_brand($slug)
    {
        $brand=Brand::where([['slug', '=', $slug],['status', '=', 1]])->first();
        if($brand==null)
        {
            return $this->error_404($slug);
        }
        $brandName=$brand->name;
        $list_product=Product::where([['status', '=', 1], ['brand_id', '=', $brand->id]])->paginate(8);
        return view('frontend.product-brand', compact('list_product','brandName'));
    }
    #Product Detail
    public function product_detail($product)
    {
        $listcatid = array();
        array_push($listcatid, $product->category_id);
        $list_category1 = Category::where([['parent_id', '=', $product->category_id], ['status', '=', 1]])->get();
        if (count($list_category1)) {
            foreach ($list_category1 as $category1) {
                array_push($listcatid, $category1->id);
                $list_category2 = Category::where([['parent_id', '=', $category1->id], ['status', '=', 1]])->get();
                if (count($list_category2)) {
                    foreach ($list_category2 as $category2) {
                        array_push($listcatid, $category2->id);
                        $list_category3=Category::where([['parent_id', '=', $category2->id], ['status', '=', 1]])->get();
                        if (count($list_category3))
                        {
                            foreach ($list_category3 as $category3)
                            {
                                array_push($listcatid, $category3->id);
                            }
                        }
                    }
                }
            }
        }
        $list_product = Product::where([['status','=', 1], ['id', '!=', $product->id]])
        ->whereIn('category_id', $listcatid)
        ->orderBy('created_at', 'DESC')
        ->limit(8)
        ->get();
        return view('frontend.product-detail', compact('product','list_product'));
    }
    #POST
    public function post()
    {
        $list_post=Post::where('status', 1)->paginate(16);
return view('frontend.post', compact('list_post'));
    }
    #contact
    public function contact()
    {

        return view('frontend.contact');
    }
    #Post Topic
    public function post_topic($slug)
    {
        $topic=Topic::where([['slug', '=', $slug],['status', '=', 1]])->first();
        if($topic==null)
        {
            return $this->error_404($slug);
        }
        $list_post=Post::where([['topic_id', '=',$topic->id], ['status', '=','post'], ['type', '=', 'post']])->orderBy('created_at', 'DESC')
        ->limit(8)
        ->get();
        return view('frontend.post-topic', compact('list_post'));
    }
    #Post page
    private function post_page($slug)
    {
        $page=Post::where([['$slug', '=', $slug],['status', '=', 1], ['type', '=', 'page']])->first();
        if($page==null)
        {
            return $this->error_404($slug);
        }
        return view('frontend.post-page', compact('page'));
    }

    #Post Detail
    private function post_detail($postdetail, $slug)
    {
        if($postdetail==null)
        {
            return $this->error_404($slug);
        }
        $list_post=Post::where([['status', '=', 1], ['id', '!=', $postdetail], ['topic_id', '=', $postdetail->topic_id]])->orderBy('created_at', 'DESC')
        ->limit(9)
        ->get();
        return view('frontend.post-detail', compact('postdetail', 'list_post'));
    }
    #Error
    private function error_404($slug)
    {
        return view('frontend.404');
    }
}
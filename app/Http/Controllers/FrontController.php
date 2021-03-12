<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Service;
use App\Models\SubService;
use App\Models\Featured;
use App\Models\Portfolio;
use App\Models\Review;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class FrontController extends Controller
{
    public function view(Request $request, $page='home') 
    {
        $data['page_title'] = Str::ucfirst(str_replace('-', ' ', $page));
        $page_filename = str_replace(' ', '', Str::title(str_replace('-', ' ', $page)));

        $data['breadcrumb'] = [
            [
                'name' => $data['page_title'],
                'active' => true
            ]
        ];

        if ($page == 'home') {
            $data['page_title'] = 'Web & Mobile Development, and SEO Agency - iDesignUX';
            $data['featured_portfolios'] = Featured ::portfolios('images', 'metadatas');
            $data['services'] = Service::where('relation', 'parent')->with('images')->get();
            $data['portfolios'] = Portfolio::latest()->with('images')->get();
            $data['reviews'] = Review::latest()->with('image')->get();
        }


        return Inertia::render("front/$page_filename", $data);
    }

    public function service (Service $service, $subservice=null)
    {
        $page_filename = 'Category';
        $data['service'] = $service->load('images');
        $data['page_title'] = $service->title;
        
        $data['breadcrumb'] = [
            [
                'name' => $service->title,
                'active' => is_null($subservice),
                'url' => "/services/$service->slug"
            ]
        ];

        if (!is_null($subservice)) {
            $instance = $service->subservice()->where('slug', $subservice);
            if (!$instance->exists()) {
                abort(404);
            }
            $sub = $instance->first();
            $data['subservice'] = $sub->load('metadatas', 'deliverables', 'images');
            $data['processes'] = $sub->processes()->with('image')->get();
            $data['portfolios'] = $sub->portfolios()->with('images')->get();
            $data['page_title'] = $sub->title;
            array_push($data['breadcrumb'], [
                'name' => $data['page_title'],
                'active' => true,
                'url' => "/services/{$service->slug}/{$data['subservice']->slug}"
            ]);
            $page_filename = 'Detail';
        } else {
            $data['subservices'] = $service->subservice()->with('images')->get();
            $data['portfolios'] = $service->portfolios()->with('images')->get();
        }

        // dd($data['breadcrumb']);

        return Inertia::render("front/service/$page_filename", $data);
    }

    public function blog ($slug=null)
    {
        $page_filename = "Index";
        $data['page_title'] = "Blog";
        $data['required_password'] = false;
        $data['categories'] = Category::all();
        $data['tags'] = Tag::all();

        $data['breadcrumb'] = [
            [
                'name' => $data['page_title'],
                'active' => is_null($slug),
                'url' => "/blog"
            ]
        ];

        if (!is_null($slug)) {
            $where = [['slug', '=', $slug]];
            $post = Blog::findBy($where, ['image', 'metadatas', 'tags']);

            if ($post->visibility == 'private') {
                if (! Gate::allows('view-post', $post)) { //Needs modification when 
                    abort(403);
                }
            } elseif ($post->visibility == 'password-protected') {
                $data['required_password'] = true;
            }
            
            $page_filename = 'Detail';
            $data['page_title'] = $post->title;
            $data['comments'] = $post->comments()->latest()->with('replies')->get();
            $data['author'] = $post->user()->with('image')->first();
            array_push($data['breadcrumb'], [
                'name' => $data['page_title'],
                'active' => true,
                'url' => "/service/blog/$post->title"
            ]);
            $data['post'] = $post;
            $data['related_posts'] = Blog::related($post);
        } else {
            $data['posts'] = Blog::fetch(['image', 'user', 'metadatas', 'tags']);
            // $data['tags'] = Tag::with('taggable', Blog::class)->get();
            // dd($data['tags']);
        }

        return Inertia::render("front/blog/$page_filename", $data);
    }

    public function portfolio ($slug=null) 
    {
        $page_filename = 'Index';
        $data['page_title'] = 'Porfolio';
        $data['breadcrumb'] = [
            [
                'name' => $data['page_title'],
                'active' => is_null($slug),
                'url' => "/portfolio"
            ]
        ];

        if (!is_null($slug)) {
            $portfolio = Portfolio::where('slug', $slug)->with('images', 'tags')->firstOrFail();

            $page_filename = 'Detail';
            $data['page_title'] = $portfolio->title;
            $data['portfolio'] = $portfolio;
            // $data['header_image'] = $portfolio->images()->where('data->name', 'header')->first();
            // $data['icon'] = $portfolio->images()->where('data->name', 'icon')->first();
            // $data['gallery'] = $portfolio->images()->where('data->name', 'gallery')->get();
            // dd($data['icon']);

            array_push($data['breadcrumb'], [
                'name' => $data['page_title'],
                'active' => true,
                'url' => "/service/blog/$portfolio->title"
            ]);
        } else {
            $data['portfolios'] = Portfolio::latest()->with('tags', 'images')->get();
        }

        return Inertia::render("front/portfolio/$page_filename", $data);
    }

    private function __unslug ($string)
    {
        return str_replace('-', ' ', $string);
    }
}

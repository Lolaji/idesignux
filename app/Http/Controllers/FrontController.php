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

        $page_path = base_path("resources/js/Pages/front/{$page_filename}.vue"); // Get the full path to the vue file
        abort_if( ! file_exists($page_path), 404 ); // Throw 400 not found error if the page file doesn't exist.

        $data['breadcrumb'] = [
            [
                'name' => $data['page_title'],
                'active' => true
            ]
        ];

        if ($page == 'home') {
            $data['page_title'] = 'Web & Mobile Development, and SEO Agency';
            $data['featured_portfolios'] = Featured::portfolios('images');
            $data['services'] = Service::where('relation', 'parent')->where('settings->is_published', true)->with('images')->get();
            $data['portfolios'] = Portfolio::where('settings->is_published', true)->latest()->with('images')->get();
            $data['reviews'] = Review::latest()->with('image')->get();
        }

        if ($page == 'about-us') {
            $data['reviews'] = Review::latest()->with('image')->get();
        }


        return Inertia::render("front/$page_filename", $data);
    }

    public function service (Service $service, $subservice=null)
    {
        // Make service page accessible to admin if the 
        // settings is not null and is_published is true
        $this->__makePageAccessible('view-service', $service);

        $page_filename = 'Category';
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

            // Make service page accessible to admin if the 
            // settings is not null and is_published is true
            $this->__makePageAccessible('view-service', $sub);

            $data['subservice'] = $sub->load('deliverables', 'images');
            $data['metadatas'] = $sub->metadatas()->get(['name', 'content']);
            $data['processes'] = $sub->processes()->with('image')->get();
            $data['portfolios'] = $sub->portfolios()->with('images')->get();
            $data['page_title'] = "$sub->title > {$data['page_title']}";
            array_push($data['breadcrumb'], [
                'name' => $sub->title,
                'active' => true,
                'url' => "/services/{$service->slug}/{$data['subservice']->slug}"
            ]);
            $page_filename = 'Detail';
        } else {
            $data['service'] = $service->load('images');
            $data['subservices'] = $service->subservice()->where('settings->is_published', true)->with('images')->get();
            $data['metadatas'] = $service->metadatas()->get(['name', 'content']);

            if (!is_null($service->settings) && $service->settings->show_content)
                $data['deliverables'] = $service->deliverables;

            if (!is_null($service->settings) && $service->settings->show_process)
                $data['processes'] = $service->processes()->with('image')->get();
            
            if (!is_null($service->settings) && $service->settings->show_portfolio)
                $data['portfolios'] = $service->portfolios()->where('settings->is_published', true)->with('images')->get();
        }

        // dd($data['breadcrumb']);

        return Inertia::render("front/service/$page_filename", $data);
    }

    public function blog ($slug=null)
    {
        $page_filename = "Index";
        $data['page_title'] = "Blog";
        $data['metadatas'] = [
            [
                'name' => 'keywords', 
                'content' => 'blog, post, IT blog post, IT blog, IT post, technologies post, technologies post, new technologies post, new technologies post, latest technologies post, latest technologies post'
            ],
            [
                'name' => 'description',
                'content' => 'Read about latest technologies.'
            ]
        ];
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
            $post = Blog::findBy($where, ['image', 'tags']);

            if ($post->visibility == 'private') {
                if (! Gate::allows('view-post', $post)) { //Needs modification when 
                    abort(500);
                }
            } elseif ($post->visibility == 'password-protected') {
                $data['required_password'] = true;
            }
            
            $page_filename = 'Detail';
            $data['page_title'] = $post->title;
            $data['metadatas'] = $post->metadatas()->get(['name', 'content']);
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
        $data['page_title'] = 'Portfolio';
        $data['metadatas'] = [
            [
                'name' => 'keywords', 
                'content' => 'portfolios, idesignux portfolios, idesignux case-study, IT case study, project portfolios, website design portfolios, website design case study, custom website development portfolios, custom website development case study, '],
        ];
        $data['breadcrumb'] = [
            [
                'name' => $data['page_title'],
                'active' => is_null($slug),
                'url' => "/portfolio"
            ]
        ];

        if (!is_null($slug)) {
            $portfolio = Portfolio::where('slug', $slug)->with('images', 'tags')->firstOrFail();

            // Make portfolio page accessible to admin if the 
            // settings is not null and is_published is true
            $this->__makePageAccessible('view-portfolio', $portfolio);

            $page_filename = 'Detail';
            $data['page_title'] = $portfolio->title;
            $data['metadatas'] = $portfolio->metadatas()->get(['name', 'content']);
            $data['portfolio'] = $portfolio;

            array_push($data['breadcrumb'], [
                'name' => $data['page_title'],
                'active' => true,
                'url' => "/service/blog/$portfolio->title"
            ]);
        } else {
            $data['portfolios'] = Portfolio::where('settings->is_published', true)->latest()->with('tags', 'images')->get();
        }

        return Inertia::render("front/portfolio/$page_filename", $data);
    }

    private function __unslug ($string)
    {
        return str_replace('-', ' ', $string);
    }

    /**
     * Restrict page access if not published based 
     * on the model provided by checking its settings column
     * 
     * @param $action: gate action like "view-post"
     * @param $model: model to check against
     * 
     * @return 403 error or pass the check
     * 
     */
    private function __makePageAccessible($action, $model)
    {
        if (!is_null($model->settings)) {
            if (!$model->settings->is_published) {
                abort_if(!Gate::allows($action, $model), 404);
            }
        } else {
            abort_if(!Gate::allows($action, $model), 404);
        }
    }

}

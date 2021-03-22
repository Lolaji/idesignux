<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Featured;
use App\Models\MailingList;
use App\Models\Portfolio;
use App\Models\Review;
use App\Models\Service;
use App\Models\SubService;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function view($page='dashboard')
    {
        $page_filename =  str_replace(' ', '', ucwords(str_replace(['_', '-'], ' ', $page)));
        $data['page_title'] = ucwords(str_replace(['_', '-'], ' ', $page));
        if ($page=='mailing_list') {
            $data['mailing_list'] = MailingList::latest()->get();
        }

        if ($page=='review') {
            $data['reviews'] = Review::latest()->with('image')->get();
        }
        return Inertia::render("admin/$page_filename", $data);
    }

    public function auth (Request $request)
    {
        return Inertia::render('admin/auth/Login');
    }

    public function service (Request $request, $service=null, $subservice=null) 
    {
        $data['page_title'] = "Services";
        $page_filename = 'Index';
        if (!is_null($service)) {
            $data['is_sub_service'] = false;
            if (!is_null($subservice)) {
                $data['is_sub_service'] = true;
                $data['service_id'] = $service;
                if ($subservice == 'create'){
                    $data['page_title'] = "Add Sub-Service";
                    $page_filename = "Create";
                } else if(is_numeric($subservice)) {
                    $data['service'] = Service::findOrFail($subservice)->load('metadatas', 'deliverables', 'processes', 'images', 'portfolios');
                    $data['page_title'] = "{$data['service']->title} Sub-Service";
                    $page_filename = "Detail";
                } else {
                    abort('404');
                }
            } else {
                if ($service == 'create') {
                    $data['page_title'] = "Create New Service";
                    $page_filename = 'Create';
                } else if(is_numeric($service)){
                    $service_found = Service::findOrFail($service);
                    $data['page_title'] = "$service_found->title Service";
                    $data['service'] = $service_found->load('metadatas', 'deliverables', 'processes', 'images', 'portfolios');
                    $data['sub_services'] = $service_found->subservice;
                    $page_filename = "Detail";
                } else {
                    abort('404');
                }
            }
        } else {
            // $subservice = Arr::flatten(SubService::select('sub_service_id')->get()->toArray());
            $data['services'] = Service::where('relation', 'parent')->get();
        }

        return Inertia::render("admin/service/$page_filename", $data);
    }

    public function portfolio (Request $request, $portfolio=null)
    {
        $page_filename = 'Index';

        $data['page_title'] = "Portfolios";
        $data['portfolios'] = Portfolio::latest()->with('feature')->get();
        $data['features'] = Featured::query()->with('featurable', function (MorphTo $morphTo) {
            $morphTo->morphWith([
                Portfolio::class => ['images']
            ]);
        })->get();

        // dd($data['features']);

        if (!is_null($portfolio)){
            if ($portfolio == 'create'){
                $page_filename = 'Create';
                $data['page_title'] = "Add Porfolio";
            } else {
                $page_filename = "Detail";
                $data['page_title'] = "Portfolio Detail";
                $data['portfolio'] = Portfolio::findOrFail($portfolio)->load('metadatas', 'images');
            }
        }

        return Inertia::render("admin/portfolio/$page_filename", $data);
    }

    public function contact (Request $request, Contact $contact=null)
    {
        $page_filename = 'Index';
        $data['page_title'] = 'Contacts';
        $data['contacts'] = Contact::latest()->get();

        return Inertia::render("admin/contact/$page_filename", $data);
    }

    public function post (Request $request, $post=null)
    {
        $page_filename = 'Index';

        $data['page_title'] = "Posts";
        $data['user_id'] = (int) Auth::user()->id;

        if (!is_null($post)){
            $data['categories'] = Category::all();
            $data['tags'] = Tag::all();
            if ($post == 'create') {
                $page_filename = 'Create';
                $data['page_title'] = "Add Post";
            } else {
                $page_filename = "Detail";
                $data['page_title'] = "Post Detail";
                $data['post'] = Blog::findOrFail($post)->load('metadatas', 'category', 'tags', 'image');
            }
        } else {
            $data['posts'] = Blog::latest()->get();
        }

        return Inertia::render("admin/blog/$page_filename", $data);
    }

    public function taxonomies ()
    {
        $data['page_title'] = 'Taxonomies';
        $data['categories'] = Category::latest()->get();
        $data['tags'] = Tag::latest()->get();
        return Inertia::render('admin/taxonomy/Index', $data);
    }
}

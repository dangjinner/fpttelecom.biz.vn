<?php

namespace Themes\Fpt\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use HoangPhi\VietnamMap\Models\Ward;
use Illuminate\Http\Request;
use Modules\Core\Entities\District;
use Modules\FptService\Emails\SendRegistedCustomerDataMail;
use Modules\FptService\Entities\FptCategory;
use Modules\FptService\Entities\FptService;
use Modules\FptService\Entities\FptServiceCustomer;
use Modules\FptService\Jobs\SendRegistedCustomerDataJob;
use Modules\Group\Entities\Group;
use Modules\Page\Entities\Page;
use Modules\Post\Entities\Post;
use Modules\Province\Entities\Province;
use Modules\Slider\Entities\Slider;
use Themes\Fpt\Http\Requests\RegisterFptServiceRequest;

class HomeController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEOMeta::setTitle(setting('fpt_home_meta_title'));
        SEOMeta::setDescription(setting('fpt_home_meta_description'));
        SEOMeta::addKeyword(setting('fpt_home_meta_keyword'));
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::twitter()->setSite(route('home'));

        $posts = Post::latest()->limit(8)->get();
        return view('public.home.' . setting('home_switcher'), [
            'posts' => $posts,
        ]);
    }

    /**
     * @param Request $request
     * @param $slug
     * @return mixed
     */
    public function fptCategory(Request $request, $slug)
    {
        $fptCategory = FptCategory::where('slug', $slug)
            ->where('is_searchable', true)
            ->first();

        if (!$fptCategory) {
            return $this->fptNewsDetails($slug);
        }

        SEOMeta::setTitle($fptCategory->meta->meta_title ?? $fptCategory->name);
        SEOMeta::setDescription($fptCategory->meta->meta_description ?? $fptCategory->description);
        SEOMeta::addKeyword($fptCategory->meta->meta_keyword);
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::twitter()->setSite(route('home'));

        if (!$fptCategory->parent_id && count($fptCategory->children) > 0) {
            $fptCategory = $fptCategory->children[0];
            return redirect()->route('fpt.services.category', ['slug' => $fptCategory->slug]);
        }

        $fptCategories = [];

        if ($fptCategory->parent) {
            $fptCategories = $fptCategory->parent->children()
                ->where('is_searchable', true)
                ->get();
        }

        return view('public.services.category', compact(
                'fptCategory',
                'fptCategories')
        );
    }

    public function fptNews(Request $request)
    {
        SEOMeta::setTitle(setting('fpt_news_meta_title') ?? 'Tin tức');
        SEOMeta::setDescription(setting('fpt_news_meta_description'));
        SEOMeta::addKeyword(setting('fpt_news_meta_description'));
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::twitter()->setSite(route('home'));

        $posts = Post::latest()->paginate(10);
        $banner = Slider::findWithSlides(setting('home_page_banner'));
        $groups = Group::searchable()
            ->isParent()
            ->get();

        return view('public.news.index', compact('posts', 'banner', 'groups'));
    }

    public function fptNewsCategory($slug)
    {
        $currentGroup = Group::where('slug', $slug)->firstOrFail();

        SEOMeta::setTitle($currentGroup->meta->meta_title ?? $currentGroup->name);
        SEOMeta::setDescription($currentGroup->meta->meta_description);
        SEOMeta::addKeyword($currentGroup->meta->meta_keyword);
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::twitter()->setSite(route('home'));

        $posts = $currentGroup->posts()->latest()->paginate(10);
        $banner = Slider::findWithSlides(setting('home_page_banner'));
        $groups = $currentGroup->children;

        return view('public.news.index', compact('posts', 'banner', 'currentGroup', 'groups'));
    }

    public function fptNewsDetails($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if (empty($post)) {
            return $this->pageDetails($slug);
        }

        SEOMeta::setTitle($post->meta->meta_title ?? $post->name);
        SEOMeta::setDescription($post->meta->meta_description);
        SEOMeta::addKeyword($post->meta->meta_keyword);
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::twitter()->setSite(route('home'));

        $banner = Slider::findWithSlides(setting('home_page_banner'));
        $group = $post->groups->first();
        $otherPosts = Post::latest()
            ->whereNotIn('id', [$post->id])
            ->limit(8)->get();

        return view('public.news.details', compact('post', 'banner', 'group', 'otherPosts'));
    }

    public function pageDetails($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        SEOMeta::setTitle($page->meta->meta_title ?? $page->name);
        SEOMeta::setDescription($page->meta->meta_description);
        SEOMeta::addKeyword($page->meta->meta_keyword);
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::twitter()->setSite(route('home'));

        return view('public.pages.show', compact('page'));
    }

    public function registerService(Request $request)
    {
        SEOMeta::setTitle('Đăng ký thông tin');

        $fptService = FptService::where('slug', $request->get('service'))->first();
        $provinces = Province::all();
        $selectedService = FptService::where('slug', $request->get('service'))->first();
        return view('public.services.register', compact('fptService', 'provinces', 'selectedService'));
    }

    public function postRegisterService(RegisterFptServiceRequest $request)
    {
        $data = $request->only(
            'name',
            'phone_number',
            'home_address',
            'property_type',
            'apartment_name',
            'building_name',
            'floor_number',
            'room_number',
            'note',
            'province_id',
            'district_id',
            'ward_id'
        );

        $fptService = FptService::where('slug', $request->get('service_slug'))->first();

        $fptServiceCustomer = FptServiceCustomer::create(array_merge($data, [
            'fpt_service_id' => $fptService ? $fptService->id : 0 ,
        ]));

        SendRegistedCustomerDataJob::dispatch($fptServiceCustomer);

        return redirect()->route('fpt.register.completed');
    }

    public function registerCompleted(Request $request)
    {
        SEOMeta::setTitle('Đăng ký thành công!');
        return view('public.services.register_completed');
    }

    public function fptDistricts($provinceId)
    {
        $districts = District::where('province_id', $provinceId)->get();
        return response()->json($districts);
    }

    public function fptWards($provinceId, $districtId)
    {
        $wards = Ward::where('district_id', $districtId)->get();
        return response()->json($wards);
    }
}


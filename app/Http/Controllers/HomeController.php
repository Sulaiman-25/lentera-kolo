<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\TitipTulisan;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Display the homepage with latest news and titip tulisan
     */
    public function index()
    {
        // Data dari News
        $latestNews = News::where('status', 'Accept')->latest()->take(10)->get();
        $topNews = News::where('status', 'Accept')->orderBy('views', 'desc')->take(10)->get();
        $popularNews = News::where('status', 'Accept')
            ->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->take(10)
            ->get();

        // Data dari TitipTulisan
        $latestTitip = TitipTulisan::where('status', 'Accept')->latest()->take(10)->get();
        $popularTitip = TitipTulisan::where('status', 'Accept')
            ->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->take(10)
            ->get();

        // Gabungkan data untuk beberapa bagian
        $allLatest = $latestNews->merge($latestTitip)->take(10);
        $allPopular = $popularNews->merge($popularTitip)->take(10);

        // Kategori populer
        $topCategory = Category::orderBy('views', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('home', compact(
            'latestNews',
            'topNews',
            'popularNews',
            'latestTitip',
            'popularTitip',
            'allLatest',
            'allPopular',
            'topCategory'
        ));
    }

    /**
     * Display the specified news article
     */
    public function show(News $news)
    {
        // Check if news is accepted
        if ($news->status !== 'Accept') {
            abort(404);
        }

        // Get random related news
        $randomNews = News::where('status', 'Accept')
            ->where('id', '!=', $news->id)
            ->where('category_id', $news->category_id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        // If not enough related news, get any random news
        if ($randomNews->count() < 3) {
            $additionalNews = News::where('status', 'Accept')
                ->where('id', '!=', $news->id)
                ->whereNotIn('id', $randomNews->pluck('id'))
                ->inRandomOrder()
                ->take(3 - $randomNews->count())
                ->get();
            $randomNews = $randomNews->merge($additionalNews);
        }

        // Increment views
        $news->increment('views');

        return view('news.show', compact('news', 'randomNews'));
    }

    /**
     * View news by category
     */
    public function viewCategory(Category $categories)
    {
        // Get news from this category with pagination
        $latestNews = $categories->news()
            ->where('status', 'Accept')
            ->latest()
            ->paginate(12, ['*'], 'news_page');

        $topNews = $categories->news()
            ->where('status', 'Accept')
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        $popularNews = $categories->news()
            ->where('status', 'Accept')
            ->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->take(5)
            ->get();

        // Get titip tulisan from this category with pagination
        $latestTitip = $categories->titipTulisans()
            ->where('status', 'Accept')
            ->latest()
            ->paginate(12, ['*'], 'titip_page');

        // Get popular titip tulisan
        $popularTitip = $categories->titipTulisans()
            ->where('status', 'Accept')
            ->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->take(5)
            ->get();

        // Get other categories for sidebar
        $otherCategories = Category::where('id', '!=', $categories->id)
            ->orderBy('views', 'desc')
            ->take(6)
            ->get();

        // Increment category views
        $categories->increment('views');

        return view('viewCategory', compact(
            'categories',
            'latestNews',
            'topNews',
            'popularNews',
            'latestTitip',
            'popularTitip',
            'otherCategories'
        ));
    }

    /**
     * Search news and titip tulisan
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return redirect()->route('index');
        }

        // Search news
        $newsResults = News::where('status', 'Accept')
            ->where(function($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('content', 'like', '%' . $query . '%');
            })
            ->latest()
            ->get();

        // Search titip tulisan
        $titipResults = TitipTulisan::where('status', 'Accept')
            ->where(function($q) use ($query) {
                $q->where('judul', 'like', '%' . $query . '%')
                  ->orWhere('isi', 'like', '%' . $query . '%');
            })
            ->latest()
            ->get();

        return view('search', compact('query', 'newsResults', 'titipResults'));
    }

    /**
     * Get trending news (most viewed in last 7 days)
     */
    public function trending()
    {
        $trendingNews = News::where('status', 'Accept')
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('views', 'desc')
            ->take(10)
            ->get();

        return view('trending', compact('trendingNews'));
    }
}

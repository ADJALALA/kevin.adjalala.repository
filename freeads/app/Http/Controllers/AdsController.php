<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model;
use App\Models\User;
use App\Models\Ads;
use App\Models\Category;


class AdsController extends Controller
{
    /**
     * get all ads in database.
     */
    public function index(Request $request)
    {
        $ads = Ads::query();
        $categories = Category::all();

        //Recherche texte (par titre ou description)
        if ($request->filled('q')) {
            $search = $request->input('q');
            $ads->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        //Filtre par catégorie
        if ($request->filled('category_id')) {
            $ads->where('category_id', $request->category_id);
        }

        //Filtre par localisation
        if ($request->filled('location')) {
            $ads->where('location', 'like', "%{$request->location}%");
        }

        //Filtre par prix min/max
        if ($request->filled('price_min')) {
            $ads->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $ads->where('price', '<=', $request->price_max);
        }

        //Filtre par ancienneté (date de création)
        if ($request->filled('date')) {
            switch ($request->date) {
                case 'today':
                    $ads->whereDate('created_at', today());
                    break;
                case 'week':
                    $ads->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $ads->whereMonth('created_at', now()->month);
                    break;
            }
        }

        // Pagination
        $ads = $ads->latest()->paginate(6);

        //return view('ads.index', compact('ads'));
        return view('index', [
            'ads'=>$ads,
            'categories'=>$categories,
        ]);
    }

    public function detail(Ads $ad)
    {
        return view('adsdetail', compact('ad'));
    }

    public function dashboard()
    {
        $user_id = auth()->user()->id;

        // Comptage des annonces par mois pour l'utilisateur connecté
        $adsByMonth = Ads::where('user_id', $user_id)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        // Labels et valeurs pour le graphique
        $months = ['Jan', 'Fév', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
        $totals = [];

        foreach (range(1, 12) as $m) {
            $totals[] = $adsByMonth[$m] ?? 0;
        }

        $page = "Dashboard";
        $email = auth()->user()->email;

        return view('ads.dashboard', compact('months', 'totals','page', 'email'));
    }


    /**
     * Create new ads.
     */
    public function create()
    {
        $categories = Category::all();
        $email = auth()->user()->email;

        return view('ads.createAd', [
            'categories' => $categories,
            'page'=> "Create Article",
            "email"=>$email,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());

        //Verifier si un user est connecté et get son instance
        if(auth()->check()){

            //Validate all element xend by form
            $validated = $request->validate([
                'title'=> 'required',
                'description'=> 'required',
                'price'=> 'required',
                'location'=> 'required',
                'image'=> 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category_id' => 'required|exists:categories,id',
            ]);

            //$user = User::factory()->create();
            $imagePath = $request->file('image')->store('ads', 'public');
            //$validated['image'] = $imagePath;

            $user = auth()->user();

            Ads::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
            'location' => $request->location,
            'user_id' => $user->id,
            "image" => $imagePath,
            ]);

            return redirect()->route('ads.listeAds');
        } else {
            return redirect()->route('login')->with('error', 'Please log in.');
        }

    }


    /**
     * Display elements for authenticate user.
     */
    public function show(Ads $ads)
    {
        if(auth()->check()){
            $user = auth()->user()->with('ads');
            $userAds = auth()->user()->ads;

            $email = auth()->user()->email;
            return view('ads.listeAds', [
                'userAds'=>$userAds,
                'page'=> "Article List",
                'email'=>$email,
            ]);
        } else{
            return redirect()->route('login')->with('error', 'Please log in.');
        }
    }


    /**
     * Show the form for editing for ads.
     */
    public function edit(Ads $ad)
    {
        $categories = Category::all();
        $email = auth()->user()->email;

        return view('ads.editAd', [
            'ad' => $ad,
            'categories' => $categories,
            'page'=>"Edit Article",
            'email'=>$email,
        ]);
    }

    /**
     * Update the specified ads.
     */
    public function update(Request $request, Ads $ad)
    {
        if(auth()->check()){
            $validated = $request->validate([
                'title'=> 'required',
                'description'=> 'required',
                'price'=> 'required',
                'location'=> 'required',
                'image'=> 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'category_id' => 'required|exists:categories,id',
            ]);
            // $imagePath = $request->file('image')->store('ads', 'public');
            // $validated['image'] = $imagePath;

            if ($request->hasFile('image')) {
                $request->validate([ 'image'=> 'image|mimes:jpeg,png,jpg,gif|max:2048']);
                $imagePath = $request->file('image')->store('ads', 'public');
                $validated['image'] = $imagePath;
            } else {
                $validated['image'] = $ad->image;
            }

            $ad->update($validated);

            return redirect()->route('ads.listeAds')->with('success', 'Article Successfully Modified');
        } else{
            return redirect()->route('login')->with('error', 'Please log in.');
        }
    }

    /**
     * Remove the specified ads.
     */
    public function destroy(Ads $ad)
    {
        if(auth()->check()){
            $ad->delete();

            //return redirect()->route('books.index');
            return to_route('ads.listeAds');
        } else{
            return redirect()->route('login')->with('error', 'Please log in.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RealtorListingController extends Controller
{
    public function index(Request $request)
    {
//        Gate::authorize('view', Listing::class);
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by','order']),
        ];
        return inertia('Realtor/Index',

            [   'filters' => $filters,
                'listings'=> Auth::user()
                    ->listings()
                    ->filter($filters)
                    ->withCount('images')
                    ->withCount('offers')
                    ->paginate(4)
                    ->withQueryString(),
        ]);
    }


    public function show(Listing $listing)
    {
        Gate::authorize('view', $listing);
        return inertia('Realtor/Show', // offer.bidder - мы вытягиваем ещё тех людей кто сделал уже offer
            ['listing' => $listing->load('offers','offers.bidder')]
        );
    }


    public function create()
    {
        Gate::authorize('create', Listing::class);
        return inertia('Realtor/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // user() - возвращает текущего пользователя
        // listings() наш метод , что у каждого listings будет свой пользователь
        $request->user()->listings()->create(

            $request->validate([
                'beds' => ['required','integer','min:0','max:15'],
                'baths' => ['required','integer','min:0','max:15'],
                'area' => ['required','integer','min:15','max:1500'],
                'city' => ['required'],
                'code' => ['required'],
                'street' => ['required'],
                'street_nr' => ['required','min:1','max:1000'],
                'price' => ['required','integer','min:0','max:20000000'],
            ])
        );

        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing successfully created.');

    }





    public function edit(Listing $listing)
    {
        Gate::authorize('update', $listing);
        return inertia('Realtor/Edit',
            [
                'listing' => $listing,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        Gate::authorize('update', $listing);
        $listing->update(
            $request->validate([
                'beds' => ['required','integer','min:0','max:15'],
                'baths' => ['required','integer','min:0','max:15'],
                'area' => ['required','integer','min:15','max:1500'],
                'city' => ['required'],
                'code' => ['required'],
                'street' => ['required'],
                'street_nr' => ['required','min:1','max:1000'],
                'price' => ['required','integer','min:0','max:20000000'],
            ])
        );

        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing  CHANGED.');
    }

    public function destroy(Listing $listing)
    {
        Gate::authorize('delete', $listing);
        $listing->deleteOrFail();
        return redirect()->route('realtor.listing.index')->with('success', 'Listing deleted.');
    }

    public function restore(Listing $listing)
    {
        $listing->restore();

        return redirect()->back()->with('success', 'Listing was restored!');
    }

}

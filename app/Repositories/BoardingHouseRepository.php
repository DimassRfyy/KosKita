<?php

namespace App\Repositories;

use App\Interfaces\BoardingHouseRepositoryInterface;
use App\Models\BoardingHouse;
use App\Models\Room;

class BoardingHouseRepository implements BoardingHouseRepositoryInterface
{
    public function getAllBoardingHouses($search = null, $city = null, $category = null) {
       
        $query = BoardingHouse::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
        }

        if ($city) {
            $query->whereHas('city', function($query) use ($city) {
                $query->where('slug', $city);
            });
        }

        if ($category) {
            $query->whereHas('category', function($query) use ($category) {
                $query->where('slug', $category);
            });
        }

        return $query->with(['category','city'])->get();
    }

    public function getPopularBoardingHouses($limit = 5) {

        return BoardingHouse::withCount('transactions')->orderBy('transactions_count', 'desc')->with(['category','city'])->take($limit)->get();
    }

    public function getBoardingHouseByCitySlug($slug) {
       
        return BoardingHouse::whereHas('city', function($query) use ($slug) {
            $query->where('slug', $slug);
        })->with('category')->get();
    }
    public function getBoardingHouseByCategorySlug($slug) {
       
        return BoardingHouse::whereHas('category', function($query) use ($slug) {
            $query->where('slug', $slug);
        })->with('city')->get();
    }

    public function getBoardingHouseBySlug($slug) {
        
        return BoardingHouse::where('slug', $slug)->with([
            'city',
            'category',
            'bonuses',
            'testimonials',
            'contacts',
            'facilities',
        ])->first();
    }

    public function getBoardingHouseRoomById($id) {
        return Room::find($id);
    }

    public function findBoardingHouses($name, $citySlug, $categorySlug)
    {
        return BoardingHouse::query()
            ->when($name, function ($query, $name) {
                $query->where('name', 'like', '%' . $name . '%');
            })
            ->when($citySlug, function ($query, $citySlug) {
                $query->whereHas('city', function ($query) use ($citySlug) {
                    $query->where('slug', $citySlug);
                });
            })
            ->when($categorySlug, function ($query, $categorySlug) {
                $query->whereHas('category', function ($query) use ($categorySlug) {
                    $query->where('slug', $categorySlug);
                });
            })
            ->with(['category','city'])
            ->get();
    }
}

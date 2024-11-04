<?php

namespace App\Http\Controllers;

use App\Interfaces\BoardingHouseRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\CityRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private CityRepositoryInterface $cityRepository;
    private CategoryRepositoryInterface $categoryRepository;
    private BoardingHouseRepositoryInterface $boardingHouseRepository;

    public function __construct(
        CityRepositoryInterface $cityRepository,
        CategoryRepositoryInterface $categoryRepository,
        BoardingHouseRepositoryInterface $boardingHouseRepository,
    ) {
        $this->cityRepository = $cityRepository;
        $this->categoryRepository = $categoryRepository;
        $this->boardingHouseRepository = $boardingHouseRepository;
    }

    public function index() {
        $categories = $this->categoryRepository->getAllCategories();
        $popularBoardingHouses = $this->boardingHouseRepository->getPopularBoardingHouses();
        $cities = $this->cityRepository->getAllCities();
        $boardingHouses = $this->boardingHouseRepository->getAllBoardingHouses();
        return view('pages.home', compact('categories','popularBoardingHouses','cities','boardingHouses'));
    }

    public function kosByCategory($slug) {
        $category = $this->categoryRepository->getBoardingHouseByCategorySlug($slug);
        $boardingHouses = $this->boardingHouseRepository->getBoardingHouseByCategorySlug($slug);
        return view('pages.kosByCategory', compact('boardingHouses','category'));
    }

    public function kosByCity($slug) {
        $city = $this->cityRepository->getBoardingHouseByCitySlug($slug);
        $boardingHouses = $this->boardingHouseRepository->getBoardingHouseByCitySlug($slug);
        return view('pages.kosByCity', compact('boardingHouses','city'));
    }

    public function check() {
        return view('pages.check_booking');
    }

    public function find() {
        $categories = $this->categoryRepository->getAllCategories();
        $cities = $this->cityRepository->getAllCities();
        return view('pages.find', compact('categories','cities'));
    }

    public function details($slug) {
        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseBySlug($slug);
        return view('pages.details', compact('boardingHouse'));
    }
}

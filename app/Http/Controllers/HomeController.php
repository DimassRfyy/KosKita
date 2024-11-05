<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerInformationRequest;
use App\Interfaces\BoardingHouseRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\TransactionRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private CityRepositoryInterface $cityRepository;
    private CategoryRepositoryInterface $categoryRepository;
    private BoardingHouseRepositoryInterface $boardingHouseRepository;
    private TransactionRepositoryInterface $transactionRepository;

    public function __construct(
        CityRepositoryInterface $cityRepository,
        CategoryRepositoryInterface $categoryRepository,
        BoardingHouseRepositoryInterface $boardingHouseRepository,
        TransactionRepositoryInterface $transactionRepository,
    ) {
        $this->cityRepository = $cityRepository;
        $this->categoryRepository = $categoryRepository;
        $this->boardingHouseRepository = $boardingHouseRepository;
        $this->transactionRepository = $transactionRepository;
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

    public function rooms($slug) {
        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseBySlug($slug);
        return view('pages.rooms', compact('boardingHouse'));
    }

    public function booking(Request $request, $slug) {
        $this->transactionRepository->saveTransactionDataToSession($request->all());

        return redirect()->route('information', $slug);
    }

    public function information($slug) {

        $transaction = $this->transactionRepository->getTransactionDataFromSession();
        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseBySlug($slug);
        $room = $this->boardingHouseRepository->getBoardingHouseRoomById($transaction['room_id']);
        return view('pages.information', compact('transaction','boardingHouse','room'));
    }

    public function information_save(CustomerInformationRequest $request, $slug) {
        $data = $request->validated();

        $this->transactionRepository->saveTransactionDataToSession($data);

        return redirect()->route('checkout', $slug);
    }

    public function checkout($slug) {
        $transaction = $this->transactionRepository->getTransactionDataFromSession();
        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseBySlug($slug);
        $room = $this->boardingHouseRepository->getBoardingHouseRoomById($transaction['room_id']);
        return view('pages.checkout', compact('transaction','boardingHouse','room'));
    }

    public function payment(Request $request) {
        $this->transactionRepository->saveTransactionDataToSession($request->all());

        $transaction = $this->transactionRepository->saveTransaction($this->transactionRepository->getTransactionDataFromSession());
        dd($transaction);
    }
}

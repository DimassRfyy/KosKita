@extends('layouts.app')
@section('content')
<div id="ForegroundFade"
class="absolute top-0 w-full h-[143px] bg-[linear-gradient(180deg,#070707_0%,rgba(7,7,7,0)_100%)] z-10">
</div>
<div id="TopNavAbsolute" class="absolute top-[60px] flex items-center justify-between w-full px-5 z-10">
<a href="{{ route('index') }}"
    class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-white/10 backdrop-blur-sm">
    <img src="{{ asset('assets/images/icons/arrow-left-transparent.svg') }}" class="w-8 h-8" alt="icon">
</a>
<p class="font-semibold text-white">Details</p>
<button
    class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-white/10 backdrop-blur-sm">
    <img src="{{ asset('assets/images/icons/like.svg') }}" class="w-[26px] h-[26px]" alt="">
</button>
</div>
<div id="Gallery" class="swiper-gallery w-full overflow-x-hidden -mb-[38px]">
<div class="swiper-wrapper">
   @foreach ($boardingHouse->rooms as $room)
        @foreach ($room->images as $image)
            <div class="swiper-slide !w-fit">
            <div class="flex shrink-0 w-[320px] h-[430px] overflow-hidden">
                <img src="{{ Storage::url($image->image) }}" class="w-full h-full object-cover"
                    alt="gallery thumbnails">
            </div>
            </div>
        @endforeach
   @endforeach
</div>
</div>
<main id="Details" class="relative flex flex-col rounded-t-[40px] py-5 pb-[10px] gap-4 bg-white z-10">
<div id="Title" class="flex items-center justify-between gap-2 px-5">
    <h1 class="font-bold text-[22px] leading-[33px]">{{ $boardingHouse->name }}</h1>
    <div
        class="flex flex-col items-center text-center shrink-0 rounded-[22px] border border-[#F1F2F6] p-[10px_20px] gap-2 bg-white">
        <img src="{{ asset('assets/images/icons/star.svg') }}" class="w-6 h-6" alt="icon">
        <p class="font-bold text-sm">4/5</p>
    </div>
</div>
<hr class="border-[#F1F2F6] mx-5">
<div id="Features" class="grid grid-cols-2 gap-x-[10px] gap-y-4 px-5">
    <div class="flex items-center gap-[6px]">
        <img src="{{ asset('assets/images/icons/location.svg') }}" class="w-[26px] h-[26px] flex shrink-0" alt="icon">
        <p class="text-ngekos-grey">{{ $boardingHouse->city->name }}</p>
    </div>
    <div class="flex items-center gap-[6px]">
        <img src="{{ asset('assets/images/icons/3dcube.svg') }}" class="w-[26px] h-[26px] flex shrink-0" alt="icon">
        <p class="text-ngekos-grey">{{ $boardingHouse->category->name }}</p>
    </div>
    <div class="flex items-center gap-[6px]">
        <img src="{{ asset('assets/images/icons/profile-2user.svg') }}" class="w-[26px] h-[26px] flex shrink-0" alt="icon">
        <p class="text-ngekos-grey"> Max 4 People</p>
    </div>
    <div class="flex items-center gap-[6px]">
        <img src="{{ asset('assets/images/icons/shield-tick.svg') }}" class="w-[26px] h-[26px] flex shrink-0" alt="icon">
        <p class="text-ngekos-grey">Privacy 100%</p>
    </div>
</div>
<hr class="border-[#F1F2F6] mx-5">
<div id="About" class="flex flex-col gap-[6px] px-5">
    <h2 class="font-bold">About</h2>
    <p class="leading-[30px]">{!! $boardingHouse->description !!}</p>
</div>
<div id="Tabs" class="swiper-tab w-full overflow-x-hidden">
    <div class="swiper-wrapper">
        <div class="swiper-slide !w-fit">
            <button
                class="tab-link rounded-full p-[8px_14px] border border-[#F1F2F6] text-sm font-semibold hover:bg-ngekos-black hover:text-white transition-all duration-300 !bg-ngekos-black !text-white"
                data-target-tab="#Facilities-Tab">Facilities</button>
        </div>
        <div class="swiper-slide !w-fit">
            <button
                class="tab-link rounded-full p-[8px_14px] border border-[#F1F2F6] text-sm font-semibold hover:bg-ngekos-black hover:text-white transition-all duration-300"
                data-target-tab="#Address-Tab">Address</button>
        </div>
        <div class="swiper-slide !w-fit">
            <button
                class="tab-link rounded-full p-[8px_14px] border border-[#F1F2F6] text-sm font-semibold hover:bg-ngekos-black hover:text-white transition-all duration-300"
                data-target-tab="#Bonus-Tab">Bonus</button>
        </div>
        <div class="swiper-slide !w-fit">
            <button
                class="tab-link rounded-full p-[8px_14px] border border-[#F1F2F6] text-sm font-semibold hover:bg-ngekos-black hover:text-white transition-all duration-300"
                data-target-tab="#Testimonials-Tab">Testimonials</button>
        </div>
        <div class="swiper-slide !w-fit">
            <button
                class="tab-link rounded-full p-[8px_14px] border border-[#F1F2F6] text-sm font-semibold hover:bg-ngekos-black hover:text-white transition-all duration-300"
                data-target-tab="#Rules-Tab">Rules</button>
        </div>
        <div class="swiper-slide !w-fit">
            <button
                class="tab-link rounded-full p-[8px_14px] border border-[#F1F2F6] text-sm font-semibold hover:bg-ngekos-black hover:text-white transition-all duration-300"
                data-target-tab="#Contact-Tab">Contact</button>
        </div>
        <div class="swiper-slide !w-fit">
            <button
                class="tab-link rounded-full p-[8px_14px] border border-[#F1F2F6] text-sm font-semibold hover:bg-ngekos-black hover:text-white transition-all duration-300"
                data-target-tab="#Rewards-Tab">Rewards</button>
        </div>
    </div>
</div>
<div id="TabsContent" class="px-5">
    <div id="Facilities-Tab" class="tab-content grid grid-cols-2 gap-3">
        @foreach ($boardingHouse->facilities as $facility)
        <div
            class="facility-card flex items-center rounded-[22px] border border-[#F1F2F6] p-[10px] gap-3 hover:border-[#91BF77] transition-all duration-300">
            <div class="flex w-[30px] h-[30px] shrink-0 overflow-hidden">
                <img src="{{ Storage::url($facility->icon) }}" class="w-full h-full max-w-[30px] max-h-[30px] object-cover" alt="WiFi">
            </div>
            <p class="font-semibold">{{ $facility->name }}</p>
        </div>
        @endforeach
    </div>
    
    <div id="Address-Tab" class="tab-content flex flex-col gap-5 hidden">
        <div class="flex flex-col gap-3">
            <div class="rounded-[18px] overflow-hidden border border-[#F1F2F6] hover:border-[#91BF77] transition-all duration-300">
                <iframe 
                    src="https://www.google.com/maps?q={{ urlencode($boardingHouse->address) }}&output=embed"
                    width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy">
                </iframe>
            </div>
    
            <a href="https://www.google.com/maps/search/?q={{ urlencode($boardingHouse->address) }}" 
               target="_blank" 
               class="w-full text-center bg-[#91BF77] text-white font-semibold p-3 rounded-[18px] hover:bg-[#7FA766] transition-all duration-300">
                See on Google Maps
            </a>
    
            <div class="p-4 border border-[#F1F2F6] rounded-[18px] hover:border-[#91BF77] transition-all duration-300">
                <p class="text-sm font-semibold">{{ $boardingHouse->address }}</p>
            </div>
    
            <div class="flex flex-col gap-3">
                <h3 class="text-lg font-semibold">Nearest Place</h3>
                @foreach ($boardingHouse->nearestPlaces as $nearestPlace)
                    <div class="flex items-center gap-3 p-[10px] border border-[#F1F2F6] rounded-[18px] hover:border-[#91BF77] transition-all duration-300">
                        <div class="w-[40px] h-[40px] shrink-0 rounded-full overflow-hidden bg-[#D9D9D9] flex items-center justify-center">
                            <img src="{{ Storage::url($nearestPlace->icon) }}" class="w-8 h-8 object-contain" alt="Rumah Sakit">
                        </div>
                        <div class="flex flex-col">
                            <p class="font-semibold">{{ $nearestPlace->name }}</p>
                            <p class="text-xs text-gray-500">{{ $nearestPlace->distance }}m</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
    
    <div id="Bonus-Tab" class="tab-content flex flex-col gap-5 hidden">
        <div class="flex flex-col gap-5">
            @foreach ($boardingHouse->bonuses as $bonus)
            <div
            class="bonus-card flex items-center rounded-[22px] border border-[#F1F2F6] p-[10px] gap-3 hover:border-[#91BF77] transition-all duration-300">
            <div class="flex w-[120px] h-[90px] shrink-0 rounded-[18px] bg-[#D9D9D9] overflow-hidden">
                <img src="{{ Storage::url($bonus->image) }}" class="w-full h-full object-cover"
                    alt="thumbnails">
            </div>
            <div>
                <p class="font-semibold">{{ $bonus->name }}</p>
                <p class="text-xs text-ngekos-grey">{{ $bonus->description }}</p>
            </div>
            </div>
            @endforeach
        </div>
    </div>
    <div id="Testimonials-Tab" class="tab-content flex-col gap-5 hidden">
        <div class="flex flex-col gap-4">
          @foreach ($boardingHouse->testimonials as $testimoni)
                <div
                class="testi-card flex flex-col rounded-[22px] border border-[#F1F2F6] p-4 gap-3 bg-white hover:border-[#91BF77] transition-all duration-300">
                <div class="flex items-center gap-3">
                    <div
                        class="w-[70px] h-[70px] flex shrink-0 rounded-full border-4 border-white ring-1 ring-[#F1F2F6] overflow-hidden">
                        <img src="{{ Storage::url($testimoni->photo) }}" class="w-full h-full object-cover"
                            alt="icon">
                    </div>
                    <div>
                        <p class="font-semibold">{{ $testimoni->name }}</p>
                        <p class="mt-[2px] text-sm text-ngekos-grey">{{ $testimoni->created_at->format('d F Y') }}</p>
                    </div>
                </div>
                <p class="leading-[26px]">{{ $testimoni->content }}</p>
                <div class="flex">
                    @for ($i = 0; $i < $testimoni->rating; $i++)
                        <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="w-[22px] h-[22px] flex shrink-0"
                        alt="">
                    @endfor
                </div>
            </div>    
          @endforeach
        </div>
    </div>
    <div id="Rules-Tab" class="tab-content flex flex-col gap-3 hidden">
        @foreach ($boardingHouse->rules as $rule)
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-3 p-4 border border-[#F1F2F6] rounded-[18px] hover:border-[#91BF77] transition-all duration-300">
                    <span class="font-semibold text-lg">{{ $loop->iteration }}.</span>
                    <p class="text-sm">{{ $rule->name }}</p>
                </div>
            </div>
        @endforeach
    </div>    
    
    <div id="Contact-Tab" class="tab-content flex-col gap-5 hidden">
        <p class="text-sm leading-[28px]">If you have any questions please contact this contact</p>
        @foreach ($boardingHouse->contacts as $contact)
        <div class="flex flex-col gap-5">
            <div id="Contact" class="flex flex-col gap-2">
              <div class="rounded-[22px] border border-[#F1F2F6] flex items-center justify-between p-4 bg-white hover:border-[#91BF77] transition-all duration-300">
                <div class="flex items-center gap-[10px]">
                    <div
                    class="w-[70px] h-[70px] flex shrink-0 rounded-full border-4 border-white ring-1 ring-[#F1F2F6] overflow-hidden">
                    <img src="{{ Storage::url($contact->avatar) }}" class="w-full h-full object-cover"
                        alt="icon">
                    </div>
                  <div class="flex flex-col h-fit">
                    <p class="font-semibold">{{ $contact->name }}</p>
                    <p class="text-sm leading-[21px] text-[#909DBF]">{{ $contact->email }}</p>
                  </div>
                </div>
                <a href="tel:{{$contact->phone}}"
                  class="appearance-none font-semibold text-sm leading-[21px] hover:underline">Call
                  Now</a>
              </div>
            </div>
          </div>
        @endforeach
    </div>
    <div id="Rewards-Tab" class="tab-content flex-col gap-5 hidden">Lorem ipsum dolor sit amet consectetur
        adipisicing elit. Porro, vitae.</div>
</div>
</main>
<div id="BottomNav" class="relative flex w-full h-[138px] shrink-0">
<div class="fixed bottom-5 w-full max-w-[640px] px-5 z-10">
    <div class="flex items-center justify-between rounded-[40px] py-4 px-6 bg-ngekos-black">
        <p class="font-bold text-xl leading-[30px] text-white">
            Rp. {{ number_format($boardingHouse->price, 0, ',', '.') }}
            <br>
            <span class="text-sm font-normal">/bulan</span>
        </p>
        <a href="{{ route('rooms', $boardingHouse->slug) }}"
            class="flex shrink-0 rounded-full py-[14px] px-5 bg-ngekos-orange font-bold text-white">Book
            Now</a>
    </div>
</div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/js/details.js') }}"></script>
@endsection
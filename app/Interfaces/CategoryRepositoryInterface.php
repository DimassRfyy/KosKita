<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    public function getAllCategories();

    public function getBoardingHouseByCategorySlug($slug);
}
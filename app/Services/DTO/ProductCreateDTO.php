<?php

namespace App\Services\DTO;

use App\Models\Enums\ProductReviewableType;
use App\Models\Provider;
use App\Models\User;

class ProductCreateDTO
{
    private string $title;
    private int $price;
    private int $vote;
    private Provider $provider;
    private User $creator;
    private bool $active;
    private ProductReviewableType $reviewableType;

    public function setTitle(string $title): ProductCreateDTO
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setPrice(int $price): ProductCreateDTO
    {
        $this->price = $price;
        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setVote(int $vote): ProductCreateDTO
    {
        $this->vote = $vote;
        return $this;
    }

    public function getVote(): int
    {
        return $this->vote;
    }

    public function setProvider(Provider $provider): ProductCreateDTO
    {
        $this->provider = $provider;
        return $this;
    }

    public function getProvider(): Provider
    {
        return $this->provider;
    }

    public function setCreator(User $creator): ProductCreateDTO
    {
        $this->creator = $creator;
        return $this;
    }

    public function getCreator(): User
    {
        return $this->creator;
    }

    public function setActive(bool $active): ProductCreateDTO
    {
        $this->active = $active;
        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setReviewableType(ProductReviewableType $reviewableType): ProductCreateDTO
    {
        $this->reviewableType = $reviewableType;
        return $this;
    }

    public function getReviewableType(): ProductReviewableType
    {
        return $this->reviewableType;
    }
}
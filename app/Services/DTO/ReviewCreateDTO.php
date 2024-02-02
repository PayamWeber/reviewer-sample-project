<?php

namespace App\Services\DTO;

use App\Models\Product;
use App\Models\User;

class ReviewCreateDTO
{
    private int $vote;
    private string $description;
    private Product $product;
    private User $user;

    public function setVote(int $vote): ReviewCreateDTO
    {
        $this->vote = $vote;
        return $this;
    }

    public function getVote(): int
    {
        return $this->vote;
    }

    public function setDescription(string $description): ReviewCreateDTO
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setProduct(Product $product): ReviewCreateDTO
    {
        $this->product = $product;
        return $this;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setUser(User $user): ReviewCreateDTO
    {
        $this->user = $user;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
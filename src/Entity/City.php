<?php

namespace App\Entity;

class City
{

    private $city;

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function __toString(): string
    {
        return $this->city;
    }
}

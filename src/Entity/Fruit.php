<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FruitRepository")
 */
class Fruit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $weight;
    /**
     * @ORM\Column(type="text")
     */
    private $color;

    /**
     * @ORM\Column(type="text")
     */
    private $cultivar;

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getWeight(): ?int
    {
      return $this->weight;
    }
    public function getColor(): ?string
    {
      return $this->color;
    }
    public function getCultivar(): ?string
    {
      return $this->cultivar;
    }

    // Setters
    public function setWeight($weight)
    {
      $this->weight = $weight;
    }
    public function setColor($color)
    {
      $this->color = $color;
    }
    public function setCultivar($cultivar)
    {
      $this->cultivar = $cultivar;
    }
}

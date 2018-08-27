<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Car
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
    private $year;
    /**
     * @ORM\Column(type="text")
     */
    private $brand;

    /**
     * @ORM\Column(type="text")
     */
    private $model;

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getYear(): ?int
    {
      return $this->year;
    }
    public function getBrand(): ?string
    {
      return $this->brand;
    }
    public function getModel(): ?string
    {
      return $this->model;
    }

    // Setters
    public function setYear($year)
    {
      $this->year = $year;
    }
    public function setBrand($brand)
    {
      $this->brand = $brand;
    }
    public function setModel($model)
    {
      $this->model = $model;
    }
}

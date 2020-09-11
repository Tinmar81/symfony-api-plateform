<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 *     itemOperations={
 *      "get_restaurant_full"={
 *          "method"="GET",
 *          "path"="/restaurants/{id}/full",
 *          "normalization_context"={"groups"={"restaurantFull"}}
 *      },
 *     },
 *     collectionOperations={
 *      "get_restaurants_all"={
 *          "method"="GET",
 *          "normalization_context"={"groups"={"restaurantFull"}}
 *       }
 *     },
 *     attributes={
 *          "order"={"name":"ASC"}
 *     }
 * )
 * @ORM\Entity(repositoryClass=RestaurantRepository::class)
 */
class Restaurant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"restaurantSlots","restaurantFull"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"restaurantFull"})
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Groups({"restaurantFull"})
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Slot::class, mappedBy="restaurant")
     * @Groups({"restaurantFull"})
     * @ApiSubresource()
     */
    private $slots;

    /**
     * @ORM\OneToOne(targetEntity=RestaurantImage::class, cascade={"persist", "remove"})
     * @Groups({"restaurantFull"})
     * @ApiSubresource()
     */
    private $image;

    public function __construct()
    {
        $this->slots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Slot[]
     */
    public function getSlots(): Collection
    {
        return $this->slots;
    }

    public function addSlot(Slot $slot): self
    {
        if (!$this->slots->contains($slot)) {
            $this->slots[] = $slot;
            $slot->setRestaurant($this);
        }

        return $this;
    }

    public function removeSlot(Slot $slot): self
    {
        if ($this->slots->contains($slot)) {
            $this->slots->removeElement($slot);
            // set the owning side to null (unless already changed)
            if ($slot->getRestaurant() === $this) {
                $slot->setRestaurant(null);
            }
        }

        return $this;
    }

    public function getImage(): ?RestaurantImage
    {
        return $this->image;
    }

    public function setImage(?RestaurantImage $image): self
    {
        $this->image = $image;

        return $this;
    }
}

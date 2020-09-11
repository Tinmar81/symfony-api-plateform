<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\SlotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SlotRepository::class)
 * @ApiResource(
 *     itemOperations={
 *      "get_slot_full"={
 *          "method"="GET",
 *          "path"="/slots/{id}/full",
 *      }
 *     },
 *     collectionOperations={
 *      "get_restaurants_slots_all"={"method"="GET"}
 *     },
 * )
 */
class Slot
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ApiSubresource()
     * @Groups({"restaurantFull"})
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     * @ApiSubresource()
     * @Groups({"restaurantFull"})
     */
    private $slot_from;

    /**
     * @ORM\Column(type="time")
     * @ApiSubresource()
     * @Groups({"restaurantFull"})
     */
    private $slot_to;

    /**
     * @ORM\Column(type="smallint")
     * @ApiSubresource()
     * @Groups({"restaurantFull"})
     */
    private $affluence;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurant::class, inversedBy="slots")
     */
    private $restaurant;

    /**
     * @ORM\OneToMany(targetEntity=Booking::class, mappedBy="slot", orphanRemoval=true)
     */
    private $bookings;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlotFrom(): ?\DateTimeInterface
    {
        return $this->slot_from;
    }

    public function setSlotFrom(DateTimeInterface $slot_from): self
    {
        $this->slot_from = $slot_from;

        return $this;
    }

    public function getSlotTo(): ?\DateTimeInterface
    {
        return $this->slot_to;
    }

    public function setSlotTo(DateTimeInterface $slot_to): self
    {
        $this->slot_to = $slot_to;

        return $this;
    }

    public function getAffluence(): ?int
    {
        return $this->affluence;
    }

    public function setAffluence(int $affluence): self
    {
        $this->affluence = $affluence;

        return $this;
    }

    public function getRestaurant(): ?Restaurant
    {
        return $this->restaurant;
    }

    public function setRestaurant(?Restaurant $restaurant): self
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setSlot($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
            // set the owning side to null (unless already changed)
            if ($booking->getSlot() === $this) {
                $booking->setSlot(null);
            }
        }

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}

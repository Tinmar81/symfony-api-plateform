<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SlotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SlotRepository::class)
 */
class Slot
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $slot_from;

    /**
     * @ORM\Column(type="time")
     */
    private $slot_to;

    /**
     * @ORM\Column(type="smallint")
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

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSlotFrom(): ?\DateTimeInterface
    {
        return $this->slot_from;
    }

    public function setSlotFrom(\DateTimeInterface $slot_from): self
    {
        $this->slot_from = $slot_from;

        return $this;
    }

    public function getSlotTo(): ?\DateTimeInterface
    {
        return $this->slot_to;
    }

    public function setSlotTo(\DateTimeInterface $slot_to): self
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
}

<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RestaurantImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=RestaurantImageRepository::class)
 * @ApiResource(
 *     itemOperations={
 *      "get_image_full"={
 *          "method"="GET",
 *          "path"="/restaurant_images/{id}/full",
 *      }
 *     },
 *     collectionOperations={
 *      "get_restaurants_all"={"method"="GET"}
 *     }
 * )
 */
class RestaurantImage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"restaurantFull"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"restaurantFull"})
     */
    private $path;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"restaurantFull"})
     */
    private $format;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"restaurantFull"})
     */
    private $filename;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }
}

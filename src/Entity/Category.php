<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category entity.
 */
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $updated_at = null;

    #[ORM\Column(length: 64)]
    private ?string $title = null;

    #[ORM\Column(length: 64)]
    private ?string $code = null;

    /**
     * @return int|null getter ID
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return DateTimeInterface|null getter created
     */
    public function getCreated_at(): ?DateTimeInterface
    {
        return $this->created_at;
    }

    /**
     * @param DateTimeInterface $created_at setter
     *
     * @return $this this
     */
    public function setCreated_at(DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return DateTimeInterface|null getter
     */
    public function getUpdated_at(): ?DateTimeInterface
    {
        return $this->updated_at;
    }

    /**
     * @param DateTimeInterface $updated_at setter
     *
     * @return $this object
     */
    public function setUpdated_at(DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return string|null getter
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title setter
     *
     * @return $this object
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null getter
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code setter
     *
     * @return $this obejct
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string|null return ojb email
     */
    public function __toString()
    {
        return $this->title;
    }
}

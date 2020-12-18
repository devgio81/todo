<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource
 * @ORM\Entity
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    public $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    public $description;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('call', 'meeting' , 'misc')")
     */
    public $type;

    /**
     * @ORM\Column(type="boolean")
     *
     */
    public $isDone;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="tasks")
     */
    private $user;

    public function getUser(): ?User
    {
        return $this->user;
    }


    /**
     * @param mixed $user
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setType(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return bool|null
     */
    public function getIsDone(): ?bool
    {
        return $this->isDone;
    }

    /**
     * @param mixed $isDone
     */
    public function setIsDone(bool $isDone): void
    {
        $this->isDone = boolval($isDone);
    }
}

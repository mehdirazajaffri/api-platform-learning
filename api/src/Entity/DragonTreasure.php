<?php

namespace App\Entity;

use App\Repository\DragonTreasureRepository;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Carbon\Carbon;
use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use function Symfony\Component\String\u;
use ApiPlatform\Serializer\Filter\PropertyFilter;
use Symfony\Component\Validator\Constraints as Assert;




#[ORM\Entity(repositoryClass: DragonTreasureRepository::class)]
#[ApiResource(
                description: 'A rare and valuable treasure.',
                normalizationContext: [
                    'groups' => ['treasure:read'],
                ],
                denormalizationContext: [
                    'groups' => ['treasure:write'],
                ],
                paginationItemsPerPage: 10,
                formats: [
                    'jsonld',
                    'json',
                    'csv' => 'text/csv',
                ],
                
)]
#[ApiFilter(BooleanFilter::class, properties: ['isPublished'])]
#[ApiFilter(PropertyFilter::class)]
class DragonTreasure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['treasure:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['treasure:read', 'treasure:write'])]
    #[ApiFilter(SearchFilter::class, strategy: 'partial')]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 50, maxMessage: 'Describe your loot in 50 chars or less')]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['treasure:read'])]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['treasure:read', 'treasure:write'])]
    #[ApiFilter(RangeFilter::class)]
    #[Assert\GreaterThanOrEqual(0)]
    private ?int $value = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['treasure:read', 'treasure:write'])]
    private ?int $coolFactor = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $plunderAt;

    #[ORM\Column(nullable: true)]
    #[Groups(['treasure:read'])]
    private ?bool $isPublished = null;


    public function __construct(string $name)
    {
        $this->name = $name;
        $this->plunderAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    // public function setName(?string $name): static
    // {
    //     $this->name = $name;

    //     return $this;
    // }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }


    #[Groups(['treasure:read'])]
    public function getShortDescription(): string
    {
        return u($this->getDescription())->truncate(40, '...');
    }
    


    #[SerializedName('description')]
    #[Groups(['treasure:write'])]
    public function setTextDescription(string $description): self
    {
        $this->description = nl2br($description);
        return $this;
    }

    public function getTextDescription(): ?string
    {
        return $this->description . " Mehdi Raza ";
    }
    

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(?int $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getCoolFactor(): ?int
    {
        return $this->coolFactor;
    }

    public function setCoolFactor(?int $coolFactor): static
    {
        $this->coolFactor = $coolFactor;

        return $this;
    }

    public function getPlunderAt(): ?\DateTimeImmutable
    {
        return $this->plunderAt;
    }

    /**
     * A human-readable representation of when this treasure was plundered.
     */
    #[Groups(['treasure:read'])]
    public function getPlunderedAtAgo(): string
    {
        return Carbon::instance($this->plunderAt)->diffForHumans();
    }

    public function setPlunderAt(?\DateTimeImmutable $plunderAt): static
    {
        $this->plunderAt = $plunderAt;

        return $this;
    }

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(?bool $isPublished): static
    {
        $this->isPublished = $isPublished;

        return $this;
    }
}

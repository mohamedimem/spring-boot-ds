<?php

namespace App\Entity;

use App\Repository\SoutenanceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SoutenanceRepository::class)]
class Soutenance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $numjury = null;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $dateSoutenance = null;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank]
    #[Assert\Range(min: 0, max: 20)]
    private ?float $note = null;

    #[ORM\ManyToOne(targetEntity: Enseignant::class, inversedBy: 'soutenances')]
    #[ORM\JoinColumn(name: 'matricule', referencedColumnName: 'matricule', nullable: false)]
    private ?Enseignant $enseignant = null;

    #[ORM\ManyToOne(targetEntity: Etudiant::class, inversedBy: 'soutenances')]
    #[ORM\JoinColumn(name: 'nce', referencedColumnName: 'nce', nullable: false)]
    private ?Etudiant $etudiant = null;

    public function getNumjury(): ?int
    {
        return $this->numjury;
    }
    public function getDateSoutenance(): ?\DateTimeInterface
    {
        return $this->dateSoutenance;
    }

    public function setDateSoutenance(\DateTimeInterface $dateSoutenance): self
    {
        $this->dateSoutenance = $dateSoutenance;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(float $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getEnseignant(): ?Enseignant
    {
        return $this->enseignant;
    }

    public function setEnseignant(?Enseignant $enseignant): self
    {
        $this->enseignant = $enseignant;

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }
}

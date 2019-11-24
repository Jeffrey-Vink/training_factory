<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LessonRepository")
 */
class Lesson
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateTime;

    /**
     * @ORM\Column(type="integer")
     */
    private $location;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxPersons;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Training", inversedBy="lessons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $training;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Person", inversedBy="instructors")
     * @ORM\JoinColumn(nullable=false)
     */
    private $instructor;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Registration", mappedBy="lesson")
     */
    private $lessons;

    public function __construct()
    {
        $this->lessons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateTime(): ?\DateTimeInterface
    {
        return $this->dateTime;
    }

    public function setDateTime(\DateTimeInterface $dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getLocation(): ?int
    {
        return $this->location;
    }

    public function setLocation(int $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getMaxPersons(): ?int
    {
        return $this->maxPersons;
    }

    public function setMaxPersons(int $maxPersons): self
    {
        $this->maxPersons = $maxPersons;

        return $this;
    }

    public function getTraining(): ?Training
    {
        return $this->training;
    }

    public function setTraining(?Training $training): self
    {
        $this->training = $training;

        return $this;
    }

    public function getInstructor(): ?Person
    {
        return $this->instructor;
    }

    public function setInstructor(?Person $instructor): self
    {
        $this->instructor = $instructor;

        return $this;
    }

    /**
     * @return Collection|Registration[]
     */
    public function getLessons(): Collection
    {
        return $this->lessons;
    }

    public function addLesson(Registration $lesson): self
    {
        if (!$this->lessons->contains($lesson)) {
            $this->lessons[] = $lesson;
            $lesson->setLesson($this);
        }

        return $this;
    }

    public function removeLesson(Registration $lesson): self
    {
        if ($this->lessons->contains($lesson)) {
            $this->lessons->removeElement($lesson);
            // set the owning side to null (unless already changed)
            if ($lesson->getLesson() === $this) {
                $lesson->setLesson(null);
            }
        }

        return $this;
    }
}

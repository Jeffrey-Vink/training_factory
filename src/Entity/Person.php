<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 */
class Person
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $loginName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $firstName;

    /**
     * @ORM\Column(type="float")
     */
    private $preProvision;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $lastName;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $emailAddress;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $psnType;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $hiringDate;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $salary;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $place;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lesson", mappedBy="instructor")
     */
    private $instructors;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Registration", mappedBy="member")
     */
    private $members;

    public function __construct()
    {
        $this->instructors = new ArrayCollection();
        $this->members = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLoginName(): ?string
    {
        return $this->loginName;
    }

    public function setLoginName(string $loginName): self
    {
        $this->loginName = $loginName;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getPreProvision(): ?float
    {
        return $this->preProvision;
    }

    public function setPreProvision(float $preProvision): self
    {
        $this->preProvision = $preProvision;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getEmailAddress(): ?string
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(string $emailAddress): self
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    public function getPsnType(): ?string
    {
        return $this->psnType;
    }

    public function setPsnType(string $psnType): self
    {
        $this->psnType = $psnType;

        return $this;
    }

    public function getHiringDate(): ?\DateTimeInterface
    {
        return $this->hiringDate;
    }

    public function setHiringDate(?\DateTimeInterface $hiringDate): self
    {
        $this->hiringDate = $hiringDate;

        return $this;
    }

    public function getSalary(): ?float
    {
        return $this->salary;
    }

    public function setSalary(?float $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(?string $place): self
    {
        $this->place = $place;

        return $this;
    }

    /**
     * @return Collection|Lesson[]
     */
    public function getInstructors(): Collection
    {
        return $this->instructors;
    }

    public function addInstructor(Lesson $instructor): self
    {
        if (!$this->instructors->contains($instructor)) {
            $this->instructors[] = $instructor;
            $instructor->setInstructor($this);
        }

        return $this;
    }

    public function removeInstructor(Lesson $instructor): self
    {
        if ($this->instructors->contains($instructor)) {
            $this->instructors->removeElement($instructor);
            // set the owning side to null (unless already changed)
            if ($instructor->getInstructor() === $this) {
                $instructor->setInstructor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Registration[]
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(Registration $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members[] = $member;
            $member->setMember($this);
        }

        return $this;
    }

    public function removeMember(Registration $member): self
    {
        if ($this->members->contains($member)) {
            $this->members->removeElement($member);
            // set the owning side to null (unless already changed)
            if ($member->getMember() === $this) {
                $member->setMember(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AppointmentRepository::class)
 */
class Appointment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255,nullable= true)
     */
    private ?string $Symptome;

    /**
     * @ORM\Column(type="string", length=255,nullable= true)
     */
    private ?string $Comments;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $Status;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="appointments")
     */
    private mixed $users;

    /**
     * @ORM\ManyToOne(targetEntity=Schedule::class)
     */
    private ?Schedule $schedule;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComments(): ?string
    {
        return $this->Comments;
    }

    public function setComments(string $Comments): self
    {
        $this->Comments = $Comments;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getStatus(): ?bool
    {
        return $this->Status;
    }

    /**
     * @param bool|null $Status
     * @return Appointment
     */
    public function setStatus(?bool $Status): Appointment
    {
        $this->Status = $Status;
        return $this;
    }

    public function getSchedule(): ?Schedule
    {
        return $this->schedule;
    }

    public function setSchedule(?Schedule $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users): void
    {
        $this->users = $users;
    }

    /**
     * @return string|null
     */
    public function getSymptome(): ?string
    {
        return $this->Symptome;
    }

    /**
     * @param string|null $Symptome
     * @return Appointment
     */
    public function setSymptome(?string $Symptome): Appointment
    {
        $this->Symptome = $Symptome;
        return $this;
    }



}

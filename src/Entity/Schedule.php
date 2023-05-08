<?php

namespace App\Entity;

use App\Repository\ScheduleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ScheduleRepository::class)
 */
class Schedule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ScheduleDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ScheduleDay;

    /**
     * @ORM\Column(type="time")
     */
    private $StartTime;

    /**
     * @ORM\Column(type="time")
     */
    private $EndTime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $BookAvail;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScheduleDate(): ?\DateTimeInterface
    {
        return $this->ScheduleDate;
    }

    public function setScheduleDate(\DateTimeInterface $ScheduleDate): self
    {
        $this->ScheduleDate = $ScheduleDate;

        return $this;
    }

    public function getScheduleDay(): ?string
    {
        return $this->ScheduleDay;
    }

    public function setScheduleDay(string $ScheduleDay): self
    {
        $this->ScheduleDay = $ScheduleDay;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->StartTime;
    }

    public function setStartTime(\DateTimeInterface $StartTime): self
    {
        $this->StartTime = $StartTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->EndTime;
    }

    public function setEndTime(\DateTimeInterface $EndTime): self
    {
        $this->EndTime = $EndTime;

        return $this;
    }

    public function getBookAvail(): ?string
    {
        return $this->BookAvail;
    }

    public function setBookAvail(string $BookAvail): self
    {
        $this->BookAvail = $BookAvail;

        return $this;
    }

    public function __toString(): string
    {
        return $this->ScheduleDate;
    }
}

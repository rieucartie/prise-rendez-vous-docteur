<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UsersRepository;
use Doctrine\ORM\PersistentCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;
     /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;
    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    */
    private $activation_token;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $patientNom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $patientPrenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $patientMaritialStatus;

    /**
     * @ORM\Column(type="datetime")
     */
    private $patientDateDeNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $Sexe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $patientPhone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $patientAdresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $patientEmail;
     /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reset_token;

    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @ORM\OneToMany(targetEntity=Appointment::class, mappedBy="users")
     */
    private $appointments;

    public function __construct()
    {
        $this->appointments = new ArrayCollection();
    }
    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    function getEmail() {
        return $this->email;
    } 

    function setEmail($email) {
        $this->email = $email;
    }

    
    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = "ROLE_USER";

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
    function getActivation_token() {
        return $this->activation_token;
    }

    function setActivation_token($activation_token) {
        $this->activation_token = $activation_token;
    }
    function getReset_token() {
        return $this->reset_token;
    }

    function setReset_token($reset_token) {
        $this->reset_token = $reset_token;
    }

    public function getActivationToken(): string
    {
        return $this->activation_token;
    }

    public function setActivationToken(?string $activation_token)
    {
        $this->activation_token = $activation_token;

        return $this;
    }

    public function getResetToken()
    {
        return $this->reset_token;
    }

    public function setResetToken(string $reset_token)
    {
        $this->reset_token = $reset_token;

        return $this;
    }
    
     public function __toString() {
    return $this->username;
   }

    /**
     * @return string|null
     */
    public function getPatientNom(): ?string
    {
        return $this->patientNom;
    }

    /**
     * @param string|null $patientNom
     */
    public function setPatientNom(?string $patientNom): void
    {
        $this->patientNom = $patientNom;
    }

    /**
     * @return string|null
     */
    public function getPatientPrenom(): ?string
    {
        return $this->patientPrenom;
    }

    /**
     * @param string|null $patientPrenom
     */
    public function setPatientPrenom(?string $patientPrenom): void
    {
        $this->patientPrenom = $patientPrenom;
    }

    /**
     * @return string|null
     */
    public function getPatientMaritialStatus(): ?string
    {
        return $this->patientMaritialStatus;
    }

    /**
     * @param string|null $patientMaritialStatus
     */
    public function setPatientMaritialStatus(?string $patientMaritialStatus): void
    {
        $this->patientMaritialStatus = $patientMaritialStatus;
    }

    /**
     * @return mixed
     */
    public function getPatientDateDeNaissance()
    {
        return $this->patientDateDeNaissance;
    }

    /**
     * @param mixed $patientDateDeNaissance
     */
    public function setPatientDateDeNaissance($patientDateDeNaissance): void
    {
        $this->patientDateDeNaissance = $patientDateDeNaissance;
    }

    /**
     * @return string|null
     */
    public function getSexe(): ?string
    {
        return $this->Sexe;
    }

    /**
     * @param string|null $Sexe
     */
    public function setSexe(?string $Sexe): void
    {
        $this->Sexe = $Sexe;
    }

    /**
     * @return string|null
     */
    public function getPatientPhone(): ?string
    {
        return $this->patientPhone;
    }

    /**
     * @param string|null $patientPhone
     */
    public function setPatientPhone(?string $patientPhone): void
    {
        $this->patientPhone = $patientPhone;
    }

    /**
     * @return string|null
     */
    public function getPatientAdresse(): ?string
    {
        return $this->patientAdresse;
    }

    /**
     * @param string|null $patientAdresse
     */
    public function setPatientAdresse(?string $patientAdresse): void
    {
        $this->patientAdresse = $patientAdresse;
    }

    /**
     * @return string|null
     */
    public function getPatientEmail(): ?string
    {
        return $this->patientEmail;
    }

    /**
     * @param string|null $patientEmail
     */
    public function setPatientEmail(?string $patientEmail): void
    {
        $this->patientEmail = $patientEmail;
    }

    /**
     * @return PersistentCollection
     */
    public function getAppointments(): ArrayCollection|PersistentCollection
    {
        return $this->appointments;
    }

    /**
     * @param ArrayCollection $appointments
     */
    public function setAppointments(ArrayCollection $appointments): void
    {
        $this->appointments = $appointments;
    }



}

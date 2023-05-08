<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class DateSearch
{
      /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateSearch1", type="datetime", options={"default" = "CURRENT_TIMESTAMP"}))
     */
    private $dateSearch1;

    /**
     * Constructor
     */
    public function __construct()
    {
         $this->dateSearch1=new \DateTime();
   
    }
    
    
    public function getDateSearch1(): \DateTime {
        return $this->dateSearch1;
    }


    public function setDateSearch1(\DateTime $dateSearch1) {
        $this->dateSearch1 = $dateSearch1;
    }



    public function __toString() {
        return  'date'. $this->dateSearch1;
   }


}

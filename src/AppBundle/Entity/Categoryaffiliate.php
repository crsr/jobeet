<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoryaffiliate
 *
 * @ORM\Table(name="categoryaffiliate", indexes={@ORM\Index(name="id_category", columns={"id_category"}), @ORM\Index(name="id_affiliate", columns={"id_affiliate"})})
 * @ORM\Entity
 */
class Categoryaffiliate
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_categoryaffiliate", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCategoryaffiliate;

    /**
     * @var \AppBundle\Entity\Affiliate
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Affiliate")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_affiliate", referencedColumnName="id_affiliate")
     * })
     */
    private $idAffiliate;

    /**
     * @var \AppBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_category", referencedColumnName="id_category")
     * })
     */
    private $idCategory;



    /**
     * Get idCategoryaffiliate
     *
     * @return integer
     */
    public function getIdCategoryaffiliate()
    {
        return $this->idCategoryaffiliate;
    }

    /**
     * Set idAffiliate
     *
     * @param \AppBundle\Entity\Affiliate $idAffiliate
     *
     * @return Categoryaffiliate
     */
    public function setIdAffiliate(\AppBundle\Entity\Affiliate $idAffiliate = null)
    {
        $this->idAffiliate = $idAffiliate;

        return $this;
    }

    /**
     * Get idAffiliate
     *
     * @return \AppBundle\Entity\Affiliate
     */
    public function getIdAffiliate()
    {
        return $this->idAffiliate;
    }

    /**
     * Set idCategory
     *
     * @param \AppBundle\Entity\Category $idCategory
     *
     * @return Categoryaffiliate
     */
    public function setIdCategory(\AppBundle\Entity\Category $idCategory = null)
    {
        $this->idCategory = $idCategory;

        return $this;
    }

    /**
     * Get idCategory
     *
     * @return \AppBundle\Entity\Category
     */
    public function getIdCategory()
    {
        return $this->idCategory;
    }
}

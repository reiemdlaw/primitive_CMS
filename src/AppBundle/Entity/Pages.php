<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="pages")
 */
class Pages
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
        /**
     * @ORM\Column(type="string", length=100)
     */

    private $linktext;
    
      /**
     * @ORM\Column(type="string", length=100)
     */
  
    private $url;
        /**
     * @ORM\Column(type="text")
     */

    private $headline;
        /**
     * @ORM\Column(type="text")
     */

    private $maintext;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set linktext
     *
     * @param string $linktext
     *
     * @return Pages
     */
    public function setLinktext($linktext)
    {
        $this->linktext = $linktext;

        return $this;
    }

    /**
     * Get linktext
     *
     * @return string
     */
    public function getLinktext()
    {
        return $this->linktext;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Pages
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set headline
     *
     * @param string $headline
     *
     * @return Pages
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;

        return $this;
    }

    /**
     * Get headline
     *
     * @return string
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Set maintext
     *
     * @param string $maintext
     *
     * @return Pages
     */
    public function setMaintext($maintext)
    {
        $this->maintext = $maintext;

        return $this;
    }

    /**
     * Get maintext
     *
     * @return string
     */
    public function getMaintext()
    {
        return $this->maintext;
    }
}

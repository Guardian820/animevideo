<?php

namespace FaceManga\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Anime
 */
class Anime
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $year;

    /**
     * @var integer
     */
    private $episodes;

    /**
     * @var array
     */
    private $genre;

    /**
     * @var string
     */
    private $description;


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
     * Set name
     *
     * @param string $name
     * @return Anime
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return Anime
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set episodes
     *
     * @param integer $episodes
     * @return Anime
     */
    public function setEpisodes($episodes)
    {
        $this->episodes = $episodes;

        return $this;
    }

    /**
     * Get episodes
     *
     * @return integer 
     */
    public function getEpisodes()
    {
        return $this->episodes;
    }

    /**
     * Set genre
     *
     * @param array $genre
     * @return Anime
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return array 
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Anime
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * @var integer
     */
    private $view_count = 0;


    /**
     * Set view_counter
     *
     * @param integer $viewCounter
     * @return Anime
     */
    public function increaseViewCount()
    {
        $this->view_count++;
    
        return $this;
    }

    /**
     * Get view_counter
     *
     * @return integer 
     */
    public function getViewCount()
    {
        return $this->view_count;
    }
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Image
 *
 *
 *@ORM\HasLifeCycleCallbacks()
 */
class Image
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $filename;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $filesize;

    /**
     * @var string
     */
    private $mimetype;

    /**
     * @var boolean
     */
    private $isPublished;

    /**
     * @var \DateTime
     */
    private $dateCrea;

    /**
     * @var \DateTime
     */
    private $dateMod;

    /**
     * @var UploadedFile
     * @Assert\Image(maxSize="5M")
     */
    private $tempFile;

    /**
    *   @ORM\PrePersist()
    */
    public function prePersist()
    {
        die("pre persist called !");

        $this->setFilename( 
            sha1( $this->getTempFile()->getClientOriginalName() )
            . uniqid()
            . "."
            . $this->getTempFile()->guessExtension()
        );

        $this->setFilesize( $this->getTempFile()->getSize() );
        $this->setMimetype( $this->getTempFile()->getMimeType());

        $this->setIsPublished(true);

        $this->setDateCrea( new \DateTime() );

        $this->setDateMod(new \DateTime() );

        $this->getTempFile()->move(
            __DIR__."/../../../web/uploads/originals",
            $this->getFilename()
        );

        dump($this);
     }
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
     * Set filename
     *
     * @param string $filename
     * @return Image
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Image
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Image
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
     * Set filesize
     *
     * @param integer $filesize
     * @return Image
     */
    public function setFilesize($filesize)
    {
        $this->filesize = $filesize;

        return $this;
    }

    /**
     * Get filesize
     *
     * @return integer 
     */
    public function getFilesize()
    {
        return $this->filesize;
    }

    /**
     * Set mimetype
     *
     * @param string $mimetype
     * @return Image
     */
    public function setMimetype($mimetype)
    {
        $this->mimetype = $mimetype;

        return $this;
    }

    /**
     * Get mimetype
     *
     * @return string 
     */
    public function getMimetype()
    {
        return $this->mimetype;
    }

    /**
     * Set isPublished
     *
     * @param boolean $isPublished
     * @return Image
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * Get isPublished
     *
     * @return boolean 
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * Set dateCrea
     *
     * @param \DateTime $dateCrea
     * @return Image
     */
    public function setDateCrea($dateCrea)
    {
        $this->dateCrea = $dateCrea;

        return $this;
    }

    /**
     * Get dateCrea
     *
     * @return \DateTime 
     */
    public function getDateCrea()
    {
        return $this->dateCrea;
    }

    /**
     * Set dateMod
     *
     * @param \DateTime $dateMod
     * @return Image
     */
    public function setDateMod($dateMod)
    {
        $this->dateMod = $dateMod;

        return $this;
    }

    /**
     * Get dateMod
     *
     * @return \DateTime 
     */
    public function getDateMod()
    {
        return $this->dateMod;
    }
}

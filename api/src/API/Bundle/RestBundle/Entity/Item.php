<?php

namespace API\Bundle\RestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="item")
 */
class Item
{
    const ACCESS_TYPE_PUBLIC = "public";
    const ACCESS_TYPE_LIMITED = "limited";
    const ACCESS_TYPE_RESTRICTED = "restricted";

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $studyTitle;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $datasetTitle;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $studyId;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $datasetId;

    /**
     * @ORM\Column(type="string")
     */
    protected $host;

    /**
     * @ORM\Column(type="text")
     */
    protected $summary;

    /**
     * @ORM\Column(type="text")
     */
    protected $studyDescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $datasetDescription;

    /**
     * @ORM\Column(type="string")
     */
    protected $accessType;

    /**
     * @ORM\Column(type="integer")
     */
    protected $noOfViews = 0;

    /**
     * @ORM\Column(type="integer")
     */
    protected $noOfAccessRequests = 0;

    /**
     * @ORM\OneToMany(targetEntity="Issue", mappedBy="item")
     */
    protected $issues;

    /**
     * @ORM\ManyToOne(targetEntity="Owner", inversedBy="items", cascade="persist")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    protected $owner;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $location; // this needs to be a data structure

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $fileFormat;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $technology;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $phenotype;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $tagCloud;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $population;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $sampleSize;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $frequency;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $gender;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $sampleType;

    public function __construct()
    {
        $this->issues = new ArrayCollection();
    }

    /**
     * @param mixed $accessType
     */
    public function setAccessType($accessType)
    {
        $this->accessType = $accessType;
    }

    /**
     * @return mixed
     */
    public function getAccessType()
    {
        return $this->accessType;
    }

    /**
     * @param mixed $fileFormat
     */
    public function setFileFormat($fileFormat)
    {
        $this->fileFormat = $fileFormat;
    }

    /**
     * @return mixed
     */
    public function getFileFormat()
    {
        return $this->fileFormat;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getIssues()
    {
        return $this->issues;
    }

    /**
     * @param Issue $issue
     * @return $this
     */
    public function addIssue(Issue $issue)
    {
        $this->issues[] = $issue;

        return $this;
    }

    /**
     * @param Issue $issue
     */
    public function removeIssue(Issue $issue)
    {
        $this->issues->removeElement($issue);
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param integer $noOfAccessRequests
     */
    public function setNoOfAccessRequests($noOfAccessRequests)
    {
        $this->noOfAccessRequests = $noOfAccessRequests;
    }

    /**
     * @return integer
     */
    public function getNoOfAccessRequests()
    {
        return $this->noOfAccessRequests;
    }

    /**
     * @param integer $noOfViews
     */
    public function setNoOfViews($noOfViews)
    {
        $this->noOfViews = $noOfViews;
    }

    /**
     * @return integer
     */
    public function getNoOfViews()
    {
        return $this->noOfViews;
    }

    /**
     * @param mixed $phenotype
     */
    public function setPhenotype($phenotype)
    {
        $this->phenotype = $phenotype;
    }

    /**
     * @return mixed
     */
    public function getPhenotype()
    {
        return $this->phenotype;
    }

    /**
     * @param mixed $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param mixed $tagCloud
     */
    public function setTagCloud($tagCloud)
    {
        $this->tagCloud = $tagCloud;
    }

    /**
     * @return mixed
     */
    public function getTagCloud()
    {
        return $this->tagCloud;
    }

    /**
     * @param mixed $technology
     */
    public function setTechnology($technology)
    {
        $this->technology = $technology;
    }

    /**
     * @return mixed
     */
    public function getTechnology()
    {
        return $this->technology;
    }

    /**
     * @param mixed $frequency
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;
    }

    /**
     * @return mixed
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $population
     */
    public function setPopulation($population)
    {
        $this->population = $population;
    }

    /**
     * @return mixed
     */
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * @param mixed $sampleSize
     */
    public function setSampleSize($sampleSize)
    {
        $this->sampleSize = $sampleSize;
    }

    /**
     * @return mixed
     */
    public function getSampleSize()
    {
        return $this->sampleSize;
    }

    /**
     * @param mixed $sampleType
     */
    public function setSampleType($sampleType)
    {
        $this->sampleType = $sampleType;
    }

    /**
     * @return mixed
     */
    public function getSampleType()
    {
        return $this->sampleType;
    }

    /**
     * @param mixed $datasetId
     */
    public function setDatasetId($datasetId)
    {
        $this->datasetId = $datasetId;
    }

    /**
     * @return mixed
     */
    public function getDatasetId()
    {
        return $this->datasetId;
    }

    /**
     * @param mixed $studyId
     */
    public function setStudyId($studyId)
    {
        $this->studyId = $studyId;
    }

    /**
     * @return mixed
     */
    public function getStudyId()
    {
        return $this->studyId;
    }

    /**
     * @param mixed $studyTitle
     */
    public function setStudyTitle($studyTitle)
    {
        $this->studyTitle = $studyTitle;
    }

    /**
     * @return mixed
     */
    public function getStudyTitle()
    {
        return $this->studyTitle;
    }

    /**
     * @param mixed $datasetTitle
     */
    public function setDatasetTitle($datasetTitle)
    {
        $this->datasetTitle = $datasetTitle;
    }

    /**
     * @return mixed
     */
    public function getDatasetTitle()
    {
        return $this->datasetTitle;
    }

    /**
     * @param mixed $datasetDescription
     */
    public function setDatasetDescription($datasetDescription)
    {
        $this->datasetDescription = $datasetDescription;
    }

    /**
     * @return mixed
     */
    public function getDatasetDescription()
    {
        return $this->datasetDescription;
    }

    /**
     * @param mixed $studyDescription
     */
    public function setStudyDescription($studyDescription)
    {
        $this->studyDescription = $studyDescription;
    }

    /**
     * @return mixed
     */
    public function getStudyDescription()
    {
        return $this->studyDescription;
    }
} 
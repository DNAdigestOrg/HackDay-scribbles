<?php

namespace API\Bundle\RestBundle\Controller;

use API\Bundle\RestBundle\Entity\Item;
use API\Bundle\RestBundle\Entity\Owner;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class DefaultController extends FOSRestController
{
    public function indexAction($name)
    {
        return $this->render('APIRestBundle:Default:index.html.twig', array('name' => $name));
    }

    /**
     * This retrieves a summary of all metadata available for the given search term
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Get all dataset descriptions",
     *  filters={
     *      {"name"="search-term", "dataType"="string"}
     *  },
     *  output="API\Bundle\RestBundle\Entity\Item"
     * )
     */
    public function getItemsAction()
    {
        $searchTerm = $this->getRequest()->get('search-term');

        $repository = $this->getDoctrine()
            ->getRepository('APIRestBundle:Item');

        if ($searchTerm){
            $items = $this->search($searchTerm);
        } else {
            $items = $repository->findAll();
        }

        $view = $this->view($items, 200);

        return $this->handleView($view);
    }

    /**
     * This retrieves the complete metadata available for a given dataset
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Get complete metadata for the dataset",
     *  output="API\Bundle\RestBundle\Entity\Item"
     * )
     * @param $itemId
     */
    public function getItemAction($itemId)
    {
        $repository = $this->getDoctrine()
            ->getRepository('APIRestBundle:Item');


        $item = $repository->find($itemId);

        $view = $this->view($item, 200);

        return $this->handleView($view);
    }

    /**
     * Register a dataset
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Register a dataset",
     *  input="API\Bundle\RestBundle\Entity\Item"
     * )
     */
    public function postItemAction()
    {
        $owner = $this->hydrateOwner();
        $item = $this->hydrateItem();

        $errors = $this->get('validator')->validate($item);
        if (count($errors) > 0){
            $view = $this->view((string)$errors, 400);
            return $this->handleView($view);
        }

        $item->setOwner($owner);
        $this->getDoctrine()->getManager()->persist($item);
        $this->getDoctrine()->getManager()->flush();

        $view = $this->view(null, 201, [
                'Location' => $this->generateUrl('get_item', array('itemId' => $item->getId()))
            ]);

        return $this->handleView($view);
    }

    private function search($searchTerm)
    {
        $repository = $this->getDoctrine()
            ->getRepository('APIRestBundle:Item');

        $query = $repository->createQueryBuilder('i')
            //->where('i.OrderEmail = :email')
            //->andWhere('o.Product LIKE :product')
            ->where('i.studyTitle LIKE :searchTerm')
            ->orWhere('i.datasetId LIKE :searchTerm')
            ->orWhere('i.studyId LIKE :searchTerm')
            ->orWhere('i.datasetTitle LIKE :searchTerm')
            ->orWhere('i.host LIKE :searchTerm')
            ->orWhere('i.summary LIKE :searchTerm')
            ->orWhere('i.description LIKE :searchTerm')
            ->orWhere('i.location LIKE :searchTerm')
            ->orWhere('i.technology LIKE :searchTerm')
            ->orWhere('i.tagCloud LIKE :searchTerm')
            ->orWhere('i.population LIKE :searchTerm')
            ->orWhere('i.sampleType LIKE :searchTerm')
            ->setParameter('searchTerm', '%'.$searchTerm.'%')
            ->getQuery();

        $items = $query->getResult();

        return $items;
    }
    private function hydrateOwner()
    {
        $owner = new Owner();

        $inputOwner = $this->getRequest()->get('owner');

        if (isset($inputOwner['first_name'])){
            $owner->setFirstName($this->getRequest()->get('owner')['first_name']);
        }

        if (isset($inputOwner['last_name'])){
            $owner->setLastName($this->getRequest()->get('owner')['last_name']);
        }

        if (isset($inputOwner['type'])){
            $owner->setType($this->getRequest()->get('owner')['type']);
        }

        if (isset($inputOwner['organization_name'])){
            $owner->setOrganizationName($this->getRequest()->get('owner')['organization_name']);
        }

        if (isset($inputOwner['email'])){
            $owner->setEmail($this->getRequest()->get('owner')['email']);
        }

        if (isset($inputOwner['phone_number'])){
            $owner->setPhoneNumber($this->getRequest()->get('owner')['phone_number']);
        }

        if (isset($inputOwner['mobile_number'])){
            $owner->setPhoneNumber($this->getRequest()->get('owner')['mobile_number']);
        }

        if (isset($inputOwner['address_line1'])){
            $owner->setAddressLine1($this->getRequest()->get('owner')['address_line1']);
        }

        if (isset($inputOwner['address_line2'])){
            $owner->setAddressLine2($this->getRequest()->get('owner')['address_line2']);
        }

        if (isset($inputOwner['address_line3'])){
            $owner->setAddressLine3($this->getRequest()->get('owner')['address_line3']);
        }

        if (isset($inputOwner['city'])){
            $owner->setCity($this->getRequest()->get('owner')['city']);
        }

        if (isset($inputOwner['country'])){
            $owner->setCountry($this->getRequest()->get('owner')['country']);
        }

        if (isset($inputOwner['postcode'])){
            $owner->setPostcode($this->getRequest()->get('owner')['postcode']);
        }

        return $owner;
    }

    private function hydrateItem()
    {
        $item = new Item();

        // these if conditions are helpful in PUT requests, not really relevant for POST. just leaving it here
        // so copy paste while implementing edit might be easier.
        if ($this->getRequest()->get('studyTitle')){
            $item->setTitle($this->getRequest()->get('study_title'));
        }

        if ($this->getRequest()->get('datasetTitle')){
            $item->setTitle($this->getRequest()->get('dataset_title'));
        }

        if ($this->getRequest()->get('datasetId')){
            $item->setTitle($this->getRequest()->get('dataset_id'));
        }

        if ($this->getRequest()->get('studyId')){
            $item->setTitle($this->getRequest()->get('study_id'));
        }

        if ($this->getRequest()->get('host')){
            $item->setHost($this->getRequest()->get('host'));
        }

        if ($this->getRequest()->get('summary')){
            $item->setSummary($this->getRequest()->get('summary'));
        }

        if ($this->getRequest()->get('study_description')){
            $item->setStudyDescription($this->getRequest()->get('study_description'));
        }

        if ($this->getRequest()->get('dataset_description')){
            $item->setDatasetDescription($this->getRequest()->get('dataset_description'));
        }

        if ($this->getRequest()->get('access_type')){
            $item->setAccessType($this->getRequest()->get('access_type'));
        }

        // convering to intval cos validation doesn't seem to work for some reason?
        if ($this->getRequest()->get('no_of_views')){
            $item->setNoOfViews(intval($this->getRequest()->get('no_of_views')));
        }

        if ($this->getRequest()->get('no_of_access_requests')){
            $item->setNoOfAccessRequests(intval($this->getRequest()->get('no_of_access_requests')));
        }

        if ($this->getRequest()->get('location')){
            $item->setLocation($this->getRequest()->get('location'));
        }

        if ($this->getRequest()->get('file_format')){
            $item->setFileFormat($this->getRequest()->get('file_format'));
        }

        if ($this->getRequest()->get('technology')){
            $item->setTechnology($this->getRequest()->get('technology'));
        }

        if ($this->getRequest()->get('phenotype')){
            $item->setPhenotype($this->getRequest()->get('phenotype'));
        }

        if ($this->getRequest()->get('tag_cloud')){
            $item->setTagCloud($this->getRequest()->get('tag_cloud'));
        }

        if ($this->getRequest()->get('population')){
            $item->setPopulation($this->getRequest()->get('population'));
        }

        if ($this->getRequest()->get('sample_size')){
            $item->setSampleSize(intval($this->getRequest()->get('sample_size')));
        }

        if ($this->getRequest()->get('frequency')){
            $item->setFrequency(intval($this->getRequest()->get('frequency')));
        }

        if ($this->getRequest()->get('gender')){
            $item->setGender($this->getRequest()->get('gender'));
        }

        if ($this->getRequest()->get('sample_type')){
            $item->setSampleType($this->getRequest()->get('sample_type'));
        }

        return $item;
    }
}

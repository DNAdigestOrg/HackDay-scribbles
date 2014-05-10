<?php

namespace API\Bundle\RestBundle\Controller;

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
     *  description="Get complete metadat for the dataset",
     *  output="API\Bundle\RestBundle\Entity\Item"
     * )
     * @param $itemId
     */
    public function getItemAction($itemId)
    {

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

    }

    private function search($searchTerm)
    {
        $repository = $this->getDoctrine()
            ->getRepository('APIRestBundle:Item');

        $query = $repository->createQueryBuilder('i')
            //->where('i.OrderEmail = :email')
            //->andWhere('o.Product LIKE :product')
            ->where('i.title LIKE :searchTerm')
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
}

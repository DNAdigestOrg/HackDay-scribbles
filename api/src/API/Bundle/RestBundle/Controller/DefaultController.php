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
        $view = $this->view(200);

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
}

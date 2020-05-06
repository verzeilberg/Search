<?php
namespace Search\Controller\Factory;

use Interop\Container\ContainerInterface;
use Search\Controller\SearchController;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Search\Service\searchService;
/**
 * This is the factory for AuthController. Its purpose is to instantiate the controller
 * and inject dependencies into its constructor.
 */
class SearchControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {   
        
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $searchService = new searchService($entityManager);
        return new SearchController($entityManager, $searchService);
    }
}

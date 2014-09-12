<?php
/**
 * @file BaseTest.php
 * @date Aug 7, 2013 
 * @author Sandro Meier
 */

namespace FF\CommonBundle\Tests;

use Doctrine\ORM\EntityManager;

class BaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Creates and returns an entity manager mock.
     * @return EntityManager The entity manager
     * @see https://gist.github.com/wowo/1331789
     */
    public function getEntityManagerMock()
    {
	$mockBuilder = $this->getMockBuilder('Doctrine\ORM\EntityRepository');
	$mockBuilder->disableOriginalConstructor();

	$classMetaDataMock = $this->getMock('Doctrine\Common\Persistence\Mapping\ClassMetadata');
	$classMetaDataMock->expects($this->any())->method('getAssociationNames')->will($this->returnValue(array()));

	$emMock  = $this->getMock('\Doctrine\ORM\EntityManager',
	    array('getRepository', 'getClassMetadata', 'persist', 'flush', 'getFilters'), array(), '', false);
	$emMock->expects($this->any())
	    ->method('getRepository')
	    ->will($this->returnValue($mockBuilder->getMock()));
	$emMock->expects($this->any())
	    ->method('getClassMetadata')
	    ->will($this->returnValue($classMetaDataMock));
	$emMock->expects($this->any())
	    ->method('persist')
	    ->will($this->returnValue(null));
	$emMock->expects($this->any())
	    ->method('flush')
	    ->will($this->returnValue(null));

	// Filters
	$filterCollectionMock = $this->getMock('\Doctrine\ORM\Configuration\FilterCollection', 
	    array('enable'), array(), '', false);
	$filterCollectionMock->expects($this->any())
	    ->method('enable');

	$emMock->expects($this->any())
	    ->method('getFilters')
	    ->will($this->returnValue($filterCollectionMock));
	return $emMock;  // it tooks 13 lines to achieve mock!
    }

    public function testHasNoTests()
    {
	// Is added. I will get a fail because this class does 
	// not implement any tests.
    }
}

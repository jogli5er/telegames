<?php
/**
 * @file SerializationBaseTest.php
 * @date Dec 24, 2013 
 * @author Sandro Meier
 */

namespace FF\CommonBundle\Tests;

use JMS\Serializer\SerializerBuilder;

class SerializationBaseTest extends BaseTest
{
    /**
     * Serializes the given object to JSON and then decodes the json.
     * The data will then be returned.
     *
     * @param $object The object you want to serialize
     * @param SerializationContext $context The context you want to use for serialization.
     *
     * @return array
     */
    protected function serializedData($object, $context = null)
    {
	$serializer = SerializerBuilder::create()->build();
	$json = $serializer->serialize($object, 'json', $context);

	return json_decode($json, true);
    }
}

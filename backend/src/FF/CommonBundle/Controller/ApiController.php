<?php
/**
 * @file ApiController.php
 * @date Dec 23, 2013 
 * @author Sandro Meier
 */

namespace FF\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolation;

/**
 * Controller that provides some additional methods to use while implementing an API.
 */
class ApiController extends Controller
{
    /**
     * Creates a JSON error response with the given message and error code
     * 
     * @param String 	$title				The title of the error. (Short descriptive message)
     * @param String 	$description		Longer explanation of the error.
     * @param Int		$errorCode			Error code
     * @param String	$documentationLink	A link to the documentation which describes the error.
     */
    protected function createErrorResponse($title, $description = null, $statusCode = JsonResponse::HTTP_BAD_REQUEST, $errorCode = 0, $documentationLink = null)
    {
	$data = array(
	    'error' => $title
	);

	if ($description) {
	    $data['description'] = $description;
	}

	if ($documentationLink) {
	    $data['documentation'] = $documentationLink;
	}

	if ($errorCode != 0) {
	    $data['error_code'] = $errorCode;
	}

	return new JsonResponse($data, $statusCode);
    }

    /**
     * Creates a JSON error response from a ConstraintViolation
     */
    protected function createValidationErrorResponse(ConstraintViolation $violation)
    {
	return $this->createErrorResponse(
	    "The '". $violation->getPropertyPath() ."' value is invalid.", 
	    $violation->getMessage()
	);
    }

    /**
     * Creates a JSON response that is mady by serializing the given object(s)
     */
    protected function createObjectResponse($object, $statusCode = JsonResponse::HTTP_OK, $serializationContext = null)
    {
	$serializer = SerializerBuilder::create()->build();
	$json = $serializer->serialize($object, 'json', $serializationContext);

	// Create the response
	$response = new Response();
	$response->headers->set('Content-Type', 'application/json', true);
	$response->setStatusCode($statusCode);
	$response->setContent($json);

	return $response;
    }
}

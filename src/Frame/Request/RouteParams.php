<?php

namespace Frame\Request;

use Frame\Core\Context;
use Frame\Core\Utils\Url;
use Frame\Request\Request;

class RouteParams extends Foundation implements RequestInterface
{

    protected $routeParams = [];

    /*
     * Route param values are simply stored as object properties - unsanitized!
     */
    public function __construct(Context $context)
    {

        parent::__construct($context);

        $this->type = 'RouteParams';

        if (isset($context->getCaller()->annotations['canonical'])) {
            $this->routeParams = Url::extract($context->getCaller()->annotations['canonical'], $context->getUrl()->requestUri);
        }

    }

    /*
     * Set the local route parameter variable
     */
    public function setRouteParams($routeParams)
    {

        $this->routeParams = $routeParams;

    }

    /*
     * Return all properties as an array
     */
    public function toArray()
    {

        return $this->routeParams;

    }

    /*
     * Magic getter method maps requests to the protected $get property
     */
    public function __get($property)
    {

        return (isset($this->routeParams[$property]) ? $this->routeParams[$property] : null);

    }

    /*
     * Magic isset method maps requests to the protected $routeParams property
     */
    public function __isset($property)
    {

        return isset($this->routeParams[$property]);

    }

}

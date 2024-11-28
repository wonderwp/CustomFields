<?php

namespace WonderWp\Component\Fields\Service;

use WonderWp\Component\Taxonomy\Definition\TaxonomyInterface;
use WonderWp\Component\Taxonomy\Exception\TaxonomyRegistrationException;
use WonderWp\Component\Taxonomy\Response\TaxonomyRegistrationResponse;
use WonderWp\Component\Taxonomy\Response\TaxonomyRegistrationResponseInterface;
use WonderWp\Component\Service\AbstractService;

abstract class AbstractFieldsRegistryService extends AbstractService implements TaxonomyServiceInterface
{
    /** @var TaxonomyInterface[] */
    protected $fields = [];

    //========================================================================================================//
    // Getters and Setters
    //========================================================================================================//

    /** @inheritDoc */
    public function getFields(): array
    {
        return $this->fields;
    }

    /** @inheritDoc */
    public function getTaxonomy(string $key): ?TaxonomyInterface
    {
        return $this->fields[$key] ?? null;
    }

    /** @inheritDoc */
    public function addTaxonomy(TaxonomyInterface $taxonomy): static
    {
        $this->fields[$taxonomy->getKey()] = $taxonomy;
        return $this;
    }

    /** @inheritDoc */
    public function removeTaxonomy(string $key): static
    {
        if (isset($this->fields[$key])) {
            unset($this->fields[$key]);
        }
        return $this;
    }

    /** @inheritDoc */
    public function setFields(array $fields): static
    {
        $this->fields = $fields;
        return $this;
    }

    //========================================================================================================//
    // Registration methods
    //========================================================================================================//

    /** @inheritDoc */
    public function registerFields(): array
    {
        $responses = [];

        foreach ($this->fields as $taxonomy) {
            $responses[$taxonomy->getKey()] = $this->registerTaxonomy($taxonomy);
        }

        return $responses;
    }

    /** @inheritDoc */
    public function registerTaxonomy(TaxonomyInterface $taxonomy): TaxonomyRegistrationResponseInterface
    {
        try {
            $wpRes = register_taxonomy($taxonomy->getKey(), $taxonomy->getObjectTypes(), $taxonomy->getArgs());

            if ($wpRes instanceof \WP_Error) {
                throw new TaxonomyRegistrationException($wpRes->get_error_message(), $wpRes->get_error_code());
            } else {
                $response = new TaxonomyRegistrationResponse(200, TaxonomyRegistrationResponseInterface::SUCCESS);
                $response->setWpRegistrationResult($wpRes);
            }
        } catch (\Exception $e) {
            $errorCode = is_int($e->getCode()) ? $e->getCode() : 500;
            $response = new TaxonomyRegistrationResponse($errorCode, TaxonomyRegistrationResponseInterface::ERROR);
            $response->setError($e);
        }

        return $response;
    }
}

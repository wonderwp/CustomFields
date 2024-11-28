<?php

namespace WonderWp\Component\Customfields\Service;

use WonderWp\Component\Taxonomy\Definition\TaxonomyInterface;
use WonderWp\Component\Taxonomy\Response\TaxonomyRegistrationResponseInterface;

interface FieldsRegistryServiceInterface
{
    /**
     * @return TaxonomyInterface[]
     */
    public function getTaxonomies(): array;

    /**
     * @param string $key
     * @return TaxonomyInterface|null
     */
    public function getTaxonomy(string $key): ?TaxonomyInterface;

    /**
     * @param TaxonomyInterface $Taxonomy
     * @return $this
     */
    public function addTaxonomy(TaxonomyInterface $Taxonomy): static;

    /**
     * @param string $key
     * @return $this
     */
    public function removeTaxonomy(string $key): static;

    /**
     * @param TaxonomyInterface[] $Taxonomys
     * @return $this
     */
    public function setTaxonomies(array $Taxonomys): static;

    /**
     * Register all Taxonomys
     *
     * @return TaxonomyRegistrationResponseInterface[]
     * @throws TaxonomyRegistrationException
     */
    public function registerTaxonomies(): array;

    /**
     * Register a Taxonomy
     *
     * @param TaxonomyInterface $Taxonomy
     * @return TaxonomyRegistrationResponseInterface
     * @throws TaxonomyRegistrationException
     */
    public function registerTaxonomy(TaxonomyInterface $Taxonomy): TaxonomyRegistrationResponseInterface;
}

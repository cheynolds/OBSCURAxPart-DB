<?php

namespace App\DataTables\Filters;

use App\DataTables\Filters\Constraints\BooleanConstraint;
use App\DataTables\Filters\Constraints\DateTimeConstraint;
use App\DataTables\Filters\Constraints\EntityConstraint;
use App\DataTables\Filters\Constraints\NumberConstraint;
use App\DataTables\Filters\Constraints\Part\TagsConstraint;
use App\DataTables\Filters\Constraints\TextConstraint;
use App\Entity\Parts\Category;
use App\Entity\Parts\Footprint;
use App\Entity\Parts\Manufacturer;
use App\Entity\Parts\MeasurementUnit;
use App\Entity\Parts\Storelocation;
use App\Entity\Parts\Supplier;
use App\Services\Trees\NodesListBuilder;
use Doctrine\ORM\QueryBuilder;

class PartFilter implements FilterInterface
{

    use CompoundFilterTrait;

    /** @var NumberConstraint */
    protected $dbId;

    /** @var TextConstraint */
    protected $name;

    /** @var TextConstraint */
    protected $description;

    /** @var TextConstraint */
    protected $comment;

    /** @var TagsConstraint */
    protected $tags;

    /** @var NumberConstraint */
    protected $minAmount;

    /** @var BooleanConstraint */
    protected $favorite;

    /** @var BooleanConstraint */
    protected $needsReview;

    /** @var NumberConstraint */
    protected $mass;

    /** @var DateTimeConstraint */
    protected $lastModified;

    /** @var DateTimeConstraint */
    protected $addedDate;

    /** @var EntityConstraint */
    protected $category;

    /** @var EntityConstraint */
    protected $footprint;

    /** @var EntityConstraint */
    protected $manufacturer;

    /** @var EntityConstraint */
    protected $supplier;

    /** @var EntityConstraint */
    protected $storelocation;

    /** @var EntityConstraint */
    protected $measurementUnit;

    /** @var TextConstraint */
    protected $manufacturer_product_url;

    /** @var TextConstraint */
    protected $manufacturer_product_number;

    public function __construct(NodesListBuilder $nodesListBuilder)
    {
        $this->name = new TextConstraint('part.name');
        $this->description = new TextConstraint('part.description');
        $this->comment = new TextConstraint('part.comment');
        $this->category = new EntityConstraint($nodesListBuilder, Category::class, 'part.category');
        $this->footprint = new EntityConstraint($nodesListBuilder, Footprint::class, 'part.footprint');
        $this->tags = new TagsConstraint('part.tags');

        $this->favorite = new BooleanConstraint('part.favorite');
        $this->needsReview = new BooleanConstraint('part.needs_review');
        $this->measurementUnit = new EntityConstraint($nodesListBuilder, MeasurementUnit::class, 'part.partUnit');
        $this->mass = new NumberConstraint('part.mass');
        $this->dbId = new NumberConstraint('part.id');
        $this->addedDate = new DateTimeConstraint('part.addedDate');
        $this->lastModified = new DateTimeConstraint('part.lastModified');

        $this->minAmount = new NumberConstraint('part.minAmount');
        $this->supplier = new EntityConstraint($nodesListBuilder, Supplier::class, 'orderdetails.supplier');

        $this->manufacturer = new EntityConstraint($nodesListBuilder, Manufacturer::class, 'part.manufacturer');
        $this->manufacturer_product_number = new TextConstraint('part.manufacturer_product_number');
        $this->manufacturer_product_url = new TextConstraint('part.manufacturer_product_url');

        $this->storelocation = new EntityConstraint($nodesListBuilder, Storelocation::class, 'partLots.storage_location');
    }

    public function apply(QueryBuilder $queryBuilder): void
    {
        $this->applyAllChildFilters($queryBuilder);
    }


    /**
     * @return BooleanConstraint|false
     */
    public function getFavorite()
    {
        return $this->favorite;
    }

    /**
     * @return BooleanConstraint
     */
    public function getNeedsReview(): BooleanConstraint
    {
        return $this->needsReview;
    }

    public function getMass(): NumberConstraint
    {
        return $this->mass;
    }

    public function getName(): TextConstraint
    {
        return $this->name;
    }

    public function getDescription(): TextConstraint
    {
        return $this->description;
    }

    /**
     * @return DateTimeConstraint
     */
    public function getLastModified(): DateTimeConstraint
    {
        return $this->lastModified;
    }

    /**
     * @return DateTimeConstraint
     */
    public function getAddedDate(): DateTimeConstraint
    {
        return $this->addedDate;
    }

    public function getCategory(): EntityConstraint
    {
        return $this->category;
    }

    /**
     * @return EntityConstraint
     */
    public function getFootprint(): EntityConstraint
    {
        return $this->footprint;
    }

    /**
     * @return EntityConstraint
     */
    public function getManufacturer(): EntityConstraint
    {
        return $this->manufacturer;
    }

    /**
     * @return EntityConstraint
     */
    public function getSupplier(): EntityConstraint
    {
        return $this->supplier;
    }

    /**
     * @return EntityConstraint
     */
    public function getStorelocation(): EntityConstraint
    {
        return $this->storelocation;
    }

    /**
     * @return EntityConstraint
     */
    public function getMeasurementUnit(): EntityConstraint
    {
        return $this->measurementUnit;
    }

    /**
     * @return NumberConstraint
     */
    public function getDbId(): NumberConstraint
    {
        return $this->dbId;
    }

    /**
     * @return TextConstraint
     */
    public function getComment(): TextConstraint
    {
        return $this->comment;
    }

    /**
     * @return NumberConstraint
     */
    public function getMinAmount(): NumberConstraint
    {
        return $this->minAmount;
    }

    /**
     * @return TextConstraint
     */
    public function getManufacturerProductUrl(): TextConstraint
    {
        return $this->manufacturer_product_url;
    }

    /**
     * @return TextConstraint
     */
    public function getManufacturerProductNumber(): TextConstraint
    {
        return $this->manufacturer_product_number;
    }

    /**
     * @return TagsConstraint
     */
    public function getTags(): TagsConstraint
    {
        return $this->tags;
    }
}

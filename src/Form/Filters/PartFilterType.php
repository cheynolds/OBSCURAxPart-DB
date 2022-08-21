<?php

namespace App\Form\Filters;

use App\DataTables\Filters\PartFilter;
use App\Entity\Parts\Category;
use App\Entity\Parts\Footprint;
use App\Entity\Parts\Manufacturer;
use App\Entity\Parts\MeasurementUnit;
use App\Entity\Parts\Storelocation;
use App\Form\Filters\Constraints\BooleanConstraintType;
use App\Form\Filters\Constraints\DateTimeConstraintType;
use App\Form\Filters\Constraints\NumberConstraintType;
use App\Form\Filters\Constraints\StructuralEntityConstraintType;
use App\Form\Filters\Constraints\TagsConstraintType;
use App\Form\Filters\Constraints\TextConstraintType;
use Svg\Tag\Text;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartFilterType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'compound' => true,
            'data_class' => PartFilter::class,
            'csrf_protection' => false,
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*
         * Common tab
         */

        $builder->add('name', TextConstraintType::class, [
            'label' => 'part.edit.name',
        ]);

        $builder->add('description', TextConstraintType::class, [
            'label' => 'part.edit.description',
        ]);

        $builder->add('category', StructuralEntityConstraintType::class, [
            'label' => 'part.edit.category',
            'entity_class' => Category::class
        ]);

        $builder->add('footprint', StructuralEntityConstraintType::class, [
            'label' => 'part.edit.footprint',
            'entity_class' => Footprint::class
        ]);

        $builder->add('tags', TagsConstraintType::class, [
            'label' => 'part.edit.tags'
        ]);

        $builder->add('comment', TextConstraintType::class, [
            'label' => 'part.edit.comment'
        ]);

        /*
         * Advanced tab
         */

        $builder->add('dbId', NumberConstraintType::class, [
            'label' => 'part.filter.dbId',
            'min' => 1,
        ]);

        $builder->add('favorite', BooleanConstraintType::class, [
            'label' => 'part.edit.is_favorite'
        ]);

        $builder->add('needsReview', BooleanConstraintType::class, [
            'label' => 'part.edit.needs_review'
        ]);

        $builder->add('mass', NumberConstraintType::class, [
            'label' => 'part.edit.mass',
            'text_suffix' => 'g',
            'min' => 0,
        ]);

        $builder->add('measurementUnit', StructuralEntityConstraintType::class, [
            'label' => 'part.edit.partUnit',
            'entity_class' => MeasurementUnit::class
        ]);

        $builder->add('lastModified', DateTimeConstraintType::class, [
            'label' => 'lastModified'
        ]);

        $builder->add('addedDate', DateTimeConstraintType::class, [
            'label' => 'createdAt'
        ]);


        /*
         * Manufacturer tab
         */

        $builder->add('manufacturer', StructuralEntityConstraintType::class, [
            'label' => 'part.edit.manufacturer.label',
            'entity_class' => Manufacturer::class
        ]);

        $builder->add('manufacturer_product_url', TextConstraintType::class, [
            'label' => 'part.edit.manufacturer_url.label'
        ]);

        $builder->add('manufacturer_product_number', TextConstraintType::class, [
            'label' => 'part.edit.mpn'
        ]);

        /*
         * Purchasee informations
         */

        $builder->add('supplier', StructuralEntityConstraintType::class, [
            'label' => 'supplier.label',
            'entity_class' => Manufacturer::class
        ]);


        /*
         * Stocks tabs
         */
        $builder->add('storelocation', StructuralEntityConstraintType::class, [
            'label' => 'storelocation.label',
            'entity_class' => Storelocation::class
        ]);

        $builder->add('minAmount', NumberConstraintType::class, [
            'label' => 'part.edit.mininstock',
            'min' => 0,
        ]);


        $builder->add('submit', SubmitType::class, [
            'label' => 'Update',
        ]);
    }
}
<?php
namespace App\Form;

use App\Entity\Brand;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ProductType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('productname')
        ->add('productprice')
        ->add('productdes')
        ->add('Brand', EntityType::class, [
            'class' =>Brand::class,
            'choice_label' => 'brandname'
        ])
        ->add('file',FileType::class, [
            'label' => 'Image',
            'required'=>false,
            'mapped' => false
        ])
        ->add('image',HiddenType::class, [
            'required' => false
        ])
        ->add('save',SubmitType::class, [
            'label' => "Confirm"
        ])
        ;
    }
}
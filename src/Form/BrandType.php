<?php
namespace App\Form;

use App\Entity\Brand;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class BrandType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('brandname')
        // ->add('Brand', EntityType::class, [
        //     'class' =>Brand::class,
        //     'choice_label' => 'brandname'
        // ])
        ->add('save',SubmitType::class, [
            'label' => "Confirm"
        ])
        ;
    }
}
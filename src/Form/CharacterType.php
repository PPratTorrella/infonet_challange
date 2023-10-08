<?php

namespace App\Form;

use App\Entity\Character;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CharacterType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('name', TextType::class, [
				'label' => 'Name',
				'attr' => ['class' => 'form-control']
			])
			->add('mass', NumberType::class, [
				'label' => 'Mass',
				'attr' => ['class' => 'form-control']
			])
			->add('height', NumberType::class, [
				'label' => 'Height',
				'attr' => ['class' => 'form-control']
			])
			->add('gender', ChoiceType::class, [
				'label' => 'Gender',
				'choices' => [
					'Male' => 'male',
					'Female' => 'female',
					'Other' => 'other'
				],
				'attr' => ['class' => 'form-control']
			])
			->add('picture', FileType::class, [
				'label' => 'Upload Picture',
				'mapped' => false,
				'required' => false,
				'attr' => ['class' => 'form-control-file']
			])
			->add('submit', SubmitType::class, [
				'label' => 'Save',
				'attr' => ['class' => 'btn btn-primary mt-3']
			]);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => Character::class,
		]);
	}
}

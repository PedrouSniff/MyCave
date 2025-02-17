<?php

namespace App\Controller\Admin;

use App\Entity\Caves;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CavesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Caves::class;
    }
 
    public function configureFields(string $pageName): iterable
    {
        return [
            TextEditorField::new('nom'),
            TextEditorField::new('description'),
            DateField::new('date'),
            ImageField::new('imageName')
                ->setBasePath('images')
                ->setUploadDir('public/images/'),        
        ];
    }
}

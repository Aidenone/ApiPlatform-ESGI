<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Borrow;
use App\Entity\Borrower;
use App\Entity\Copybook;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    	$faker = Faker\Factory::create('fr_FR');
    	$populator = new Faker\ORM\Doctrine\Populator($faker, $manager);
        $populator->addEntity(User::class, 10); 
        $insertedPKs = $populator->execute();

        for ($i = 0; $i < 10; $i++) {
            $author = new Author();
            $author->setLastname($faker->lastName);
            $author->setFirstname($faker->firstName);
            $author->setAge(mt_rand(10, 100));
            $manager->persist($author);

            $book = new Book();
            $book->setReference($faker->randomNumber(8));
            $book->setName($faker->name);
            $book->setDescription('description_'.$i);
            $book->setPublicationDate($faker->dateTime());
            $book->setAuthor($author);
            $manager->persist($book);

            $copybook = new Copybook();
            $copybook->setCopybookNumber($faker->randomNumber(3));
            $copybook->setBook($book);
            $manager->persist($copybook);

            $borrower = new Borrower();
            $borrower->setLastname($faker->lastName());
            $borrower->setFirstname($faker->firstName());
            $borrower->setPhone($faker->phoneNumber());
            $borrower->setEmail($faker->email());
            $borrower->setAddress($faker->address());
            $manager->persist($borrower);

            $borrow = new Borrow();
            $borrow->setBorrowingDate($faker->dateTime());
            $borrow->setReturnDate($faker->dateTime());
            $borrow->setState($faker->numberBetween(0, 1));
            $borrow->setBorrowers($borrower);
            $borrow->setCopybook($copybook);
            $manager->persist($borrow);
        }

        $manager->flush();
    }
}

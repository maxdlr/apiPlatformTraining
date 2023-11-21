<?php
namespace App\Factory;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
* @extends ModelFactory<User>

    */
final class UserFactory extends ModelFactory
{
    const USERNAMES = [
        'FlamingInferno',
        'ScaleSorcerer',
        'TheDragonWithBadBreath',
        'BurnedOut',
        'ForgotMyOwnName',
        'ClumsyClaws',
        'HoarderOfUselessTrinkets',
    ];

    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    )
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
        'email' => self::faker()->email(),
        'password' => 'password',
        'username' => self::faker()->randomElement(self::USERNAMES) . self::faker()->randomNumber(3),
        ];
    }

    protected function initialize(): self
    {
        return $this
            ->afterInstantiate(function(User $user): void {
                $user->setPassword($this->passwordHasher->hashPassword(
                    $user,
                    $user->getPassword()
                ));
            })
        ;
    }

    protected static function getClass(): string
    {
        return User::class;
    }
}

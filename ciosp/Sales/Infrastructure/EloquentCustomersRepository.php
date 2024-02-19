<?php

namespace Ciosp\Sales\Infrastructure;

use App\Models\User;
use Ciosp\Sales\Domain\Entities\Customer;
use Ciosp\Sales\Domain\Repositories\ICustomersRepository;
use Ciosp\Sales\Domain\ValueObjects\Email;

final class EloquentCustomersRepository implements ICustomersRepository{

    public function getById(int $id): ?Customer {
        $user = User::find($id);

        if(is_null($user)){
            return null;
        }

        return new Customer(
            $user->id,
            $user->name,
            new Email($user->email)
        );
    }

}

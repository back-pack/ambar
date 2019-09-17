<?php

namespace App\Repositories;

use App\Client;
use App\Http\Requests\ClientRequest;

class ClientRepository
{
    public function all()
    {
        return Client::paginate(config('pagination.model.client'));
    }

    public function create(ClientRequest $request): Client
    {
        return Client::create($request->validated());
    }

    public function update(ClientRequest $request, Client $client): Client
    {
        $client->update($request->validated());

        return $client;
    }

    public function delete(Client $client)
    {
        $client->delete();
    }
}

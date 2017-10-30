<?php

namespace Contacts\Http\Controllers;

use Contacts\Repositories\ContactRepository;
use Illuminate\Http\Request;
use Contacts\Http\Resources\Contact as ContactResource;

class ContactController extends Controller
{

    /**
     * @var ContactRepository
     */
    private $repository;

    /**
     * ContactController constructor.
     * @param ContactRepository $repository
     */
    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of resources
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request) {

        $contacts = $this->repository->paginate(30);

        return ContactResource::collection($contacts);
    }

    /**
     * Store the new contact
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request) {

        $contact = $this->repository->create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->name . '@pagelab.io'
        ]);

        return new ContactResource($contact);
    }

    /**
     * Display a listing of resources
     * @param string $query
     * @return mixed
     */
    public function search($query = '') {

        $contacts = $this->repository->search($query);

        return ContactResource::collection($contacts);
    }
}

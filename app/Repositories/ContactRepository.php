<?php

namespace Contacts\Repositories;

use Contacts\Models\Contact;

class ContactRepository extends BasicRepository {

    /**
     * Especifíca el Model que será utilizado.
     *
     * @return mixed
     */
    public function model()
    {
        return Contact::class;
    }

    /**
     * Guarda un objeto no vacío.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        $contact = new Contact();
        $contact->email = $data['email'];
        $contact->name = $data['name'];
        $contact->phone = $data['phone'];
        $contact->address = $data['address'];
        $contact->user_id = 1;
        $contact->save();

        return $contact;
    }

    /**
     * Search records for string query specified
     *
     * @param string $query
     * @return mixed
     */
    public function search($query)
    {
        //return $this->model->where('name', 'like', "%$query%")->where('user_id', 1)->get();
        return Contact::search($query)->where('user_id', 1)->get();
    }

}
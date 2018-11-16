<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function all();

    /*public function paginate($limit = null, $columns = array('*'));*/

    public function find($id);
    
    public function findWithTrash($id);

    /*public function findByField($field, $value, $columns = array('*'));*/

    public function findWhere($where , $columns);

    public function whereWithTrash($where , $columns);

    /*public function findWhereIn( $field, array $values, $columns = array('*'));

    public function findWhereNotIn( $field, array $values, $columns = array('*'));*/

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);
}

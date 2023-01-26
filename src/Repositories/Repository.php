<?php

namespace Genesis\Repositories;

use Genesis\Adhoc\DynamicAttribute;
use Genesis\Repositories\Concerns\HasCrud;
use Genesis\Repositories\Concerns\HasSoftDelete;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Traits\Macroable;

abstract class Repository
{
    use Macroable;
    use DynamicAttribute;
    use HasSoftDelete;
    use HasCrud;

    /**
     * The eloquent model.
     *
     * @var unknown
     */
    protected $model;

    /**
     * Class constructor.
     *
     * @param Container $app
     * @param Model     $model
     */
    public function __construct(Model $model = null)
    {
        $this->model = $model;
    }

    /**
     *  Return the model related to this finder.
     *
     *  @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set model.
     *
     * @param Model $model
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function setModel(Model $model)
    {
        return $this->model = $model;
    }

    /**
     *  Check if the model's table exists.
     *
     *  @return bool
     */
    public function tableExists()
    {
        return $this->model->getConnection()->getSchemaBuilder()->hasTable($this->model->getTable());
    }

    /**
     * Returns total number of entries in DB.
     *
     * @return int
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * Dynamically handle calls to the class.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public static function __callStatic($method, $parameters)
    {
        return forward_static_call_array([$this->model, $method], $parameters);
    }

    /**
     * Dynamically handle calls to the class.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->model, $method], $parameters);
    }
}

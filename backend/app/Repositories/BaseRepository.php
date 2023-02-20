<?php

namespace App\Repositories;

use App\Models\BaseModel;
use App\Models\User;
use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Model;
use App\Validators\CustomValidator;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseRepository
{
    public static $model;

    /**
     * @throws \Exception
     */
    public static function create(array $attributes, ?int $id): array
    {
        $attributes = (new CustomValidator($attributes, static::$model::$createRules))->getAttributes();
        $model = new static::$model($attributes);

        $model->save();
        return ['data' => $model, 'status' => Response::HTTP_CREATED];

    }

    public static function update(array $attributes, ?int $id): array
    {
        $attributes = (new CustomValidator($attributes, static::$model::$updateRules))->getAttributes();
        $model = (new static::$model())->find($id);
        if (is_null($model))
            return ['data' => [], 'status' => Response::HTTP_NOT_FOUND];

        $model->update($attributes);

        return ['data' => $model, 'status' => Response::HTTP_CREATED];
    }

    public static function delete(array $attributes, ?int $id): array
    {
        $model = (new static::$model())->find($id);
        if (is_null($model))
            return ['data' => [], 'status' => Response::HTTP_NOT_FOUND];

        $success = (bool)$model->delete();
        return ['data' => ['success' => $success], 'status' => Response::HTTP_CREATED];
    }

    public static function get(array $attributes, ?int $id)
    {
        return (is_null($id)) ? static::getMany($attributes) : static::getOne($id, $attributes);
    }

    private static function getMany(array $attributes): array
    {
        $data = (new static::$model())::all();

        return ['data' => $data, 'status' => Response::HTTP_OK];
    }

    private static function getOne(int $id, array $attributes): array
    {
        $model = (new static::$model())::find($id);

        if (is_null($model))
            return ['data' => [], 'status' => Response::HTTP_NOT_FOUND];

        return ['data' => $model->getAttributes(), 'status' => Response::HTTP_OK];
    }
}

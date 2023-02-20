<?php

namespace App\Repositories;

use App\Exceptions\ValidationException;
use App\Models\Item;
use App\Models\Review;
use App\Models\ReviewFile;
use App\Models\User;
use App\Validators\CustomValidator;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

class ReviewFileRepository extends BaseRepository
{
    public static $model = ReviewFile::class;

    public static function create(array $attributes, ?int $id): array
    {
        /**
         * @var UploadedFile $image
         */

        $image = $attributes['image'];
        unset($attributes['image']);

        $review = Review::query()->find($attributes['review_id']);
        if (!$review) {
            $validationError = new ValidationException();
            $validationError->setValidationError(['path' => 'Произошла ошибка при сохранении']);
            throw $validationError;
        }

        $userKey =  $review->user()->first()->getKey();
        $path = $userKey . '/ReviewFiles';


        $serverImagePath = $image->store('/public/' . $path);

        if (!$serverImagePath) {
            $validationError = new ValidationException();
            $validationError->setValidationError(['path' => 'Произошла ошибка при сохранении']);
            throw $validationError;
        }

        $attributes['path'] = $image->hashName($path);
        $attributes['review_count'] = (int)$review->loadCount('reviewFiles')->getAttribute('review_files_count') + 1;
        $attributes['extension'] = $image->getClientOriginalExtension();
        $attributes = (new CustomValidator($attributes, static::$model::$createRules))->getAttributes();

        unset($attributes['review_count']);

        $model = new static::$model($attributes);

        $model->save();

        return ['data' => $model, 'status' => Response::HTTP_CREATED];
    }

}

<?php

declare(strict_types=1);

namespace App\Http\UseCases\Api\v1\Campain;

use App\Http\Shared\MakeApiResponse;
use App\Models\Post as Campain;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

final class UpdateUseCase
{
    use MakeApiResponse;

    public function handle(Campain $campain, array $data): JsonResponse
    {


        //Upload thumbnail image
        if (isset($data['thumbnail'])) {
            $data['featured_image'] = $this->saveImgBase64($data['thumbnail'], 'thumbnail');
        }
        //Unset data files
        unset($data['thumbnail']);
        unset($data['files']);
        //tags_list
        unset($data['tags_list']);
        $dataTask = $data['tasks'];

        unset($data['tasks']);

        //$data['password'] = bcrypt($password);
        //$data['email_verified_at'] = now();

        $campain->update($data);
        //Clear old task
        $campain->tasks()->delete();
        //Store Task
        $campain->tasks()->createMany($dataTask);

        //Notification::send($campain, new AccountCreated($password));
        $dataReturn = $campain->toArray();
        //Data list tasks
        $dataReturn['tasks'] = $campain->tasks()->get()->toArray();

        return $this->successResponse('Campain updated successfully.', $campain);
    }

    protected function saveImgBase64($content, $folder)
    {
        $extension = '.jpg';

        preg_match('/.([0-9]+) /', microtime(), $m);

        $fileName = sprintf('img%s%s.%s', date('YmdHis'), $m[1], $extension);

        $storage = Storage::disk('cloudinary2');

        $checkDirectory = $storage->exists($folder);

        if (!$checkDirectory) {
            $storage->makeDirectory($folder);
        }

        $fileNameSave =$folder . '/' . $fileName;
        $storage->put($fileNameSave, base64_decode($content), 'public');
        $fullURL = Storage::disk('cloudinary2')->url($fileNameSave);

        return $fullURL;
    }
}

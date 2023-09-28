<?php

namespace App\Traits;

use Kreait\Firebase\Database;
use Kreait\Firebase\Factory;

/**
 * Class SyncsWithFirebase
 */
trait SyncsWithFirebase
{
    /**
     * @var Database|null
     */
    protected $firebaseClient;

    /**
     * Boot the trait and add the model events to synchronize with firebase
     */
    public static function bootSyncsWithFirebase()
    {
        static::created(function ($model) {
            $model->saveToFirebase('set');
        });
        static::updated(function ($model) {
            $model->saveToFirebase('update');
        });
        static::deleted(function ($model) {
            $model->saveToFirebase('delete');
        });
        /*static::retrieved(function ($model) {
            $model->saveToFirebase('get');
        });*/
        /* static::forceDeleted(function ($model) {
             $model->saveToFirebase('delete');
         });*/
        /* static::restored(function ($model) {
             $model->saveToFirebase('set');
         });*/
    }

    /**
     * @param  Database|null  $firebaseClient
     */
    public function setFirebaseClient(Database $firebaseClient)
    {
        $this->firebaseClient = $firebaseClient;
    }

    /**
     * @return array
     */
    protected function getFirebaseSyncData()
    {
        if ($fresh = $this->fresh()) {
            return $fresh->toArray();
        }

        return [];
    }

    protected function saveToFirebase($mode)
    {
        if (is_null($this->firebaseClient)) {
            //$this->firebaseClient = new FirebaseLib(config('services.firebase.database_url'), config('services.firebase.secret'));
            $dbUri = env('FIREBASE_DATABASE_URL');
            $factory = (new Factory())->withDatabaseUri($dbUri);
            $this->firebaseClient = $factory->createDatabase();
        }

        $path = env('APP_ENV').'/schedule/'.$this->getTable().'/'.$this->getKey();

        if ($mode === 'set') {
            //$this->firebaseClient->set($path, $this->getFirebaseSyncData());
            $this->firebaseClient->getReference($path)
                ->set($this->getFirebaseSyncData());
        } elseif ($mode === 'update') {
            //$this->firebaseClient->update($path, $this->getFirebaseSyncData());
            $this->firebaseClient->getReference($path)
                ->set($this->getFirebaseSyncData());
        } elseif ($mode === 'delete') {
            $this->firebaseClient->getReference($path)
                ->remove();
        } elseif ($mode === 'get') {
            $reference = $this->firebaseClient->getReference($path);
            $snapshot = $reference->getSnapshot();
            //$value = $snapshot->getValue();
            $value = $reference->getValue();
        }
    }
}

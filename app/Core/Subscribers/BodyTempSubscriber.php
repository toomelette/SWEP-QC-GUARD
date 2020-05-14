<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class BodyTempSubscriber extends BaseSubscriber{



    public function __construct(){
        parent::__construct();
    }



    public function subscribe($events){

        $events->listen('body_temp.store', 'App\Core\Subscribers\BodyTempSubscriber@onStore');
        $events->listen('body_temp.update', 'App\Core\Subscribers\BodyTempSubscriber@onUpdate');
        $events->listen('body_temp.destroy', 'App\Core\Subscribers\BodyTempSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:body_temp:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:body_temp:countByDateStatus:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:body_temp:getByDate:*');

        $this->session->flash('BODY_TEMP_CREATE_SUCCESS', 'The Body Temperature has been successfully created!');

    }





    public function onUpdate($body_temp){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:body_temp:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:body_temp:getAll');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:body_temp:countByDateStatus:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:body_temp:getByDate:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:body_temp:findBySlug:'. $body_temp->slug .'');

        $this->session->flash('BODY_TEMP_UPDATE_SUCCESS', 'The Body Temperature has been successfully updated!');
        $this->session->flash('BODY_TEMP_UPDATE_SUCCESS_SLUG', $body_temp->slug);

    }



    public function onDestroy($body_temp){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:body_temp:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:body_temp:getAll');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:body_temp:countByDateStatus:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:body_temp:getByDate:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:body_temp:findBySlug:'. $body_temp->slug .'');

        $this->session->flash('BODY_TEMP_DELETE_SUCCESS', 'The Body Temperature has been successfully deleted!');
        $this->session->flash('BODY_TEMP_DELETE_SUCCESS_SLUG', $body_temp->slug);

    }



}
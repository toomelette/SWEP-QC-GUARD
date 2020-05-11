<?php

namespace App\Providers;


use View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider{

    
    public function boot(){

        /** VIEW COMPOSERS  **/


        // USERMENU
        View::composer('layouts.admin-sidenav', 'App\Core\ViewComposers\UserMenuComposer');


        // MENU
        View::composer(['dashboard.user.create', 
                        'dashboard.user.edit'], 'App\Core\ViewComposers\MenuComposer');
        

        // SUBMENU
        View::composer(['dashboard.user.create', 
                        'dashboard.user.edit'], 'App\Core\ViewComposers\SubmenuComposer');
        

        // EMPLOYEES
        View::composer(['dashboard.body_temp.create', 
                        'dashboard.body_temp.edit'], 'App\Core\ViewComposers\EmpMasterComposer');
        

        // COS
        View::composer(['dashboard.body_temp.create', 
                        'dashboard.body_temp.edit'], 'App\Core\ViewComposers\CosMasterComposer');

        
    }

    




    
    public function register(){

      


    
    }




}

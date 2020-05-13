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
                        'dashboard.body_temp.edit', 
                        'dashboard.body_temp.reports'], 'App\Core\ViewComposers\EmpMasterComposer');
        

        // COS
        View::composer(['dashboard.body_temp.create', 
                        'dashboard.body_temp.edit', 
                        'dashboard.body_temp.reports'], 'App\Core\ViewComposers\CosMasterComposer');
        

        // Janitors
        View::composer(['dashboard.body_temp.create', 
                        'dashboard.body_temp.edit', 
                        'dashboard.body_temp.reports'], 'App\Core\ViewComposers\JanitorMasterComposer');
        

        // Sec Guards
        View::composer(['dashboard.body_temp.create', 
                        'dashboard.body_temp.edit', 
                        'dashboard.body_temp.reports'], 'App\Core\ViewComposers\SecGuardMasterComposer');

        
    }

    




    
    public function register(){

      


    
    }




}

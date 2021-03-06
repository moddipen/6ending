<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Menu::make('admin_sidebar', function ($menu) {
            // Dashboard
            $menu->add('<i class="cil-speedometer c-sidebar-nav-icon"></i> Dashboard', [
                'route' => 'backend.dashboard',
                'class' => 'c-sidebar-nav-item',
            ])
            ->data([
                'order'         => 1,
                'activematches' => 'admin/dashboard*',
                'permission'    => ['view_user_dashboard'],
            ])
            ->link->attr([
                'class' => 'c-sidebar-nav-link',
            ]);

            // Users
            $menu->add('<i class="c-sidebar-nav-icon cil-people"></i> Users', [
                'route' => 'backend.users.index',
                'class' => 'c-sidebar-nav-item',
            ])
            ->data([
                'order'         => 2,
                'activematches' => 'admin/users*',
                'permission'    => ['view_users'],
            ])
            ->link->attr([
                'class' => 'c-sidebar-nav-link',
            ]);

            // Event Manager
            $menu->add('<i class="c-sidebar-nav-icon cil-task"></i> Event Manager', [
                'route' => 'backend.eventmanagers.index',
                'class' => 'c-sidebar-nav-item',
            ])
            ->data([
                'order'         => 3,
                'activematches' => 'admin/eventmanagers*',
                'permission'    => ['view_eventmanagers'],
            ])
            ->link->attr([
                'class' => 'c-sidebar-nav-link',
            ]);

            // User Dashboard
            $menu->add('<i class="cil-speedometer c-sidebar-nav-icon"></i> Dashboard', [
                'route' => 'backend.users.dashboard',
                'class' => 'c-sidebar-nav-item',
            ])
            ->data([
                'order'         => 5,
                'activematches' => 'admin/users/dashboard*',
                'permission'    => ['users_dashboard'],
            ])
            ->link->attr([
                'class' => 'c-sidebar-nav-link',
            ]);

            // Matches 
            $menu->add('<i class="c-sidebar-nav-icon cil-task"></i> Matches', [
                'route' => 'backend.matches.index',
                'class' => 'c-sidebar-nav-item',
            ])
            ->data([
                'order'         => 6,
                'activematches' => 'admin/matches*',
                'permission'    => ['view_matches'],
            ])
            ->link->attr([
                'class' => 'c-sidebar-nav-link',
            ]);

            // Reports 
            $menu->add('<i class="c-sidebar-nav-icon cil-task"></i> Account Statement', [
                'route' => 'backend.credit.debit.report',
                'class' => 'c-sidebar-nav-item',
            ])
            ->data([
                'order'         => 7,
                'activematches' => 'admin/credit-debit*',
                'permission'    => ['view_account_statement'],
            ])
            ->link->attr([
                'class' => 'c-sidebar-nav-link',
            ]);

            $menu->add('<i class="c-sidebar-nav-icon cil-task"></i> Bet History Report', [
                'route' => 'backend.betting.history.report',
                'class' => 'c-sidebar-nav-item',
            ])
            ->data([
                'order'         => 8,
                'activematches' => 'admin/bethistory*',
                'permission'    => ['view_bet_history_report'],
            ])
            ->link->attr([
                'class' => 'c-sidebar-nav-link',
            ]);



            $menu->add('<i class="c-sidebar-nav-icon cil-task"></i> Current Bet Report', [
                'route' => 'backend.betting.report',
                'class' => 'c-sidebar-nav-item',
            ])
            ->data([
                'order'         => 9,
                'activematches' => 'admin/betting*',
                'permission'    => ['view_current_bet_report'],
            ])
            ->link->attr([
                'class' => 'c-sidebar-nav-link',
            ]);

            $menu->add('<i class="c-sidebar-nav-icon cil-task"></i> Profit/Loss Report', [
                'route' => 'backend.profit.loss.report',
                'class' => 'c-sidebar-nav-item',
            ])
            ->data([
                'order'         => 10,
                'activematches' => 'admin/profit-loss*',
                'permission'    => ['view_profit_loss_report'],
            ])
            ->link->attr([
                'class' => 'c-sidebar-nav-link',
            ]);

            /*// Event Manager
            $menu->add('<i class="c-sidebar-nav-icon cil-task"></i> Matches', [
                'route' => 'backend.matches.index',
                'class' => 'c-sidebar-nav-item',
            ])
            ->data([
                'order'         => 2,
                'activematches' => 'admin/matches*',
                'permission'    => ['view_users'],
            ])
            ->link->attr([
                'class' => 'c-sidebar-nav-link',
            ]);
*/

            // Settings
            $menu->add('<i class="c-sidebar-nav-icon fas fa-cogs"></i> Settings', [
                'route' => 'backend.settings',
                'class' => 'c-sidebar-nav-item',
            ])
            ->data([
                'order'         => 15,
                'activematches' => 'admin/settings*',
                'permission'    => ['edit_settings'],
            ])
            ->link->attr([
                'class' => 'c-sidebar-nav-link',
            ]);
            // Access Permission Check
            $menu->filter(function ($item) {
                if ($item->data('permission')) {
                    if (auth()->check()) {
                        // if (auth()->user()->hasRole('super admin')) {
                        //     return true;
                        // } else
                        if (auth()->user()->hasAnyPermission($item->data('permission'))) {
                            return true;
                        }
                    }

                    return false;
                } else {
                    return true;
                }
            });

            // Set Active Menu
            $menu->filter(function ($item) {
                if ($item->activematches) {
                    $matches = is_array($item->activematches) ? $item->activematches : [$item->activematches];

                    foreach ($matches as $pattern) {
                        if (Str::is($pattern, \Request::path())) {
                            $item->activate();
                            $item->active();
                            if ($item->hasParent()) {
                                $item->parent()->activate();
                                $item->parent()->active();
                            }
                            // dd($pattern);
                        }
                    }
                }

                return true;
            });
        })->sortBy('order');

return $next($request);
}
}

<?php
namespace Modules\User;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Modules\Gig\Models\Gig;
use Modules\ModuleServiceProvider;
use Modules\Payout\Models\VendorPayout;
use Modules\User\Models\Plan;
use Modules\Vendor\Models\VendorRequest;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        Blade::directive('has_permission', function ($expression) {
            return "<?php if(auth()->user()->hasPermission({$expression})): ?>";
        });
        Blade::directive('end_has_permission', function ($expression) {
            return "<?php endif; ?>";
        });

    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
    }

    public static function getBookableServices()
    {
        return ['plan'=>Plan::class];
    }

    public static function getAdminMenu()
    {
        $noti_verify = User::countVerifyRequest();
        $noti = $noti_verify;

        $options = [
            "position"=>100,
            'url'        => 'admin/module/user',
            'title'      => __('Users :count',['count'=>$noti ? sprintf('<span class="badge badge-warning">%d</span>',$noti) : '']),
            'icon'       => 'icon ion-ios-contacts',
            'permission' => 'user_manage',
            'children'   => [
                'user'=>[
                    'url'   => 'admin/module/user',
                    'title' => __('All Users')
                ],
                'role'=>[
                    'url'        => 'admin/module/user/role',
                    'title'      => __('Role Manager'),
                    'permission' => 'role_manage'
                ],
                'subscriber'=>[
                    'url'        => 'admin/module/user/subscriber',
                    'title'      => __('Subscribers'),
                    'permission' => 'newsletter_manage',
                ],
            ]
        ];
        return [
            'users'=> $options,
            'plan'=>[
                "position"=>50,
                'url'        => route('user.admin.plan.index'),
                'title'      => __('User Plans'),
                'icon'       => 'icon ion-ios-contacts',
                'permission' => 'user_manage',
                'children'   => [
                    'user-plan'=>[
                        'url'   => route('user.admin.plan.index'),
                        'title' => __('User Plans'),
                        'permission' => 'user_manage',
                    ],
                    'employer-plan'=>[
                        'url'        => route('user.admin.plan_report.index'),
                        'title'      => __('Plan Report'),
                        'permission' => 'user_manage',
                    ],
                ]
            ]
        ];
    }

    public static function getUserFrontendMenu()
    {
        $configs = [
            'user_dashboard' => [
                'url' => 'user/dashboard',
                'title' => __("Dashboard"),
                'icon' => 'la la-home',
                'enable' => true
            ],
            'seller_dashboard' => [
                'url' => 'seller/dashboard',
                'title' => __("Seller Dashboard"),
                'icon' => 'la la-home',
                'permission' => 'candidate_manage',
                'enable' => Gig::isEnable()
            ],
            'seller_gigs' => [
                'url' => 'seller/all-gigs',
                'title' => __("Gigs"),
                'icon' => 'la la-briefcase',
                'permission' => 'candidate_manage',
                'enable' => Gig::isEnable()
            ],
            'seller_order' => [
                'url' => 'seller/orders',
                'title' => __("Gig Orders"),
                'icon' => 'la la-luggage-cart',
                'permission' => 'candidate_manage',
                'enable' => Gig::isEnable()
            ],
            'buyer_order' => [
                'url' => 'buyer/orders',
                'title' => __("Gig Orders"),
                'icon' => 'la la-luggage-cart',
                'permission' => 'employer_manage',
                'enable' => Gig::isEnable() && !is_admin()
            ],
            'payout' => [
                'url' => 'user/payout',
                'title' => __("Payouts"),
                'icon' => 'las la-credit-card',
                'permission' => 'candidate_payout_manage',
                'enable' => VendorPayout::isEnable() && Gig::isEnable()
            ],

            'user_profile' => [
                'url' => 'user/profile',
                'title' => __("My Profile"),
                'icon' => 'la la-user-tie',
                'enable' => true
            ],
            'company_profile' => [
                'url' => 'user/company/profile',
                'title' => __("Company Profile"),
                'icon' => 'la la-user-tie',
                'permission' => 'employer_manage',
                'enable' => true
            ],
            'new_job' => [
                'url' => 'user/new-job',
                'title' => __("Post A New Job"),
                'icon' => 'la la-paper-plane',
                'permission' => 'employer_manage',
                'enable' => true
            ],
            'manage_jobs' => [
                'url' => 'user/manage-jobs',
                'title' => __("Manage Jobs"),
                'icon' => 'la la-briefcase',
                'permission' => 'employer_manage',
                'enable' => true
            ],
            'my_orders' => [
                'url' => 'user/order',
                'title' => __("My Orders"),
                'icon' => 'la la-luggage-cart',
                'permission' => 'employer_manage',
                'enable' => true
            ],
            'all_applicants' => [
                'url' => 'user/applicants',
                'title' => __("All Applicants"),
                'icon' => 'la la-user-friends',
                'permission' => 'employer_manage',
                'enable' => true
            ],
            'applied_jobs' => [
                'url' => 'user/applied-jobs',
                'title' => __("Applied Jobs"),
                'icon' => 'la la-user-friends',
                'permission' => 'candidate_manage',
                'enable' => !is_admin()
            ],
            'user_bookmark' => [
                'url' => 'user/bookmark',
                'title' => __("Shortlisted Jobs"),
                'icon' => 'la la-bookmark-o',
                'permission' => 'candidate_manage',
                'enable' => !is_admin()
            ],
            'user_bookmark_employer' => [
                'url' => 'user/bookmark',
                'title' => __("Shortlisted"),
                'icon' => 'la la-bookmark-o',
                'permission' => 'employer_manage',
                'enable' => true
            ],
            'following_employers' => [
                'url' => 'user/following-employers',
                'title' => __("Following Employers"),
                'icon' => 'la la-user',
                'permission' => 'candidate_manage',
                'enable' => !is_admin()
            ],
            'my_plan' => [
                'url' => 'user/my-plan',
                'title' => __("My Plans"),
                'icon' => 'la la-box',
                'permission' => 'employer_manage',
                'enable' => true
            ],
            'my_contact' => [
                'url' => 'user/my-contact',
                'title' => __("My Contact"),
                'icon' => 'la la-envelope',
                'enable' => true
            ],
            'change_password' => [
                'url' => 'user/profile/change-password',
                'title' => __("Change Password"),
                'icon' => 'la la-lock',
                'enable' => true
            ],
            'user_logout' => [
                'url' => 'user/logout',
                'title' => __("Logout"),
                'icon' => 'la la-sign-out',
                'enable' => true
            ]
        ];
        return $configs;
    }

    public static function getUserMenu()
    {
        /**
         * @var $user User
         */
        $res = [];
        $user = Auth::user();

        $is_wallet_module_disable = setting_item('wallet_module_disable');
        if(empty($is_wallet_module_disable))
        {
            $res['wallet']= [
                'position'   => 27,
                'icon'       => 'fa fa-money',
                'url'        => route('user.wallet'),
                'title'      => __("My Wallet"),
            ];
        }

        if(setting_item('inbox_enable')) {
            $res['chat'] = [
                'position' => 20,
                'icon' => 'fa fa-comments',
                'url' => route('user.chat'),
                'title' => __("Messages"),
            ];
        }

        return $res;
    }
}

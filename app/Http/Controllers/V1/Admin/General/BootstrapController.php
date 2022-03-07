<?php

namespace Crater\Http\Controllers\V1\Admin\General;

use Crater\Http\Controllers\Controller;
use Crater\Http\Resources\CompanyResource;
use Crater\Http\Resources\UserResource;
use Crater\Models\Company;
use Crater\Models\CompanySetting;
use Crater\Models\Currency;
use Crater\Models\Module;
use Crater\Models\Setting;
use Crater\Traits\GeneratesMenuTrait;
use Illuminate\Http\Request;
use Silber\Bouncer\BouncerFacade;

class BootstrapController extends Controller
{
    use GeneratesMenuTrait;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $current_user = $request->user();
        $current_user_settings = $current_user->getAllSettings();

        $main_menu = $this->generateMenu('main_menu', $current_user);

        $setting_menu = $this->generateMenu('setting_menu', $current_user);

        $companies = $current_user->companies;

        $current_company = Company::find($request->header('company'));

        if ((! $current_company) || ($current_company && ! $current_user->hasCompany($current_company->id))) {
            $current_company = $current_user->companies()->first();
        }

        $current_company_settings = CompanySetting::getAllSettings($current_company->id);

        $current_company_currency = $current_company_settings->has('currency')
            ? Currency::find($current_company_settings->get('currency'))
            : Currency::first();

        BouncerFacade::refreshFor($current_user);

        $global_settings = Setting::getSettings([
            'api_token',
            'admin_portal_theme',
            'admin_portal_logo',
            'login_page_logo',
            'login_page_heading',
            'login_page_description',
            'admin_page_title',
            'copyright_text'
        ]);

        // $current_company_settings['has_transport_option'] = true;
        $current_company_settings['place_of_supply'] = 10;
        $current_company_settings['tax_formats'] = [
                ['code'=>'no_tax', 'label'=>'Exempted'],
                ['code'=>'igst', 'label'=>'IGST'],
                ['code'=>'csgst', 'label'=>'CGST + SGST']
            ];
            
        $current_company_settings['invoice_types'] = [
                ['code'=>'tax_invoice', 'label'=>'Tax Invoice'],
                ['code'=>'bill_of_supply', 'label'=>'Bill Of Supply'],
                ['code'=>'sez_with_tax', 'label'=>'SEZ with Tax'],
                ['code'=>'sez_without_tax', 'label'=>'SEZ without Tax'],
            ];
            

        return response()->json([
            'current_user' => new UserResource($current_user),
            'current_user_settings' => $current_user_settings,
            'current_user_abilities' => $current_user->getAbilities(),
            'companies' => CompanyResource::collection($companies),
            'current_company' => new CompanyResource($current_company),
            'current_company_settings' => $current_company_settings,
            'current_company_currency' => $current_company_currency,
            'config' => config('crater'),
            'global_settings' => $global_settings,
            'main_menu' => $main_menu,
            'setting_menu' => $setting_menu,
            'modules' => Module::where('enabled', true)->pluck('name'),
        ]);
    }
}

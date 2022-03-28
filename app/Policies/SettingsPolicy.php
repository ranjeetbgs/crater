<?php

namespace Crater\Policies;

use Crater\Models\Company;
use Crater\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Silber\Bouncer\BouncerFacade;

class SettingsPolicy
{
    use HandlesAuthorization;

    public function manageCompany(User $user, Company $company)
    {
        if ($user->id == $company->owner_id) {
            return true;
        }

        if (BouncerFacade::can('manage-company') && $user->hasCompany($company->id)) {
            return true;
        }

        return false;
    }

    public function manageBackups(User $user)
    {
        if ($user->isOwner()) {
            return true;
        }

        return false;
    }

    public function manageFileDisk(User $user)
    {
        if ($user->isOwner()) {
            return true;
        }

        return false;
    }

    public function manageEmailConfig(User $user)
    {
        if ($user->isOwner()) {
            return true;
        }

        return false;
    }

    public function manageSettings(User $user)
    {
        if ($user->isOwner()) {
            return true;
        }

        return false;
    }
}

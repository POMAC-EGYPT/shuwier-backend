<?php

namespace App\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;

trait AuthorizesAdminActions
{
    protected function checkPermission(string $permission): void
    {
        $admin = auth('admin')->user();

        if (!$admin || !$admin->can($permission))
            throw new HttpResponseException(
                Response::api(__('message.you_dont_have_permission_to_access_this_resource'), 403, false, 403)
            );
    }
}

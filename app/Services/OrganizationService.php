<?php

namespace App\Services;

class OrganizationService extends AbstractModelService
{
    protected static function getModelClass(): string
    {
        return \App\Models\Organization::class;
    }

    protected static function getFilterClass(): string
    {
        return \App\Filters\OrganizationFilter::class;
    }

    protected function afterCreate($organization, $params): void
    {
        $permissions = [
            'view_organization',
            'edit_organization',
            'delete_organization',
            'create_team',
            'edit_team',
            'delete_team'
        ];

        $organization->users()->attach($organization->user_id, [
            'permissions' => json_encode($permissions),
        ]);
    }
}

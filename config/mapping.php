<?php

return [
    \Story\Cms\Contracts\StoryCategory::class => \Story\Cms\Category::class,
    \Story\Cms\Contracts\StoryCategoryRepository::class => \Story\Cms\Repositories\CategoryRepository::class,
    \Story\Cms\Contracts\StoryUser::class => \Story\Cms\User::class,
    \Story\Cms\Contracts\StoryUserRepository::class => \Story\Cms\Repositories\UserRepository::class,
    \Story\Cms\Contracts\StoryRole::class => Story\Cms\Role::class,
    \Story\Cms\Contracts\StoryRoleRepository::class => Story\Cms\Repositories\RoleRepository::class,
];

<?php

return [
    \Story\Cms\Contracts\StoryCategory::class => \Story\Cms\Category::class,
    \Story\Cms\Contracts\StoryCategoryRepository::class => \Story\Cms\Repositories\CategoryRepository::class,
    \Story\Cms\Contracts\StoryUser::class => \Story\Cms\User::class,
    \Story\Cms\Contracts\StoryUserRepository::class => \Story\Cms\Repositories\UserRepository::class,
    \Story\Cms\Contracts\StoryRole::class => \Story\Cms\Role::class,
    \Story\Cms\Contracts\StoryRoleRepository::class => \Story\Cms\Repositories\RoleRepository::class,
    // \Story\Cms\Config\ConfigManager::class,
    \Story\Cms\Contracts\StoryPost::class => \Story\Cms\Post::class,
    \Story\Cms\Contracts\StoryPostRepository::class => \Story\Cms\Repositories\PostRepository::class
];

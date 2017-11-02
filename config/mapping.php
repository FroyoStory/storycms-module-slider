<?php

return [
    \Story\Framework\Contracts\StoryCategory::class => \Story\Framework\Category::class,
    \Story\Framework\Contracts\StoryCategoryRepository::class => \Story\Framework\Repositories\CategoryRepository::class,
    \Story\Framework\Contracts\StoryUser::class => \Story\Framework\User::class,
    \Story\Framework\Contracts\StoryUserRepository::class => \Story\Framework\Repositories\UserRepository::class,
    \Story\Framework\Contracts\StoryRole::class => \Story\Framework\Role::class,
    \Story\Framework\Contracts\StoryRoleRepository::class => \Story\Framework\Repositories\RoleRepository::class,
    \Story\Framework\Contracts\StoryPost::class => \Story\Framework\Post::class,
    \Story\Framework\Contracts\StoryPostMeta::class => \Story\Framework\PostMeta::class,
    \Story\Framework\Contracts\StoryPostRepository::class => \Story\Framework\Repositories\PostRepository::class,
    \Story\Framework\Contracts\StoryPostRepository::class => \Story\Framework\Repositories\PostRepository::class,
    \Story\Framework\Contracts\StoryMenu::class => \Story\Framework\Menu::class,
    \Story\Framework\Contracts\StoryMenuRepository::class => \Story\Framework\Repositories\MenuRepository::class,
    \Story\Framework\PostAttribute::class,

    // Support
    'theme' => \Story\Framework\Support\Theme::class,
    'seo' => \Story\Framework\Support\SEO::class,
    'plugin' => \Story\Framework\Support\Plugins\PluginManager::class,

];

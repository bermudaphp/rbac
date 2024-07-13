# Install
```bash
composer require bermudaphp/rbac
```
# How to use example
```php
enum Permissions {
    case READ_BLOG; //allows you to read all blogs
    case CREATE_BLOG; // allows you to create new blog
    case EDIT_BLOG; // allows you to edit any blog
}

class User implements \Bermuda\RBAC\RoleInterface
{
    private array $permissions;

    /**
     * @param int $id
     * @param iterable<string|\Bermuda\RBAC\PermissionInterface> $permissions
     */
    public function __construct(
        public int $id, iterable $permissions = []
    ){
        foreach ($permissions as $permission) {
            if ($permission instanceof \Bermuda\RBAC\PermissionInterface) {
                $this->permissions[$permission->getId()] = $permission;
            } else $this->associate($permission);
        }
    }


    public function getHierarchy(): int
    {
        return 0;
    }

    public function getPermissions(): iterable
    {
        return $this->permissions;
    }

    public function associate(string $permissionId): \Bermuda\RBAC\RoleInterface
    {
        $this->permissions[$permissionId] = new \Bermuda\RBAC\Permission($permissionId);
        return $this;
    }

    public function dissociate(string $permissionId): \Bermuda\RBAC\RoleInterface
    {
        unset($this->permissions[$permissionId]);
        return $this;
    }

    public function has(string $permissionId): bool
    {
        return array_key_exists($permissionId, $this->permissions);
    }
}

$guard = new \Bermuda\RBAC\Guard();

$user = new User('John Smith', [
    Permissions::CREATE_BLOG,
    Permissions::EDIT_BLOG,
    Permissions::READ_BLOG,
]);

readonly class Blog
{
    public function __construct(
        public ?int $id,
        public string $title,
        public object $author
    ) {
    }
}

readonly class BlogState
{
    public function __construct(
        public ?int $id = null,
        public ?string $title = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter(
            get_object_vars($this),
            static fn ($v) => $v !== null
        );
    }
}

$createBlogAction = function (\Bermuda\RBAC\AccessControl $rbac, \Bermuda\RBAC\RoleInterface $actor, BlogState $state)
{
    static $id = 0;

    if (!$rbac->enforce(Permissions::CREATE_BLOG->name, $actor)) {
        throw new Exception('User cannot create blog');
    }

    return new Blog($state->id ?? ++$id, $state->title, $actor);
};
$editBlogAction = function (\Bermuda\RBAC\AccessControl $rbac, \Bermuda\RBAC\RoleInterface $actor, Blog $blog, BlogState $state) use ($guard): Blog
{
    if (!$guard->enforce(Permissions::EDIT_BLOG->name, $actor, new EditBlogContext($blog))) {
        throw new Exception('User cannot edit blog');
    }

    foreach ($state->toArray() as $prop => $value) {
        $blog->$prop = $value;
    }

    // save blog logics

    return $blog;
};

$blog = $createBlogAction($guard, $user, new BlogState(null, 'My first blog'));

$user->dissociate(Permissions::EDIT_BLOG->name); // remove permission to edit any blog

$editBlogAction($guard, $user, $blog, new BlogState(title: 'New blog title')); // throw Exception

final class EditBlogContext
{
    public function __construct(
        public Blog $blog,
    ) {
    }
}

final class EditSelfBlogRule implements \Bermuda\RBAC\Rules\RuleInterface
{
    public function can(\Bermuda\RBAC\ActorInterface $actor, object $context = null): bool
    {
        /**
         * @var EditBlogContext $context
         */

        return $actor === $context->blog->author;
    }

    public function mode(): \Bermuda\RBAC\Rules\RuleMode
    {
        // The rule will work anyway
        return \Bermuda\RBAC\Rules\RuleMode::ever;
    }
}

$guard = $guard->withRules([Permissions::EDIT_BLOG->name => new EditSelfBlogRule]); // Now the user can edit their own blog even without global permission

$editBlogAction($guard, $user, $blog, new BlogState(title: 'New blog title')); // success

````

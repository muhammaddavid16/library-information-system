<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        DB::table('users')->delete();
    }

    public function testInsert(): void
    {
        $user = new User([
            'name' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        $result = $user->save();

        self::assertTrue($result);
    }

    public function testInserMany(): void
    {
        $users = [
            [
                'name' => 'admin',
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'role' => 'admin',
            ],
            [
                'name' => 'staff',
                'username' => 'staff',
                'password' => Hash::make('staff'),
                'role' => 'staff',
            ],
        ];

        $result = User::query()->upsert($users, ['name', 'username', 'password', 'role']);

        self::assertEquals(2, $result);
    }

    public function testUpdate(): void
    {
        $user = new User([
            'name' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        $result = $user->save();

        self::assertTrue($result);

        $result = $user->update(['name' => 'Muhammad David']);

        self::assertTrue($result);
    }

    public function testUpdateMany(): void
    {
        $users = [
            [
                'name' => 'admin',
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'role' => 'staff',
            ],
            [
                'name' => 'staff',
                'username' => 'staff',
                'password' => Hash::make('staff'),
                'role' => 'staff',
            ],
        ];

        $result = User::query()->upsert($users, ['name', 'username', 'password', 'role']);

        self::assertEquals(2, $result);

        $result = User::query()->where('role', 'staff')->update(['role' => 'admin']);

        self::assertEquals(2, $result);
    }

    public function testDelete(): void
    {
        $user = new User([
            'name' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        $result = $user->save();

        self::assertTrue($result);

        $result = $user->delete();

        $user = User::query()->first();

        self::assertTrue($result);
        self::assertNull($user);
    }

    public function testDeleteMany(): void
    {
        $users = [
            [
                'name' => 'admin',
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'role' => 'admin',
            ],
            [
                'name' => 'staff',
                'username' => 'staff',
                'password' => Hash::make('staff'),
                'role' => 'staff',
            ],
        ];

        $result = User::query()->upsert($users, ['name', 'username', 'password', 'role']);

        self::assertEquals(2, $result);

        $users = User::all()->toArray();

        $result = User::destroy([$users[0]['id'], $users[1]['id']]);
        $users = User::all();

        self::assertEquals(2, $result);
        self::assertEquals(0, $users->count());
    }
}

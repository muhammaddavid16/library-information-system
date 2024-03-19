<?php

namespace Tests\Feature;

use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class MemberTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        DB::table('members')->delete();
    }

    public function testInsert(): void
    {
        $member = new Member([
            'nis' => '123123',
            'class' => '3.A',
            'name' => 'Budi Setiawan',
            'address' => 'Bekasi',
            'phone_number' => '081234567891',
        ]);

        $result = $member->save();

        self::assertTrue($result);
    }

    public function testInsertMany(): void
    {
        $members = [
            [
                'nis' => '123123',
                'class' => '3.A',
                'name' => 'Budi Setiawan',
            ],
            [
                'nis' => '12312',
                'class' => '3.B',
                'name' => 'Budi Setiadi',
            ],
        ];

        $result = Member::query()->upsert($members, ['nis', 'class', 'name']);

        self::assertEquals(2, $result);
    }

    public function testUpdate(): void
    {
        $member = new Member([
            'nis' => '123123',
            'class' => '3.A',
            'name' => 'Budi Setiawan',
            'address' => 'Bekasi',
            'phone_number' => '081234567891',
        ]);

        $result = $member->save();

        self::assertTrue($result);

        $result = $member->update([
            'nis' => '123456',
        ]);

        self::assertTrue($result);
    }

    public function testUpdateMany(): void
    {
        $members = [
            [
                'nis' => '123123',
                'class' => '3.A',
                'name' => 'Budi Setiawan',
            ],
            [
                'nis' => '12312',
                'class' => '3.B',
                'name' => 'Budi Setiadi',
            ],
        ];

        $result = Member::query()->upsert($members, ['nis', 'class', 'name']);

        self::assertEquals(2, $result);

        $result = Member::query()->where('address', null)->update(['address' => 'Bekasi']);

        self::assertEquals(2, $result);
    }

    public function testDelete(): void
    {
        $member = new Member([
            'nis' => '123123',
            'class' => '3.A',
            'name' => 'Budi Setiawan',
            'address' => 'Bekasi',
            'phone_number' => '081234567891',
        ]);

        $result = $member->save();

        self::assertTrue($result);

        $result = $member->delete();
        $member = Member::query()->first();

        self::assertTrue($result);
        self::assertNull($member);
    }

    public function testDeleteMany(): void
    {
        $members = [
            [
                'nis' => '123123',
                'class' => '3.A',
                'name' => 'Budi Setiawan',
            ],
            [
                'nis' => '12312',
                'class' => '3.B',
                'name' => 'Budi Setiadi',
            ],
        ];

        $result = Member::query()->upsert($members, ['nis', 'class', 'name']);

        self::assertEquals(2, $result);

        $members = Member::all()->toArray();
        $result = Member::destroy([$members[0]['id'], $members[1]['id']]);
        $members = Member::all();

        self::assertEquals(2, $result);
        self::assertEquals(0, $members->count());
    }
}

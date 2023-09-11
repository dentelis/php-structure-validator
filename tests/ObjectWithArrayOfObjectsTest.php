<?php
declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use tests\structs\StructFactory;

final class ObjectWithArrayOfObjectsTest extends TestCase
{

    public static function simpleProvider(): array
    {
        $color = (object)['r' => 0, 'g' => 0, 'b' => 10];
        return [
            ['data' => (object)['title' => 'bmw', 'colors' => [$color, $color]]],
            ['data' => (object)['title' => 'audi', 'colors' => [$color,]]],
        ];
    }

    #[DataProvider('simpleProvider')]
    public function testSimple(object $data): void
    {
        $struct = StructFactory::classWithArrayOfClass();
        $this->check($struct, $data);
    }

    protected function check(\EntelisTeam\Validator\Structure\_struct $struct, mixed $data): void
    {
        try {
            $struct->validate($data);
        } catch (\Throwable $e) {
            $this->assertNull($e);
        }
        $this->expectNotToPerformAssertions();
    }


}

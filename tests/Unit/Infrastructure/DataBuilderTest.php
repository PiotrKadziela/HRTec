<?php

namespace Tests\Unit\Infrastructure;

use App\Infrastructure\DataBuilder;
use PHPUnit\Framework\TestCase;
use SimplePie\Author;
use SimplePie\Item;

class DataBuilderTest extends TestCase
{
    /**
     * @test
     */
    public function shouldReturnArray(): void
    {
        $item1 = $this->createMock(Item::class);
        $item1->expects($this->once())
            ->method('get_title')
            ->willReturn('title1');
        $item1->expects($this->once())
            ->method('get_description')
            ->willReturn('description1');
        $item1->expects($this->once())
            ->method('get_link')
            ->willReturn('link1');
        $item1->expects($this->once())
            ->method('get_date')
            ->willReturn('date1');
        $author1 = $this->createMock(Author::class);
        $item1->expects($this->once())
            ->method('get_author')
            ->willReturn($author1);
        $author1->expects($this->once())
            ->method('get_name')
            ->willReturn('name1');

        $item2 = $this->createMock(Item::class);
        $item2->expects($this->once())
            ->method('get_title')
            ->willReturn('title2');
        $item2->expects($this->once())
            ->method('get_description')
            ->willReturn('description2');
        $item2->expects($this->once())
            ->method('get_link')
            ->willReturn('link2');
        $item2->expects($this->once())
            ->method('get_date')
            ->willReturn('date2');
        $author2 = $this->createMock(Author::class);
        $item2->expects($this->once())
            ->method('get_author')
            ->willReturn($author2);
        $author2->expects($this->once())
            ->method('get_name')
            ->willReturn('name2');

        $dataBuilder = new DataBuilder();

        self::assertSame(
            [
                ['title1', 'description1', 'link1', 'date1', 'name1'],
                ['title2', 'description2', 'link2', 'date2', 'name2'],
            ],
            $dataBuilder->build([$item1, $item2])
        );
    }
}

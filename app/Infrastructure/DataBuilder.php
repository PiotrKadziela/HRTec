<?php

namespace App\Infrastructure;

use App\Domain\DataBuilderInterface;
use SimplePie\Item;

class DataBuilder implements DataBuilderInterface
{
    /**
     * @param array<Item> $items
     * @return array
     */
    public function build(array $items): array
    {
        $data = [];

        foreach ($items as $item) {
            $data[] = [
                $item->get_title(),
                preg_replace(
                    '/\b(https?):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i',
                    ' ',
                    strip_tags($item->get_description())
                ),
                $item->get_link(),
                $item->get_date('j F Y G:i:s'),
                $item->get_author()->get_name()
            ];
        }

        return $data;
    }
}

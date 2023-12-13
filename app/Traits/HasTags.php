<?php
namespace App\Traits;

use Spatie\Tags\HasTags as HasSpatieTags;
trait HasTags
{
    use HasSpatieTags;

    public function syncTagsFromString(string $tags): static
    {
        $tags = collect(explode(',', $tags))->map(fn($value) => trim($value));
        return $this->syncTags($tags);
    }
}

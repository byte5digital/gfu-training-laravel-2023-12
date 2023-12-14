<?php
namespace App\Traits;

use Spatie\Tags\HasTags as HasSpatieTags;
trait HasTags
{
    use HasSpatieTags;

    public function syncTagsFromString(string $tags): self
    {
        $tags = collect(explode(',', $tags))->map(fn($value) => trim($value))->filter();
        return $this->syncTags($tags);
    }
}

<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;

it('has posts page', function () {
    $response = $this->get('/posts');

    $response->assertStatus(200);
});

it('has forbidden creation-page for guests', function() {
    $response = $this->get('/posts/create');

    $response->assertStatus(302)
        ->assertSessionHasNoErrors();
});

it('has creation-page for authenticated users', function() {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/posts/create');

    $response->assertStatus(200);
});

it('can post be created for users', function() {
    $user = User::factory()->create();

    $testTitle = 'Test Post';

    $response = $this->actingAs($user)->post('/posts', [
        'user_id' => $user->getKey(),
        'title' => $testTitle,
        'text'  => 'Long text to test if a post can be created. Long text to test if a post can be created. Long text to test if a post can be created. Long text to test if a post can be created. Long text to test if a post can be created. Long text to test if a post can be created. Long text to test if a post can be created. Long text to test if a post can be created. Long text to test if a post can be created. Long text to test if a post can be created.',
        'tags'  => 'Tag1, Tag2',
    ]);
    $response->assertStatus(302);
    $response->assertRedirect('/posts');

    $this->assertDatabaseHas('posts', [
        'title' => $testTitle,
    ]);
});

it('will be created a slug for new posts', function() {
    $user = User::factory()->create();

    $testTitle = 'Test Post';

    $response = $this->actingAs($user)->post('/posts', [
        'user_id' => $user->getKey(),
        'title' => $testTitle,
        'text'  => 'Long text to test if a post can be created. Long text to test if a post can be created. Long text to test if a post can be created. Long text to test if a post can be created. Long text to test if a post can be created. Long text to test if a post can be created. Long text to test if a post can be created. Long text to test if a post can be created. Long text to test if a post can be created. Long text to test if a post can be created.',
        'tags'  => 'Tag1, Tag2',
    ]);
    $response->assertStatus(302);
    $response->assertRedirect('/posts');

    $this->assertDatabaseHas('posts', [
        'slug' => Str::slug($testTitle),
    ]);
});

it('cannot create posts with short text', function() {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/posts', [
        'user_id' => $user->getKey(),
        'title' => 'Test Post',
        'text'  => 'Short text',
        'tags'  => 'Tag1, Tag2',
    ]);

    $response->assertStatus(302)
        ->assertRedirect('/')
        ->assertSessionHasErrors();

    $errors = session('errors');
    /** @var MessageBag $errors */

    $this->assertTrue($errors->has('text'));
    $this->assertSame($errors->get('text')[0], 'The text field must be at least 50 characters.');

    $this->assertDatabaseCount('posts', 0);
});

it('can be edited a post', function() {
    User::factory()->create();
    $post = Post::factory()->create();
    $user = $post->user;
    /** @var User $user */

    $editedTitle = 'Edited Title';
    $response = $this->actingAs($user)->put('/posts/' . $post->slug, [
        'title' => $editedTitle,
        'text'  => $post->text,
        'tags'  => $post->tags->implode(', '),
    ]);

    $response->assertStatus(302)
        ->assertSessionHasNoErrors();

    $this->assertDatabaseHas('posts', [
        'title' => $editedTitle,
    ]);
});

it('can be deleted a post', function() {
    $user = User::factory()->create();
    $post = Post::factory()->create();

    $response = $this->actingAs($user)->delete('/posts/' . $post->slug);

    $response->assertStatus(302)
        ->assertSessionHasNoErrors();

    $this->assertDatabaseMissing('posts', [
        'deleted_at' => null,
    ]);
});

<?php

it('admin dapat membaca data monitoring awal melalui notifikasi', function (): void {
    $this->actingAs(makeFeatureUser('Admin'));

    $this->getJson('/api/notifications')
        ->assertOk()
        ->assertJsonStructure([
            'items' => [
                '*' => ['key', 'label', 'ids', 'latest_id', 'module'],
            ],
        ]);
});

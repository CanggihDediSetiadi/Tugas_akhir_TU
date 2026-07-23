<?php

it('admin dapat membuka halaman dashboard setelah login', function (): void {
    $this->actingAs(makeFeatureUser('Admin'));

    $this->get('/admin')
        ->assertOk()
        ->assertSee('Dashboard');
});

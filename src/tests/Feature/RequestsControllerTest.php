<?php

describe('Requests Controller', function () {

    test('A valid request from a library manager receive a response status 200 with the correct data', function () {

        Http::fake([
            '*/api/reservations' => Http::response([
                'requester' => 'biblio x',
                'date_from' => '2024-03-01 12:00:00',
                'date_to' => '2024-03-10 12:00:00',
                'book' => [
                    'id' => 1,
                    'title' => 'book title',
                    'author' => 'book author',
                    'published_at' => '2020-01-01',
                    'isbn' => '1234567890123',
                ],
            ], 200),
        ]);

        $jsonResponse = $this->getJson('/api/requests/reservations/valid')
            ->assertStatus(200)
            ->assertJson([
                'requester' => 'biblio x',
                'date_from' => '2024-03-01 12:00:00',
                'date_to' => '2024-03-10 12:00:00',
                'book' => [
                    'id' => 1,
                    'title' => 'book title',
                    'author' => 'book author',
                    'published_at' => '2020-01-01',
                    'isbn' => '1234567890123',
                ],
            ]);
    });

    test('A not valid request from a library manager receive a response status 422 with the errors info', function () {

        Http::fake([
            '*/api/reservations' => Http::response([
                'message' => 'The date from field must be a date before or equal to date to. (and 1 more error)',
                'errors' => [
                    'date_from' => [
                        'The date from field must be a date before or equal to date to.',
                    ],
                    'date_to' => [
                        'The date to field must be a date after or equal to date from.',
                    ],
                ],
            ], 422),
        ]);

        $jsonResponse = $this->getJson('/api/requests/reservations/not-valid')
            ->assertStatus(422)
            ->assertJson([
                'error' => 'API request failed',
                'response' => [
                    'message' => 'The date from field must be a date before or equal to date to. (and 1 more error)',
                    'errors' => [
                        'date_from' => [
                            'The date from field must be a date before or equal to date to.',
                        ],
                        'date_to' => [
                            'The date to field must be a date after or equal to date from.',
                        ],
                    ],
                ],
            ]);
    });

});

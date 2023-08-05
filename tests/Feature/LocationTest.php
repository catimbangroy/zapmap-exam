<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LocationTest extends TestCase
{
    public function testNoLocationFound(): void
    {
        $params = '?latitude=1&longitude=-1.80980069169524&radius=0';
        $response = $this->get('api/locations' . $params);
        $response->assertStatus(404);
        $response->assertExactJson([
            'errors' => 'No locations found.'
        ]);
    }

    public function testLocationFound(): void
    {
        $params = '?latitude=51.4720288546056&longitude=-1.80980069169524&radius=20';
        $response = $this->get('api/locations' . $params);
        $response->assertStatus(200);
        $array = json_decode('{
            "data": [
                {
                    "id": 1,
                    "name": "Museum Inn",
                    "latitude": 51.60398385376592,
                    "longitude": -1.96649082603195
                },
                {
                    "id": 10,
                    "name": "Holiday Inn Elstree",
                    "latitude": 51.58795710176158,
                    "longitude": -1.75274026779778
                },
                {
                    "id": 22,
                    "name": "6 Nansen Road",
                    "latitude": 51.41743187735718,
                    "longitude": -1.98512655633444
                },
                {
                    "id": 63,
                    "name": "Tesco Extra Merthyr Tydfil",
                    "latitude": 51.43288775670301,
                    "longitude": -1.68239879314892
                },
                {
                    "id": 88,
                    "name": "22 Preston Road",
                    "latitude": 51.4720288546056,
                    "longitude": -1.80980069169524
                },
                {
                    "id": 112,
                    "name": "Fitzroy Court",
                    "latitude": 51.41198069577813,
                    "longitude": -1.99404862818395
                },
                {
                    "id": 134,
                    "name": "First Flexi Lease",
                    "latitude": 51.58724055198066,
                    "longitude": -1.61952939942366
                },
                {
                    "id": 137,
                    "name": "Billingham Forum",
                    "latitude": 51.61341151184067,
                    "longitude": -1.70099952884316
                },
                {
                    "id": 138,
                    "name": "St Aloysius School",
                    "latitude": 51.52439322803315,
                    "longitude": -2.0204490059464097
                },
                {
                    "id": 156,
                    "name": "Playbox Theatre",
                    "latitude": 51.62373147297192,
                    "longitude": -1.81181690954972
                },
                {
                    "id": 167,
                    "name": "Lidl Bucksburn",
                    "latitude": 51.59694034430917,
                    "longitude": -1.62734328442835
                },
                {
                    "id": 177,
                    "name": "Travelodge Beckton",
                    "latitude": 51.57233258478235,
                    "longitude": -1.85364906484031
                },
                {
                    "id": 196,
                    "name": "Bell Road Car Park Hounslow Station",
                    "latitude": 51.63792022377141,
                    "longitude": -1.81753966647157
                }
            ]
        }', true);
        $response->assertExactJson($array);
    }

    public function testInvalidLatitude(): void
    {
        $params = '?latitude=a&longitude=-1.80980069169524&radius=0';
        $response = $this->get('api/locations' . $params);
        $response->assertStatus(302);
    }

    public function testNoLatitude(): void
    {
        $params = '?longitude=-1.80980069169524&radius=0';
        $response = $this->get('api/locations' . $params);
        $response->assertStatus(302);
    }
}

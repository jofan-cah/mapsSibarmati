<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        // Ambil semua data lokasi dari model Location
        $locations = Location::all();
        return view('admin.map', compact('locations'));
    }

    public function nearestRoute(Request $request)
    {
        // Ambil lokasi dari inputan pengguna
        $locationInput = $request->input('location');

        // Pecah inputan menjadi array dengan delimiter koma
        $locationParts = explode(',', $locationInput);

        // Pastikan format inputan sesuai dengan yang diharapkan (misalnya: latitud, longitud)
        if (count($locationParts) != 2 || !is_numeric($locationParts[0]) || !is_numeric($locationParts[1])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid location format'
            ]);
        }

        // Ambil koordinat latitud dan longitud dari inputan pengguna
        $latitude = $locationParts[0];
        $longitude = $locationParts[1];

        // Format data lokasi dari inputan pengguna untuk respons
        $start = [
            'lat' => $latitude,
            'lng' => $longitude
        ];

        // Ambil lokasi dari database
        $locations = Location::all();

        // Inisialisasi variabel untuk menyimpan jarak terpendek dan lokasi terdekat
        $shortestDistance = null;
        $nearestLocation = null;

        // Loop melalui semua lokasi dari model Location
        foreach ($locations as $location) {
            // Hitung jarak antara lokasi dari inputan pengguna dan lokasi dari model Location
            $distance = $this->haversineGreatCircleDistance(
                $latitude,
                $longitude,
                $location->latitude,
                $location->longitude
            );

            // Jika ini adalah lokasi pertama yang diperiksa atau jaraknya lebih pendek dari jarak terpendek yang sebelumnya,
            // maka update nilai jarak terpendek dan lokasi terdekat
            if ($shortestDistance === null || $distance < $shortestDistance) {
                $shortestDistance = $distance;
                $nearestLocation = $location;
            }
        }

        // Jika tidak ada lokasi yang ditemukan di model Location
        if (!$nearestLocation) {
            return response()->json([
                'status' => 'error',
                'message' => 'No locations found in database'
            ]);
        }

        // Format data lokasi terdekat untuk respons
        $end = [
            'lat' => $nearestLocation->latitude,
            'lng' => $nearestLocation->longitude
        ];

        // Menggunakan Leaflet Routing Machine untuk mencari rute terdekat
        return response()->json([
            'status' => 'success',
            'start' => $start,
            'end' => $end
        ]);
    }

    private function haversineGreatCircleDistance($lat1, $lng1, $lat2, $lng2, $earthRadius = 6371)
    {
        // Convert degree to radians
        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lng1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lng2);

        // Compute differences between latitudes and longitudes
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        // Calculate the angle
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        // Calculate the distance
        $distance = $angle * $earthRadius;

        return $distance;
    }
}
